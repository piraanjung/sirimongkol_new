<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'แก้ไขแปลงบ้าน:'.$model->house_name;
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="houses-update">

     <?php 
        $title =$this->title;
        $subtitle ="แก้ไขข้อมูลแปลงบ้าน";
        $a_text = "สร้างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = false;
        \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>
    <div class="box box-success">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <?php \app\models\Methods::card_footer();?>
</div>
