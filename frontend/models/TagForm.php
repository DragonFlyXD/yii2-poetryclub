<?php

/**
 * file TagsForm.php 标签表单
 */
namespace frontend\models;

use common\models\TagModel;
use yii\base\Exception;
use yii\base\Model;

class TagForm extends Model
{
    public $id;
    public $tags;

    public function rules()
    {
        return [
            ['tags', 'required'],
            ['tags', 'each', 'rule' => ['string']], //遍历,tags是string的集合
        ];
    }

    /**
     * 保存标签集合
     * @return array 标签id集合
     */
    public function saveTags()
    {
        $ids = [];
        if (!empty($this->tags)) {
            foreach ($this->tags as $tag) {
                $ids[] = $this->_saveTag($tag);
            }
        }

        return $ids;
    }

    /**
     * 单个保存标签
     * @param $tag
     * @return int|mixed
     * @throws Exception
     */
    private function _saveTag($tag)
    {
        $model = new TagModel();
        $res = $model->find()
            ->where(['tag_name' => $tag])
            ->one();
        if (!$res) {    //如果没有找到标签,则新添加一条
            $model->tag_name = $tag;
            $model->poem_num = 1;
            if (!$model->save()) {
                throw new Exception('标签添加失败!');
            }

            return $model->id;
        } else {    //如果有找到,则使该标签与诗文的关联数加1
            $model->updateCounters(['poem_num' => 1]);
        }

        return $res->id;
    }
}