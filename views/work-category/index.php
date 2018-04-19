<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กลุ่มงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   <div class="box box-success">
  

    <div class="box-body">
    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => true
            ])
            ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'wc_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
    </div><!-- div card-->
</div>
