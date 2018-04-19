<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\ceo\models\Laborcostdetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Laborcostdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laborcostdetails-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'work_classify_id',
            'work_name',
            'stalment_paid',
            'paid_amount',
            'ceiling_money',
            'money_type',
            'reciever_id',
            'comment:ntext',
            'ref_id',
            'create_date',
            'update_date',
        ],
    ]) ?>

</div>
