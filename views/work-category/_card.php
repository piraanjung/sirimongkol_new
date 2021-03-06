<?php

use yii\helpers\Html;
?>
<div class="card">
    <div class="card-header" data-background-color="purple">
        <div class="row">
            <div class="col-md-10">
                <h4 class="title">
                    <?=$title;?>
                </h4>
                <p class="category"><?=$subtitle;?></p>
            </div>
            <div class="col-md-2">
                <?= Html::a('สร้างหมวดงาน', ['create'], 
                    [
                        'class' => 'btn btn-info btn-round',
                        'style' => $display == false ? 'display:none' :''
                    ]) ?>
            </div>
        </div>

    </div>
    <div class="card-content table-responsive" style="padding:15px; margin-top:0px !important">