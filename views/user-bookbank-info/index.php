<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserBookbankInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลธนาคารของผู้ใช้ระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookbank-info-index">

 <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => true,
                'a_title' => 'เพิ่มข้อมูลธนาคารของผู้ใช้ระบบ'
            ])
            ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="box box-success">

    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' =>'user_id',
                'value' => function($model){
                    $name = \app\models\Profile::find()
                            ->where(['user_id' => $model->user_id])->one();
                    return $name['name'];
                }
            ],
            [
                'attribute' => 'bank_id',
                'value' => function($model){
                    $bank = \app\models\Banks::find()
                        ->where(['id'=> $model->bank_id])->one();
                    return $bank['name'];
                }
            ],
            'account_bank',
            // 'create_date',
            // 'update_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div><!--card-->
</div>
