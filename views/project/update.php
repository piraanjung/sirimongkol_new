<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'แก้ไข โครงการ:'.$model->projectname;
$this->params['breadcrumbs'][] = ['label' => 'โครงการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->projectname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="project-update">

    <?php 
        $title =$this->title;
        $subtitle ="แก้ไข ข้อมูลโครงการ";
        $a_text = "สร้่่างข้อมูล".$this->title ;
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
