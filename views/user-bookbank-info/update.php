<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */

$this->title = 'แก้ไขข้อมูลธนาคารของผู้ใช้ระบบ: '. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลธนาคารของผู้ใช้ระบบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>

<div class="user-bookbank-info-update">

 <?=$this->render('_card',[
             'title'=> $this->title,
             'subtitle' => '',
             'display' => false,
             'a_title' => ''
         ])
         ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>