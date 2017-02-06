<?php

/**
 * file BannerWidget.php 图片轮播小部件
 */

namespace frontend\widgets\banner;

use yii\bootstrap\Widget;

class BannerWidget extends Widget
{

    public $items = [];

    public function init()
    {

        if (empty($this->items)) {
            $this->items = [
                [
                    'label' => 'banner_img',
                    'image_url' => '/statics/images/banner/b_0.png',
                    'url' => ['post/index'],
                    'html' => '',
                    'active' => 'active',
                ],
                [
                    'label' => 'banner_img',
                    'image_url' => '/statics/images/banner/b_0.png',
                    'url' => ['post/index'],
                    'html' => '',
                    'active' => '',
                ],
                [
                    'label' => 'banner_img',
                    'image_url' => '/statics/images/banner/b_0.png',
                    'url' => ['post/index'],
                    'html' => '',
                    'active' => '',
                ],
            ];
        }
    }

    public function run()
    {
        $data['items'] = $this->items;
        return $this->render('index', ['data' => $data]);
    }
}


