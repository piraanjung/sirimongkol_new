<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseModelHaveWorkgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผูกแบบบ้านกับกลุ่มงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="house-model-have-workgroup-index">
    <div class="box box-success">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => true,
                'a_title' => 'ผูกแบบบ้านกับกลุ่มงาน'
            ])
            ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'responsive'=>true,
            'hover'=>true,
            'pjax'=>true,
            'pjaxSettings'=>[
                'neverTimeout'=>true,
                // 'beforeGrid'=>'My fancy content before.',
                // 'afterGrid'=>'My fancy content after.',
            ],


            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                [
                    'attribute' => 'houseModel',
                    'value' => 'houseModel.hm_name',
                ],
                
                [
                    'attribute' => 'workGroup',
                    'value' => 'workGroup.wg_name',
                ],
                [
                    'attribute' =>'cost_control',
                    'header' => 'งบควบคุม',
                    'contentOptions' => ['style' => 'text-align:right'],
                    'value' =>function($model){
                        return number_format($model['cost_control'],2);
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    </div><!--card-->
</div>