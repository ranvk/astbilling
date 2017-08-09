<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CdrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cdrs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdr-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cdr', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uniqueid',
            'userfield',
            'accountcode',
            'src',
            // 'dst',
            // 'dcontext',
            // 'clid',
            // 'channel',
            // 'dstchannel',
            // 'lastapp',
            // 'lastdata',
            // 'calldate',
            // 'duration',
            // 'billsec',
            // 'disposition',
            // 'amaflags',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
