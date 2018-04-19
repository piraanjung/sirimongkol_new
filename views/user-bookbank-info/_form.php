<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */
/* @var $form yii\widgets\ActiveForm */
$banks = \app\models\Banks::find()->all();
$banksList = ArrayHelper::map($banks, 'id', 'name');

$user = \app\models\Profile::find()->all();
$userList = ArrayHelper::map($user, 'user_id', 'name')
?>

<div class="user-bookbank-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($userList,[
        'prompt' =>'เลือก user...'
    ]) ?>
    
    <!-- <?= $form->field($model, 'bank_id')->textInput() ?> -->
    <?= $form->field($model, 'bank_id')->dropDownList($banksList,[
        'prompt' => 'เลือกธนาคาร...'
        ]); 
    ?>

    <?= $form->field($model, 'account_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_date')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>

    <?= $form->field($model, 'update_date')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <br class="clearboth">
    <?php ActiveForm::end(); ?>

</div>
