<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WorkGroup */

$this->title = 'แก้ไขกลุ่มงาน: ' .$model->wg_name;
$this->params['breadcrumbs'][] = ['label' => 'Work Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-group-update">

<?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false
            ])
            ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div><!--card-->
</div>
