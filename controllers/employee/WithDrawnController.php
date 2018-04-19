<?php

namespace app\controllers\employee;
use Yii;
use app\models\Laborcostdetails;
use yii\db\Query;
 
class WithDrawnController extends \yii\web\Controller
{
    public function actionIndex($instalment_id)
    {
        $this->layout = "employee_layout";
        $query = new Query;
        // compose the query
        $query->select('*')
            ->from('instalmentcostdetails')
            ->where(['instalment_id'=> $instalment_id])
            ->andWhere(['summoney_id' => isset($_REQUEST['edit']) ? 1 : 0])
            ->orderBy('contructor_id,money_type_id', 'asc')
            ->groupBy('id');
        $command = $query->createCommand();
        $rows = $command->queryAll();
        $inst = \app\models\Instalment::find()->where(['id' => $instalment_id])->one();
        $inst_date = explode(" ", $inst['create_date']);
        $date = explode("-",$inst_date[0]);
        $monththai = \app\models\Methods::getMonth($date[1]);
        $yearthai = "25".$inst['year'];
        $inst_str = $date[2]." ".$monththai." ".$yearthai." (".$inst['monthly']."/".$inst['instalment'].".".$inst['year'] .")";
        // \app\models\Methods::print_array($inst_date);
        // 
        return $this->render('index',[
            'models' => $rows,
            'inst_str' => $inst_str
        ]);
    }

    public function actionCreate(){
        $this->layout = "employee_layout";
        if(count(Yii::$app->request->post()) >0){
            $this->sumAmountByInstalment($_REQUEST['_instalment_id']);
           
            foreach($_REQUEST['paidmethod'] as  $key => $pm ){
                foreach($pm as $k => $val){
                    if($k =='cash' || $k =='bank'){
                        if($val !=""){
                            $model =  new \app\models\Paidtype();
                            $model->paid_amount = $val;
                            $model->paid_type   = $k == "cash" ? 1 : 2;
                            $model->summoney_id = $this->getSummoneyId($_REQUEST['_instalment_id'], $key);
                            $model->create_date = date('Y-m-d H:i:s');
                            $model->update_date = date('Y-m-d H:i:s');
                            $model->save();
                        }
                    }
                }
            }
        } 
        $_REQUEST=null;
        return $this->redirect(['employee/instalment/index']);
    }

    public function sumAmountByInstalment($inst_id){
        $query = new Query;
        $query->select('a.contructor_id, a.instalment_id, sum(a.amount) as sum_amount, 
                (select sum(b.amount) from instalmentcostdetails b 
                    where b.instalment_id='.$inst_id.' and b.contructor_id = a.contructor_id 
                    and (b.money_type_id=3 or b.money_type_id =4)
                ) as minus')
            ->from('instalmentcostdetails a')
            ->where(['a.instalment_id'=>$inst_id])
            ->andWhere(['summoney_id' => 0])
            ->groupBy('a.contructor_id');
        // build and execute the query
        $rows = $query->all();
        // \app\models\Methods::print_array($rows);
        foreach($rows as $row){
            $summoney = new \app\models\Summoney();
            $summoney->total            = $row['sum_amount'] - $row['minus'];
            $summoney->contructor_id    = $row['contructor_id'];
            $summoney->instalment_id    = $row['instalment_id'];
            $summoney->create_date      = date('y-m-d H:i:s');
            $summoney->update_date      = date('y-m-d H:i:s');
            if($summoney->save()){
                // update summoney_id ใน instalmentcostdetails table รายช่าง
                $update_query = \Yii::$app->db;
                $command = $update_query->createCommand('UPDATE instalmentcostdetails SET summoney_id='.$summoney->id.'  
                                 WHERE contructor_id ='. $summoney->contructor_id .' 
                                 AND instalment_id = '. $summoney->instalment_id);
                $command->execute();
            }
        }
    }

    private function getSummoneyId($inst_id, $const_id){
        $constructor_id = \app\models\Summoney::find()
                        ->select('id')
                        ->where(['instalment_id' => $inst_id])
                        ->andWhere(['contructor_id' => $const_id])
                        ->one(); 
        return $constructor_id['id'];
    }

    public function actionChangeMoneyValue(){
        $model =  \app\models\Instalmentcostdetails::find()
                ->where(['id' => $_REQUEST['id']])->one();
        $query = new Query;
        if(isset($_REQUEST['change_amount'])){

            $model->amount = $_REQUEST['change_amount'];
            $model->save();
            return $this->redirect(['employee/with-drawn','instalment_id'=>$model['instalment_id']]);
        }else{
            $query->select('a.*, b.wg_name, c.work_name, d.house_name')
            ->from('instalmentcostdetails a')
            ->leftJoin('work_group b', 'a.worktype_id = b.id')
            ->leftJoin('works c', 'a.work_id = b.id')
            ->leftJoin('houses d', 'a.house_id = d.id')
            ->where(['a.id'=>$_REQUEST['id']]);

            $rows = $query->all();
            $model = $rows[0];
        }

        // \app\models\Methods::print_array($model[0]);
        return $this->renderAjax('change-money-value',[
            'model' => $model
        ]);
    }

}
