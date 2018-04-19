
<?php foreach($allbanks as $bank){ ?>
    <?php $sum =0; ?>
    <table class="table table-bordered table-hover">
    <tr>
        <th colspan="2" style="background-color:#26c6da;" class="col-md-5 col-xs-12"><?="ธนาคาร ".$bank['name'];?></th>
    </tr>
    <tr>
        <th width="5%">#</th>
        <th>ชื่อ - สกุล</th>
        <th>หมายเลขบัญชี</th>
        <th>จำนวนเงิน</th>
    </tr>
    <?php foreach($bank['data'] as $key => $data){ ?>
        <tr>
            <td><?=$key+1;?></td>
            <td><?=$data['name'];?></td>
            <td class="text-center"><?=$data['account_bank'];?></td>
            <td class="text-right"><?=number_format($data['paid_amount'],2); $sum +=$data['paid_amount'];?></td>
        </tr>
    <?php } ?>
        <tr>
            <th colspan="3">รวม</th>
            <th class="text-right table-info"><?=number_format($sum, 2);?></th>
        </tr>
    </table>
    <br>
<?php }//for?>
