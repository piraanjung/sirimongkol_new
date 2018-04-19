<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\WorkGroup;

$ints_sum =$instalment_sum_provider->getModels();
$percent = ($ints_sum[0]['sum_paid_amount']/$ints_sum[0]['sum_cost_control'])*100;
$class = $percent < 100 ? 'bg-yellow' : '';
// print_r($instalment_sum_provider);
?>

<div class="box box-success">
    <?= GridView::widget([
            'dataProvider' => $instalment_sum_provider,
            // 'filterModel'=> $searchModel ,
            'showPageSummary'=>true,
            'striped'=> false,
            'pjax'=>true,
            'columns' => [
                [
                    'class'=>'kartik\grid\SerialColumn',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ?  ['class' => 'bg-yellow'] : [];
                    }, 
                ],
                
                [
                    'attribute' => 'wg_name',
                    'header' => 'กลุ่มงาน',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:left', 'class' => 'bg-yellow'] : ['style'=> 'text-align:left'];
                    },
                    'value' => function($model){

                        return $model['wg_name'];
                    }
                ],
                [
                    'attribute' => 'cost_control',
                    'header' => 'งบควบคุม',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:right', 'class' => 'bg-yellow'] : ['style'=> 'text-align:right'];
                    },
                    'value' => function($model){
                        return $model['cost_control'];
                    },
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                ],
                [
                    'attribute' =>'paid_amount',
                    'header' => 'จ่ายแล้ว',
                    
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:right', 'class' => 'bg-yellow'] : ['style'=> 'text-align:right'];
                    },
                    'value' => function($model){
                        $a = $model['paid_amount'] > 0 ? $model['paid_amount'] : 0;
                        return $a;
                    },
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryOptions'=>['class'=>'text-right text-warning'], 
                ],
                [
                    'header' =>'%',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:right', 'class' => 'bg-yellow'] : ['style'=> 'text-align:right'];
                    },
                    'value' => function($model){
                        return $model['progress_percent'] == '' ? 0 : $model['progress_percent'];
                    },
                    'format'=>['decimal', 2],
                ],
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
                    },
                    'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
                ],
                // [
                //     'class' => 'kartik\grid\ActionColumn',
                //     // 'dropdown' => ['a','b'],
                //     // 'dropdownOptions' => ['class' => 'pull-right'],
                //     'urlCreator' => function($action, $model, $key, $index) { return '#'; },
                //     'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
                //     'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
                //     'deleteOptions' => ['title' => 'This will launch the book delete action. Disabled for this demo!', 'data-toggle' => 'tooltip'],
                //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                // ],

            ],
            
            
        ]);


    ?>
</div>