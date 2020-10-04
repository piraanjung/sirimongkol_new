<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

use kartik\grid\GridView;
use app\models\Methods;
use yii\helpers\ArrayHelper;
use app\models\Profile;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use kartik\dialog\Dialog;
use yii\widgets\Pjax;
use app\models\Instalment;
use app\models\WorkGroup;
use app\models\Houses;
$this->title = 'สรุปเบิกจ่ายเงินงวดงาน';
$this->params['breadcrumbs'][] = $this->title;

$methodModel = new Methods();
$instalmentModel = new Instalment();
$selectedColumn = ['monthly', 'year', 'instalment'];
$instalmentCols = $instalmentModel->get_column_value($dataProvider->getModels()[0]['instalment_id'], $selectedColumn);
// $methodModel->print_array($instalmentCols);

?>
<h3>
    ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  

    <?=$instalmentModel->date_of_instalment($dataProvider->getModels()[0]['create_date']);?> 
    (งวด <?=$instalmentCols['monthly']."/".$instalmentCols['instalment'].".".$instalmentCols['year']?> )
    </h3>
<?php
   
   echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showPageSummary' => true,
    'pjax' => true,
    'striped' => false,
    'hover' => true,
    'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [//1
            'attribute' => 'constructor', 
            'width' => '310px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->constructor->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Profile::find()->orderBy('user_id')->asArray()->all(), 'user_id', 'name'), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any supplier'],
            'group' => true,  // enable grouping
            'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns' => [[1,3]], // columns to merge in summary
                    'content' => [             // content to show in each summary cell
                        1 => 'Summary (' . $model->constructor->name . ')',
                        6 => GridView::F_SUM,
                        7 => GridView::F_SUM,
                        // 8 => GridView::F_SUM,
                    ],
                    'contentFormats' => [      // content reformatting for each summary cell
                        6 => ['format' => 'number', 'decimals' => 2],
                        7 => ['format' => 'number', 'decimals' => 0],
                        // 8 => ['format' => 'number', 'decimals' => 2],
                    ],
                    'contentOptions' => [      // content html attributes for each summary cell
                        1 => ['style' => 'font-variant:small-caps'],
                        6 => ['style' => 'text-align:right'],
                        7 => ['style' => 'text-align:right'],
                        // 8 => ['style' => 'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options' => ['class' => 'info table-info','style' => 'font-weight:bold;']
                ];
            }
        ],
        [//2
            'attribute' => 'houses', 
            'width' => '50px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->houses->house_name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Houses::find()->orderBy('house_name')->asArray()->all(), 'id', 'house_name'), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any category'],
            'group' => true,  // enable grouping
            'subGroupOf' => 1, // supplier column index is the parent group,
            'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns' => [[2, 5]], // columns to merge in summary
                    'content' => [              // content to show in each summary cell
                        2 => 'Summary (' . $model->houses->house_name . ')',
                        6 => GridView::F_SUM,
                        7 => GridView::F_SUM,
                        // 8 => GridView::F_SUM,
                    ],
                    'contentFormats' => [      // content reformatting for each summary cell
                        6 => ['format' => 'number', 'decimals' => 2],
                        7 => ['format' => 'number', 'decimals' => 0],
                        // 8 => ['format' => 'number', 'decimals' => 2],
                    ],
                    'contentOptions' => [      // content html attributes for each summary cell
                        6 => ['style' => 'text-align:right'],
                        7 => ['style' => 'text-align:right'],
                        // 8 => ['style' => 'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options' => ['class' => 'success table-success','style' => 'font-weight:bold;']
                ];
            },
        ],
        [//3
            'attribute' => 'workGroup',
            // 'pageSummary' => 'Page Summary',
            'value' => function($model){
                return $model->workGroup['wg_name'] == "" ? "-" : $model->workGroup['wg_name'];
            },//'
            'pageSummaryOptions' => ['class' => 'text-right'],
        ],
        [//4
            'attribute' => 'work',
            // 'pageSummary' => 'Page Summary',
            'value' => function($model){
                return $model->workOne['work_name'] == "" ? "-" : $model->workOne['work_name'];
            },//'workOne.work_name',
            'pageSummaryOptions' => ['class' => 'text-right'],
        ],
        [
            'attribute' => 'money_type_id',
            'value' => 'moneyType.name',
            'pageSummary'=>'รวมทั้งสิ้น',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        ],
        [
            'attribute' => 'workOne.work_control_statement',
            'width' => '150px',
            'hAlign' => 'right',
            'format' => ['decimal', 2],
            'pageSummary' => true,
            'pageSummaryFunc' => GridView::F_SUM
        ],
        [
            'attribute' => 'จำนวนที่เบิก',
            'width' => '150px',
            'hAlign' => 'right',
            'value' => function($model){
                return $model->amount;
            },
            'format' => ['decimal', 0],
            'pageSummary' => true
        ],
        'comment',
        [
            'attribute' => 'แก้ไข/ลบ',
            'format' => 'raw',
            'width'=> '80px', 
            'value' => function($model){
                return '<i class="material-icons edit-money-icon" 
                value="'.\yii\helpers\Url::to(['employee/instalment/change-money-value', 
                'id'=>$model['id'],'money_type_id'=>$model['money_type_id']]).'">create</i>
                <i class="material-icons delete-money-icon" value="'.$model['id'].'">delete</i>';
            },

        ],
    ],
]);

?>


<?php Modal::begin([
            'header' => '<h4>เปลี่ยนจำนวนเงิน</h4>',
            'id'     => 'modal',
            'size'   => 'modal-md',
            'clientOptions' => [
                'backdrop' => false, 'keyboard' => true
                ]
    ]);
    
    echo "<div id='modelContent'></div>";
    
    Modal::end();
?>
<!-- <br style="clear:both"> -->


<?php
// Form::print_array($models);
$this->registerJs("
 $('.edit-money-icon').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
});

$('.delete-money-icon').click(function(){
    var id = $(this).attr('value')
    krajeeDialog.confirm('คุณต้องการลบข้อมูลใช่หรือไม่?', function (result) {
        if (result) {
            $.ajax({
                type : 'POST',
                url  : 'index.php?r=employee/instalment/delete-money-value',
                data : {id: id},
                   success : function(data){
                      krajeeDialog.alert('ทำการลบข้อมูลเรียบร้อยแล้ว')
                      location.reload();
                }
    
            })
        } else {
            // alert('Oops! You declined!');
        }
    });
});


    
", $this::POS_READY); 
?>