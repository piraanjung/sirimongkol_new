<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\db\Query;

$this->title = 'รายละเอียดโครงการ สิริมงคล '.substr($houseCount[0]['project_id'],-1) ;
$this->params['breadcrumbs'][] = ['label' => 'หน้าแรก ความคืบหน้าโครงการ', 'url' => ['/ceo/ceo/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="owner-default-index">
<?php
        //หาจำนวนบ้านที่มีการจ่ายเงินผิดปกติ
        $paid_abnormal_houses0 =0;
        $paid_abnormal_houses1 =0;
        $paid_abnormal_houses2 =0;
        // echo "<pre>";
        // print_r($dataProvider->getModels());
        foreach($dataProvider->getModels() as $a){
            $i = \app\models\Methods::get_amount_over($a['id']);
            if($i > 0){
                if($a['house_status'] ==0 ){
                    $paid_abnormal_houses0+=1;
                }else if($a['house_status'] ==1 ){
                    $paid_abnormal_houses1+=1;
                }else if($a['house_status'] ==2){
                    $paid_abnormal_houses2+=1;
                }
            }
            // $i <= 0 ? $paid_abnormal_houses+=0 : $paid_abnormal_houses+=1;
        }
    ?>
    <?= $this->render('_projectdetail_header',[
        'houseCount' => $houseCount,
        'completeBuildedHoueses' => $completeBuildedHoueses,
        'duringBuildedHouses' => $duringBuildedHouses,
        'project' => $project,
        'sumPaidAmountByProject' => $sumPaidAmountByProject,
        'paid_abnormal_houses0' => $paid_abnormal_houses0,
        'paid_abnormal_houses1' => $paid_abnormal_houses1,
        'paid_abnormal_houses2' => $paid_abnormal_houses2,
        'house_status' => $house_status
        
    ]);
    ?>
</div>
   
   <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false
            ])
            ?>
