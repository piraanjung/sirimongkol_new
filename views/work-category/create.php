<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkCategory */

$this->title = 'สร้างหมวดงาน';
$this->params['breadcrumbs'][] = ['label' => 'หมวดงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="work-category-create">
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
