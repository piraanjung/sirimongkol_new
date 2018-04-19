<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */

$this->title = 'เพิ่มข้อมูลธนาคารของผู้ใช้ระบบ';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookbank-info-create">

   <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false,
                'a_title' => ''
            ])
            ?>
 <div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div><!--card-->
</div>
