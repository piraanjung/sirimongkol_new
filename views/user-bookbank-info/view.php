<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลธนาคารของผู้ใช้ระบบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookbank-info-view">
<?=$this->render('_card',[
             'title'=> $this->title,
             'subtitle' => '',
             'display' => false,
             'a_title' => ''
         ])
         ?>
    <div class="box box-success">
        <p>
            <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-round']) ?>
            <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-round',
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
                [
                    'attribute' =>'user_id',
                    'header' => 'ชื่อผู้ใช้ระบบ',
                    'value' => function($model){
                        return $model->profile['name'];
                    }
                ],
                
                'banks.name',
                'account_bank',
                // 'create_date',
                // 'update_date',
            ],
        ]) ?>
    </div>
    </div><!--card--
</div>
