<button class="btn btn-info btn-raised pull-right" id="banksummarybtn">Print</button>
    <div id="_banksummary">
<?php foreach($allbanks as $bank){ ?>
    
    <?php $sum =0; ?>
    <table class="table table-bordered table-hover">
    <tr>
        <th colspan="2" style="background-color:#26c6da;" class="col-md-5 col-xs-12"><?="ธนาคาร ".$bank['name'];?></th>
    </tr>
    <?php if(count($bank['data']) > 0 ){ ?>
    <tr>
        <th width="5%">#</th>
        <th width="45%">ชื่อ - สกุล</th>
        <th width="30%">หมายเลขบัญชี</th>
        <th>จำนวนเงิน</th>
    </tr>
    <?php foreach($bank['data'] as $key => $data){ ?>
        <tr>
            <td><?=$key+1;?></td>
            <td><?=$data['constructor_name'];?></td>
            <td class="text-center"><?=$data['account_bank'];?></td>
            <td class="text-right"><?=number_format($data['paid_amount'],2); $sum +=$data['paid_amount'];?></td>
        </tr>
    <?php } ?>
        <tr>
            <th colspan="3">รวม</th>
            <th class="text-right table-info"><?=number_format($sum, 2);?></th>
        </tr>
    <?php }else{ ?>
        <tr>
            <th colspan="4">ไม่มีข้อมูลการโอนเงินผ่านธนาคาร</th>
        </tr>
    <?php }//else ?>
    </table>
   
    <br>
<?php }//for?>

 </div>

<?php
$this->registerJs("
    

    $('#banksummarybtn').click(function(){
        var printContents = document.getElementById('_banksummary').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    })




    
", $this::POS_READY); 
?>