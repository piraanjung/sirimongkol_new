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
            'houseModel.hm_name',
            'workGroup.wg_name',
            'cost_control',
        ],
    ]) ?>
</div><!--card-->
</div>
