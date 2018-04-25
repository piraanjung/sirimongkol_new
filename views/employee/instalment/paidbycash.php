
<?php if(count($paidbycashs) > 0){  $sum =0; ?>
    <br style="clear:both">
<div id="_paidbycash">
    <h3>สรุปการจ่ายเงินให้ช่าง โดยจ่ายเงินสด</h3>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ชื่อ-สกุล</th>
            <th>จำนวนเงิน</th>
        </tr>
        <?php foreach($paidbycashs as $paidbycash){ ?>
        <tr>
            <td><?=$paidbycash['name'];?></td>
            <td class="r"><?=number_format($paidbycash['paid_amount'],2);?></td>
        </tr>
        <?php $sum += $paidbycash['paid_amount']; ?>
        <?php }//foreach ?>
        <tr>
            <td colspan="2" class="_total">
                <div class="row">
                    <div class="col-md-6"><b>รวม</b></div>
                    <div class="col-md-6 r"><b><?=number_format($sum, 2);?></b></div>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php } ?>