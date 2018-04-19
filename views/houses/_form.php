<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Houses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="houses-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'house_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?php 
                $housemodels= \app\models\HouseModel::find()->all();

                $listData=ArrayHelper::map($housemodels,'id','hm_name');

                echo $form->field($model, 'house_model_id')->dropDownList(
                                                $listData, 
                                                ['prompt'=>'Select...']);
            ?>

        </div>
        <div class="col-md-4 col-xs-12">
            <?php 
                $projects= app\models\Project::find()->all();

                $listData=ArrayHelper::map($projects,'project_id','projectname');

                echo $form->field($model, 'project_id')->dropDownList(
                                                $listData, 
                                                ['prompt'=>'Select...']);
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <?php $listData = ['0' => 'ยังไม่สร้าง', '1' => 'กำลังก่อสร้าง', '2' =>'สร้างแล้วเสร็จ'];?>
            <?= $form->field($model, 'house_status')->dropDownList(
                                                $listData, 
                                                ['prompt'=>'Select...']);
            ?>
        </div>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success btn-round pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <br style="clear:both">

</div>
