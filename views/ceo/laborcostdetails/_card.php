<?php

use yii\helpers\Html;
?>
<div class="card">
    <div class="card-header" data-background-color="purple">
        <div class="row">
            <div class="col-md-10" >
                <h4 class="title" style="text-align:left !important">
                    <?=$title;?>
                </h4>
                <p class="category"><?=$subtitle;?></p>
            </div>
            <div class="col-md-2">
                <?= Html::a('สร้างงวดจ่ายเงิน', ['create'], 
                    [
                        'class' => 'btn btn-success btn-raised',
                        'style' => $display == false ? 'display:none' :''
                    ]) ?>
            </div>
        </div>

    </div>
    <div class="card-content table-responsive">