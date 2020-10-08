<?php

namespace app\controllers\ceo;

use Yii;
use app\models\Instalmentcostdetails;
use app\models\InstalmentcostdetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Houses;
use app\models\Project;
use app\models\WorkGroupSearch;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
/**
 * LaborcostdetailsController implements the CRUD actions for Laborcostdetails model.
 */
class LaborcostdetailsController extends Controller
{
    /**
     * @inheritdoc
     */
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ]
    //     ];
    // }

    /**
     * Lists all Laborcostdetails models.
     * @return mixed
     */
    
    public function actionIndex()
    {
        $this->layout = 'ceo_layout';
        $query = new Query;
        $query->select('
                a.*,
                d.projectname
            ')
            ->from('instalmentcostdetails a')
            // ->leftJoin('instalment b', 'a.instalment_id = b.instalment')
            ->leftJoin('houses c', 'a.house_id = c.id')
            ->leftJoin('project d', 'c.project_id = d.project_id')
            ->where(['c.project_id' => $_REQUEST['project_id']])
            ->andWhere(['c.id' => $_REQUEST['id']])
            // ->andWhere(['a.instalment_id' => $_REQUEST['instalment']])
            ->groupBy('a.instalment_id');
        $model = $query->all();
        \app\models\Methods::print_array($model);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        $query3 = new Query();
        $command = $query3->select(['h.*', 'hm.hm_name', 'hm.hm_control_statment'])
            ->from('houses h')
            ->leftJoin('house_model hm', ' h.house_model_id = hm.id')
            
            ->all();
            
        $provider = new ArrayDataProvider([
            'allModels' =>$command,

            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'provider' => $provider,
            'model'    => $model,
            'instalment' => $_REQUEST['instalment']

        ]);

    }

    public function actionExport_excel_by_workgroup(){
        $this->layout = 'excel_layout';

        $instalment = \app\controllers\ceo\LaborcostdetailsController::_instalment_by_house($_REQUEST);
        // print_r($instalment);die();

        return $this->render('_workgroup_instal_excel_for_ceo',[
           'instalment_sum_provider' => $instalment['instalment_sum_provider']
        ]);
    }

    public function actionInstalmentdetail_by_house(){
        $searchModel = new WorkGroupSearch();
        $this->layout = 'ceo_layout';
        $instalment = $this->_instalment_by_house($_REQUEST);
        // $query = new Query;
        // $query->select('a.*, (select sum(amount) from instalmentcostdetails 
        //                        where house_id='.$_REQUEST['id'].') as sum_amount,
        //         b.name ,
        //         c.wc_name,
        //         d.wg_name, d.id as wg_id,
        //         e.id as inst_id, e.instalment, e.monthly as instalment_monthly, e.year as instalment_year,
        //         f.name as moneytype,
        //         g.id, g.project_id, g.house_name,
        //         h.hm_name, h.id as hm_id, h.hm_control_statment,
        //         i.work_name,i.work_control_statement,
        //         j.projectname
        //     ')
        //     ->from('instalmentcostdetails a')
        //     ->leftJoin('profile b', 'a.contructor_id = b.user_id')
        //     ->leftJoin('work_category c', 'a.workclassify_id = c.id ')
        //     ->leftJoin('work_group d', 'a.worktype_id = d.id')
        //     ->leftJoin('works i', 'a.work_id = i.id')
        //     ->leftJoin('instalment e', 'a.instalment_id = e.id')
        //     ->leftJoin('money_type f', 'a.money_type_id = f.id')
        //     ->leftJoin('houses g', 'a.house_id = g.id')
        //     ->leftJoin('house_model h', 'g.house_model_id = h.id')
        //     ->leftJoin('project j', 'e.project_id = j.project_id')
        //     ->where(['a.house_id' => $_REQUEST['id']])
        //     ->groupBy('a.instalment_id')
        //     // ->andWhere(['a.instalment_id' => $_REQUEST['instalment_id']])
        //     ;
        // $instalment = $query->all(); 
        // if(empty($instalment)){
        //     $query2 = new Query;
        //     $query2->select('a.id, a.project_id')
        //         ->from('houses a')
        //         ->leftJoin('project b', 'a.project_id = b.id')
        //         ->where(['a.id' => $_REQUEST['id']]);
        //     $empty_instalment = $query2->all();
        //     $empty_instalment['empty_instalment'] = true;

        // }
        // $sql = "
        //     SELECT  a.id as house_id, a.house_name,
        //         b.hm_name, b.hm_control_statment ,
        //         c.wg_id , d.wg_name, c.cost_control ,
        //         (SELECT SUM(cost_control) FROM house_model_have_workgroup WHERE house_model_id = b.id ) as sum_cost_control,
        //         (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ". $_REQUEST['id']." AND worktype_id = c.wg_id) as paid_amount,
        //         (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ". $_REQUEST['id'].") as sum_paid_amount,
        //         ((SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ". $_REQUEST['id']." AND worktype_id = c.wg_id)/c.cost_control)*100 as progress_percent
        //     FROM houses a
        //     LEFT JOIN house_model b ON a.house_model_id = b.id
        //     LEFT JOIN house_model_have_workgroup c ON b.id = c.house_model_id
        //     LEFT JOIN work_group d ON c.wg_id = d.id
        //     LEFT JOIN instalmentcostdetails e ON a.id = e.house_id
        //     WHERE a.id=". $_REQUEST['id']." 
        //     Group By c.wg_id";

        //     $instalment_sum_provider =$this->generateSqlDataProvider($sql);
        // // \app\models\Methods::print_array($instalment);
        // //บวก sum work group
        // foreach($instalment as $key => $ints){
        //     $query2 = new Query;
        //     $query2->select('SUM(work_control_statement) AS ww')
        //         ->from('works')
        //         ->where(['wg_id' => $ints['wg_id']]);
        //     $w_statement = $query2->one();             
        //     $instalment[$key]['work_control_statement'] =$w_statement['ww'];
        // }

        return $this->render('instalmentdetail_by_house',[
            'instalment' => empty($instalment['instalment']) ? $instalment['empty_instalment'] : $instalment['instalment'],
            'instalment_sum_provider' => $instalment['instalment_sum_provider'],
            'searchModel' => $searchModel
        ]);
    }

    public function actionSummary_all_home(){
        $homes=[];
        for($i=1; $i<=100 ;$i++){
            $sql = " select a.*, b.house_name  
            from instalmentcostdetails a 
            left join houses b ON a.house_id = b.id
            where house_id=".$i.
            " order by workclassify_id, worktype_id, work_id  asc"
        ;
        $data = Yii::$app->db->createCommand($sql)->queryAll();
            array_push($homes, $data);
        }
        return $this->render('summary_all_home',[
            'homes' => $homes
        ]);
        // \app\models\Methods::print_array($homes);
    }

    public function actionGetDataByInstalement(){
       
        $sql ='SELECT 
                a.instalment_id, a.worktype_id, a.amount, SUM(a.amount) as "sumpaid",
                b.wg_name,
                c.year, c.monthly, c.instalment,
                (SELECT sum(c.work_control_statement) FROM works c 
                        WHERE c.wg_id = a.worktype_id) AS "sum_statement_control"
               
            FROM `instalmentcostdetails` a
            LEFT JOIN work_group b ON a.worktype_id = b.id
            LEFT JOIN instalment c ON a.instalment_id = c.id
            WHERE a.instalment_id='.$_REQUEST['id'].' AND  a.house_id = '.$_REQUEST['house_id'].'
            GROUP BY a.worktype_id
            ORDER BY a.`worktype_id`  ASC';
            $model = \Yii::$app->db->createCommand($sql)->queryAll();

            $sum_all_statement_control =0;
            $sum_all_amount =0;
            foreach($model as $key => $m){
                $sum_all_statement_control += $m['sum_statement_control'];
                $sum_all_amount += $m['amount'];
            }
            $x = ($sum_all_amount/$sum_all_statement_control)*100;
            $bg = $x > 100 ? 'bg-yellow' : '';
            
            echo "<div class='box box-success'>";
            echo \app\models\Methods::getMonth($model[0]['monthly'])." ".
                        $model[0]['year']." (".$model[0]['instalment'].")";
                echo "<table class='table table-condensed table-bordered ".$bg."'>";
                    echo    "<tr>
                                <th  class='work_despt'>#</th>
                                <th  class='work_despt'>กลุ่มงาน</th>
                                <th  class='work_despt'>งบควบคุม</th>
                                <th  class='work_despt'>จ่ายแล้ว</th>
                                <th  class='work_despt'>%</th>
                                <th  class='work_despt'>หมายเหตุ</th>
                            </tr>";
                foreach($model as $key => $m){
                    $i= $key+1;
                    $s = $m['sum_statement_control'] =='' ? 0 :(($m['amount']/$m['sum_statement_control'])*100);
                    $work_bg = $m['amount'] > $m['sum_statement_control'] ? 'bg-red' : '';
                    echo    "<tr class=".$work_bg.">
                                <td>".$i."</td>
                                <td>".$m['wg_name']."</td>
                                <td>".$m['sum_statement_control']."</td>
                                <td>".$m['amount']."</td>
                                <td>".number_format($s,2)." %</td>
                                <td></td>
                            </tr>";
                }
                echo        "<tr>
                                <td colspan='2'></td>
                                <td>".$sum_all_statement_control."</td>
                                <td>".$sum_all_amount."</td>
                            </tr>";
                echo "</table>";
            echo "</div>";

    }

    /**
     * Displays a single Laborcostdetails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Laborcostdetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Laborcostdetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Laborcostdetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Laborcostdetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Laborcostdetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Laborcostdetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Laborcostdetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public static function generateSqlDataProvider($sql){
        $provider = new SqlDataProvider([
            'sql' => $sql,
            'sort' => [
              //  'attributes' => ['id', 'username', 'email'],
            ],
            'pagination' => [
                'pageSize' => 21,
            ],
        ]);
        return $provider;
    }

    public static function _instalment_by_house($REQUEST){
        $empty_instalment['empty_instalment'] = false;
        $query = new Query;
        $query->select('a.*, (select sum(amount) from instalmentcostdetails 
                               where house_id='.$REQUEST['id'].') as sum_amount,
                b.name ,
                c.wc_name,
                d.wg_name, d.id as wg_id,
                e.id as inst_id, e.instalment, e.monthly as instalment_monthly, e.year as instalment_year,
                f.name as moneytype,
                g.id, g.project_id, g.house_name,
                h.hm_name, h.id as hm_id, h.hm_control_statment,
                i.work_name,i.work_control_statement,
                j.projectname
            ')
            ->from('instalmentcostdetails a')
            ->leftJoin('profile b', 'a.contructor_id = b.user_id')
            ->leftJoin('work_category c', 'a.workclassify_id = c.id ')
            ->leftJoin('work_group d', 'a.worktype_id = d.id')
            ->leftJoin('works i', 'a.work_id = i.id')
            ->leftJoin('instalment e', 'a.instalment_id = e.id')
            ->leftJoin('money_type f', 'a.money_type_id = f.id')
            ->leftJoin('houses g', 'a.house_id = g.id')
            ->leftJoin('house_model h', 'g.house_model_id = h.id')
            ->leftJoin('project j', 'e.project_id = j.project_id')
            ->where(['a.house_id' => $REQUEST['id']])
            ->groupBy('a.instalment_id')
            // ->andWhere(['a.instalment_id' => $REQUEST['instalment_id']])
            ;
        $instalment = $query->all(); 
        if(count($instalment) == 0){
            $query2 = new Query;
            $query2->select('a.id as house_id, a.project_id')
                ->from('houses a')
                ->leftJoin('project b', 'a.project_id = b.id')
                ->where(['a.id' => $REQUEST['id']]);
            $empty_instalment = $query2->all();
            $empty_instalment['empty_instalment'] = true;

        }
        $sql = "
            SELECT  a.id as house_id, a.house_name,
                b.hm_name, b.hm_control_statment ,
                c.wg_id , d.wg_name, c.cost_control ,
                (SELECT SUM(cost_control) FROM house_model_have_workgroup WHERE house_model_id = b.id ) as sum_cost_control,
                (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ". $REQUEST['id']." AND worktype_id = c.wg_id) as paid_amount,
                (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ". $REQUEST['id'].") as sum_paid_amount,
                ((SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ". $REQUEST['id']." AND worktype_id = c.wg_id)/c.cost_control)*100 as progress_percent
            FROM houses a
            LEFT JOIN house_model b ON a.house_model_id = b.id
            LEFT JOIN house_model_have_workgroup c ON b.id = c.house_model_id
            LEFT JOIN work_group d ON c.wg_id = d.id
            LEFT JOIN instalmentcostdetails e ON a.id = e.house_id
            WHERE a.id=". $REQUEST['id']." 
            Group By c.wg_id";

        $instalment_sum_provider =\app\controllers\ceo\LaborcostdetailsController::generateSqlDataProvider($sql);
        // \app\models\Methods::print_array($empty_instalment);
        //บวก sum work group
        foreach($instalment as $key => $ints){
            $query2 = new Query;
            $query2->select('SUM(work_control_statement) AS ww')
                ->from('works')
                ->where(['wg_id' => $ints['wg_id']]);
            $w_statement = $query2->one();             
            $instalment[$key]['work_control_statement'] =$w_statement['ww'];
        }
        $inst = array();
        $inst['instalment'] = $instalment;
        $inst['instalment_sum_provider'] = $instalment_sum_provider;
        $inst['empty_instalment'] = $empty_instalment;
        // \app\models\Methods::print_array($inst['empty_instalment']);
        return $inst;
        
    }

    public function actionTestexportexcel(){
        $this->layout = 'excel_layout';

        $instalment = \app\controllers\ceo\LaborcostdetailsController::_instalment_by_house($_REQUEST);
        // print_r($instalment);die();

        return $this->render('_all_instal_excel_for_ceo',[
           'instalment_sum_provider' => $instalment['instalment_sum_provider']
        ]);
    }
}
