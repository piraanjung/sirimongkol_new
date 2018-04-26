<!-- <= \app\models\Methods::print_array($addlist);?> -->
<?php
    $title ='รายการขัอมูลการจ่ายเงินงวดงาน';
    $subtitle = "รายการขัอมูลการจ่ายเงินงวดงานที่ถูกเพิ่มข้อมูล ก่อนทำการบันทึกข้อมูล";
    $a_text = "";
    $action= "";
    $btn_color = "btn-info";
    $display = false;
    \app\models\Methods::card_header($title, $subtitle, $a_text, $action, $btn_color, $display); 
?>
<table class="table table-striped table-bordered ">
<thead>
    <tr>
        <th style="width:2%;text-align:center">#</th>
        <th style="width:8%;text-align:center">แปลงบ้าน</th>
        <th style="width:18%;text-align:center">ชื่อช่าง</th>
        <th style="width:4%;text-align:center">งวดที่</th>
        <th style="width:15%;text-align:center">หมวดงาน</th>
        <th style="width:15%;text-align:center">กลุ่มงาน</th>
        <th style="width:15%;text-align:center">งาน</th>
        <th style="width:12%;text-align:center">จำนวนจ่าย(บาท)</th>
        <th style="width:14%;text-align:center">ประเภทงวด</th>
        <th style="text-align:center"></th>
    </tr>
</thead>
<tbody>
<!-- \app\models\Methods::print_array($addlist) -->
    <?php $c=0;$i=1; ?>
    <?php foreach($addlist as $ls){ ?>
    <tr>
        <td><?=$i++;?></td>
        <td>
            <?php
                $house = \app\models\Houses::find()->select('house_name')
                    ->where(['id' =>$ls['Instalmentcostdetails']['house_id']])->one();
                echo count($house) == 0 ? "-" : $house['house_name'];
            ?>
            <input type="hidden" name="aa[house_id][]" value="<?=$ls['Instalmentcostdetails']['house_id'];?>">
        </td>

        <td>
            <?php
                $payee = \app\models\Profile::find()->select('name')
                ->where(['user_id' => $ls['Instalmentcostdetails']['contructor_id']])->one();
                echo $payee['name'];
            ?>
            <input type="hidden" name="aa[contructor_id][]" value="<?=$ls['Instalmentcostdetails']['contructor_id'];?>">
        </td>
        <td>
            <?php
                $instalment_no = \app\models\Instalment::find()->select('instalment,monthly,year')
                    ->where(['id' => $ls['Instalmentcostdetails']['instalment_id']])->one();
                echo $instalment_no['monthly']."/".$instalment_no['instalment'].".".$instalment_no['year'];
            ?>
            <input type="hidden" name="aa[instalment_id][]" value="<?=$ls['Instalmentcostdetails']['instalment_id'];?>">
        </td>
        
        <td>
            <?php
                $work_classify_id = \app\models\WorkCategory::find()->select('wc_name')
                    ->where(['id' => $ls['Instalmentcostdetails']['workclassify_id']])->one();
                    echo count($work_classify_id) ==0 ? "-" : $work_classify_id['wc_name'];
                ?>
                <input type="hidden" name="aa[workclassify_id][]" value="<?=$ls['Instalmentcostdetails']['workclassify_id'];?>">
        </td>
        
        <td>
            <?php 
                $worktype = \app\models\WorkGroup::find()->select('wg_name')
                    ->where(['id'=> $ls['Instalmentcostdetails']['worktype_id']])->one();
                    echo count($worktype) == 0 ? "-" : $worktype['wg_name'];
            ?>
            <input type="hidden" name="aa[work_type][]"  value="<?=$ls['Instalmentcostdetails']['worktype_id'];?>">
        </td>            
        <td>
            <?php 
                $work = \app\models\Works::find()->select('work_name')
                    ->where(['id'=> $ls['Instalmentcostdetails']['work_id']])->one();
                echo count($work) == 0 ? "-" : $work['work_name'];
            ?>
            <input type="hidden" name="aa[works][]"  
                value="<?=$ls['Instalmentcostdetails']['work_id'];?>">
        </td>
        <td style="text-align:right">
            <?php 
            if($ls['Instalmentcostdetails']['money_type_id'] == 3){
                //แสดงจำนวนเงินหักค่ากู้ยืม
            echo $ls['deduction']['loan_deduction']['amount'] !="" ? number_format($ls['deduction']['loan_deduction']['amount'],2) : "";
            ?>
                <input type="hidden" name="aa[amount][]" value="<?=$ls['deduction']['loan_deduction']['amount'];?>">
            <?php
            }else if($ls['Instalmentcostdetails']['money_type_id'] == 4){
                //แสดงจำนวนเงินหักค่าอุปกรณ์
            echo $ls['deduction']['equipment_deduction']['amount'] !="" ? number_format($ls['deduction']['equipment_deduction']['amount'],2) : "";
            ?>
                <input type="hidden" name="aa[amount][]" value="<?=$ls['deduction']['equipment_deduction']['amount'];?>">
            <?php
            }else{//else if
                //type money_id ==1หรือ2
            echo number_format($ls['Instalmentcostdetails']['amount'],2);
            ?>
                <input type="hidden" name="aa[amount][]" value="<?=$ls['Instalmentcostdetails']['amount'];?>">
            <?php
            }//else
            ?>
        </td>
        <td>
            <?php
            $money_type = \app\models\MoneyType::find()->select('name')
                ->where(['id' => $ls['Instalmentcostdetails']['money_type_id']])->one();
            echo $money_type['name'];
            ?>
            <input type="hidden" name="aa[money_type_id][]" value="<?=$ls['Instalmentcostdetails']['money_type_id'];?>">
        </td>
        <td style="width:10%">
            <?= \yii\helpers\Html::a('<i class="material-icons">delete_forever</i>',['unset-array', 'id'=>$c++, 'instalment_id' => $ls['Instalmentcostdetails']['instalment_id']], 
                    ['class'=>'']);?>
        </td>

    </tr>
    
    <?php } ?>
</tbody>


</table>
<input type="hidden" name="hidden" value="savelists">
<button type="submit" class="btn btn-success btn-round pull-right">บันทึก</button>

</div>