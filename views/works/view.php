<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = "ข้อมูลงาน - ". $model->work_name;
$this->params['breadcrumbs'][] = ['label' => 'Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-view">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false,
                'a_title' => 'สร้างรายการงาน'
            ])
            ?>
    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
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
            'work_name',
            'workGroup.wg_name',
            'work_control_statement',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return \app\models\Works::workStatus($model['status']);
                }
            ]
        ],
    ]) ?>
</div><!--card-->
</div>
