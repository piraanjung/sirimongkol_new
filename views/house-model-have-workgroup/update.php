<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */

$this->title = 'แก้ไข ผูกแบบบ้านกับกลุ่มงาน: แบบบ้าน '.$model->houseModel->hm_name;
$this->params['breadcrumbs'][] = ['label' => 'ผูกแบบบ้านกับกลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="house-model-have-workgroup-update">

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
</div><!--card-->
</div>
