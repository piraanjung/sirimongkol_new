<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\WorkCategory;

/* @var $this yii\web\View */
/* @var $model app\models\WorkGroup */
/* @var $form yii\widgets\ActiveForm */
$wc= WorkCategory::find()->all();
$listData=ArrayHelper::map($wc,'id','wc_name');

?>

<div class="work-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wg_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wc_id')->dropDownList(
            $listData,
            ['prompt'=>'Select...']
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
