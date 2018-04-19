<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\ceo\models\Laborcostdetails */

$this->title = 'Create Laborcostdetails';
$this->params['breadcrumbs'][] = ['label' => 'Laborcostdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laborcostdetails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
