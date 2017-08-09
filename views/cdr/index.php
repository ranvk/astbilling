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

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
