<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => true,
                'a_title' => 'สร้างรายการงาน'
            ])
            ?>
    <div class="box box-success">

      <div class="box-header">
      
        </div>
        <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'work_name',
                'workGroup.wg_name',
                [
                    'attribute' => 'work_control_statement',
                    'contentOptions' => ['style' => 'text-align:right'],
                    'value' => function($model){
                        return number_format($model['work_control_statement'],2);
                    }
                ],
                [
                    'attribute' => 'status',
                    'header' => 'สถานะ',
                    'value' => function($model){
                        return \app\models\Works::workStatus($model['status']);
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>
    </div><!--card-->
</div>
