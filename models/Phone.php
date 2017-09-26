<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

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
    const PHONE_INACTIVE = 0;
    const PHONE_ACTIVE = 1;

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
            [['type', 'status'], 'integer'],
            [['remark'], 'string'],
            [['number'], 'safe'],
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

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'userid'])
            ->viaTable(UserPhone::tableName(), ['phoneid' => 'id']);
    }


    public static function getPhonesByUser()
    {
        $phones = self::find()
            ->andWhere(['status' => Phone::PHONE_ACTIVE])
            ->andWhere(['user_phone.userid' => Yii::$app->user->identity->id])
            ->joinWith('userPhones')
            ->asArray()
            ->all();
        if ($phones) {
            return ArrayHelper::getColumn($phones, 'number');
        }
        return [];
    }

    public static function getStatus($status = null)
    {
        $allstatus = [
            self::PHONE_INACTIVE => \Yii::t('app', 'Inactive'),
            self::PHONE_ACTIVE => \Yii::t('app', 'Active'),
        ];
        if (isset($status)) {
            return $allstatus[$status];
        } else {
            return $allstatus;
        }
    }

    public static function MapPhone()
    {
        $query = new Query();
        $query->select('*')
            ->from(['p'=>Phone::tableName()])
            ->andWhere(['status' => Phone::PHONE_ACTIVE])
            ->andWhere(['not exists',
                (new Query())->select('*')->from(['up'=>UserPhone::tableName()])
                ->andWhere('p.id=up.phoneid')
                ]);

        $phone = $query->all();
        if ($phone) {
            return ArrayHelper::map($phone, 'id', 'number');
        }
        return [];
    }


}
