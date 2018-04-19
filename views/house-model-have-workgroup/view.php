<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูล ผูกแบบบ้านกับกลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-have-workgroup-view">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false,
                'a_title' => ''
            ])
            ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'houseModel.hm_name',
            'workGroup.wg_name',
            'cost_control',
        ],
    ]) ?>
</div><!--card-->
</div>
