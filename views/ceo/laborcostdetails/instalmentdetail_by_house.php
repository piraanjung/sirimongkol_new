<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\DataColumn;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ceo\models\LaborcostdetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if(!isset($instalment['empty_instalment']) && !empty($instalment)){
$this->title = 'สรุปการจ่ายค่าแรง แปลงที่'.$instalment[0]['house_id'];
                // " งวดที่ ".$instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'].
                // ".".$instalment[0]['instalment_year'];
$this->params['breadcrumbs'][] = ['label' => 'หน้าแรก ความคืบหน้าโครงการ'.$instalment[0]['project_id'], 'url' => ['/ceo/ceo/index']];

$this->params['breadcrumbs'][] = ['label' => 'รายละเอียดโตรงการ สิริมงคล'.$instalment[0]['project_id'], 
                'url' => ['ceo/ceo/projectdetail','project_id' =>$instalment[0]['project_id']]]; 
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<?=$this->render('_instalmentdetail_by_house',[
                    'instalment' => $instalment,
                    'instalment_sum_provider' => $instalment_sum_provider,
                    'searchModel' => $searchModel
                ])
        ?>
<?php }else{
        echo "sdfsdfd";
} ?>