<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->projectname;
$this->params['breadcrumbs'][] = ['label' => 'โครงการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <?php 
        $title =$this->title;
        $subtitle ="แสดงข้อมูลโครงการ";
        $a_text = "สร้่่างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = false;
        \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>
    
        <p>
            <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-round']) ?>
            <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-round',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        
    <div class="well">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'project_id',
                'projectname',
                'control_statement',
                'start_date',
                'end_date',
                
            ],
        ]) ?>
    </div>
    <?php \app\models\Methods::card_footer();?>
</div>
