<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HouseModel;

/**
 * HouseModelSearch represents the model behind the search form of `app\models\HouseModel`.
 */
class HouseModelSearch extends HouseModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['hm_code', 'hm_name', 'hm_description'], 'safe'],
            [['hm_control_statment'], 'number'],
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
        $query = HouseModel::find();

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
            'hm_control_statment' => $this->hm_control_statment,
        ]);

        $query->andFilterWhere(['like', 'hm_code', $this->hm_code])
            ->andFilterWhere(['like', 'hm_name', $this->hm_name])
            ->andFilterWhere(['like', 'hm_description', $this->hm_description]);

        return $dataProvider;
    }
}
