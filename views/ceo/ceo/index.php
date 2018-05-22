<?php
use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use app\models\Houses;
/* @var $this yii\web\View */

$this->title = 'หน้าแรก ความคืบหน้าโครงการ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php foreach ($boxs as $box) {?>
    <?php
        //หาจำนวนบ้านที่มีการจ่ายเงินผิดปกติ
        $paid_abnormal_houses0 =0;
        $paid_abnormal_houses1 =0;
        $paid_abnormal_houses2 =0;
        // print_r($dataProvider2->getModels());
        foreach($dataProvider2->getModels() as $a){
            $i = \app\models\Methods::get_amount_over($a['id']);
            if($i > 0){
                if($a['house_status'] ==0 ){
                    $paid_abnormal_houses0+=1;
                }else if($a['house_status'] ==1 ){
                    $paid_abnormal_houses1+=1;
                }else if($a['house_status'] ==2){
                    $paid_abnormal_houses2+=1;
                }
            }
            // $i <= 0 ? $paid_abnormal_houses+=0 : $paid_abnormal_houses+=1;
        }
    ?>
        <div class="container-fluid">
            <div class="card card-profile col-md-4">
                <div class="card-avatar">
                    <?=Html::img("@web/images/siri_logo.jpg");?>
                </div>
                <div class="content">
                    <h6 class="category text-gray">ชื่อโครงการ</h6>
                    <h4 class="card-title">
                        <?=$box['projectname'];?>
                    </h4>

                    <?= Html::a('ดูรายละเอียด', ['ceo/ceo/projectdetail', 'project_id' => $box['project_id']]
                    ,['class'=>'btn btn-primary btn-round'])?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">home</i>
                        </div>
                        <div class="card-content" style="padding:15px 5px !important">
                            <h4 class="title">
                                จำนวนบ้าน
                            </h4>
                            <h4 class="title">
                                &nbsp;
                            </h4>
                        </div>

                        <div class="card-footer">
                            <h3 class="title">
                                <small>
                                    <?=$box['unit_count'];?>&nbsp;หลัง</small>
                            </h3>
                            <h3 class="title">
                                &nbsp;
                            </h3>
                        </div>
                    </div>
                    <!--card-->
                </div>
                <!--col -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">home</i>
                        </div>
                        <div class="card-content" style="padding:15px 5px !important">
                            <h4 class="title">
                                <?php $noneBuildedHouses = Houses::countHousesByStatus(0, $box['project_id']);?> ยังไม่ดำเนินการ
                                <?=$noneBuildedHouses;?> &nbsp;หลัง
                            </h4>

                        </div>

                        <div class="card-footer">
                            <h3 class="title">
                                <small style="color:green">ปกติ :
                                    <?=$noneBuildedHouses - $paid_abnormal_houses0;?>&nbsp;หลัง</small>
                            </h3>
                            <h3 class="title">
                                <small style="color:red">จ่ายเกินงบ :
                                    <?=$paid_abnormal_houses0;?>&nbsp;หลัง</small>
                            </h3>
                        </div>
                    </div>
                    <!--card-->
                </div>
                <!--col -->

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">home</i>
                        </div>
                        <div class="card-content">
                            <h4 class="title">
                                <?php $completeBuildedHoueses  = Houses::countHousesByStatus(2,$box['project_id']); ?> บ้านแล้วเสร็จ
                                <?=$completeBuildedHoueses;?>&nbsp;หลัง
                            </h4>
                        </div>

                        <div class="card-footer">
                            <h3 class="title">
                                <small style="color:green">ปกติ :
                                    <?=$completeBuildedHoueses - $paid_abnormal_houses2;?>&nbsp;หลัง</small>
                            </h3>
                            <h3 class="title">
                                <small style="color:red">จ่ายเกินงบ :
                                    <?=$paid_abnormal_houses2;?>&nbsp;หลัง</small>
                            </h3>
                        </div>
                    </div>
                    <!--card-->
                </div>
                <!--col -->

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">home</i>
                        </div>
                        <div class="card-content">
                            <h4 class="title">
                                <?php $duringBuildedHouses = Houses::countHousesByStatus(1, $box['project_id']);?> กำลังก่อสร้าง
                                <?=$duringBuildedHouses;?>&nbsp;หลัง
                            </h4>
                        </div>

                        <div class="card-footer">
                            <h3 class="title">
                                <small style="color:green">ปกติ :
                                    <?=$duringBuildedHouses - $paid_abnormal_houses1;?>&nbsp;หลัง</small>
                            </h3>
                            <h3 class="title">
                                <small style="color:red">จ่ายเกินงบ :
                                    <?=$paid_abnormal_houses1;?>&nbsp;หลัง</small>
                            </h3>
                        </div>
                    </div>
                    <!--card-->
                </div>
                <!--col -->
            </div>
            <!--row-->

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">store</i>
                        </div>
                        <div class="card-content">
                            <h3 class="title">
                                <small>งบก่อสร้าง</small>
                            </h3>
                        </div>

                        <div class="card-footer">
                            <h3 class="title">
                                <?= number_format($box['control_statement'],2) ?>
                                    <small>บาท</small>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">store</i>
                        </div>
                        <div class="card-content" style="padding:15px 5px !important">
                            <h3 class="title">
                                <small>ความคืบหน้าเบิกจ่ายงบก่อสร้าง</small>
                            </h3>
                        </div>

                        <div class="card-footer">
                            <!-- <h3 class="title"> -->
                            <?php 
                                $sumPaidAmountByProject = Houses::sumPaidAmountByProject($box['project_id']);
                            ?>
                            <table class="table table-hover">
                                <thead class="text-success">
                                    <tr>
                                        <th>เบิกจ่ายงบก่อสร้างแล้ว</th>
                                        <th>
                                            <?php echo number_format($sumPaidAmountByProject,2);?>
                                        </th>
                                        <th>บาท</th>
                                    </tr>
                                </thead>
                                <thead class="text-success">
                                    <tr>
                                        <th>คิดเป็น %</th>
                                        <th>
                                            <?=number_format(($sumPaidAmountByProject*100)/$box['control_statement'],2);?>
                                        </th>
                                        <th>%</th>

                            </table>
                            <!-- </h3> -->
                        </div>


                    </div>
                </div>


                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="blue">
                                <i class="material-icons">store</i>
                            </div>
                            <div class="card-content">
                                <h3 class="title">
                                    <small>ระยะเวลาการก่อสร้าง</small>
                                </h3>
                            </div>

                            <div class="card-footer">
                                <h4>
                                    เริ่มการก่อสร้าง :
                                    <?=\app\models\Methods::createDate($box['start_date']);?>
                                        <br> สิ้นสุดการก่อสร้าง:
                                        <?=\app\models\Methods::createDate($box['end_date']);?>
                                </h4>
                            </div>
                        </div>
                    </div>




                </div>


                <?php } ?>

            </div>
        </div>