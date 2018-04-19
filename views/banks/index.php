<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BanksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ธนาคาร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="box box-success">
   
    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => true,
                'a_title' => 'สร้างธนาคาร'
            ])
            ?>
   
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'brance',
            'address',
            'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
    </div><!--card-->
</div>
