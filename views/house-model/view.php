<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */

$this->title = $model->hm_name;
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าแบบบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-view">

     <?php 
        $title =$this->title;
        $subtitle ="แสดงข้อมูลแบบบ้าน";
        $a_text = "สร้างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = false;
        \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-round']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-round',
            'data' => [
                'confirm' => 'คุณต้องการลบข้อมูลนี้หรือไม่?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'hm_code',
                'hm_name',
                'hm_control_statment',
                'hm_description:ntext',
            ],
        ]) ?>
    </div>
    <?php \app\models\Methods::card_footer();?>
</div>
