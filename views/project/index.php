<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use app\models\Methods;

$methodModel = new Methods();
$this->title = 'โครงการ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success">
        <div class="box-body">
            <?php 
                $title =$this->title;
                $subtitle ="เพิ่ม แก้ไข ข้อมูลโครงการ";
                $a_text = "สร้างข้อมูล".$this->title ;
                $action ="create"; 
                $btn_color="btn-info";
                $display = true;
                $methodModel->card_header($title, $subtitle, $a_text, $action, 
                        $btn_color="btn-info", $display);
            ?>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'project_id',
                    'projectname',
                    'control_statement',
                    'start_date',
                    'end_date',
                    //'create_date',
                    //'update_date',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <br>
            <?php $methodModel->card_footer();?>
        </div>
    </div>
</div>