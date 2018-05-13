<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WorkCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'หมวดงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-category-view">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false
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
            'wc_name',
        ],
    ]) ?>
</div><!--card-->
</div>
