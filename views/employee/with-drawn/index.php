<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\Form;
use yii\widgets\ActiveForm;
use app\models\Methods;

$methodModel = new Methods();
$this->title = 'วิธีจ่ายงวด';
$this->params['breadcrumbs'][] = ['label' => 'จ่ายงวด', 'url' => ['employee/instalment/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.paidmethod{
    color:#000000;
    font-weight:bold;
    text-align:right;
    border-radius:8px
}
._number{
    text-align:right
}
th{
    text-align:center;
    font-weight:bold
}
.edit-money-icon{
    font-size:14px;
    border:1px solid red;
    border-radius:5px 5px;
    color:red;
    margin-left:5px;
    cursor: pointer;
}
tr._total td, th{
    background:blue;
    color:#FFFFFF;
    font-size :1.2em
}

</style>

<?php Modal::begin([
            'header' => '<h4>เปลี่ยนจำนวนเงิน</h4>',
            'id'     => 'modal',
            'size'   => 'modal-sm',
            'clientOptions' => [
                'backdrop' => false, 'keyboard' => true
                ]
    ]);
    
    echo "<div id='modelContent'></div>";
    
    Modal::end();
?>
<!-- <h1>วิธีการจ่ายเงินให้ช่าง</h1> -->
<?php if(count($models) >0){ ?>
<div class="box box-success">
<div class="box-body">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="title">
                    วิธีการจ่ายเงินให้ช่าง
                    </h4>
                    <p class="category">ทำการเลือกงวิธีจ่ายเงินให้ช่าง</p>
                </div>

            </div>

        </div>
        <div class="card-content table-responsive">


<?php $form = ActiveForm::begin(['action' => ['employee/with-drawn/create'],'options' => ['method' => 'post']]) ?>
    <h3>
        ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  <?=$inst_str;?>
    </h3>
    <div class="tabel table-responsive">
        <table class="table table-condensed table-bordered">
            <thead >
                <tr  id="tr_paid_list" class="_total">
                    <th width="20">ลำดับ</th>
                    <th>ชื่อช่าง</th>   
                    <th width="100">เลขแปลงบ้าน</th>
                    <th>รายละเอียดงาน</th>
                    <th>ลักษณะเงิน</th>
                    <th>งบควบคุม</th>
                    <th>จำนวนเงิน</th>
                    <th>หมายเหตุ</th>
                </tr>
                
            </thead>
            <tbody>
            <?php 
            $curname = $models[0]['contructor_id'];
            $sum_id= $models[0]['summoney_id'];
            $sum_by_payee=0;
            $curhouse = $models[0]['house_id'];
            $i=0;
            $showname = 1;
            $total =0;
            $name_rowspan =0;
            // $methodModel->print_array($models);
            foreach($models as $model){
                $color = $sum_by_payee >= 0 ? "" : "display:none";
                if($curname != $model['contructor_id']  ){
                    //ทำการเริ่มแถวใหม่
                    echo "<tr class='payee_sum'>";
                    echo    "<td colspan='6'> รวม</td>";
                    echo    "<td class='_number'>".number_format($sum_by_payee,2)."</td>";
                    echo    "<td>
                                <div style='color:#ffffff; ".$color."' class='paymethod' id='".$i."'>
                                    <span class='glyphicon glyphicon-download'></span> 
                                    วิธีจ่ายเงิน
                                </div>
                    
                            </td>";
                    echo "</tr>";
                    echo "<tr id='paymethod".$i."'   class='payee_sum' style='".$color."'>
                            <td colspan='4'>
                                จ่ายเงินสด
                                <input type='text' class='paidmethod' name='paidmethod[".$curname."][cash]'>
                                บาท
                            </td>
                            <td colspan='4'>
                            โอนเงินทางธนาคาร
                            <input type='text' class='paidmethod' name='paidmethod[".$curname."][bank]'>
                            บาท
                            <input type='hidden' name='paidmethod[".$curname."][summoney_id]' value='".$sum_id."'>

                            </td>
                          </tr>
                          ";
                    $curname = $model['contructor_id'];
                    $sum_id= $model['summoney_id'];
                    $total+=$sum_by_payee;
                    $sum_by_payee =0;
                    $showname =1;
                
                ?>
                <!-- สร้างแถวข้อมูลของ usreคนใหม่ -->
                <tr>
                <td><?=++$i?></td>
                <td>
                <?php 
                    $User = app\models\Profile::find()
                        ->where(['user_id'=>$model['contructor_id']])->one();
                        if($showname ==1){
                            echo $User['name'];
                            $showname =0;
                        }
                ?>
                </td>   
                <td><?php
                        if($model['house_id']== 0 ){
                            echo  " ";
                        }else{
                            $house = \app\models\Houses::find()->select('house_name')
                                ->where(['id'=>$model['house_id']])->one();
                            echo $house['house_name'];
                        }
                    ?>
                </td>
                <td class="work_despt">
                <?php 
                    $work = \app\models\Works::find()->select('work_name, work_control_statement')
                        ->where(['id'=>$model['work_id']])->one();
                    echo $work['work_name'];
                ?>
                </td>
                <td>
                <?php 
                    $mt = \app\models\MoneyType::find()
                        ->where(['id'=>$model['money_type_id']])->one();
                    echo $mt['name'];
                ?>
                </td>
                <td class="_number">
                    <?=  number_format($work['work_control_statement'],2);?>
                </td>
                <td class="_number" >
                <?php 
                    echo number_format($model['amount'],2);
                    // if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                    //     $sum_by_payee -= $model['amount'];
                    // }else{
                        $sum_by_payee += $model['amount'];
                   // }
                    
                ?>
                </td>
                <td><?=$model['comment'];?></td>
            </tr>
                <?php
                }else{ //สร้างแถวข้อมูลของuserคนแรกและ คนปัจจุบัน
            ?>
                <tr>
                    <td><?=++$i?></td>
                    <td>
                    <?php 
                        $user = app\models\Profile::find()
                            ->where(['user_id'=>$model['contructor_id']])->one();
                            if($showname ==1){
                                echo $user['name'];
                                $showname =0;
                            }
                    ?>
                    </td>   
                    <td>
                        <?php
                            if($model['house_id']== 0 ){
                                echo  " ";
                            }else{
                                $house = \app\models\Houses::find()->select('house_name')
                                    ->where(['id'=>$model['house_id']])->one();
                                echo $house['house_name'];
                            }
                        ?>
                    </td>
                    <td class="work_despt">
                    <?php 
                        $work = \app\models\Works::find()->select('work_name, work_control_statement')
                        ->where(['id'=>$model['work_id']])->one();
                        echo $work['work_name'];
                    ?>
                    </td>
                    <td>
                    <?php 
                        $wc = \app\models\MoneyType::find()
                            ->where(['id'=>$model['money_type_id']])->one();
                        echo $wc['name'];
                    ?>
                    </td>
                    <td class="_number">
                        <?= number_format($work['work_control_statement'],2);?>
                    </td>
                    <td class="_number">
                    <?php 
                        echo number_format($model['amount'],2);
                        // if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                        //     $sum_by_payee -= $model['amount'];
                        // }else{
                            $sum_by_payee += $model['amount'];
                       // }
                        
                    ?>
                    </td>
                    <td><?=$model['comment'];?></td>
                </tr>
            <?php
        
                 
                }//else
                if($i == count($models)){
                    //ถ้าเป็นข้อมูลชุดสุดท้าย
                    $color = $sum_by_payee >= 0 ? "" : "display:none";
                    echo "<tr class='payee_sum'>";
                    echo    "<td colspan='6'> รวม</td>";
                    echo    "<td class='_number' id='payee_sum".$i."'>".number_format($sum_by_payee,2)."</td>";
                    echo    "<td>
                                <div style='color:#ffffff; ".$color."' class='paymethod' id='".$i."'>
                                    <span class='glyphicon glyphicon-download'></span> 
                                    วิธีจ่ายเงิน
                                </div>
                    
                            </td>";
                    echo "</tr>";
                    echo "<tr id='paymethod".$i."'   class='payee_sum'>
                            <td colspan='4'>
                                จ่ายเงินสด
                                <input type='text' class='paidmethod' id='bycash".$i."' data-id='".$i."' name='paidmethod[".$curname."][cash]'>
                                บาท
                            </td>
                            <td colspan='4'>
                            โอนเงินทางธนาคาร
                            <input type='text' class='paidmethod' id='bybank".$i."' data-id='".$i."' name='paidmethod[".$curname."][bank]'>
                            บาท
                            <input type='hidden' name='paidmethod[".$curname."][summoney_id]' value='".$sum_id."'>
                            </td>
                          </tr>
                          ";

                    $total+=$sum_by_payee;

                    $sum_by_payee  = 0;
                    
                 }else{
                    // echo $i ."==". count($models);
                 }
            }
            ?>
            <tr class=_total>
                <td  colspan="6">รวมทั้งสิ้น</td>
                <td class="_number"><?=number_format($total,2);?></td>
                <td>
                    
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- <Html::a('บันทึก', ['create'], ['class' => 'btn  btn-success btn-raised']);?> -->
    <input type="hidden" name="_instalment_id" value="<?=$models[0]['instalment_id']?>">
    <div class="form-group">
        <?= Html::submitButton('บันทึก' , ['class' => 'btn btn-success btn-round pull-right' ]) ?>
    </div>
   
    <?php ActiveForm::end(); ?>

    <?php }else{
            $alert_title = $this->title;
            $alert_subtitle = 'ทำการเลือกการจ่ายเงินงวดงานให้ช่าง จ่ายโดย เงินสด หรือ โอนเข้าบัญชีธนาคาร';
            $alert_content = 'ไม่พบข้อมูล';
            $alert_bgcolor = "orange";
            $methodModel->alert_card($alert_title, $alert_subtitle,$alert_content, $alert_bgcolor);
        } ?>
    </div>
</div>
    </div> <!--div card-->
<?php
// Form::print_array($models);
$this->registerJs("
    $('.paymethod').click(function(){
        id = $(this).attr('id')

        $('#paymethod'+id).toggle('fadein')
    });

    $('.edit-money-icon').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });


    $('.paidmethod').keyup(function(){
        var id = $(this).data('id');
        var payee_sum0 = $('#payee_sum'+id).text();
        var payee_sum1 = payee_sum0.split(',').join('');
        var payee_sum = parseFloat(payee_sum1);
        var bycash = parseFloat($('#bycash'+id).val() == '' ? 0 : $('#bycash'+id).val()) ;
        var bybank = parseFloat($('#bybank'+id).val() == '' ? 0 : $('#bybank'+id).val());
        var sum = bycash + bybank
        if(sum > payee_sum){
            alert('คุณกรอกจำนวนเงินเกินที่จะสามารถจ่ายให้ช่างได้')
        }
        console.log('sum',payee_sum )
    });
    
", $this::POS_READY); 
?>