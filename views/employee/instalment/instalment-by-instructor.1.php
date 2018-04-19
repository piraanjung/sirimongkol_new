<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Button;

// use app\models\Form;
// use app\models\Payee;
use app\models\Project;
use app\models\Housemodels;
use app\models\MoneyType;
use app\models\Instalment;
use app\models\Houses;
use yii\bootstrap\Alert;

$inst = $instalment['monthly']."/".$instalment['instalment'].".".$instalment['year'];
$this->title = 'จ่ายงวดงานโดยเลือกช่าง งวดที่ '.$inst;

$this->params['breadcrumbs'][] = ['label' => 'งวดจ่าย', 'url' => ['employee/instalment/index']];
$this->params['breadcrumbs'][] = $this->title;

$instructor = ArrayHelper::map(\app\models\Profile ::find()
    ->leftJoin('user', 'user.id = profile.user_id')
    ->where(['user.user_type_id' => 4])->all(), 'user_id', 'name');  

$moneyType = ArrayHelper::map(MoneyType::find()->all(), 'id', 'name');
$workClassify = ArrayHelper::map(\app\models\WorkCategory::find()
    ->select('id, wc_name')->all(), 'id', 'wc_name');
    
$houses = Arrayhelper::map(Houses::find()->all(), 'id', 'house_name');

