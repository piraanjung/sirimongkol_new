<?php
use yii\db\Query;
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=สรุปการจ่ายค่าแรง_แปลงที่_".$instalment_sum_provider->getModels()[0]['house_name'].".xls");
header("Pragma: public");
header("Cache-Control: max-age=0");
set_time_limit(0)
?>
<div>
    <table border=1>
        <tr>
            <th colspan="6">สรุปการจ่ายค่าแรง แปลงที่ <?=$instalment_sum_provider->getModels()[0]['house_name'];?></th>
        </tr>
        <tr>
            <th>กลุ่มงาน</th>
            <th>งบควบคุม</th>
            <th>จ่ายแล้ว</th>
            <th>%</th>
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
                    $query = new Query;
                    $query->select('
                            a.*,
                            b.work_name,
                            c.name as constructor_name,
                            d.name as money_type_name
                        ')
                        ->from('instalmentcostdetails a')
                        ->leftJoin('works b', 'a.work_id = b.id')
                        ->leftJoin('profile c', 'a.contructor_id = c.user_id')
                        ->leftJoin('money_type d', 'a.money_type_id = d.id')
                        ->where(['house_id' => $i['house_id']])
                        ->andWhere(['worktype_id' => $i['wg_id']]);
                    
                    $rows = $query->all();
                ?>
                <?php if(count($rows) > 0){ ?>
                    <tr>
                        <th>&nbsp;</th>
                        <th>ผู้รับเหมา</th>
                        <th>งาน</th>
                        <th>ชนิดเงิน</th>
                        <th>จ่ายจำนวน</th>
                        <th>วันที่บันทึก</th>
                    </tr>
                    <?php foreach($rows as $row){ ?>
                        <tr>
                            <th>&nbsp;</th>
                            <th><?=$row['constructor_name'];?></th>
                            <th><?=$row['work_name'];?></th>
                            <th><?=$row['money_type_name'];?></th>
                            <th><?=number_format($row['amount'],2);?></th>
                            <th><?=$row['create_date'];?></th>
                        </tr>
                    <?php } ?>
                      
                    </tr>
                <?php } //if?>

           
        <?php } ?>      
    </table>
</div>

