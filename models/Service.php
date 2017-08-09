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
            'id' => 'ID',
            'host' => 'Host',
            'port' => 'Port',
            'trunk' => 'Trunk',
            'status' => 'Status',
            'remark' => 'Remark',
        ];
    }
}
