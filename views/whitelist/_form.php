<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Whitelist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="whitelist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prefixnum')->textInput() ?>

    <?= $form->field($model, 'provider')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
