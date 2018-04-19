<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = 'สร้างงาน';
$this->params['breadcrumbs'][] = ['label' => 'งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">

    <?=$this->render('_card',[
                'title'=> $this->title,
                'subtitle' => '',
                'display' => false,
                'a_title' => 'สร้างรายการงาน'
            ])
            ?>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div><!--card-->
</div>
