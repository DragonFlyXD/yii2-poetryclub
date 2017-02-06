<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() //防御scrf攻击                        ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="' . Yii::$app->params['common']['logo'] . '" alt="' . Yii::t('common', 'Poetry Club') . '">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'id' => 'nav',
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $LeftItems = [
        ['label' => Yii::t('common', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('common', 'Library'), 'url' => ['/poem/index']],
        ['label' => Yii::t('common', 'Original'), 'url' => ['/original/index']],
    ];
    //如果是游客
    if (Yii::$app->user->isGuest) {
        $RightItems[] = ['label' => Yii::t('common', 'Signup'), 'url' => ['/site/signup']];
        $RightItems[] = ['label' => Yii::t('common', 'Login'), 'url' => ['/site/login']];
    } else {    //已登录的用户
        $RightItems[] = [
            'label' => '<img src="' . (Yii::$app->user->identity->avatar ?: Yii::$app->params['avatar']['small']) . '" alt="' . Yii::$app->user->identity->username . '">',
            'linkOptions' => ['class' => 'avatar'],
            'items' => [
                ['label' => '<i class="fa fa-user-circle"></i>&nbsp;个人中心', 'url' => ['user/index','id'=>Yii::$app->user->identity->id]],
                ['label' => '<div class="u-line"></div>'],
                ['label' => '<i class="fa fa-sign-out"></i>&nbsp;退出登录', 'url' => ['site/logout'], 'linkOptions' => ['data-method' => 'post'],],
            ],
        ];
    }
    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav navbar-left'
        ],
        'items' => $LeftItems,
    ]);
    echo Nav::widget([
        'options' => [
            'id' => 'header-avatar',
            'class' => 'navbar-nav navbar-right',
        ],
        'encodeLabels' => false,
        'items' => $RightItems,
    ]);
    NavBar::end();
    ?>

    <div class="container" id="outer">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-center text-muted" style="font-size: .8em">Copyright &copy; 2017 Designed by DragonFly. All rights reserved.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
