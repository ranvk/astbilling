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
            'id' => 'ID',
            'uniqueid' => 'Uniqueid',
            'userfield' => 'Userfield',
            'accountcode' => 'Accountcode',
            'src' => 'Src',
            'dst' => 'Dst',
            'dcontext' => 'Dcontext',
            'clid' => 'Clid',
            'channel' => 'Channel',
            'dstchannel' => 'Dstchannel',
            'lastapp' => 'Lastapp',
            'lastdata' => 'Lastdata',
            'calldate' => 'Calldate',
            'duration' => 'Duration',
            'billsec' => 'Billsec',
            'disposition' => 'Disposition',
            'amaflags' => 'Amaflags',
        ];
    }
}
