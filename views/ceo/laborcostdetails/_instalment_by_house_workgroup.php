<section class="content">
<?php if(count($instalment)> 0){ 
    $percent = ($instalment[0]['sum_amount']/$instalment[0]['hm_control_statment'])*100    
?>
    <div class="box box-success ">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-map-o"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">แบบบ้าน :</span>
                <span class="info-box-number"> <?=$instalment[0]['hm_name']; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">แปลงบ้าน</span>
                <span class="info-box-number"><?=$instalment[0]['house_name'];?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box <?=$percent > 100 ?' bg-yellow' : '' ?>">
                <span class="info-box-icon <?=$percent > 100 ?' bg-yellow' : 'bg-green' ?>">
                    <i class="fa  fa-line-chart"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">สถานะการก่อสร้าง</span>
                <span class="info-box-number"><?=number_format($percent,2);?><small>%</small></span>
                <span class="info-box-text"><?=$percent > 100 ?'เกินงบควบคุม' : 'ปกติ' ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>
            <table class="table table-bordered <?=$percent > 100 ?' bg-yellow' : '' ?>">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>กลุ่มงาน</th>
                        <th>จำนวน(บาท)</th>
                    </tr>
                </thead>
                <tbody>
                <!-- <=\app\models\Methods::print_array($instalment);?> -->
                <?php 
                    $i=1;
                    foreach($instalment as $inst){ 
                ?>
                    <tr>
                        <td><?=$i++;?></td>
                        <td class="work_despt"><?=$inst['wg_name'];?></td>
                        <td class="_number"><?=number_format($inst['amount'],2);?></td>
                    </tr>
                <?php }?>
                </tbody>
                <tfooter>
                    <tr>
                        <th colspan='2'>รวม</th><th class="_number"><?=number_format($instalment[0]['sum_amount'],2);?></th>
                    </tr> 
                    <tr>
                        <th colspan='2'>Budget</th>
                        <th class="_number"><?=number_format($instalment[0]['hm_control_statment'],2);?></th>
                    </tr>   
                    <tr>
                        <th colspan='2'></th>
                        <th class="_number"><?=number_format($percent,2)."%";?></th>
                    </tr>   
                </tfooter>
            </table>       
    </div>
<?php }else{
    echo "<center><h2>ไม่พบข้อมูล</h2></center>";
}?>
</section>