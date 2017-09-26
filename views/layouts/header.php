<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle">
                        <span class="hidden-xs"><?=Yii::$app->user->identity->username?></span>
                    </a>

                </li>
                <li class="dropdown user user-menu">
                    <?= Html::a(
                        '<span class="hidden-xs">登出</span>',
                        ['/site/logout'],
                        ['data-method' => 'post', 'class' => 'dropdown-toggle']
                    ) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
