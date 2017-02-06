<?php

/**
 * file chatWidget.php 聊天版小部件
 */
namespace frontend\widgets\chat;

use frontend\models\UfeedForm;
use yii\bootstrap\Widget;
use frontend\models\FeedForm;
use yii\helpers\ArrayHelper;

class ChatWidget extends Widget
{
    public $config = [];

    public function init()
    {
        $_config = [
            'original' => false,  //判断是否原创诗文
        ];
        $this->config = ArrayHelper::merge($_config, $this->config);
    }

    public function run()
    {
        $this->config['original'] ? $model = new UfeedForm() : $model = new FeedForm();
        $data['feed'] = $model->getList();
        $data['p_id'] = isset($_GET['id']) ? $_GET['id'] : 0;
        return $this->render('index', ['data' => $data, 'config' => $this->config]);
    }
}