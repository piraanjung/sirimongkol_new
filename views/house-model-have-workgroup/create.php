<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */

$this->title = 'ผูกแบบบ้านกับกลุ่มงาน';
$this->params['breadcrumbs'][] = ['label' => 'ผูกแบบบ้านกับกลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-have-workgroup-create">
    <div class="box box-success">
    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false,
                'a_title' => ''
            ])
            ?>
        <?= $this->render('_form', [
            'model' => $model,
            'workgroup' => $workgroup,
            'house_model' => $house_model
        ]) ?>
    </div>
    </div><!-- card -->
</div>
