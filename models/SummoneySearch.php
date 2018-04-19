<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Summoney;

/**
 * SummoneySearch represents the model behind the search form of `app\models\Summoney`.
 */
class SummoneySearch extends Summoney
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contructor_id', 'instalment_id'], 'integer'],
            [['total'], 'number'],
            [['create_date', 'update_date'], 'safe'],
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
        $query = Summoney::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'total' => $this->total,
            'contructor_id' => $this->contructor_id,
            'instalment_id' => $this->instalment_id,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        return $dataProvider;
    }
}
