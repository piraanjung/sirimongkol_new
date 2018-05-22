<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Button;
use kartik\widgets\Select2;
use app\models\Project;
use app\models\Housemodels;
use app\models\MoneyType;
use app\models\Instalment;
use app\models\Houses;
use yii\bootstrap\Alert;
use yii\widgets\Pjax;

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
                        <div class="col-md-12 col-xs-12" id="infoform" style="display:block">
                           
                                <?=$this->render('_paid_by_house_form',[
                                    'form' =>$form,
                                    'model' => $model,
                                    'houses' =>$houses,
                                    'inst' => $inst,
                                    'instalment' => $instalment,
                                    'moneyType' =>$moneyType,
                                    'workClassify' => $workClassify,
                                    'instructor' => $instructor,
                                    'title' => 'จ่ายงวดตามชนิดงาน'
                                ]);?>
                        </div>
                    </div>
                    
                <?php ActiveForm::end(); ?>
              
            <?=\app\models\Methods::card_footer();?>
        </div>
    </div><!-- box box-success -->

    <?php if(count($addlist) > 0 && 
                $addlist[0]['Instalmentcostdetails']['instalment_id'] == $instalment['id']){ ?>
        <?php Pjax::begin(['id' => 'countries']) ?>       
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
        <?php Pjax::end() ?>
    <?php } ?>



    <?php
$script = <<< JS
    $("document").ready(function(){ 
		$("#new_country").on("pjax:end", function() {
			$.pjax.reload({container:"#countries"});  //Reload GridView
		});
    });

    $('#instalmentcostdetails-workclassify_id').change(function(){
        console.log($(this).val())
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=work-group/work-group-lists',
           data : {wc_id: $(this).val()},
            success : function(data){
                $( "#instalmentcostdetails-worktype_id" ).html( data );
            }

        })
    });
    $('#instalmentcostdetails-worktype_id').change(function(){
        console.log($(this).val())
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=works/get-work-lists',
            data : {wg_id: $(this).val()},
            success : function(data){
                $( "#instalmentcostdetails-work_id" ).html( data );
            }

        })
    });

    $('#instalmentcostdetails-work_id').change(function(){
        w_id = $(this).val()
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=works/get-work-control-statement',
            data : {w_id: w_id},
                success : function(data){
                    $( "#w_controlstatement" ).val( data );
                    w_controlstatement = data
                    $.ajax({
                        type : 'POST',
                        url  : 'index.php?r=works/get-sum-instalment-paid',
                        data : {w_id:w_id, 
                            constructor_id :$('#instalmentcostdetails-contructor_id').val(), 
                            house_id :$('select#instalmentcostdetails-house_id').val()
                        },success : function(_data){
                            $('#w_paid').val(_data)
                            remain = w_controlstatement - _data;
                            $('#w_remain').val(remain)
                        }
                    })
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

    // $('#instalmentcostdetails-contructor_id').change(function(){
    //     $('#showModalButton').css('display','block')
    // });



    $('#instalmentcostdetails-money_type_id').change(function(){
       
        var _type = $(this).val()
        if(_type == 1 || _type ==2){
            $("#activity").css("display", "block");
            $("#activity input").prop("disabled", false);
            $("#activity select").prop("disabled", false);
            $("#activity textarea").prop("disabled", false);
            $('select#instalmentcostdetails-house_id option[value="0"]').remove()
            $('#activity select#instalmentcostdetails-workclassify_id option[value="0"]').remove()
            $('#activity select#instalmentcostdetails-worktype_id option[value="0"]').remove()
            $('#activity select#instalmentcostdetails-work_id option[value="0"]').remove()
            
            $("#loan_div").css("display", "none");
            $("#loan_div input").prop("disabled", true);

            $("#equipment_div").css("display", "none");
            $("#equipment_div input").prop("disabled", true);

            $('.title').text('จ่ายงวดตามชนิดงาน')
            
        }else{
            if(_type == 3){
                //จ่ายค่ากู้ยืม
                $("#loan_div").css("display", "block");
                $("#loan_div input").prop("disabled", false);

                $("#equipment_div").css("display", "none");
                $("#equipment_div input").prop("disabled", true);
                $('.title').text('หัก เงินกู้ยืม')
            
            
            }else if(_type == 4){
                //equipment_div
                $("#equipment_div").css("display", "block");
                $("#equipment_div input").prop("disabled", false);
                $("#loan_div").css("display", "none");
                $("#loan_div input").prop("disabled", true);
                $('.title').text('หัก ค่าเครื่องมือ')
            }
            
            $('#activity').css("display", "none")
          
            $('select#instalmentcostdetails-house_id').append("<option value='0'>0</option>")
            $('select#instalmentcostdetails-house_id').val(0)
            
            $('#activity select#instalmentcostdetails-workclassify_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-workclassify_id').val(0)
            
            $('#activity select#instalmentcostdetails-worktype_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-worktype_id').val(0)
            
            $('#activity select#instalmentcostdetails-work_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-work_id').val(0)
            
            $('#w_controlstatement').val(0)
            $('#instalmentcostdetails-amount').val(0)
            $('#instalmentcostdetails-comment').text("")
            
        }//else
    });

    $('#instalmentcostdetails-amount').change(function(){
        console.log($(this).val())
    });

    $(document).on('change', '#instalmentcostdetails-contructor_id', function(){
        $('#infoform').css('display','block')
        // if ($('#modal').hasClass('in')) {
        //     $('#modal').find('#modalContent')
        //             .load($(this).attr('value'));
        //     document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        // } else {
        //     $('#modal').modal('show')
        //             .find('#modalContent')
        //             .load($(this).attr('value'));
        //     document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        // }
    });

JS;
$this->registerJs($script);
?>