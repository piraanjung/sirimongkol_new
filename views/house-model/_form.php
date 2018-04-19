<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-model-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'hm_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'hm_name')->textInput(['maxlength' => true]) ?>        
        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'hm_control_statment')->textInput() ?>
        </div>
    </div>
    <?= $form->field($model, 'hm_description')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <br style="clear:both">
    <?php ActiveForm::end(); ?>

</div>
