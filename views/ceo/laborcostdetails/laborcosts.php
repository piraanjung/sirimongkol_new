<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\DataColumn;
use app\models\WorkType;
use app\models\MoneyType;
use app\models\Profile;
?>
            <?= GridView::widget([
                'dataProvider' => $provider,
        
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'work_name',
                        'value' => function($model){
                            $workname =  WorkType::find()->select('work_type_name')
                            ->where(['id' => $model['work_name']])->one();
                            return $workname['work_type_name'];
                        }
                    ],
                    'stalment_paid',
                    [
                        'attribute' =>'paid_amount',
                        'contentOptions' => ['style' => 'text-align:right'],
                        'value' => function($model){
                            return number_format($model['paid_amount'],2);
                        }
                    ],
                    [
                        'attribute' => 'money_type',
                        'value' => function($model){
                            $monenytype = MoneyType::find()->select('name')
                                ->where(['id' => $model['money_type']])->one();
                            return $monenytype['name'];
                        }
                    ],
                    [
                        'attribute' =>'reciever_id',
                        'value' => function($model){
                            $user = Profile::find()->select('name')
                                ->where(['user_id' => $model['reciever_id']])->one();
                            return $user['name'];
                        }
                    ],
                    [
                        'attribute' => 'comment',
                        'value' => function($model){
                            return $model->comment == "" ? "-" : $model->comment;
                        }
                    ]
                
                ],
            ]); 
            ?>