<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\bootstrap\Modal;


class Methods extends Model
{
    public function print_array($arr){
        echo  "<pre>";
        print_r($arr);
        die();
    }

    public function getMonthLists(){
        $months =[
            '00' => '',
            '01'=>'มกราคม',
            '02'=>'กุมภาพันธ์',
            '03'=>'มีนาคม',
            '04'=>'เมษายน',
            '05'=>'พฤษภาคม',
            '06'=>'มิถุนายน',
            '07'=>'กรกฎาคม',
            '08'=>'สิงหาคม',
            '09'=>'กันยายน',
            '10'=>'ตุลาคม',
            '11'=>'พฤศจิกายน',
            '12'=>'ธันวาคม',
        ];
        return $months;
    }
    public function getMonth($index){
        $months =[
            '00' => '',
            '01'=>'มกราคม',
            '02'=>'กุมภาพันธ์',
            '03'=>'มีนาคม',
            '04'=>'เมษายน',
            '05'=>'พฤษภาคม',
            '06'=>'มิถุนายน',
            '07'=>'กรกฎาคม',
            '08'=>'สิงหาคม',
            '09'=>'กันยายน',
            '10'=>'ตุลาคม',
            '11'=>'พฤศจิกายน',
            '12'=>'ธันวาคม',
        ];
        return $months[$index];
    }

    public function createDate($date){
        $sub_date = explode("-", $date);
        $thai_year = $sub_date[0]+543;
        $thai_month = \app\models\Methods::getMonth($sub_date[1]);
        return $sub_date[2]." ".$thai_month." ".$thai_year;
    }

    public static function house_status($house_status){
        $status_str ="";
        switch($house_status){
            case 0 :
                $status_str = "ยังไม่ก่อสร้าง";
                break;
            case 1 :
                $status_str = "กำลังก่อสร้าง";
                break;
            default:
                $status_str = "สร้างเสร็จแล้ว";
        }
        return $status_str;
    }

    public function alert_card($alert_title,$alert_subtitle,$alert_content, $alert_bgcolor){
        echo'
        <div class="container-fluid">
            <div class="card">
                <div class="card-header" data-background-color="'.$alert_bgcolor.'">
                    <h4 class="title" style="text-align:left">'.$alert_title.'</h4>
                    <p class="subtitle">'.$alert_subtitle.'</p>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info alert-with-icon" data-notify="container">
                                <i data-notify="icon" class="material-icons">add_alert</i>
                                <span data-notify="message"><h3>'.$alert_content.'</h3></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    public  function card_header($title, $subtitle, $a_text="", $action="", $btn_color="btn-info", $display){
        echo '
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="title" style="text-align:left !important">
                            '.$title.'
                        </h4>
                        <p class="category">'.$subtitle.'</p>
                    </div>
                    <div class="col-md-3">&nbsp;'
                        .Html::a("$a_text", ["$action"], 
                            [
                                "class" => "btn $btn_color btn-round",
                                "style" => $display == false ? "display:none" :"color:#ffffff; font-weight:bold"
                            ]).'
                    </div>
                </div>
            </div>
            <div class="card-content" style="margin-top:0">
        ';
    }

    public function card_footer(){
        echo '
            </div><!-- card-content -->
        </div><!-- card -->
        ';
    }

    public static function get_amount_over($id){
        $sql = "
            SELECT  a.id as house_id, a.house_name,
                b.hm_name, b.hm_control_statment ,
                c.wg_id , d.wg_name, c.cost_control ,
                (SELECT SUM(cost_control) FROM house_model_have_workgroup WHERE house_model_id = b.id ) as sum_cost_control,
                (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ".$id." AND worktype_id = c.wg_id) as paid_amount,
                (SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ".$id.") as sum_paid_amount,
                ((SELECT SUM(amount) FROM instalmentcostdetails WHERE house_id = ".$id." AND worktype_id = c.wg_id)/c.cost_control)*100 as progress_percent
            FROM houses a
            LEFT JOIN house_model b ON a.house_model_id = b.id
            LEFT JOIN house_model_have_workgroup c ON b.id = c.house_model_id
            LEFT JOIN work_group d ON c.wg_id = d.id
            LEFT JOIN instalmentcostdetails e ON a.id = e.house_id
            LEFT JOIN works f ON e.work_id = f.id
            WHERE a.id=".$id." 
            Group By c.wg_id";
        $datas = Yii::$app->db->createCommand($sql)->queryAll();
        $i=0;
        foreach($datas as $data){
            if($data['progress_percent']> 0){
                $over=$data['paid_amount'] - $data['cost_control'];
                $over > 0 ? $i++ : $i+0; 
                // echo $over;
            }
        }
        return $i;
        // \app\models\Methods::print_array($datas);
    }


    public static function find_abnormal_house_status($ab_house_status){
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
            foreach($datas as $data){
               foreach($data as $d){
                    $percent = empty($d['progress_percent']) ? 0 : $d['progress_percent'];
                    if($percent > 100){
                        array_push($_house_id, $d['house_id']);
                    }
               }
            }
        }
        return $_house_id;
    }
    
}

?>