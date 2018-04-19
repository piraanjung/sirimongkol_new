<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'project_id')->textInput() ?>
        </div>
        <div class="col-md-8 col-xs-12">
            <?= $form->field($model, 'projectname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'control_statement')->textInput() ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter  date ...'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'd-m-yyyy'
                    ]
                ]);
            ?>

        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter  date ...'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'd-m-yyyy'
                    ]
                ]);
            ?>
        </div>
    </div>

    <div class="form-group" >
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success btn-round  pull-right']) ?>
    </div>
    <br style="clear:both">

    <?php ActiveForm::end(); ?>

