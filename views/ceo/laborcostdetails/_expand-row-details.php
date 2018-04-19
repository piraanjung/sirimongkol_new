<?php
use yii\db\Query;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Instalmentcostdetails;


$query = new Query;
$query->select('
        a.*,
        b.work_name,
        c.name as constructor_name,
        d.name as money_type_name
    ')
    ->from('instalmentcostdetails a')
    ->leftJoin('works b', 'a.work_id = b.id')
    ->leftJoin('profile c', 'a.contructor_id = c.user_id')
    ->leftJoin('money_type d', 'a.money_type_id = d.id')
    ->where(['house_id' => $model['house_id']])
    ->andWhere(['worktype_id' => $model['wg_id']]);

$rows = $query->all(); 
$dataProvider = new ArrayDataProvider([
    'allModels' => $rows,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
?>
<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'header' => 'ผู้รับเหมา',
            'contentOptions' => ['style' => 'text-align:left;'],
            'value' => function($model){
                return $model['constructor_name'];
            }
        ],
        [
            'header' => 'งาน',
            'contentOptions' => ['style' => 'text-align:left;'],
            'value' => function($model){
                return $model['work_name'];
            }
        ],
        [
            'header' => 'ชนิดเงิน',
            'value' => function($model){
                return $model['money_type_name'];
            }
        ],
        [
            'header' => 'จ่ายจำนวน',
            'contentOptions' => ['style' => 'text-align:right;'],
            'value' => function($model){
                return number_format($model['amount'],2);
            }
        ],
        [
            'header' => 'วันที่บันทึก',
            'value' => function($model){
                return $model['create_date'];
            }
        ]
    ],
    // other widget settings
]);
?>