?>

    <div class="box box-success">
        <div class="box-body">
            <?php
                $title = $this->title;
                $subtitle = "ทำการบันทึกข้อมูลการจ่ายงวดงานโดยการบันทึกรายช่างหรือผู้รับเหมา";
                $a_text = "";
                $action= "";
                $btn_color = "btn-info";
                $display = false;
                \app\models\Methods::card_header($title, $subtitle, $a_text, $action, $btn_color, $display); 
            ?>

                <?php $form = ActiveForm::begin(['id'=> $model->formName()]); ?>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="material-icons">person</i>
                                </div>
                                <div class="card-content">
                                    <!-- <p class="category"></p> -->
                                    <h3 class="title">เลือกช่าง</h3>
                                    <?= $form->field($model, 'contructor_id')->dropDownList($instructor,[
                                    'prompt' => 'เลือก...'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <div class="card-content">
                                    <!-- <p class="category"></p> -->
                                    <h3 class="title">ประเภทงวดที่จ่าย</h3>
                                    <?= $form->field($model, 'money_type_id')->dropDownList($moneyType,[
                                        'prompt' => 'เลือก...'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <div class="card card-stats"> 
                                <div class="card-content">
                                        <?=Button::widget([
                                                'label' => 'เพิ่มข้อมูล',
                                                'options' => ['class' => 'btn btn-info  btn-round', 
                                                            'id'=>'showModalButton',                                                    ],
                                            ]);
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        yii\bootstrap\Modal::begin([
                            'headerOptions' => ['id' => 'modalHeader'],
                            'id' => 'modal',
                            'size' => 'modal-lg',
                            'closeButton' => [
                                'id'=>'close-button',
                                'class'=>'close',
                                'data-dismiss' =>'modal',
                                ],
                            //keeps from closing modal with esc key or by clicking out of the modal.
                            // user must click cancel or X to close
                            'clientOptions' => [
                                'backdrop' => false, 'keyboard' => true
                                ]
                        ]);
                            echo "<div id='modalContent'>";
                        ?>

                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <!-- <h2>จ่ายงวดตามชนิดงาน</h2> -->
                                <?=$this->render('_paid_by_house_form',[
                                    'form' =>$form,
                                    'model' => $model,
                                    'houses' =>$houses,
                                    'inst' => $inst,
                                    'instalment' => $instalment,
                                    'moneyType' =>$moneyType,
                                    'workClassify' => $workClassify,
                                    'title' => 'จ่ายงวดตามชนิดงาน'
                                ]);?>
                            </div>
                            <div id="loan_div">
                                <div class="col-md-6 col-xs-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                        <h3 class="box-title">หัก เงินกู้ยืม</h3>
                                        </div>
                                        <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-12- col-md-6">
                                            <input type="text" name="deduction[loan_deduction][amount]" 
                                                    id="loan_deduction_money" class="form-control" required>
                                            </div>
                                            <input type="hidden" name="deduction[loan_deduction][type]" value="3">
                                        </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                            <div id="equipment_div">
                                <div class="col-md-6 col-xs-12">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                        <h3 class="box-title">หัก ค่าเครื่องมือ</h3>
                                        </div>
                                        <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                            <input type="text" name="deduction[equipment_deduction][amount]" 
                                                    id="equipment_deduction_money" class="form-control" required>
                                            
                                            <input type="hidden" name="deduction[equipment_deduction][type]" value="4">
                                            </div>
                                        </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>


                            
                        </div><!-- tab-content -->            
                        <input type="hidden" name="hidden" value="addlists">
                        <button type="submit" class="btn btn-round btn-success pull-right">เพิ่มรายการ</button>
                        <br style="clear:both">

                        <?php echo "</div>";
                            yii\bootstrap\Modal::end(); 
                        ?>
                <?php ActiveForm::end(); ?>
                
            <?=\app\models\Methods::card_footer();?>
        </div>
    </div><!-- box box-success -->

    <?php if(count($addlist) > 0 && 
                $addlist[0]['Instalmentcostdetails']['instalment_id'] == $instalment['id']){ ?>
       
       <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <?php $form2 = ActiveForm::begin(['action' =>'index.php?r=employee/instalment/instalment_by_instructor','id'=>'form2',
                        'options'=>['instalment_id'=> $instalment['id']]]); ?>
                        <?= $this->render('_instalment_paid_lists',[
                                            'addlist' => $addlist,
                                            'instalment' => $instalment,
                                            'form' => $form2
                            ]);    
                        ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php
$script = <<< JS


    $('#instalmentcostdetails-workclassify_id').change(function(){
        console.log($(this).val())
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=work-group/work-group-lists',
           data : {wc_id: $(this).val()},
            success : function(data){
                $( "#workgroup" ).html( data );
            }

        })
    });
    $('#workgroup').change(function(){
        console.log($(this).val())
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=works/get-work-lists',
            data : {wg_id: $(this).val()},
            success : function(data){
                $( "#works" ).html( data );
            }

        })
    });

    $('#works').change(function(){
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=works/get-work-control-statement',
            data : {w_id: $(this).val()},
               success : function(data){
                $( "#w_controlstatement" ).val( data );
            }

        })
    });


    $('#paid_amount_id').keyup(function(){
        var checkzero = $(this).val();
        if(checkzero == "0"){
            $(this).val("");
        }
    })

    $( document ).ready(function() {
        $("#timeline input").prop("disabled", true);
        
        $("#loan_div").css("display", "none");
        $("#loan_div input").prop("disabled", true);

        $("#equipment_div").css("display", "none");
        $("#equipment_div input").prop("disabled", true);

        // $('#instalmentcostdetails-workclassify_id').val("");
    });



    $('#instalmentcostdetails-money_type_id').change(function(){
        var _type = $(this).val()
        if(_type == 1 || _type ==2){
            $("#activity").css("display", "block");
            $("#activity input").prop("disabled", false);
            $("#activity select").prop("disabled", false);
            $("#activity textarea").prop("disabled", false);
            $('#activity select#instalmentcostdetails-house_id option[value="0"]').remove()
            $('#activity select#instalmentcostdetails-workclassify_id option[value="0"]').remove()
            $('#activity select#workgroup option[value="0"]').remove()
            $('#activity select#works option[value="0"]').remove()
            
            $("#loan_div").css("display", "none");
            $("#loan_div input").prop("disabled", true);

            $("#equipment_div").css("display", "none");
            $("#equipment_div input").prop("disabled", true);
            
        }else{
            if(_type == 3){
                //จ่ายค่ากู้ยืม
                $("#loan_div").css("display", "block");
                $("#loan_div input").prop("disabled", false);

                $("#equipment_div").css("display", "none");
                $("#equipment_div input").prop("disabled", true);
            
            }else if(_type == 4){
                //equipment_div
                $("#equipment_div").css("display", "block");
                $("#equipment_div input").prop("disabled", false);
                $("#loan_div").css("display", "none");
                $("#loan_div input").prop("disabled", true);
            }
            $('#activity').css("display", "none")
            // $("#activity input").prop("disabled", true);
            // $("#activity select").prop("disabled", true);
            // $("#activity textarea").prop("disabled", true);
            $('#activity select#instalmentcostdetails-house_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-house_id').val(0)
            
            $('#activity select#instalmentcostdetails-workclassify_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-workclassify_id').val(0)
            
            $('#activity select#workgroup').append("<option value='0'>0</option>")
            $('#activity select#workgroup').val(0)
            
            $('#activity select#works').append("<option value='0'>0</option>")
            $('#activity select#works').val(0)
            
            $('#w_controlstatement').val(0)
            $('#instalmentcostdetails-amount').val("")
            $('#instalmentcostdetails-comment').text("")
            
        }//else
    });

    $('#instalmentcostdetails-amount').change(function(){
        console.log($(this).val())
    });

  $(document).on('click', '#showModalButton', function(){

    if ($('#modal').hasClass('in')) {
        $('#modal').find('#modalContent')
                .load($(this).attr('value'));
        document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
    } else {
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
    }
});

JS;
$this->registerJs($script);
?>