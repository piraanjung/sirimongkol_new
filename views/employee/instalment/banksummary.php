
<?php if(count($bank) > 0){ $_total=0;?>
    <button class="btn btn-info btn-raised pull-right" id="<?=$bankname_eng?>btn">Print</button>
    <br style="clear:both">
    <div id="_<?=$bankname_eng?>">
    <h3><?=$bankname;?></h3>
   
        <table class="table table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>หมายเลขบัญชี</th>
                <th>จำนวนเงิน</th>
            </tr>
            <?php foreach($bank as $key =>  $b){ ?>
            <tr>
                <td><?=++$key;?></td>
                <td><?=$b['constructor_name'];?></td>
                <td><?=$b['account_bank'];?></td>
                <td class="_number"><?=number_format($b['paid_amount'],2); $_total+=$b['paid_amount'];?></td>
            </tr>
                
            <?php }//foreach ?>
            <tr class="_total">
                <td colspan="3">รวม</td>
                <td class="_number"><?=number_format($_total, 2);?></td>
            </tr>
        </table>
    </div>
<?php }else{ 
        $alert_title = $bankname;
        $alert_subtitle = "ข้อมูลการโอนเงินค่างวดงานให้ช่างผ่านบัญชีธนาคาร ".$bankname;
        $alert_content = "ไม่พบข้อมูล"; 
        $alert_bgcolor = 'orange';
        \app\models\Methods::alert_card($alert_title,$alert_subtitle,$alert_content, $alert_bgcolor);
}//else ?>


            <?php
// Form::print_array($models);
$this->registerJs("
    

    $('#".$bankname_eng."btn').click(function(){
        var printContents = document.getElementById('_".$bankname_eng."').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    })




    
", $this::POS_READY); 
?>