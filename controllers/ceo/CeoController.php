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


class CeoController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout' ,'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "ceo_layout";

        $sql_one = 'select a.project_id,
        a.projectname, a.start_date, a.end_date,a.control_statement,
        count(b.id) as unit_count
        from project a
        left join houses b on a.project_id = b.project_id
        group by a.projectname,a.control_statement,b.project_id;';
        $data_one = Yii::$app->db->createCommand($sql_one)->queryAll();
        // \app\models\Methods::print_array($data_one);

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
        
        $sql_grid = 'select a.projectname,
                    ifnull(sum(d.work_control_statement),0)as fixpaid,
                    ifnull(sum(c.amount),0)as paid 
                    from project a
                    left join instalment b on a.project_id = b.project_id
                    left join instalmentcostdetails c on b.id = c.instalment_id
                    left join works d on c.work_id = d.id
                    group by a.projectname;';
        $data_grid = Yii::$app->db->createCommand($sql_grid)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data_grid
        ]);
        
        return $this->render('index',[
            'boxs' => $data_one,
            'chart1' => array_values($arr_data),
            'chart_payee' => array_values($arr_payee),
            'dataProvider' => $dataProvider
        ]);
    }



    public function actionProjectdetail($project_id){
        $this->layout = 'ceo_layout';
        $searchModel = new HousesSearch();
        $res = $this::_projectdetail($project_id);
        // \app\models\Form::print_array($houseCount);
        return $this->render('projectdetail', [
            'houseCount' => $res['houseCount'],
            'noneBuildedHouses' => $res['noneBuildedHouses'],
            'duringBuildedHouses' => $res['duringBuildedHouses'],
            'completeBuildedHoueses' => $res['completeBuildedHoueses'],
            // 'sumControlStatement' => $res['sumControlStatement'],
            'sumPaidAmountByProject' => $res['sumPaidAmountByProject'],
            'provider' => $res['provider'],
            'dataProvider' => $res['dataProvider'],
            'project' => $res['project'],
            'searchModel' =>$searchModel
        ]);
    }

    public static function _projectdetail($project_id){
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

        $project = \app\models\Project::find()
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
        // $query = new Query();
        // $provider = new ActiveDataProvider([
        //     'query' => $query
        //                 ->select('a.id, a.house_name,
        //                     b.hm_name        
        //                 ')
        //                 ->from('houses a')
        //                 ->leftJoin('house_model b','a.house_model_id = b.id'),
        //     'pagination' => [
        //         'pageSize' => 20,
        //     ],
        // ]);
        
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

        $res['houseCount'] = Houses::find()->all();
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

