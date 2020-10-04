<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Methods;

$method = new Methods();
$this->title = 'แปลงบ้าน';
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->session->hasFlash('alert')){
    echo \yii\bootstrap\Alert::widget([
    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]);
    } 
?>
<div class="houses-index">

    <?php 
        $title =$this->title;
        $subtitle ="เพิ่ม แก้ไข แปลงบ้าน";
        $a_text = "สร้างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = true;
        $method->card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success">
        <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'house_name',
                [ 
                    'attribute' => 'house_model_id',
                    'value' => function($model){
                        $hm = app\models\HouseModel::find()->where(['id' => $model['house_model_id']])->all();
                      
                        return $hm[0]['hm_name'];
                    }
                ],
                [
                    'attribute' => 'project_id',  
                    'value'     => function($model){
                     $project = app\models\Project::find()->where(['project_id' => $model['project_id']])->one();
                     return $project['projectname'];   
                    }   
                ],
                
                [
                    'attribute' => 'house_status',
                    'value'     => function($model){
                        $hs = app\models\Houses::find()->where(['house_status' => $model['house_status']])->one();
                        return\app\models\Methods::house_status($hs['house_status']);   
                    }
                ],
                
                

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>
    <?php $method->card_footer();?>
</div>
