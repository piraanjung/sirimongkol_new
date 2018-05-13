<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\db\Query;

$this->title = 'สรุปการจ่ายเงินงวดรายแปลง' ;
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="owner-default-index">
    <?= $this->render('_projectdetail_header',[
        'houseCount' => $houseCount,
        'completeBuildedHoueses' => $completeBuildedHoueses,
        'duringBuildedHouses' => $duringBuildedHouses,
        'project' => $project,
        'sumPaidAmountByProject' => $sumPaidAmountByProject
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
    
    <?= Gridview::widget([
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
                    'filter'=>array("1"=>"Active","2"=>"Inactive"),
                    'value' => function($model){
                        return $model['house_name'];
                    }
                ],
                [
                    'attribute' =>'hm_name',
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
                            return Html::a('รายละเอียด', ['instalmentdetail_by_house','id'=>$model['id'], 
                            'project_id' => $model['project_id']],
                                ['class'=> 'btn btn-raised  btn-round btn-info']);
                        },
                    ]
                ],
            ]
    ]);
    ?>


</div>
    
</div>
</div>
</div><!--card-->