<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Instalment;

/**
 * InstalmentSearch represents the model behind the search form about `app\models\Instalment`.
 */
class InstalmentSearch extends Instalment
{
    /**
     * @inheritdoc
     */
    public $profile;
    public $project;

    public function rules()
    {
        return [
            [['id', 'monthly', 'year'], 'integer'],
            [['instalment', 'project_id', 'editor_id', 'create_date', 'update_date', 
                'profile', 'project'], 'safe'],
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
        $query = Instalment::find();

        // add conditions that should always apply here
        $query->joinWith(['profile','project']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['profile'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['profile.name' => SORT_ASC],
            'desc' => ['profile.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['project'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['project.projectname' => SORT_ASC],
            'desc' => ['project.projectname' => SORT_DESC],
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
            'monthly' => $this->monthly,
            'year' => $this->year,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'instalment', $this->instalment])
            ->andFilterWhere(['like', 'project_id', $this->project_id])
            // ->andFilterWhere(['like', 'editor_id', $this->editor_id]);
            ->andFilterWhere(['like', 'profile.name', $this->profile])
            ->andFilterWhere(['like', 'project.projectname', $this->project]);
        return $dataProvider;
    }
}
