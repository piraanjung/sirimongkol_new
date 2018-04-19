<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkGroup */

$this->title = 'สร้างกลุ่มงาน';
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-group-create">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false
            ])
            ?>
    <div class="box box-success">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    </div><!--card-->
</div>
