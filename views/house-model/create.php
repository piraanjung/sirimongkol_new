<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */

$this->title = 'สร้างแบบบ้าน';
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าแบบบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success">
        
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        
    </div>

