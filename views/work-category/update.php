<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WorkCategory */

$this->title = 'แก้ไขประเภทกลุ่มงาน : '.$model->wc_name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทกลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-category-update">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false
            ])
            ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div><!--card-->
</div>
