<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Methods;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InstalmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เบิกจ่ายงวด';
$this->params['breadcrumbs'][] = $this->title;
$methodModel = new Methods();
?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="instalment-index box box-success">
        <div class="box-body">

            <?php
                $title = $this->title;
                $subtitle = 'รายการการเบิกจ่ายเงินงวดงาน';
                $a_text = "สร้างงวดเบิกจ่าย";
                $action= "create";
                $btn_color = "btn-info";
                $display = true;
               $methodModel->card_header($title,  $subtitle, $a_text, $action, $btn_color, $display); 
            ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'instalment',
                            'monthly',
                            'year',
                            [
                                'attribute' => 'project',
                                'value' => 'project.projectname'
                            ],
                            [
                                'attribute' =>'profile',
                                'value' => 'profile.name'
                            ],

                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'template' => '{add_item}  {paid_by} {instalment_sum} {details}',
                                'width' => '45%',
                                'header' => '',
                                'buttons'=>[

                                    'add_item'=> function($url, $model){
                                            return Html::a('จ่ายเงินรายช่าง', 
                                            ['employee/instalment/instalment_by_instructor','instalment_id'=>$model->id],
                                                ['class'=> 'btn btn-round  custom_button btn-md',
                                                    'style' => 'padding: 12px 15px !important',
                                                    'data-background-color'=>"green"
                                                ]
                                            );
                                        },
                                    
                                    'paid_by'=> function($url, $model){
                                        // $t = 'employee/instalment/instalment_by_instructor&instalment_id='.$model->id;
                                        return Html::a('เลือกวิธีจ่าย',['employee/with-drawn','instalment_id'=>$model->id],
                                                ['class' => 'btn btn-round btn-md',
                                                    'style' => 'padding: 12px 15px !important',
                                                    'data-background-color'=>"orange"
                                                ]);
                                    },
                                    'instalment_sum'=> function($url, $model){
                                        return Html::a('สรุปจ่ายเงินรายช่าง', 
                                        ['employee/instalment/instalment-summary','instalment_id'=>$model->id],
                                            ['class'=> 'btn btn-round  custom_button btn-md',
                                                'style' => 'padding: 12px 15px !important',
                                                'data-background-color'=>"green"
                                            ]
                                        );
                                    },
                                    'details'=> function($url, $model){
                                        // $t = 'employee/instalment/instalment_by_instructor&instalment_id='.$model->id;
                                        return Html::a('รายงานสรุป', 
                                        ['employee/instalment/instalment_by_instructor_detail','instalment_id'=>$model->id],
                                            ['class'=> 'btn btn-round  custom_button btn-md',
                                            'style' => 'padding: 12px 15px !important',
                                            'data-background-color'=>"blue"
                                            ]
                                        );
                                    },
                                    
                                ]
                            ],
                        ],
                    ]); 
                ?>
            <?=$methodModel->card_footer();?>
        </div><!-- b0x-body -->
    </div><!-- instalment-index box box-success -->


<?php



?>