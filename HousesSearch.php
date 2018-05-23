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

    public $house_model; 
    public function rules()
    {
        return [
            [['id', 'house_model_id', 'project_id', 'house_status'], 'integer'],
            [['house_name', 'create_date', 'update_date', 'house_model'], 'safe'],
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
        if(isset($params['abnormal_house_status'])){
            $houses = $this->find_abnormal_house_status($params['abnormal_house_status']);
            if(count($houses) > 0){
                foreach($houses as $key => $house){
                    if($key == 0){
                        $query->where(['houses.id' => $houses]);
                    }else{
                        $query->andWhere(['houses.id' => $houses]);
                    }
                }
                // if(count($houses) ==1){
                //     $query->where(['houses.id' => $houses]);
                // }else{

                // }
            }
        }
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['house_model'] = [
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
            // 'id' => $this->id,
            'house_model_id' => $this->house_model_id,
            'project_id' => $this->project_id,
            // 'house_name' => $this->house_name,
            'house_status' => $this->house_status,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);
        $query->andFilterWhere(['like', 'house_name', $this->house_name]);
        $query->andFilterWhere(['like', 'house_model.hm_name', $this->house_model]);
    
        return $dataProvider;
    }

    private function find_abnormal_house_status($ab_house_status){
        // $aa = \app\controllers\ceo\CeoController::_projectdetail(6);
        $houses = \app\models\Houses::find()->select('houses.id')
                ->innerJoin('instalmentcostdetails', 'houses.id = instalmentcostdetails.house_id')
                ->where(['houses.project_id' => 6])
                ->all();
        $datas =[];
        foreach($houses as $h){
        
            $sql = "
                SELECT  a.id as house_id, a.house_name,
                    b.hm_name, b.hm_control_statment ,
                    c.wg_id , d.wg_name, c.cost_control ,
                    (SELECT SUM('cost_control') FROM house_model_have_workgroup WHERE house_model_id = b.id ) as sum_cost_control,
                    (SELECT SUM('amount') FROM instalmentcostdetails WHERE house_id = 1 AND worktype_id = c.wg_id) as paid_amount,
                    (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ".$h['id'].") as sum_paid_amount,
                    ((SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ".$h['id']." AND worktype_id = c.wg_id)/c.cost_control)*100 as progress_percent
                FROM houses a
                LEFT JOIN house_model b ON a.house_model_id = b.id
                LEFT JOIN house_model_have_workgroup c ON b.id = c.house_model_id
                LEFT JOIN work_group d ON c.wg_id = d.id
                LEFT JOIN instalmentcostdetails e ON a.id = e.house_id
                LEFT JOIN works f ON e.work_id = f.id
                WHERE a.id=".$h['id']."  AND a.house_status=".$ab_house_status." 
                Group By c.wg_id";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            array_push($datas, $data);
        }

        $_house_id =[];
        if(count($datas[0]) > 0){
            $i=0;
            
            foreach($datas as $key => $data){
                if($data[$key]['progress_percent']> 0){
                    $over=$data[$key]['paid_amount'] - $data[$key]['cost_control'];
                    $over > 0 ? $i++ : $i+0; 
                    array_push($_house_id, $data[$key]['house_id']);
                }
            }
        }
                // \app\models\Methods::print_array($_house_id);
        return $_house_id;
    }
}
