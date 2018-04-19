<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="instalment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-md-12 col-xs-12">
            <label class="label-control" >ชนิดเงิน</label>
            <select name="money_type" class="form-control">
                <option value="1" <?=$model['money_type_id'] ==1 ? 'selected' : '';?>>ระหว่างงวด</option>
                <option value="2" <?=$model['money_type_id'] ==2 ? 'selected' : '';?>>จบงวด</option>
            </select>
        </div>
        <div class="col-md-12 col-xs-12">
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


