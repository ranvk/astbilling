<?php

use yii\helpers\Html;
use app\widgets\GridView;
use yii\widgets\Pjax;
use app\models\Phone;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Phones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Phone'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Phone::getStatus($model->status);
                },
                'filter' => Phone::getStatus(),
            ],
            [
                'label' => '已分配的用户',
                'value' => function ($model) {
                    $users = $model->users;
                    if ($users) {
                        $userarr = \yii\helpers\ArrayHelper::getColumn($users, 'username');
                        $userstr = implode('、', $userarr);
                    } else {
                        $userstr = '未分配';
                    }
                    return $userstr;
                },
            ],
            'remark:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
