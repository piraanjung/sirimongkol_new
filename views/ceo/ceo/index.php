<?php
use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use app\models\Houses;
/* @var $this yii\web\View */

$this->title = 'หน้าแรก ความคืบหน้าโครงการ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php foreach ($boxs as $box) {?>
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

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">store</i>
                    </div>
                    <div class="card-content">
                        <h3 class="title">
                            <small>จำนวนบ้าน</small>
                        </h3>
                    </div>

                    <div class="card-footer">
                        <h3 class="title">
                            <?=$box['unit_count']?>
                                <small>หลัง</small>
                        </h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">ความคืบหน้าการก่อสร้าง</h4>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <tr>
                                    <th>บ้านเสร็จแล้ว</th>
                                    <th>
                                        <?=$completeBuildedHoueses  = Houses::countHousesByStatus(2,$box['project_id']); ?>
                                    </th>
                                    <th>หลัง</th>
                                </tr>
                            </thead>
                            <thead class="text-warning">
                                <tr>
                                    <th>กำลังก่อสร้าง</th>
                                    <th>
                                        <?=$duringBuildedHouses = Houses::countHousesByStatus(1, $box['project_id']);?>
                                    </th>
                                    <th>หลัง</th>
                                </tr>
                            </thead>
                            <thead class="text-warning">
                                <tr>
                                    <th>ยังไม่ดำเนินการ</th>
                                    <th>
                                        <?=$noneBuildedHouses = Houses::countHousesByStatus(0, $box['project_id']);?>
                                    </th>
                                    <th>หลัง</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
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
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title"> ความคืบหน้าเบิกจ่ายงบก่อสร้าง</h4>
                    </div>
                    <div class="card-content">
                        <table class="table table-hover">
                            <thead class="text-success">
                                <tr>
                                    <th>เบิกจ่ายงบก่อสร้างแล้ว</th>
                                    <th>
                                        <?php 
                $sumPaidAmountByProject = Houses::sumPaidAmountByProject($box['project_id']);
                echo number_format($sumPaidAmountByProject,2);
                ?> </th>
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
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
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
                            เริ่มการก่อสร้าง   : <?=\app\models\Methods::createDate($box['start_date']);?>
                            สิ้นสุดการก่อสร้าง: <?=\app\models\Methods::createDate($box['end_date']);?>   
                        </h4>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <h4 class="title"> </h4>
                    </div>
                    <div class="card-content">
                        <table class="table table-hover">
                            <thead class="text-success">
                                <tr>
                                    <th>เบิกจ่ายงบก่อสร้างแล้ว</th>
                                    <th>
                                        </th>
                                    <th>บาท</th>
                                </tr>
                            </thead>
                            <thead class="text-success">
                                <tr>
                                    <th>คิดเป็น %</th>
                                    <th>
                                        
                                    </th>
                                    <th>%</th>

                        </table>
                    </div>
                </div> -->
            </div>


        </div>

    </div>


    <?php } ?>

    </div>
    </div>