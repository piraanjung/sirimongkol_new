<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Instalment */
/* @var $form yii\widgets\ActiveForm */

$project = \app\models\Project::find()->all();
$projectList = ArrayHelper::map($project, 'project_id', 'projectname');
?>

<div class="instalment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'project_id')->dropDownList($projectList,['prompt' => 'เลือก...']) ?>
        </div>
        <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'instalment')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'monthly')->dropDownList($monthly, ['prompt'=>'เลือก..']) ?>
        </div>
        <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'year')->textInput() ?>
        </div>
    </div>
   


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-round' : 'btn btn-primary btn-round']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
