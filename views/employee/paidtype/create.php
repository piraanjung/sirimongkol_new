<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Paidtype */

$this->title = 'Create Paidtype';
$this->params['breadcrumbs'][] = ['label' => 'Paidtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paidtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
