<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phone".
 *
 * @property int $id
 * @property int $number 中继号码
 * @property int $type 类型
 * @property int $status 状态
 * @property string $remark 备注
 *
 * @property UserPhone[] $userPhones
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'type', 'status'], 'integer'],
            [['remark'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPhones()
    {
        return $this->hasMany(UserPhone::className(), ['phoneid' => 'id']);
    }
}
