<div class="row">

  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header" data-background-color="blue">
        <i class="material-icons">apps</i>
      </div>
      <div class="card-content">
        <h3 class="title text-right">
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
        <h3 class="title text-right">
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
        <h3 class="title text-right">
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
        <h3 class="title text-right">
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
        <h3 class="title text-right">
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
        <h4 class="title ">
        <?php $nobuilt = count($houseCount)-($completeBuildedHoueses+$duringBuildedHouses);?>
        ยังไม่ดำเนินการ 
        </h4>
      </div>

      <div class="card-footer">
         <h3 class="title text-right">
          <small style="color:green"><?=$nobuilt;?> &nbsp;หลัง</small>
        </h3>
       <!-- <h3 class="title text-right">
          <small style="color:red">จ่ายเกินงบ : <=$paid_abnormal_houses0;?>&nbsp;หลัง</small>
        </h3> -->
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
        <h3 class="title text-right">
          <small style="color:green">ปกติ : <?=$completeBuildedHoueses - $paid_abnormal_houses2;?>&nbsp;หลัง</small>
        </h3>
        <h3 class="title text-right">
          <small style="color:red">จ่ายเกินงบ : <?=$paid_abnormal_houses2;?>&nbsp;หลัง</small>
        </h3>
      </div>
    </div><!--card-->
  </div><!--col -->

  <div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
      <div class="card-header" data-background-color="orange">
      <i class="material-icons">home</i>
      </div>
      <div class="card-content" style="padding:15px 10px !important">
        <h4 class="title">
        กำลังก่อสร้าง <?=$duringBuildedHouses;?>&nbsp;หลัง
        </h4>
      </div>

      <div class="card-footer">
        <h3 class="title text-right">
          <small style="color:green">ปกติ : <?=$duringBuildedHouses - $paid_abnormal_houses1;?>&nbsp;หลัง</small>
        </h3>
        <h3 class="title text-right">
          <small style="color:red">จ่ายเกินงบ : <?=$paid_abnormal_houses1;?>&nbsp;หลัง</small>
        </h3>
      </div>
    </div><!--card-->
  </div><!--col -->    
</div><!--row-->

