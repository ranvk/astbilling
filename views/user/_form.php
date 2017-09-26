<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFIle('@web/css/multi-select.css');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?=$form->field($model, '_phone')->dropDownList(\app\models\Phone::MapPhone(),
        ['id' => 'phone_multiple','multiple' => 'multiple'])?>

    <?= $form->field($model, 'float')->dropDownList(User::getFloat()) ?>

    <?= $form->field($model, 'status')->dropDownList(User::getStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$css = <<<cs
.selhost{
width: 100%;
margin:0px auto;
}
cs;

$this->registerCss($css);
$this->registerJsFile('@web/js/jquery.multi-select.js', [
'position' => \yii\web\View::POS_END,
'depends' => "yii\web\JqueryAsset", ]);
$this->registerJsFile('@web/js/jquery.quicksearch.js', [
'position' => \yii\web\View::POS_END,
'depends' => "yii\web\JqueryAsset", ]);
?>
<?php \app\widgets\JsBlock::begin() ?>
<script type="text/javascript">

    $(function(){
        $('#phone_multiple').multiSelect({
            keepOrder: true,
            selectableHeader: "<input type='text' class='search-input form-control' id ='selhosttids'  autocomplete='off' placeholder='筛选未选号码'>",
            selectionHeader: "<input type='text' class='search-input form-control' id ='selectedhosttids' autocomplete='off' placeholder='筛选已选号码'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            cssClass:"selhost",
        });
        //hostid选中状态
//        $('#hostsmultiple').multiSelect();
//        $('#hostsmultiple').multiSelect('select', <?//=json_encode($model->hostids) ?>//);

    });

</script>
<?php \app\widgets\JsBlock::end()?>
