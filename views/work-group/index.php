<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กลุ่มงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-group-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => true
            ])
            ?>
        <div class="box box-success">
          
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        'wg_name',
                        [
                            'attribute' => 'wc_id',
                            'value' => function($model){
                            $work_category = app\models\WorkCategory::find()->where(['id' => $model['wc_id']])->one(); 
                            return $work_category['wc_name'];  
                            }
                        ],
                        [
                            'attribute' => 'wg_status',
                            'header' => 'สถานะ',
                            'value' => function($model){
                                return \app\models\WorkGroup::workGroupStatus($model['wg_status']);
                            }
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div><!--Card-->
</div>
