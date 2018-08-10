<?php

namespace app\controllers\employee;

use Yii;
use app\models\Instalment;
use app\models\InstalmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Project;
use app\models\Housemodels;
use app\models\WorkType;
use app\models\WorkClassify;
use app\models\Laborcostdetails;
use app\models\Instalmentcostdetails;
use app\models\InstalmentcostdetailstSearch;
use yii\db\Query;
use yii\data\ActiveDataProvider;


/**
 * InstalmentController implements the CRUD actions for Instalment model.
 */
class InstalmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Instalment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "employee_layout";
        $searchModel = new InstalmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Instalment model.
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
     * Creates a new Instalment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "employee_layout";
        $model = new Instalment();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->instalment  = "".$_REQUEST['Instalment']['instalment'];
            $model->monthly     = $_REQUEST['Instalment']['monthly'];
            $model->year        = substr($_REQUEST['Instalment']['year'],2);
            $model->project_id  = $_REQUEST['Instalment']['project_id'];
            $model->editor_id   = isset(Yii::$app->user->identity->id) ? "".Yii::$app->user->identity->id :"0";
            $model->create_date = date("Y-m-d H:i:s");
            $model->update_date = date("Y-m-d H:i:s");
            $model->save();
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);

        } else {
            $form = new \app\models\Methods();
            $monthly = $form->getMonthLists();
            $model->year = date("Y")+543;
            return $this->render('create', [
                'model' => $model,
                'monthly' =>$monthly
            ]);
        }
    }

    /**
     * Updates an existing Instalment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = "employee_layout";
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
     * Deletes an existing Instalment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionInstalment_by_instructor(){
        $this->layout = "employee_layout";
        $model = new \app\models\Instalmentcostdetails ;
        if(isset($_REQUEST['instalment_id'])){
            $instalment = Instalment::find()
                        ->where(['id' => $_REQUEST['instalment_id']])->one();
        }
        $session = Yii::$app->session;
        if (!$session->has('laborcostlist')){
            $_SESSION['laborcostlist'] =array();
        }
        // \app\models\Methods::print_array($_REQUEST);
        if ($model->load(Yii::$app->request->post()) || isset($_REQUEST['hidden'])) {
            if($_REQUEST['hidden'] =="addlists"){
                array_push( $_SESSION['laborcostlist'], Yii::$app->request->post());
                $_REQUEST['hidden'] = "";
                $model->workclassify_id ='';
                $model->amount= 0;
                // \app\models\Methods::print_array($_SESSION['laborcostlist']);   
            }else if($_REQUEST['hidden'] =="savelists"){
                //ทำการบันทึกข้อมูลการจ่ายงวดรายช่าง
                // \app\models\Methods::print_array($_SESSION['laborcostlist']);
                $inst =  $this->saveInstalmentDetails($_SESSION['laborcostlist']);
                
                unset($_SESSION['laborcostlist']);
                $session->setFlash('save_res', 'ทำการบันทึกข้อมูลเรียบร้อยแล้ว');  
               
                $_REQUEST['hidden'] = "";
                return $this->redirect(['employee/instalment/index']);
            }
        }

        return $this->render('instalment-by-instructor',[
            'model' => $model,
            'addlist' => $_SESSION['laborcostlist'],
            'instalment' => $instalment
        ]);
    }

    public function actionProjectdetail_($project_id){
        $this->layout = 'employee_layout';
        $searchModel = new \app\models\ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('projectdetail/projectdetail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionProjectdetail($project_id){
        $this->layout = 'employee_layout';
        $searchModel = new \app\models\HousesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //     echo "<pre>";
    //     print_r($dataProvider->getModels());
    //    die();
        $res = \app\controllers\ceo\CeoController::_projectdetail(6);
        // \app\models\Methods::print_array($res['dataProvider']); 
        return $this->render('projectdetail/projectdetail', [
            'houseCount' => $res['houseCount'],
            'noneBuildedHouses' => $res['noneBuildedHouses'],
            'duringBuildedHouses' => $res['duringBuildedHouses'],
            'completeBuildedHoueses' => $res['completeBuildedHoueses'],
            // 'sumControlStatement' => $res['sumControlStatement'],
            'sumPaidAmountByProject' => $res['sumPaidAmountByProject'],
            'provider' => $res['provider'],
            'dataProvider2' => $res['dataProvider'],
            'project' => $res['project'],
            'searchModel' =>$searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionInstalment_by_instructor_detail_backup($instalment_id){
        $this->layout = "employee_layout";
        $query = new Query;
        $paidbycash =array();
        $paidbybanks = array();
        $query->select('b.*,b.create_date as bb, a.total, c.instalment, c.monthly, c.year')
            ->from('summoney a')
            ->leftJoin('instalmentcostdetails b', 'a.instalment_id = b.instalment_id')
            ->leftJoin('instalment c', 'a.instalment_id = c.id')
            ->where(['a.instalment_id'=> $instalment_id])
            ->orderBy('b.contructor_id, b.money_type_id', 'asc')
            ->groupBy('b.id')
            ->all();
        $rows = $query->all();
        $command = $query->createCommand();
        $rows = $command->queryAll();

        // \app\models\Methods::print_array($rows); 
        $paidbycash = $this->getpaidByCashOrBank(1, $instalment_id, 6);//paidtype =1, instalment_id
        $paidbybanks = $this->getpaidByCashOrBank(2, $instalment_id, 6);
        
        // getข้อมูลการโอนเงินให้ช่างแยกเป็นธนาคาร(bank_id, instalment_id, paid_type)
        $ktb = $this->getTransferDivideBank(1, $instalment_id, 2);
        $scb = $this->getTransferDivideBank(2, $instalment_id, 2);
        $tmb = $this->getTransferDivideBank(3, $instalment_id, 2);
        $kb  = $this->getTransferDivideBank(4, $instalment_id, 2);
        $ksb = $this->getTransferDivideBank(5, $instalment_id, 2);
        $bkb = $this->getTransferDivideBank(6, $instalment_id, 2);
        $gsb = $this->getTransferDivideBank(7, $instalment_id, 2);
        // \app\models\Methods::print_array($ktb);
        return $this->render('instalment_by_instructor_detail',[
            'models' => $rows,
            'paidbycash' => $paidbycash,
            'paidbybanks' => $paidbybanks,
            'ktb' => $ktb,
            'scb' => $scb,
            'tmb' => $tmb,
            'kb' =>  $kb ,
            'ksb' => $ksb,
            'bkb' => $bkb,
            'gsb' => $gsb, 
        ]);

    }

    public function actionInstalment_by_instructor_detail($instalment_id){
        $this->layout = "employee_layout";
        $query = new Query;
        $paidbycash =array();
        $paidbybanks = array();
        $query->select('b.*,b.create_date as bb, a.total, c.instalment, c.monthly, c.year')
            ->from('summoney a')
            ->leftJoin('instalmentcostdetails b', 'a.instalment_id = b.instalment_id')
            ->leftJoin('instalment c', 'a.instalment_id = c.id')
            ->where(['a.instalment_id'=> $instalment_id])
            ->orderBy('b.contructor_id, b.money_type_id', 'asc')
            ->groupBy('b.id')
            ->all();
        $rows = $query->all();
        $command = $query->createCommand();
        $rows = $command->queryAll();
        $searchModel = new InstalmentcostdetailstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        // \app\models\Methods::print_array($rows); 
        $paidbycash = $this->getpaidByCashOrBank(1, $instalment_id, 6);//paidtype =1, instalment_id
        $paidbybanks = $this->getpaidByCashOrBank(2, $instalment_id, 6);
        
        // getข้อมูลการโอนเงินให้ช่างแยกเป็นธนาคาร(bank_id, instalment_id, paid_type)
        $ktb = $this->getTransferDivideBank(1, $instalment_id, 2);
        $scb = $this->getTransferDivideBank(2, $instalment_id, 2);
        $tmb = $this->getTransferDivideBank(3, $instalment_id, 2);
        $kb  = $this->getTransferDivideBank(4, $instalment_id, 2);
        $ksb = $this->getTransferDivideBank(5, $instalment_id, 2);
        $bkb = $this->getTransferDivideBank(6, $instalment_id, 2);
        $gsb = $this->getTransferDivideBank(7, $instalment_id, 2);
        // \app\models\Methods::print_array($ktb);
        return $this->render('instalment_by_instructor_detail',[
            'models' => $rows,
            'paidbycash' => $paidbycash,
            'paidbybanks' => $paidbybanks,
            'ktb' => $ktb,
            'scb' => $scb,
            'tmb' => $tmb,
            'kb' =>  $kb ,
            'ksb' => $ksb,
            'bkb' => $bkb,
            'gsb' => $gsb, 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionInstalmentSummary(){
        $this->layout = "employee_layout";
        if (Yii::$app->request->post('hasEditable')) {
            echo "sdfsdf";die();
        }
        $query = new Query;
        $query->select('a.*,a.create_date as aa, c.instalment, c.monthly, c.year')
        ->from('instalmentcostdetails a')
        // ->leftJoin('instalmentcostdetails a', 'a.instalment_id = a.instalment_id')
        ->leftJoin('instalment c', 'a.instalment_id = c.id')
        ->where(['a.instalment_id'=> $_REQUEST['instalment_id']])
        ->andWhere(['a.status' => 1])
        ->orderBy('a.contructor_id, a.house_id,a.money_type_id', 'asc')
        ->groupBy('a.id')
        ->all();
        $rows = $query->all();
        $command = $query->createCommand();
        $command = $query->createCommand();
        $rows = $command->queryAll();
        $searchModel = new InstalmentcostdetailstSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //    \app\models\Methods::print_array($dataProvider->getModels());

        return $this->render('instalment-summary',[
            'models' => $rows,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUnsetArray($id){
        $session = Yii::$app->session;
        unset($_SESSION['laborcostlist'][$id]);
        array_splice($_SESSION['laborcostlist'], 0, 0);

        return $this->redirect([
            'employee/instalment/instalment_by_instructor',
            'instalment_id' => $_REQUEST['instalment_id']
        ]);
     }
    /**
     * Finds the Instalment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Instalment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instalment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function saveInstalmentDetails($lists){
        // \app\models\Methods::print_array($lists);
        $session = Yii::$app->session;
        foreach($lists  as $key => $req){
            $m_type = $req['Instalmentcostdetails']['money_type_id'];
            $model = new \app\models\Instalmentcostdetails ();
            $model->instalment_id      = $req['Instalmentcostdetails']['instalment_id'];
            $model->contructor_id      = $req['Instalmentcostdetails']['contructor_id'];
            $model->house_id           = $req['Instalmentcostdetails']['house_id'];
            $model->workclassify_id    = $req['Instalmentcostdetails']['workclassify_id'];
            $model->worktype_id        = $req['Instalmentcostdetails']['worktype_id'];
            $model->work_id            = $req['Instalmentcostdetails']['work_id'];
            $model->money_type_id      = $m_type;
            if($m_type == 3 ){ //เงินยืม
                $model->amount         = $req['deduction']['loan_deduction']['amount'];
            }else if($m_type == 4){ //เงินค่าอุปกรณ์
                $model->amount         = $req['deduction']['equipment_deduction']['amount'];
            }else{
                $model->amount         = $req['Instalmentcostdetails']['amount'];
            }
            $model->summoney_id        = 0;
            $model->saver_id           = Yii::$app->user->identity->id;
            $model->comment            = $req['Instalmentcostdetails']['comment'];
            $model->create_date        = date('y-m-d H:i:s');
            $model->update_date        = date('y-m-d H:i:s');
            $model->save();
        }
        // $summoney = $this->sumAmountByIstalment();
        return $lists[0]['Instalmentcostdetails']['instalment_id'];
       
    }

    public function sumAmountByInstalment(){
        $query = new Query;
        // compose the query
        $query->select('sum(amount)as total, contructor_id, instalment_id')
            ->from('instalmentcostdetails')
            // ->where(['instalment_id'=>1])
            ->groupBy('contructor_id');
        // build and execute the query
        $rows = $query->all();
        // alternatively, you can create DB command and execute it
        $command = $query->createCommand();
        // $command->sql returns the actual SQL
        $rows = $command->queryAll();

        foreach($rows as $row){
            $summoney = new \app\models\Summoney();
            $summoney->total            = $row['total'];
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

    private function getpaidByCashOrBank($paidtype, $instalment_id, $project_id){
        // รายงานการจ่ายเงินงวดงานโดยจ่ายเงินสด
        $query = new Query();
        $query->select('a.instalment as a_inst,a.monthly, a.project_id,
                        b.instalment_id as sum_inst, b.total, b.id, b.contructor_id,
                        c.summoney_id as c_sum_id, c.paid_type, c.paid_amount, c.update_date,
                        d.name'
                        )
                ->from('instalment a')
                ->leftJoin('summoney b', 'a.instalment = b.instalment_id')
                ->leftJoin('paidtype c', 'b.id = c.summoney_id')
                ->leftJoin('profile d', 'b.contructor_id = d.user_id')
                ->where(['a.instalment'=> $instalment_id]) 
                ->andWhere(['c.paid_type' => $paidtype])
                ->andWhere(['a.project_id' => $project_id]);
                
                $command = $query->createCommand();
                $model   = $command->queryAll();
                return $model;
       
        return $model;

    }

    private function getTransferDivideBank($bank_id, $instalment_id, $paidtype){
        $query = new Query();
        $query->select('a.*, 
                        b.contructor_id,
                        c.name,
                        d.total,
                        e.paid_type,e.paid_amount,e.id,
                        f.account_bank,
                        g.id as bank_id, g.name as bank')
                       
            ->from('instalment a')
            ->leftJoin('instalmentcostdetails b', 'a.id = b.instalment_id')
            ->leftJoin('profile c', 'b.contructor_id = c.user_id')
            ->leftJoin('summoney d', 'c.user_id = d.contructor_id')
            ->leftJoin('paidtype e', 'd.id = e.summoney_id')
            ->leftJoin('user_bookbank_info f', 'c.user_id = f.user_id')
            ->leftJoin('banks g', 'f.bank_id = g.id')
            ->where(['a.id' => $instalment_id])
            ->andWhere(['e.paid_type' => $paidtype])
            ->andWhere(['g.id' => $bank_id])
            ->groupBy('e.id', 'asc');
            
        $command = $query->createCommand();
        $model   = $command->queryAll();
         return count($model)> 0 ? $model : array();
                    // \app\models\Methods::print_array($model);

    }

    public function actionEquipment(){
        return $this->renderAjax('_equipment');
    }
    public function actionLoan(){
        return $this->renderAjax('_loan');
    }

    public function actionChangeMoneyValue(){
        $model =  \app\models\Instalmentcostdetails::find()
                ->where(['id' => $_REQUEST['id']])->one();
        
        if(isset($_REQUEST['change_amount'])){
            // \app\models\Methods::print_array($_REQUEST);
            $model->house_id = $_REQUEST['house_id'];
            $model->workclassify_id = $_REQUEST['workclassify_id'];
            $model->worktype_id = $_REQUEST['Laborcostdetails']['workgroup']; 
            $model->work_id = $_REQUEST['Laborcostdetails']['works'];
            $model->amount = $_REQUEST['change_amount'];
            $model->money_type_id = $_REQUEST['money_type'];
            $model->save();

            return $this->redirect(['employee/instalment/instalment-summary','instalment_id'=>$model['instalment_id']]);
        }else{
            $query2 = new Query;
            $query2->select('a.*, b.wg_name, c.work_name, d.house_name')
            ->from('instalmentcostdetails a')
            ->leftJoin('work_group b', 'a.worktype_id = b.id')
            ->leftJoin('works c', 'a.work_id = b.id')
            ->leftJoin('houses d', 'a.house_id = d.id')
            ->where(['a.id'=>$_REQUEST['id']]);

            $rows = $query2->all();
            $model = $rows[0];

            $workclassify = \app\models\WorkCategory::find()->all();
            $workgroup = \app\models\WorkGroup::find()
                        ->where(['wc_id' => $model['workclassify_id']])->all();
            $works = \app\models\Works::find()->where(['wg_id' => $model['worktype_id']])->all();
            $houses = \app\models\Houses::find()->all();
        }

        return $this->renderAjax('change-money-value',[
            'model' => $model,
            'workclassify' =>$workclassify,
            'workgroup' => $workgroup,
            'works' => $works,
            'houses' => $houses

        ]);
    }

    public function actionDeleteMoneyValue(){
        $model =  \app\models\Instalmentcostdetails::find()
                ->where(['id' => $_REQUEST['id']])->one();
        
        $model->status = 0;
        $model->save();
    }

    public function actionExportExcel(){
        $query = new Query;
        $query->select('a.*,a.create_date as aa, c.instalment, c.monthly, c.year')
        ->from('instalmentcostdetails a')
        // ->leftJoin('instalmentcostdetails a', 'a.instalment_id = a.instalment_id')
        ->leftJoin('instalment c', 'a.instalment_id = c.id')
        ->where(['a.instalment_id'=> $_REQUEST['instalment_id']])
        ->andWhere(['a.status' => 1])
        ->orderBy('a.contructor_id, a.house_id,a.money_type_id', 'asc')
        ->groupBy('a.id')
        ->all();
        $models = $query->all();
        return $this->render('export-excel',[
            'models' =>$models,
        ]);

    }

    public function actionInstalmentdetail_by_house(){
        $searchModel = new \app\models\WorkGroupSearch();
        $this->layout = 'employee_layout';
        // $instalment = $this->_instalment_by_house($_REQUEST);
        $instalment = \app\controllers\ceo\LaborcostdetailsController::_instalment_by_house($_REQUEST);
        return $this->render('instalmentdetail_by_house',[
            'instalment' => count($instalment['instalment']) == 0 ? $instalment['empty_instalment'] : $instalment['instalment'],
            'instalment_sum_provider' => $instalment['instalment_sum_provider'],
            'searchModel' => $searchModel
        ]);
    }   
    
    public function actionTestexportexcel(){
        $instalment = \app\controllers\ceo\LaborcostdetailsController::_instalment_by_house($_REQUEST);
        return $this->renderPartial('_exceltest',[
            'instalment_sum_provider' => $instalment['instalment_sum_provider']
        ]);
    }
}
