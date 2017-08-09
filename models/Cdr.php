<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cdr".
 *
 * @property int $id
 * @property string $uniqueid
 * @property string $userfield
 * @property string $accountcode
 * @property string $src
 * @property string $dst
 * @property string $dcontext
 * @property string $clid
 * @property string $channel
 * @property string $dstchannel
 * @property string $lastapp
 * @property string $lastdata
 * @property string $calldate
 * @property int $duration
 * @property int $billsec
 * @property string $disposition
 * @property int $amaflags
 */
class Cdr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cdr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calldate'], 'safe'],
            [['duration', 'billsec', 'amaflags'], 'integer'],
            [['uniqueid'], 'string', 'max' => 32],
            [['userfield'], 'string', 'max' => 255],
            [['accountcode'], 'string', 'max' => 100],
            [['src', 'clid'], 'string', 'max' => 20],
            [['dst', 'dcontext', 'channel', 'dstchannel', 'lastapp', 'lastdata'], 'string', 'max' => 80],
            [['disposition'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uniqueid' => Yii::t('app', 'Uniqueid'),
            'userfield' => Yii::t('app', 'Userfield'),
            'accountcode' => Yii::t('app', 'Accountcode'),
            'src' => Yii::t('app', 'Src'),
            'dst' => Yii::t('app', 'Dst'),
            'dcontext' => Yii::t('app', 'Dcontext'),
            'clid' => Yii::t('app', 'Clid'),
            'channel' => Yii::t('app', 'Channel'),
            'dstchannel' => Yii::t('app', 'Dstchannel'),
            'lastapp' => Yii::t('app', 'Lastapp'),
            'lastdata' => Yii::t('app', 'Lastdata'),
            'calldate' => Yii::t('app', 'Calldate'),
            'duration' => Yii::t('app', 'Duration'),
            'billsec' => Yii::t('app', 'Billsec'),
            'disposition' => Yii::t('app', 'Disposition'),
            'amaflags' => Yii::t('app', 'Amaflags'),
        ];
    }
}
