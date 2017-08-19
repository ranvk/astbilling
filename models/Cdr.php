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
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbast');
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

    public function getDstnum()
    {
        return strlen($this->dst) > 5 && is_numeric($this->dst) ? $this->dst : $this->accountcode;
    }

    public function getSrcArea()
    {
        $srcArea = '';
        if (!empty($this->src)) {
            $mobile = substr($this->src, -11);
            $num = substr($mobile, 0, 7);

            $area = Area::findOne(['number' => $num]);
            if ($area) {
                $srcArea = $area->area . ' ' . $area->type;
            }
        }
        return $srcArea;
    }

    public function getSrcTelecom()
    {
        $srcTelecom = 'N/A';
        if (!empty($this->src)) {
            $pre = substr(substr($this->src, -11), 0, 3);
            $data = [
                '中国移动' => [134, 135, 136, 137, 138, 139, 150, 151, 152, 157, 158, 159, 187, 188, 147, 182, 183],
                '中国电信' => [133, 153, 180, 189, 181],
                '中国联通' => [130, 131, 132, 155, 156, 185, 186],
                '其它' => [0, 2, 3, 4, 5, 6, 7, 8, 9],
            ];

            if (in_array($pre, $data['中国移动'])) {
                $srcTelecom = '中国移动';
            } elseif (in_array($pre, $data['中国电信'])) {
                $srcTelecom = '中国电信';
            } elseif (in_array($pre, $data['中国联通'])) {
                $srcTelecom = '中国联通';
            } else {
                $srcTelecom = '其它';
            }
        }
        return $srcTelecom;
    }
}
