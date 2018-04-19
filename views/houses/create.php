<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'สร้างแปลงบ้าน';
$this->params['breadcrumbs'][] = ['label' => 'แปลงบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
        $title =$this->title;
        $subtitle ="สร้างข้อมูลแปลงบ้าน";
        $a_text = "สร้างข้อมูล".$this->title ;
        $action ="create"; 
        $btn_color="btn-info";
        $display = false;
        \app\models\Methods::card_header($title, $subtitle, $a_text, $action, 
                $btn_color="btn-info", $display);
    ?>
            <div class="box box-success">
               <?= $this->render('_form', [
                'model' => $model,
              ]) ?>
           </div>
           <?php \app\models\Methods::card_footer();?>
            
      
    
    

