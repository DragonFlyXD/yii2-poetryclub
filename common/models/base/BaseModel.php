<?php

/**
 * 基类模型
 */

namespace common\models\base;

use common\models\PoemExtendModel;
use common\models\UpoemExtendModel;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    /**
     * 获取分页数据
     * @param $query        查询语句
     * @param int $curPage 选择后的当前页
     * @param int $pageSize 页面显示的条数
     * @param null $search 查询条件
     * @param false $collect 是否为收藏分页
     * @return array
     */
    public function getPages($query, $curPage = 1, $pageSize = 10, $search = null, $collect = false)
    {
        //如果有附加查询条件,则执行之
        if ($search) {
            $query->andFilterWhere($search);
        }

        //作收藏分页的时候不知道为什么count后的数目不对,/(ㄒoㄒ)/~~,待解决??????
        $fade_query=$query;
        $data['count'] = $collect ? count($fade_query->asArray()->all()) : $query->count();
        if (!$data['count']) {  //如果无数据,返回一个空内容数组
            return ['count' => 0, 'curPage' => $curPage, 'pageSize' => $pageSize,
                'start' => 0, 'end' => 0, 'data' => []];
        }

        //若用户选择的页数大于实际页数,则取当前页。否则,取跳转页数。
        $curPage = (ceil($data['count'] / $pageSize) < $curPage)
            ? ceil($data['count'] / $pageSize) : $curPage;
        //当前页
        $data['curPage'] = $curPage;
        //每页显示条数
        $data['pageSize'] = $pageSize;
        //起始页
        $data['start'] = ($curPage - 1) * $pageSize + 1;
        //末页 如果总页数等于当前页,则当前页为末页。否则,则取当前页的后一页为末页。
        $data['end'] = (ceil($data['count'] / $pageSize) == $curPage)
            ? $data['count'] : ($curPage - 1) * $pageSize + $pageSize;
        //数据
        $data['data'] = $query->offset(($curPage - 1) * $pageSize)
            ->limit($pageSize)
            ->asArray()
            ->all();

        return $data;
    }

    /**
     * 更新诗文统计
     * @param $cond 查询条件
     * @param $attribute 待更新的字段
     * @param $num 增加的次数
     * @param $original 是否为原创诗诗文
     * @return bool
     */
    public function upCounter($cond, $attribute, $num, $original = false)
    {
        $model = $original ? new UpoemExtendModel() : new PoemExtendModel();
        $counter = $model::findOne($cond);
        if (!$counter) { //如果没有统计过该字段,则创建它
            $model->setAttributes($cond);
            $model->$attribute = $num; //设置待更新的字段的值
            if (!$model->save()) {
                return false;
            }
            return true;
        } else {    //有则,更新它
            $countData[$attribute] = $num;
            if (!$counter->updateCounters($countData)) {
                return false;
            }
            return true;
        }
    }
}