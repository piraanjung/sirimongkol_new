<style>

    .bg-yellow{
        background:#fb8c00;
    }
</style>

<?php if(count($instalment)> 0){  
    $percent = $instalment[0]['hm_control_statment']== '' ? 0 : ($instalment[0]['sum_amount']/$instalment[0]['hm_control_statment'])*100    
?>


<div class="row">
    
    <!--col -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="material-icons">home</i>
            </div>
            <div class="card-content" style="padding:15px 5px !important">
                <h4 class="title">
                แปลงบ้าน
                </h4>
            </div>

            <div class="card-footer">
                <h3 class="title">
                    <small><?=$instalment[0]['house_name'];?>
                    [ <?=$instalment[0]['hm_name'];?> ]</small> 
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
                 งบควบคุม
                </h4>
            </div>

            <div class="card-footer">
                <h3 class="title">
                    <small><?=number_format($instalment[0]['hm_control_statment'],2);?>&nbsp;บาท</small>
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
                จ่ายแล้ว
                </h4>
            </div>

            <div class="card-footer">
                <h3 class="title">
                    <small><?=number_format($instalment[0]['sum_amount'],2);?>บาท</small>
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
                %การจ่ายงบ
                </h4>
            </div>

            <div class="card-footer">
                <h3 class="title">
                    <small><?=number_format($percent,2);?>&nbsp;%
                    : <?=$percent > 100 ?'เกินงบควบคุม' : 'ปกติ' ?> </small> 
                </h3>
            </div>
        </div>
        <!--card-->
    </div>
    <!--col -->
</div>
<!--row-->

<?php } ?>