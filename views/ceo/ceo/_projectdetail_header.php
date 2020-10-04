<?php 
use yii\helpers\Html;
?>
<div class="row">

  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="blue">
        <i class="material-icons">apps</i>
      </div>
      <div class="card-content">
        <h3 class="title">
        สิริมงคล  <?=substr($houseCount[0]['project_id'],-1);?>
        </h3>
      </div>

      <!-- <div class="card-footer">
        <h4 class="title">
            <small>
              <=\app\models\Methods::createDate($project['start_date']);?>
              <br>
              <=\app\models\Methods::createDate($project['end_date']);?>  
            </small>
        </h4>
      </div> -->
    </div><!--card-->
  </div><!--col -->
  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="green">
        <i class="material-icons">account_balance_wallet</i>
      </div>
      <div class="card-content">
        <h4 class="title">
        งบก่อสร้าง
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
            <small><?=number_format($project['control_statement'],2);?>&nbsp;บาท</small>
        </h3>
      </div>
    </div><!--card-->
  </div><!--col -->

  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="green">
      <i class="material-icons">trending_up</i>
      </div>
      <div class="card-content">
        <h4 class="title">
        เบิกจ่ายงบ
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
            <small><?=number_format($sumPaidAmountByProject,2);?>&nbsp;บาท</small>
        </h3>
      </div>
    </div><!--card-->
  </div><!--col -->

  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="green">
      <i class="material-icons">pie_chart</i>
      </div>
      <div class="card-content">
        <h4 class="title">
        % เบิกจ่ายงบ
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
        <small><?=number_format(($sumPaidAmountByProject*100)/$project['control_statement'],2);?> %</small>
        </h3>
      </div>
    </div><!--card-->
  </div><!--col -->
</div><!--row-->


<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="orange">
      <i class="material-icons">home</i>
      </div>
      <div class="card-content">
        <h4 class="title">
        จำนวนบ้าน
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
        <small><?=count($houseCount);?>&nbsp;หลัง</small>
        </h3>
      </div>
    </div><!--card-->
  </div><!--col -->
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="orange">
      <i class="material-icons">home</i>
      </div>
      <div class="card-content" style="padding:15px 5px !important">
        <h4 class="title">
        <?php $nobuilt = count($houseCount)-($completeBuildedHoueses+$duringBuildedHouses);?>
        ยังไม่ดำเนินการ <?=$nobuilt;?>หลัง
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
          <small style="color:green">ปกติ : <?=$nobuilt - $paid_abnormal_houses0;?>&nbsp;หลัง</small>
        </h3>
        <h4 class="title">
        <?= Html::a('&nbsp;','') ?>

        </h4>
      </div>
    </div><!--card-->
  </div><!--col -->

  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="orange">
      <i class="material-icons">home</i>
      </div>
      <div class="card-content">
        <h4 class="title">
        บ้านแล้วเสร็จ <?=$completeBuildedHoueses;?>&nbsp;หลัง
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
          <small style="color:green">ปกติ : <?=$completeBuildedHoueses - $paid_abnormal_houses2;?>&nbsp;หลัง</small>
        </h3>
        <h4 class="title">
        <?= Html::a('จ่ายเกินงบ : '.count($house_status['complete']).' หลัง',
              ['ceo/ceo/projectdetail','project_id' => $project['project_id'], 
              'abnormal_house_status' => 2], ['style'=>"color:red"]) //$paid_abnormal_houses2 ?>

        </h4>
       
      </div>
    </div><!--card-->
  </div><!--col -->

  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="orange">
      <i class="material-icons">home</i>
      </div>
      <div class="card-content" style="padding:15px 3px !important">
        <h4 class="title">
        กำลังก่อสร้าง <?=$duringBuildedHouses;?> หลัง
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title">
          <small style="color:green">ปกติ : <?=$duringBuildedHouses - $paid_abnormal_houses1;?>&nbsp;หลัง</small>
        </h3>
        <h4 class="title">
        <?= Html::a('จ่ายเกินงบ : '.count($house_status['buliding']).' หลัง',
              ['ceo/ceo/projectdetail','project_id' => $project['project_id'], 
              'abnormal_house_status' => 1], ['style'=>"color:red"]) ?>

        </h4>
      </div>
    </div><!--card-->
  </div><!--col -->    
</div><!--row-->

