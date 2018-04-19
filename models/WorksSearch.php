<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Works;

/**
 * WorksSearch represents the model behind the search form of `app\models\Works`.
 */
class WorksSearch extends Works
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wg_id'], 'integer'],
            [['work_name'], 'safe'],
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
        $query = Works::find();

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
            'wg_id' => $this->wg_id,
        ]);

        $query->andFilterWhere(['like', 'work_name', $this->work_name]);

        return $dataProvider;
    }
}
