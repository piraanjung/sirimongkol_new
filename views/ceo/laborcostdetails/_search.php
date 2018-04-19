<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ceo\models\LaborcostdetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laborcostdetails-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'work_classify_id') ?>

    <?= $form->field($model, 'work_name') ?>

    <?= $form->field($model, 'stalment_paid') ?>

    <?= $form->field($model, 'paid_amount') ?>

    <?php // echo $form->field($model, 'ceiling_money') ?>

    <?php // echo $form->field($model, 'money_type') ?>

    <?php // echo $form->field($model, 'reciever_id') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'ref_id') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
