<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ceo\models\Laborcostdetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laborcostdetails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_classify_id')->textInput() ?>

    <?= $form->field($model, 'work_name')->textInput() ?>

    <?= $form->field($model, 'stalment_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid_amount')->textInput() ?>

    <?= $form->field($model, 'ceiling_money')->textInput() ?>

    <?= $form->field($model, 'money_type')->textInput() ?>

    <?= $form->field($model, 'reciever_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ref_id')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
