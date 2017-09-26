<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cdr;

/**
 * CdrSearch represents the model behind the search form of `app\models\Cdr`.
 */
class CdrSearch extends Cdr
{
    public $from_date;
    public $to_date;

    public $nobillsec;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duration', 'billsec', 'amaflags'], 'integer'],
            [['nobillsec', 'from_date', 'to_date', 'uniqueid', 'userfield', 'accountcode', 'src', 'dst', 'dcontext', 'clid', 'channel', 'dstchannel', 'lastapp', 'lastdata', 'calldate', 'disposition'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'from_date' => Yii::t('app', 'From Date'),
            'to_date' => Yii::t('app', 'To Date'),
            'src' => Yii::t('app', 'Src'),
            'dst' => Yii::t('app', 'Dst'),
            'nobillsec' => Yii::t('app', 'No Billsec'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cdr::find();

        //加入号码过滤
        if (Yii::$app->user->identity->id != 1) {
            $phone = Phone::getPhonesByUser();
            $query->andWhere(['or',
                ['in', 'accountcode', $phone],
                ['in', 'dst', $phone],
            ]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'calldate' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if ($this->from_date && $this->to_date) {
            $query->andFilterWhere(['between', 'calldate', $this->from_date, $this->to_date]);
        }

        $query->andFilterWhere(['>', 'billsec', $this->nobillsec]);

        $query->andFilterWhere(['like', 'dst', $this->dst]);
        $query->andFilterWhere(['like', 'src', $this->src]);


//        var_dump($query->all());exit;

        return $dataProvider;
    }
}
