<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $number
 * @property string $area
 * @property string $type
 * @property string $area_code
 * @property string $postcode
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'area', 'type', 'area_code', 'postcode'], 'required'],
            [['number'], 'integer'],
            [['area', 'type', 'area_code', 'postcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', 'Number'),
            'area' => Yii::t('app', 'Area'),
            'type' => Yii::t('app', 'Type'),
            'area_code' => Yii::t('app', 'Area Code'),
            'postcode' => Yii::t('app', 'Postcode'),
        ];
    }
}
