<?php

/**
 * file PoemForm.php 诗文表单
 */

namespace frontend\models;

use common\models\CollectModel;
use common\models\PoemExtendModel;
use common\models\RelationUpoemTagModel;
use common\models\UcollectModel;
use common\models\UpoemExtendModel;
use common\models\UpoemModel;
use Yii;
use common\models\PoemModel;
use yii\base\Exception;
use yii\base\Model;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class PoemForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;

    public $_lastError = '';  //报错内容

    /**
     * 定义事件
     * EVENT_AFTER_CREATE 创建之后的事件
     * EVENT_AFTER_UPDATE 更新之后的事件
     */
    const EVENT_AFTER_CREATE = 'eventAfterCreate';
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';

    /**
     * 定义场景
     * SCENARIOS_CREATE 创建
     * SCENARIOS_UPDATE 更新
     */
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';

    public function rules()
    {
        return [
            [['id', 'title', 'content', 'cat_id'], 'required'],
            [['id', 'cat_id'], 'integer'],
            ['title', 'string', 'min' => 1, 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '编码',
            'title' => '标题',
            'content' => '内容',
            'label_img' => '标签图',
            'cat_id' => '分类',
            'tags' => '标签',
        ];
    }

    /**
     * 定义创建和更新诗文的场景
     * @return array
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
            self::SCENARIOS_UPDATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
        ];

        return array_merge(parent::scenarios(), $scenarios);
    }

    /**
     * 获取诗文列表
     * @param $cond  查询条件
     * @param int $curPage 选择后的当前页
     * @param int $pageSize 页面显示的条数
     * @param bool $original 是否为原创诗文
     * @param array $orderBy 排序,默认降序
     * @return array
     */
    public static function getList($cond, $curPage = 1, $pageSize = 10, $original = false, $orderBy = ['id' => SORT_DESC])
    {

        //是否为原创诗文
        $model = $original ? new UpoemModel() : new PoemModel();

        //查询语句
        $query = $model->find()
            ->where($cond)
            ->with('relate.tag', 'extend', 'relateStat.collect')
            ->orderBy($orderBy);

        //获取分页数据咯
        $res = $model->getPages($query, $curPage, $pageSize);
        //格式化数据
        $res['data'] = self::_formatList($res['data']);
        return $res;
    }

    /**
     * 获取收藏诗文列表
     * @param int $curPage
     * @param int $pageSize
     * @param bool $original
     * @param array $orderBy
     * @return array
     */
    public static function getCollect($curPage = 1, $pageSize = 10, $original = false, $orderBy = ['updated_at' => SORT_DESC, 'id' => SORT_DESC])
    {
        //是否为原创诗文
        $model = $original ? new UpoemModel() : new PoemModel();

        //排序
        $subOrder = [];
        foreach ($orderBy as $k => $v) {
            $subOrder['collect.' . $k] = $v;
        }
        //查询语句
        $query = $model->find()
            ->where([
                'status' => PoemModel::IS_VALID,
                'collect.status' => PoemModel::IS_VALID,
                'collect.user_id' => $_SESSION['user_id'],
            ])
            ->joinWith([
                'relate.tag',
                'relateStat.collect as collect',
                'extend'
            ])
            ->orderBy($subOrder);

        //获取分页数据咯
        $res = $model->getPages($query, $curPage, $pageSize, null, $collect = true);
        //格式化数据
        $res['data'] = self::_formatList($res['data']);
        return $res;
    }

    /**
     * 格式化数据
     * 把tag从relate从数据中挑出来,并释放掉relate
     * @param $data
     * @return mixed
     */
    private static function _formatList($data)
    {
        foreach ($data as &$list) { //注意,&按引用传递

            //格式化标签数据
            $list['tags'] = [];
            if (isset($list['relate']) && !empty($list['relate'])) {
                foreach ($list['relate'] as $item) {
                    $list['tags'][] = $item['tag']['tag_name'];
                }
            }
            unset($list['relate']); //释放掉relate

            //格式化收藏数据
            if (isset($list['relateStat']['collect']) && !empty($list['relateStat']['collect'])) {
                $list['collect'] = $list['relateStat']['collect'];
            }
            unset($list['relateStat']); //释放掉relateStat
        }
        return $data;
    }

    /**
     * 创建诗文
     * @return bool
     */
    public function create()
    {
        //事务
        //这里的采取事务是为了防止创建文章时,因某些原因,一些数据insert进了数据库
        //而一些数据没有insert进数据库,造成了表联系的混乱,而事务的回滚则能防止这类事情的发生
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new UpoemModel();
            $model->setAttributes($this->attributes);
            $model->summary = $this->_getSummary();
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->is_valid = UpoemModel::IS_VALID;
            $model->updated_at = time();
            $model->created_at = time();
            if (!$model->save()) {
                throw  new Exception('文章保存失败!');
            }
            $this->id = $model->id;
            //调用事件
            $data = array_merge($this->attributes, $model->attributes); //将tags合并进数组里
            $this->_eventAfterCreate($data);

            //提交事务
            $transaction->commit();
            return true;
        } catch (Exception $ex) {
            $transaction->rollBack();   //事务回滚
            $this->_lastError = $ex->getMessage();    //获取错误信息
            return false;
        }
    }

    /**
     * 获取诗文摘要
     * @param int $start 截取文本的开始位置
     * @param int $end 截取文本的结束位置
     * @param string $char 字符编码
     * @return null|string
     */
    private function _getSummary($start = 0, $end = 90, $char = 'utf-8')
    {
        //假若文章无内容,返回null
        if (empty($this->content)) {
            return null;
        }

        //注意清除文本内容里的空格和html或php代码
        return mb_substr(str_replace('&nbsp;', '', strip_tags($this->content)), $start, $end, $char);
    }

    /**
     * 诗文创建之后的事件
     * @param $data
     */
    private function _eventAfterCreate($data)
    {
        //添加事件
        $this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
        //触发事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    /**
     * 添加标签
     * @param $event
     * @throws Exception
     */
    public function _eventAddTag($event)
    {
        //保存标签
        $tag = new TagForm();
        $tag->tags = $event->data['tags'];
        $tagids = $tag->saveTags();

        //删除原先的关联关系
        RelationUpoemTagModel::deleteAll(['upoem_id' => $event->data['id']]);

        //批量保存标签和诗文的关联关系
        if (!empty($tagids)) {
            foreach ($tagids as $k => $v) {
                $row[$k]['upoem_id'] = $this->id;
                $row[$k]['tag_id'] = $v;
            }

            //批量插入
            $res = (new Query())->createCommand()
                ->batchInsert(RelationUpoemTagModel::tableName(), ['upoem_id', 'tag_id'], $row)
                ->execute();

            if (!$res) {
                throw new Exception('关系关联保存失败!');
            }
        }
    }

    /**
     * 根据主键获取诗文信息
     * @param $id 主键
     * @param $original 是否为原创诗文
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getViewById($id, $original = false)
    {
        //判断是否为原创
        $model = $original ? new UpoemModel() : new PoemModel();
        $res = $model->find()
            ->with('relate.tag', 'extend')
            ->where(['id' => $id])
            ->asArray()
            ->one();
        if (!$res) {
            throw new NotFoundHttpException('诗文不存在。');
        }

        //处理标签格式
        $res['tags'] = [];
        if (isset($res['relate']) && !empty($res['relate'])) {
            foreach ($res['relate'] as $item) {
                $res['tags'][] = $item['tag']['tag_name'];
            }
        }
        unset($res['relate']);
        return $res;
    }
}