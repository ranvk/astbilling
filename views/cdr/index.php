<?php

use yii\helpers\Html;
use app\widgets\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CdrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cdrs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdr-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
