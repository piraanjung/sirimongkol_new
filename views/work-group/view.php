<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WorkGroup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Work Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-group-view">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false
            ])
            ?>
    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการลบข้อมูลนี้หรือไม่?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'wg_name',
            'workCategory.wc_name',
            [
                'attribute' => 'wg_status',
                'value' => function($model){
                    return \app\models\WorkGroup::workGroupStatus($model['wg_status']);
                }
            ]
        ],
    ]) ?>
</div><!--card-->
</div>
