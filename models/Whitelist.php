<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "whitelist".
 *
 * @property int $id
 * @property int $prefixnum 呼入前缀
 * @property int $provider 供应商
 * @property int $status 状态
 * @property string $remark 备注
 */
class Whitelist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'whitelist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prefixnum', 'provider', 'status'], 'integer'],
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
            'prefixnum' => Yii::t('app', 'Prefixnum'),
            'provider' => Yii::t('app', 'Provider'),
            'status' => Yii::t('app', 'Status'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }
}
