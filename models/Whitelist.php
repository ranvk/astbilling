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
    const WHITELIST_INACTIVE = 0;
    const WHITELIST_ACTIVE = 1;

    const PROVIDER_CMCC = 0; //移动
    const PROVIDER_CUCC = 1; //联通
    const PROVIDER_CTCC = 2; //电信

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

    public static function getStatus($status = null)
    {
        $allstatus = [
            self::WHITELIST_INACTIVE => \Yii::t('app', 'Inactive'),
            self::WHITELIST_ACTIVE => \Yii::t('app', 'Active'),
        ];
        if (isset($status)) {
            return $allstatus[$status];
        } else {
            return $allstatus;
        }
    }
    public static function getProvider($provider = null)
    {
        $allprovider = [
            self::PROVIDER_CMCC => \Yii::t('app', 'CMCC'),
            self::PROVIDER_CUCC => \Yii::t('app', 'CUCC'),
            self::PROVIDER_CTCC => \Yii::t('app', 'CTCC'),
        ];
        if (isset($provider)) {
            return $allprovider[$provider];
        } else {
            return $allprovider;
        }
    }

}
