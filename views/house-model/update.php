<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */

$this->title = 'แก้ไขแบบบ้าน:'.$model->hm_name;
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าแบบบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hm_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="house-model-update">

    <?php 
        $title =$this->title;
        $subtitle ="แก้ไขข้อมูลแบบบ้าน";
        $a_text = "สร้างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = false;
        \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>
    <div>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <?php \app\models\Methods::card_footer();?>

</div>
