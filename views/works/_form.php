<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\WorkGroup;
/* @var $this yii\web\View */
/* @var $model app\models\Works */
/* @var $form yii\widgets\ActiveForm */
$wg= WorkGroup::find()->all();
$listData=ArrayHelper::map($wg,'id','wg_name');
?>

<div class="works-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_id')->dropDownList(
            $listData,
            ['prompt'=>'เลือก...']
        );
    ?>

    <?= $form->field($model, 'work_control_statement')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'status')->dropDownList(
            [0 => 'ยังไม่เปิดใช้งาน', 1 => 'เปิดใช้งาน'],
            ['prompt'=>'เลือก...']
        );
    ?>
    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
