<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = 'แก้ไข: '. $model->work_name;
$this->params['breadcrumbs'][] = ['label' => 'Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="works-update">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false,
                'a_title' => 'สร้างรายการงาน'
            ])
            ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div><!--card-->
</div>
