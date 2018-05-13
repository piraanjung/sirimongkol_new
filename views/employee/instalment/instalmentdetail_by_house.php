<?php
if(!isset($instalment['empty_instalment'])){
    $this->title = 'สรุปการจ่ายค่าแรง แปลงที่'.$instalment[0]['house_id'];
                    // " งวดที่ ".$instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'].
                    // ".".$instalment[0]['instalment_year'];
    
    $this->params['breadcrumbs'][] = ['label' => 'สรุปการจ่ายเงินงวดรายแปลง'.$instalment[0]['project_id'], 
                    'url' => ['employee/instalment/projectdetail','project_id' =>$instalment[0]['project_id']]]; 
    $this->params['breadcrumbs'][] = $this->title;
    ?>
<?=$this->render('/ceo/laborcostdetails/_instalmentdetail_by_house',[
                    'instalment' => $instalment,
                    'instalment_sum_provider' => $instalment_sum_provider,
                    'searchModel' => $searchModel
                ])
        ?>
<?php } ?>