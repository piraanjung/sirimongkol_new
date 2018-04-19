<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-model-have-workgroup-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        $listdata = ArrayHelper::map($house_model,'id', 'hm_name');
        echo $form->field($model,'house_model_id')->dropDownList(
            $listdata,['prompt' => 'เลือกแบบบ้าน....']
        )
    ?>

    <?php
        $wg = ArrayHelper::map($workgroup,'id', 'wg_name');
        echo $form->field($model,'wg_id')->dropDownList(
            $wg,['prompt' => 'เลือกกลุ่มงาน....']
        )
    ?>

    <!-- = $form->field($model, 'wg_id')->textInput() ?> -->
    <!-- <
        $i =1;
        foreach($workgroup as $key => $wg){
            if($i==1){
                echo "<div class='row'>";
            }
            echo "<div class='col-md-4' style='margin-top:5px'>";
            echo CheckboxX::widget([
                'name'=>'s_[]',
                'options'=>['id'=>'s_'.$key],
                'pluginOptions'=>['threeState'=>false]
            ]);
            echo '<label class="cbx-label" for="s_1">'.$wg['wg_name'].'</label>';
            echo $form->field($model, 'cost_control')->textInput();
            echo "</div>";
            if($i%3 ==0 || $key+1 == count($workgroup)){
                echo "</div>";
                $i=0;
            }
            $i++;
        }
    ?> -->

    <?= $form->field($model, 'cost_control')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
