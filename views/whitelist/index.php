<?php

use yii\helpers\Html;
use app\widgets\GridView;
use yii\widgets\Pjax;
use app\models\Whitelist;
/* @var $this yii\web\View */
/* @var $searchModel app\models\WhitelistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Whitelists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="whitelist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Whitelist'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'prefixnum',
            'provider',
            [
                'attribute' => 'status',
                'value'=> function($model){
                    return  Whitelist::getStatus($model->status);
                },
                'filter' => Whitelist::getStatus(),
            ],
            'remark:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
