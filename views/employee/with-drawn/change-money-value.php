<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="instalment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4 col-xs-12">
            <label class="label-control">กลุ่มงาน</label>
            <select name="workclassify_id" class="form-control" id="workclassify_id">
                <option>เลือก...</option>
                <?php foreach($workclassify as $wc){ ?>
                <option value="<?=$wc['id'];?>" <?=$model['workclassify_id'] ==$wc['id'] ? 'selected' : '';?>><?=$wc['wc_name'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 col-xs-12">
            <label class="label-control ">หมวดงาน</label>
            <select id="workgroup" name="Laborcostdetails[workgroup]" class="form-control">
                <?php foreach($workgroup as $wg){ ?>
                <option value="<?=$wg['id'];?>" <?=$model['worktype_id'] ==$wg['id'] ? 'selected' : '';?>><?=$wg['wg_name'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 col-xs-12">
            <label class="label-control ">งาน</label>
            <select id="works" name="Laborcostdetails[works]" class="form-control">
                <?php foreach($works as $work){ ?>
                <option value="<?=$work['id'];?>" <?=$model['work_id'] ==$work['id'] ? 'selected' : '';?>><?=$work['work_name'];?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-6 col-xs-12">
            <label class="label-control" >ชนิดเงิน</label>
            <select name="money_type" class="form-control">
                <option value="1" <?=$model['money_type_id'] ==1 ? 'selected' : '';?>>ระหว่างงวด</option>
                <option value="2" <?=$model['money_type_id'] ==2 ? 'selected' : '';?>>จบงวด</option>
            </select>
        </div>
        <div class="col-md-6 col-xs-12">
            <label class="label-control">จำนวนเงินที่ต้องการเปลี่ยน</label>
            <input type="text" value="<?=$model['amount'];?>" name="change_amount" class="form-control">
        </div>
    </div>
   


    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' =>  'btn btn-primary btn-round']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS


$('#workclassify_id').change(function(){
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

JS;
$this->registerJs($script);
?>
