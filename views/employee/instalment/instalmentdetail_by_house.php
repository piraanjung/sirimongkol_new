<?php

    $this->title = 'สรุปการจ่ายค่าแรง แปลงที่'.$instalment[0]['house_id'];
                    // " งวดที่ ".$instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'].
                    // ".".$instalment[0]['instalment_year'];
    
    $this->params['breadcrumbs'][] = ['label' => 'สรุปการจ่ายเงินงวดรายแปลง'.$instalment[0]['project_id'], 
                    'url' => ['employee/instalment/projectdetail','project_id' =>$instalment[0]['project_id']]]; 
    $this->params['breadcrumbs'][] = $this->title;
    ?>
<?php if(!isset($instalment['empty_instalment'])){ ?>
<?=$this->render('/ceo/laborcostdetails/_instalmentdetail_by_house',[
                    'instalment' => $instalment,
                    'instalment_sum_provider' => $instalment_sum_provider,
                    'searchModel' => $searchModel
                ])
        ?>
<?php }else{
     $title =$this->title;
     $subtitle = "";
     $a_text = "";
     $action= "";
     $btn_color = "btn-info";
     $display = false;
     \app\models\Methods::card_header($title, $subtitle, $a_text, $action, $btn_color, $display); 
     echo "<h3>ไม่พบข้อมูล การจ่ายค่าแรง แปลงที่ ".$instalment[0]['house_id']."</h3>";
     \app\models\Methods::card_footer();
} ?>