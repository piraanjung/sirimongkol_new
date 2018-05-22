<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Houses;

/**
 * HousesSearch represents the model behind the search form of `app\models\Houses`.
 */
class HousesSearch extends Houses
{
    /**
     * @inheritdoc
     */

    public $housemodels; 
    public function rules()
    {
        return [
            [['id', 'house_model_id', 'project_id', 'house_status'], 'integer'],
            [['house_name', 'create_date', 'update_date', 'housemodels'], 'safe'],
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
        $query = Houses::find();
        $query->joinWith(['house_model']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['housemodels'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['house_model.hm_name' => SORT_ASC],
            'desc' => ['house_model.hm_name' => SORT_DESC],

        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'house_model_id' => $this->house_model_id,
            'project_id' => $this->project_id,
            'house_name' => $this->house_name,
            'house_status' => $this->house_status,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'house_model.hm_name', $this->housemodels]);
        return $dataProvider;
    }
}
