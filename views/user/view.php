<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '号码列表';
?>
<div class="user-view">
    <div class="row">
        <div class="col-md-12">
            号码列表
        </div>
        <div class="col-md-12">
            <ul class="list-group">
                <?php if (isset($model) && is_array($model)): ?>
                    <?php foreach ($model as $key => $value): ?>
                        <li class="list-group-item">
                            <?= $value->number ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
