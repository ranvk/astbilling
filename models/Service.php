<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $host ip
 * @property int $port socket端口
 * @property int $trunk 中继数量
 * @property int $status 状态
 * @property string $remark 备注
 */
class Service extends \yii\db\ActiveRecord
{

    const SERVICE_INACTIVE = 0;
    const SERVICE_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['port', 'trunk', 'status'], 'integer'],
            [['remark'], 'string'],
            [['host'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'host' => Yii::t('app', 'Host'),
            'port' => Yii::t('app', 'Port'),
            'trunk' => Yii::t('app', 'Trunk'),
            'status' => Yii::t('app', 'Status'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }
    public static function getStatus($status =null)
    {
        $allstatus = [
            self::SERVICE_INACTIVE => \Yii::t('app', 'Inactive'),
            self::SERVICE_ACTIVE  => \Yii::t('app', 'Active'),
        ];
        if (isset($status)) {
            return $allstatus[$status];
        } else {
            return $allstatus;
        }
    }
}
