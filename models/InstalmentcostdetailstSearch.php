<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Instalmentcostdetails;

/**
 * InstalmentcostdetailstSearch represents the model behind the search form about `app\models\Instalmentcostdetails`.
 */
class InstalmentcostdetailstSearch extends Instalmentcostdetails
{
    /**
     * @inheritdoc
     */
    public $houses;
    public $constructor;
    public $workGroup;
    
    public function rules()
    {
        return [
            [['id', 'instalment_id', 'contructor_id', 'house_id', 'workclassify_id', 'worktype_id', 'money_type_id', 'summoney_id', 'saver_id'], 'integer'],
            [['amount'], 'number'],
            [['comment'], 'string'],
            [['create_date', 'update_date', 'wg_name', 'houses', 'constructor', 'workGroup'], 'safe'],
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
        $query = Instalmentcostdetails::find();

        // add conditions that should always apply here
        $query->joinWith(['houses', 'constructor', 'workGroup']);
        $query->where(['instalmentcostdetails.instalment_id' => $params]);
        $query->orderBy('instalmentcostdetails.contructor_id, instalmentcostdetails.house_id,instalmentcostdetails.money_type_id', 'asc');
        // $query->groupBy(['instalmentcostdetails.id']);
        // $query->orderBy('instalmentcostdetails.house_id', 'ASC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['houses'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['houses.house_name' => SORT_ASC],
            'desc' => ['houses.house_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['constructor'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['constructor.name' => SORT_ASC],
            'desc' => ['constructor.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['workGroup'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['workGroup.wg_name' => SORT_ASC],
            'desc' => ['workGroup.wg_name' => SORT_DESC],
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
            'instalment_id' => $this->instalment_id,
            'contructor_id' => $this->contructor_id,
            'house_id' => $this->house_id,
            'workclassify_id' => $this->workclassify_id,
            'worktype_id' => $this->worktype_id,
            'money_type_id' => $this->money_type_id,
            'amount' => $this->amount,
            'summoney_id' => $this->summoney_id,
            'saver_id' => $this->saver_id,
            'comment' => $this->comment,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ])
        ->andFilterWhere(['like', 'houses.house_name', $this->houses])
        ->andFilterWhere(['like', 'profile.name', $this->constructor])
        ->andFilterWhere(['like', 'work_group.wg_name', $this->workGroup]);

        return $dataProvider;
    }
}