<div class="box box-success">
<div class="box-body">
<?= GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'responsive'=>true,
            'hover'=>true,
            'striped' => false,
            'rowOptions' => function ($model) {
                // $res = ($model['sum_amount']/$model['hm_control_statment'])*100;
                //     return $res <= 100 ? ['class' => ''] : ['class' => 'danger'];
                // }
                $i = \app\models\Methods::get_amount_over($model['id']);
                return $i <= 0 ? ['class' => ''] : ['class' => 'danger'];
            }
    ,
    'columns' => [
        'house_name',
        [
            'attribute' => 'house_model',
            'value' => 'house_model.hm_name'
        ],
        [
            'header' => 'จำนวนกลุ่มงาน',
            'contentOptions' => ['style'=>'text-align:right'],
            'value' => function($model){
                $rows = \app\models\HouseModelHaveWorkgroup::find()->select('house_model_id')
                    ->where(['house_model_id' =>$model['house_model_id']])->all();
                    return count($rows);
            }
        ],
        [
            'header' => 'จ่ายเงินแล้ว',
            'contentOptions' => ['style'=>'text-align:right'],
            'value' => function($model){
                $rows = \app\models\Instalmentcostdetails::find()
                    ->where(['house_id' =>$model['id']])
                    ->sum('amount');
                    return $rows == "" ? '0.00' : number_format($rows,2);
            }
        ],
        [
            'attribute' => 'house_model.hm_control_statment',
            'contentOptions' => ['style'=>'text-align:right'],
            'header' => 'งบควบคุม',
            'value' => 'house_model.hm_control_statment'
        ],
        [
            'header' => 'คิดเป็น %',
            'contentOptions' => ['style'=>'text-align:right'],
            'value' => function($model){
                $sum = \app\models\Instalmentcostdetails::find()
                ->where(['house_id' =>$model['id']])
                ->sum('amount');
                $res = ($sum/$model['house_model']['hm_control_statment'])*100;
                        return number_format($res,2)."%";
            }
        ],
        [
            'header' => 'งานจ่ายเกินงบ',
            'contentOptions' => ['style'=>'text-align:right'],
            'value' => function($model){
                $i = \app\models\Methods::get_amount_over($model['id']);
                return $i ;
            }
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{info}',
            'width' => '10%',
            'header' => '',
            'buttons'=>[

                'info'=>function($url, $model){
                    return Html::a('รายละเอียด',  ['/ceo/laborcostdetails/instalmentdetail_by_house','id'=>$model['id'], 
                    'project_id' => $model['project_id']],
                        ['class'=> 'btn btn-raised  btn-round btn-info']);
                },
            ]
        ],
    ],
]);
?>
    <!-- < Gridview::widget([
            'dataProvider'=> $provider,
            // 'filterModel' => $searchModel,
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'responsive'=>true,
            'hover'=>true,
            'striped' => false,
            'rowOptions' => function ($model) {
                // $res = ($model['sum_amount']/$model['hm_control_statment'])*100;
                //     return $res <= 100 ? ['class' => ''] : ['class' => 'danger'];
                // }
                $i = \app\models\Methods::get_amount_over($model['id']);
                return $i <= 0 ? ['class' => ''] : ['class' => 'danger'];
            }
            ,
            'columns'=>[
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' =>'house_name',
                    'header' => 'แปลงบ้าน',
                    'value' => function($model){
                        return $model['house_name'];
                    }
                ],
                [
                    'attribute' =>'housemodels',
                    'header' => 'แบบบ้าน',
                    'value' => function($model){
                        return $model['hm_name'];
                    }
                ],
                [
                    'attribute' =>'',
                    'header' => 'จำนวนกลุ่มงาน',
                    'hAlign' => 'right',
                    'value' => function($model){
                        return $model['workgroup_num'];
                    }
                ],
                [
                    'attribute' =>'amount',
                    'hAlign' => 'right',
                    'header' => 'จ่ายเงินแล้ว',
                    'value' => function($model){
                        return number_format($model['sum_amount'],2);
                    }
                ],
                [
                    'attribute' =>'hm_control_statment',
                    'hAlign' => 'right',
                    'header' => 'งบควบคุม',
                    'value' => function($model){
                        return number_format($model['hm_control_statment'],2);
                    }
                ],
                [
                    'attribute' =>'house_status',
                    'header' => 'คิดเป็น %',
                    'hAlign' => 'right',
                    'value' => function($model){
                        $res = ($model['sum_amount']/$model['hm_control_statment'])*100;
                        return number_format($res,2)."%";
                    }
                ],
                [
                    'header' => 'งานจ่ายเกินงบ',
                    'hAlign' => 'right',
                    'value' => function($model){
                        $i = \app\models\Methods::get_amount_over($model['id']);
                        return $i ;
                    }
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{info}',
                    'width' => '10%',
                    'header' => '',
                    'buttons'=>[
        
                        'info'=>function($url, $model){
                            return Html::a('รายละเอียด', ['/ceo/laborcostdetails/instalmentdetail_by_house','id'=>$model['id'], 
                            'project_id' => $model['project_id']],
                                ['class'=> 'btn btn-raised  btn-round btn-info']);
                        },
                    ]
                ],
            ]
    ]);
    ?> -->
<!-- <= GridView::widget([
    'dataProvider'=> $dataProvider,
    // 'filterModel' => $searchModel,
    // 'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true,
    'columns'=>[
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'instalment_id',
            'header' => 'งวดที่',
            'value' => function($model){
                $month = $model['monthly'] <10 ? "0".$model['monthly'] : $model['monthly'];
                return $model['instalment_id']."/".$month.".".$model['year'];
            }
        ],
        [
            'attribute' => 'instalment_id',
            'header' => 'จำนวนที่จ่าย',
            'value' => function($model){
                return $model['instalment_id'];
            }
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{info}',
            'width' => '20%',
            'buttons'=>[

                'info'=>function($url, $model){
                    return Html::a('รายละเอียด', ['/ceo/laborcostdetails/index','id'=>$model['id'], 'instalment' => $model['instalment_id'], 
                    'house_id' => $model['house_id'], 'project_id'=>$model['project_id']],
                        ['class'=> 'btn btn-raised btn-block  btn-success']);
                },
            ]
        ],
    ]
]);
?> -->

</div>
    
</div>
</div></div><!--card-->