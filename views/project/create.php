<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'สร้างโครงการ';
$this->params['breadcrumbs'][] = ['label' => 'โครงการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="card">
    <div class="card-header" data-background-color="purple">
        <div class="row">
            <div class="col-md-12">
                <h4 class="title">
                    <?=$this->title;?>
                </h4>
                <p class="category"></p>
            </div>
            
        </div>

    </div>
    <div class="card-content table-responsive">   
    
                    <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
    </div>
</div>    
    
