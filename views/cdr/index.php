<?php

use yii\helpers\Html;
use app\widgets\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CdrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cdrs');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    'src',
    [
        'label' => '号码归属地',
        'attribute' => 'src',
        'value' => 'srcArea',
    ],
    [
        'label' => '所属运营商',
        'attribute' => 'src',
        'value' => 'srcTelecom',
    ],
    [
        'attribute' => 'dst',
        'value' => 'dstnum',
    ],
    'calldate',
    'billsec',

];
?>
<div class="cdr-index">
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
