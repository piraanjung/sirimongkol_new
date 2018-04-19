<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HouseModelHaveWorkgroup;

/**
 * HouseModelHaveWorkgroupSearch represents the model behind the search form of `app\models\HouseModelHaveWorkgroup`.
 */
class HouseModelHaveWorkgroupSearch extends HouseModelHaveWorkgroup
{
    /**
     * @inheritdoc
     */

    public  $houseModel;
    public $workGroup;
    public function rules()
    {
        return [
            [['id', 'house_model_id', 'wg_id'], 'integer'],
            [['cost_control'], 'number'],
            [['houseModel', 'workGroup'],'safe']
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
        $query = HouseModelHaveWorkgroup::find();
        $query->joinWith(['houseModel', 'workGroup']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['houseModel'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['house_model.hm_name' => SORT_ASC],
            'desc' => ['house_model.hm_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['workGroup'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['work_group.wg_name' => SORT_ASC],
            'desc' => ['work_group.wg_name' => SORT_DESC],
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
            'wg_id' => $this->wg_id,
            'cost_control' => $this->cost_control,
        ])
        ->andFilterWhere(['like', 'work_group.wg_name', $this->workGroup])
        ->andFilterWhere(['like', 'house_model.hm_name', $this->houseModel]);


        return $dataProvider;
    }
}
