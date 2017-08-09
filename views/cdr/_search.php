<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CdrSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cdr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uniqueid') ?>

    <?= $form->field($model, 'userfield') ?>

    <?= $form->field($model, 'accountcode') ?>

    <?= $form->field($model, 'src') ?>

    <?php // echo $form->field($model, 'dst') ?>

    <?php // echo $form->field($model, 'dcontext') ?>

    <?php // echo $form->field($model, 'clid') ?>

    <?php // echo $form->field($model, 'channel') ?>

    <?php // echo $form->field($model, 'dstchannel') ?>

    <?php // echo $form->field($model, 'lastapp') ?>

    <?php // echo $form->field($model, 'lastdata') ?>

    <?php // echo $form->field($model, 'calldate') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'billsec') ?>

    <?php // echo $form->field($model, 'disposition') ?>

    <?php // echo $form->field($model, 'amaflags') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
