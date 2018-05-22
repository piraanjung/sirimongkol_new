<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\db\Query;

// Generate a bootstrap responsive striped table with row highlighted on hover
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'houses.house_name'
    ],
    'responsive'=>true,
    'hover'=>true
]);