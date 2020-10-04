<?php

namespace app\controllers\ceo;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\WorkType;
use app\models\Housemodels;
use app\models\Houses;
use app\models\HousesSearch;
use app\models\Project;
use app\models\Methods;

use yii\web\NotFoundHttpException;

class CeoController extends Controller
{
  
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout', 'index', 'ceo_projectdetail'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout' ,'index', 'ceo_projectdetail'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //     ];
    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function actions()
    // {
    //     return [
    //         'error' => [
    //             'class' => 'yii\web\ErrorAction',
    //         ],
    //         'captcha' => [
    //             'class' => 'yii\captcha\CaptchaAction',
    //             'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
    //         ],
    //     ];
    // }

    public function actionIndex()
    {
        $this->layout = "ceo_layout";
        $searchModel = new HousesSearch();

        $dataProvider2 = $searchModel->search(Yii::$app->request->queryParams);
        $project_id = !isset($_REQUEST['project_id']) ? 6 : $_REQUEST['project_id'];
        $sql_one = 'select a.project_id,
        a.projectname, a.start_date, a.end_date,a.control_statement,
        count(b.id) as unit_count
        from project a
        left join houses b on a.project_id = b.project_id
        where a.project_id = '.$project_id.' 
         group by a.projectname,a.control_statement,b.project_id;';
        $data_one = Yii::$app->db->createCommand($sql_one)->queryAll();
       

        $sql = 'select b.wc_name,sum(a.amount) as paid 
                from instalmentcostdetails a
                inner join work_category b on a.workclassify_id = b.id 
                group by a.workclassify_id
                order by b.id asc;';
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $arr_data = [];
        array_push($arr_data, ['wc_name','จ่าย(บาท)']);
        foreach ($data as $row){
            $d1 = [$row['wc_name'], (int)$row['paid']];
            array_push($arr_data,$d1);
        }
        
        $sql_payee = 'select b.username,sum(a.amount) as paid 
                    from instalmentcostdetails a
                    inner join user b on a.saver_id = b.id 
                    group by b.username';
        $data_payee = Yii::$app->db->createCommand($sql_payee)->queryAll();
        
        $arr_payee = [];
        array_push($arr_payee, ['username','paid']);
        foreach ($data_payee as $row){
            $d1 = [$row['username'], (int)$row['paid']];
            array_push($arr_payee, $d1);
        }
        
        $sql_grid = 'select a.projectname, a.project_id,
                    ifnull(sum(d.work_control_statement),0)as fixpaid,
                    ifnull(sum(c.amount),0)as paid 
                    from project a
                    left join instalment b on a.project_id = b.project_id
                    left join instalmentcostdetails c on b.id = c.instalment_id
                    left join works d on c.work_id = d.id 
                    where a.project_id = '.$project_id.' 
                    group by a.projectname ;';
        $data_grid = Yii::$app->db->createCommand($sql_grid)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data_grid
        ]);
        // แสดงรายการโครงการทั้งหมด
        $project_list = Project::find()->all();
        
        $methodModel = new Methods();
        $projectdetails =$this::ceo_projectdetail($project_id);
        $house_status['empty'] = \app\models\Methods::find_abnormal_house_status(0);
        $house_status['buliding'] = \app\models\Methods::find_abnormal_house_status(1);
        $house_status['complete'] = \app\models\Methods::find_abnormal_house_status(2);
        //  \app\models\Methods::print_array($project_list);
        return $this->render('index',[
            'boxs' => $data_one,
            'chart1' => array_values($arr_data),
            'chart_payee' => array_values($arr_payee),
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'projectdetails' => $projectdetails['dataProvider'],
            'project_list' => $project_list,
            'house_status' => $house_status
        ]);
    }



    public function actionProjectdetail($project_id){
        $this->layout = 'ceo_layout';
        $searchModel = new HousesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $res = $this::ceo_projectdetail($project_id);


        // $sql = 'SELECT houses.*, house_model.hm_name, SUM(instalmentcostdetails.amount) 
        //         FROM `houses` LEFT JOIN house_model ON houses.house_model_id = house_model.id 
        //         LEFT JOIN instalmentcostdetails ON instalmentcostdetails.house_id = houses.id 
        //         GROUP BY instalmentcostdetails.house_id';
        // $data = Yii::$app->db->createCommand($sql)->queryAll();
        // $a =array();
        // foreach($data as $d){
        //     array_push($a,\app\models\Methods::get_amount_over($d['id']));
        // }
        $house_status['empty'] = \app\models\Methods::find_abnormal_house_status(0);
        $house_status['buliding'] = \app\models\Methods::find_abnormal_house_status(1);
        $house_status['complete'] = \app\models\Methods::find_abnormal_house_status(2);
        // \app\models\Methods::print_array($bb);
        // \app\models\Form::print_array($houseCount);
        return $this->render('projectdetail', [
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
            'dataProvider' => $dataProvider,
            'house_status' => $house_status
        ]);
    }

    public static  function ceo_projectdetail($project_id){
        
        $res=array();
        $sql_grid = 'select 
            a.*, 
            b.hm_name,b.hm_control_statment,
            (select sum(amount) as _total
                from instalmentcostdetails
                where house_id = a.id) as sum_amount,
            (select count(house_model_id) from house_model_have_workgroup 
                where house_model_id = a.house_model_id) as workgroup_num

            from houses a
            left join house_model b on a.house_model_id = b.id 
            where a.project_id='. $project_id;
        $data_grid = Yii::$app->db->createCommand($sql_grid)->queryAll();

        $project = Project::find()
                ->where(['project_id' => $project_id])
                ->one();    

        $provider = new ArrayDataProvider([
            'allModels' =>$data_grid,
            // 'sort' => [
            //     'attributes' => ['id', 'username', 'email'],
            // ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        $query2 = new Query;
        $query2->select('a.*, b.*')
                ->from('instalment a')
                ->leftJoin('instalmentcostdetails b', 'a.id = b.instalment_id')
                ->where(['a.project_id' => $project_id]);
        $model = $query2->all();
        // \app\models\Methods::print_array($model);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $model,
                'pagination' => [
                    'pageSize' => 2,
                ],
            ]);

        $res['houseCount'] = Houses::find() ->where(['project_id' => $project_id])->all(); 
        $res['noneBuildedHouses'] = Houses::countHousesByStatus(0, $project_id);
        $res['duringBuildedHouses'] = Houses::countHousesByStatus(1,$project_id);
        $res['completeBuildedHoueses']  = Houses::countHousesByStatus(2, $project_id);
        // $sumControlStatement = Houses::sumControllStatement();
        $res['sumPaidAmountByProject'] = Houses::sumPaidAmountByProject($project_id);
        $res['provider']= $provider;
        $res['dataProvider']= $dataProvider;
        $res['project']= $project;
        
        return $res;
    }
}

