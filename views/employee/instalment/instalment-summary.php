<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

$this->title = 'สรุปเบิกจ่ายเงินงวดงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instalment-index box box-success">
    <div class="box-body">
    <?php if(count($models)>0){ ?>
        <?php
            $title = $this->title;
            $subtitle = 'สรุปเบิกจ่ายเงินงวดงาน';
            $a_text = "แก้ไขงวดเบิกจ่าย";
            $action= "create";
            $btn_color = "btn-info";
            $display = false;
            \app\models\Methods::card_header($title,  $subtitle, $a_text, $action, $btn_color, $display); 
        ?>
         <?=$this->render("_instalmentdetails_by_constructors.php",[
                'models' => $models,
                'editable' => 1,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);?>

        <?=\app\models\Methods::card_footer();?>
    <?php }else{
            $alert_title = 'สรุปเบิกจ่ายเงินงวดงาน';
            $alert_subtitle = "แก้ไขงวดเบิกจ่าย ";
            $alert_content = "ไม่พบข้อมูล"; 
            $alert_bgcolor = 'orange';
            \app\models\Methods::alert_card($alert_title,$alert_subtitle,$alert_content, $alert_bgcolor);
            
        }
    ?>
    </div>
</div>