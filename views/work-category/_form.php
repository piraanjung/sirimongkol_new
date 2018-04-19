<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WorkCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wc_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
