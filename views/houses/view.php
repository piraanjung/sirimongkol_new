<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = "แสดงข้อมูลแปลงบ้านที่ " .$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-view">

<?php 
        $title =$this->title;
        $subtitle ="แสดงข้อมูลแปลงบ้าน";
        $a_text = "สร้างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = false;
        \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-round btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-round btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
  <div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'house_name',
            'housemodels.hm_name',
            'project.projectname',
            [
                'attribute' =>'house_status',
                'header' => 'สถานะบ้าน',
                'value' => function($model){
                    return \app\models\Methods::house_status($model['house_status']);
                }
            ],
            'create_date',
            'update_date',
        ],
    ]) ?>
</div>
<?php \app\models\Methods::card_footer();?>
</div>
