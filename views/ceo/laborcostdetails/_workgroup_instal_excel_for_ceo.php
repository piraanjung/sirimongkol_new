<?php
use yii\db\Query;
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=สรุปการจ่ายค่าแรง_แยกตามกลุ่มงาน_แปลงที่_".$instalment_sum_provider->getModels()[0]['house_name'].".xls");
header("Pragma: public");
header("Cache-Control: max-age=0");
set_time_limit(0);

?>
<?php $total = 0; ?>
<div>
    <table border=1>
        <tr>
            <th colspan="6">สรุปการจ่ายค่าแรง แยกตามกลุ่มงาน แปลงที่ <?=$instalment_sum_provider->getModels()[0]['house_name'];?></th>
        </tr>
        <tr>
            <th width="100">กลุ่มงาน</th>
            <th width="200">งบควบคุม</th>
            <th width="100">จ่ายแล้ว</th>
            <th width="20">%</th>
            <th>หมายเหตุ</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($instalment_sum_provider->getModels() as $key => $i){ ?>
                <tr>
                    <td><?=$i['wg_name'];?></td>
                    <td><?=number_format($i['cost_control'],2);?></td>
                    <td><?=number_format($i['paid_amount'],2);?></td>
                    <td><?=number_format($i['progress_percent'],2);?></td>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
               <?php
                    $total +=$i['paid_amount'];
               ?>

           
        <?php } ?>     
        <tr>
            <th colspan="2">รวม</th>
            <th><?=number_format($total,2) ?> </th>
            <th colspan="2"></th>
        </tr> 
    </table>
</div>

