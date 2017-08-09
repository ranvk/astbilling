<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_phone".
 *
 * @property int $id
 * @property int $phoneid
 * @property int $userid
 *
 * @property Phone $phone
 * @property User $user
 */
class UserPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phoneid', 'userid'], 'integer'],
            [['phoneid'], 'exist', 'skipOnError' => true, 'targetClass' => Phone::className(), 'targetAttribute' => ['phoneid' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phoneid' => 'Phoneid',
            'userid' => 'Userid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhone()
    {
        return $this->hasOne(Phone::className(), ['id' => 'phoneid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
}
