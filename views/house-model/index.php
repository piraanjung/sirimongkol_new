<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่าแบบบ้าน';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="house-model-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php 
            $title =$this->title;
            $subtitle ="เพิ่ม แก้ไข แบบบ้าน";
            $a_text = "สร้างข้อมูล".$this->title ;
            $action ="create"; 
            $btn_color="btn-info";
            $display = true;
            \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                    $btn_color="btn-info", $display);
        ?>
            <div class="box box-success">


                <div class="box-body">
                    <br>
                    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'hm_code',
                        'hm_name',
                        'hm_control_statment',
                        'hm_description:ntext',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                        <br>
                </div>
            </div>
        <?php \app\models\Methods::card_footer();?>
</div>