<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use kartik\dialog\Dialog;
use yii\widgets\Pjax;
use app\models\Instalment;

$instalmentModel = new Instalment();
?>

Instalment
 <h3>
    ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  

    <?=$instalmentModel->date_of_instalment($models[0]['create_date']);?> 
    (งวด <?=$models[0]['monthly']."/".$models[0]['instalment'].".".$models[0]['year']?>)
    </h3>
<?php
   
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],

        [
            'attribute' => 'constructor',
            'value' => 'constructor.name',
            'group'=>true,  
            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns'=>[[1,4]], // columns to merge in summary
                    'content'=>[             // content to show in each summary cell
                        1=>'รวม',
                        6=>GridView::F_SUM,
                        7=>GridView::F_SUM,
                    ],
                    'contentFormats'=>[      // content reformatting for each summary cell
                        6=>['format'=>'number', 'decimals'=>2],
                        7=>['format'=>'number', 'decimals'=>2],
                    ],
                    'contentOptions'=>[      // content html attributes for each summary cell
                        6=>['style'=>'text-align:right'],
                        7=>['style'=>'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options'=>['class'=>'danger','style'=>'font-weight:bold;']
                ];
            }
        ],

        [
            'attribute' => 'houses',
            'value' =>  function($model){
                return $model->houses['house_name'] == "" ? "-" : $model->houses['house_name'];
            },//'houses.house_name',
            'group'=>true,  // enable grouping
            'subGroupOf'=>1 
        ],
        [
            'attribute' => 'workGroup',
            'value' => function($model){
                return $model->workGroup['wg_name'] == "" ? "-" : $model->workGroup['wg_name'];
            },//'workGroup.wg_name',
            'group'=>true,  // enable grouping
            'subGroupOf'=>2 
        ],
        [
            'attribute' => 'work',
            'width'=>'10%',
            'value' => function($model){
                return $model->workOne['work_name'] == "" ? "-" : $model->workOne['work_name'];
            },//'workOne.work_name',
            'group'=>true,
            'subGroupOf'=>3
        ],
        [
            'attribute' => 'money_type_id',
            'value' => 'moneyType.name',
            'pageSummary'=>'รวมทั้งสิ้น',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        ],

        [
            'attribute' => 'workControlStatement',
            'format' => ['decimal', 2],
            'width'=>'10%',
            'hAlign' => 'right', 
            'group'=>true,  // enable grouping
            'subGroupOf'=>4,
            'value' => function($model){
                return $model->workOne['work_control_statement'] == "" ? 0 : $model->workOne['work_control_statement'];
            },//'workOne.work_control_statement',
            'pageSummary'=>true,
        ],
        [
            'attribute' => 'amount',
            'format' =>['decimal', 2],
            'hAlign' => 'right', 
            'value' => function($model){
                return $model->amount;
            },//amount',
            'pageSummary'=>true,
        ],
        'comment',
        [
            'attribute' => '',
            'format' => 'raw',
            'width'=> '70px', 
            'value' => function($model){
                return '<i class="material-icons edit-money-icon" 
                value="'.\yii\helpers\Url::to(['employee/instalment/change-money-value', 
                'id'=>$model['id'],'money_type_id'=>$model['money_type_id']]).'">create</i>
                <i class="material-icons delete-money-icon" value="'.$model['id'].'">delete</i>';
            },

        ],

    
    ];
    // echo ExportMenu::widget([
    //     'dataProvider' => $dataProvider,
    //     'columns' => $gridColumns,
    //     'columnSelectorOptions'=>[
    //         'label' => 'Cols...',
    //     ],
    //     'hiddenColumns'=>[0, 10], // SerialColumn & ActionColumn
    //     'disabledColumns'=>[9], // ID & Name
    //     'fontAwesome' => true,
    //     'dropdownOptions' => [
    //         'label' => 'Export All',
    //         'class' => 'btn btn-default'
    //     ]
    // ]);
    echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'autoXlFormat'=>true,
    'toolbar' =>  [

        '{export}',
        '{toggleData}',
    ],
    'export'=>[
        'fontAwesome'=>true,
        'showConfirmAlert'=>false,
        'target'=>GridView::TARGET_BLANK,
    ],

    'pjax' => true, // pjax is set to always true for this demo
    'showPageSummary'=>true,
    'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            // 'heading' => 'ddd',
        ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
    'exportConfig' => [
        GridView::EXCEL => [
            'label' => 'Excel',
            'icon' => 'file-excel-o',
            'iconOptions' => ['class' => 'text-success'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => 'grid-export',
            'alertMsg' => 'The EXCEL export file will be generated for download.',
            'options' => ['title' => 'Microsoft Excel 95+'],
            'mime' => 'application/vnd.ms-excel',
            'config' => [
                'worksheet' => 'ExportWorksheet',
                'cssFile' => ''
            ]
        ],
    ],

    // 'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],

        'columns' => $gridColumns
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
<br style="clear:both">


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