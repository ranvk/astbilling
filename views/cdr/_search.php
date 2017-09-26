<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\CdrSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cdr-search row" style="margin: 10px;">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="col-md-3" style="padding: 0px 5px">
        <?= $form->field($model, 'from_date')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss',
            ]
        ]); ?>
    </div>
    <div class="col-md-3" style="padding: 0px 5px">
        <?= $form->field($model, 'to_date')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => ''],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss',
            ]
        ]); ?>
    </div>

    <div class="col-md-2" style="padding: 0px 5px">
        <?= $form->field($model, 'src') ?>
    </div>
    <div class="col-md-2" style="padding: 0px 5px">
        <?= $form->field($model, 'dst') ?>
    </div>

    <div class="col-md-1" style="padding: 0px 5px">
        <?= $form->field($model, 'nobillsec')->label('不计秒数') ?>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
