<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paidtype;

/**
 * PaidtypeSearch represents the model behind the search form of `app\models\Paidtype`.
 */
class PaidtypeSearch extends Paidtype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'paid_type', 'summoney_id'], 'integer'],
            [['paid_amount'], 'number'],
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
        $query = Paidtype::find();

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
            'paid_amount' => $this->paid_amount,
            'paid_type' => $this->paid_type,
            'summoney_id' => $this->summoney_id,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        return $dataProvider;
    }
}
