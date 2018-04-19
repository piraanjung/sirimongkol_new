<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\DataColumn;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ceo\models\LaborcostdetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลรายแปลง';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="laborcostdetails-index">
        <div class="well well-default">
            <h2 class="breadcrumb">
                <?= Html::encode($this->title) ?>:
                    <?=$model[0]['projectname'];?>
                    งวดที่ :
                    <?=$model[0]['monthly']."/".$model[0]['instalment_id'].".".$model[0]['year'];?> 
            </h2>
            
        <!-- < \app\models\Methods::print_array($provider->getModels());?> -->
            <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            
            [
                'attribute' =>'house_id',
                'header' => 'เลขที่บ้าน',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'value' => function($model){
                    return $model['house_name'];
                }
            ],
            [
                'attribute' =>'house_model_id',
                'header' => 'แบบบ้าน',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'value' => function($model){
                    return $model['hm_name'];
                }
            ],
            [
                'attribute' => 'house_status',
                'header' => 'สถานะ',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'value' => function( $model){
                    if($model['house_status'] == 0){
                        $status = "ยังไม่ดำเนินการ";
                    }
                    if($model['house_status'] == 1){
                        $status = "กำลังก่อสร้าง";
                    }
                    if($model['house_status'] == 2){
                        $status = "สร้างแล้วเสร็จ";
                    }
                    return $status;
                }
            ],
            [
                'attribute' =>'control_statement',
                'header' => 'งบควบคุม (บาท)',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'contentOptions' =>['style' => 'text-align:right'],
                'value' => function($model){
                    return  number_format($model['hm_control_statment'],2);
                }
            ],
            [
                'header' => 'เบิกจ่ายแล้ว (บาท)',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'contentOptions' =>['style' => 'text-align:right'],
                'value' => function($model){
                    $query = new Query;
                    $paid = $query->select('sum(amount) as _sum')
                        ->from('instalmentcostdetails')
                        ->where(['house_id' => $model['house_name']])
                        ->groupby('house_id')
                        ->one();

                    return $paid['_sum'] !="" ?  number_format($paid['_sum'],2) : "-";
                }
            ],
            [
                'header' => '%',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'contentOptions' =>['style' => 'text-align:right'],
                'value' => function($model){
                    $query = new Query;
                    $paid = $query->select('sum(amount) as _sum')
                        ->from('instalmentcostdetails')
                        ->where(['house_id' => $model['house_name']])
                        ->groupby('house_id')
                        ->one();

                    return $paid['_sum'] >0 ? number_format((100*$paid['_sum'])/$model['hm_control_statment'],2) : 0;
                }
            ],
            [
                'header' => 'สถานะการจ่ายเงิน',
                'headerOptions' =>  ['style' => 'text-align:center'],
                'value' => function($model){
                    $query = new Query();
                    $paid = $query->select('sum(amount) as _sum')
                        ->from('instalmentcostdetails')
                        ->where(['house_id' => $model['house_name']])
                        ->groupby('house_id')
                        ->one();
                    $sumpaid = number_format((100*$paid['_sum'])/$model['hm_control_statment'],2);
                    if($sumpaid >100){
                        $txt ="เกินงบ";
                    }else if($sumpaid <100 && $sumpaid>0){
                        $txt = "ปกติ";
                    }else{
                        $txt ="-";
                    } 
                    return $txt;
                }
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' =>'{info}',
                'width' => '13%',
                'buttons' =>[
                    'info'=>function($url, $model) use ($instalment){
                        return Html::a('รายละเอียด', ['/ceo/laborcostdetails/instalmentdetail_by_house', 'instalment_id' => $instalment, 
                        'house_id' => $model['house_name'],  'project_id'=>$model['project_id']],
                            ['class'=> 'btn btn-raised btn-block  btn-success']);
                    },
                   
                ]
            ],
        ],
    ]) ?>
           
        </div>
    </div>