<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use yii\widgets\Pjax;
?>
<style>
.paidmethod{
    color:#000000;
    font-weight:bold;
    text-align:right
}
._number{
    text-align:right
}
th{
    text-align:center;
    font-weight:bold
}
.edit-money-icon{
    font-size:14px;
    border:1px solid red;
    border-radius:5px 5px;
    color:red;
    margin-left:5px;
    cursor: pointer;
}
</style>
 <h3>
    ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  

    <?=\app\models\Instalment::date_of_instalment($models[0]['create_date']);?> 
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
            'value' =>  'houses.house_name',
            'group'=>true,  // enable grouping
            'subGroupOf'=>1 
        ],
        [
            'attribute' => 'workGroup',
            'value' => 'workGroup.wg_name',
            'group'=>true,  // enable grouping
            'subGroupOf'=>2 
        ],
        [
            'attribute' => 'work',
            'value' => 'workOne.work_name',
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
            'hAlign' => 'right', 
            'group'=>true,  // enable grouping
            'subGroupOf'=>4,

            'value' => 'workOne.work_control_statement',
            'pageSummary'=>true,
        ],
        [
            'attribute' => 'amount',
            'format' => ['decimal', 2],
            'hAlign' => 'right', 
            'value' => 'amount',
            'pageSummary'=>true,
        ],
        'comment',
        [
            'attribute' => '',
            'format' => 'raw',
            'hAlign' => 'right', 
            'value' => function($model){
                return '<i class="material-icons edit-money-icon" 
                value="'.\yii\helpers\Url::to(['employee/instalment/change-money-value', 
                'id'=>$model['id']]).'">create</i>';
            },

        ],

    
    ];

    // echo ExportMenu::widget([
    //     'dataProvider' => $dataProvider,
    //     'columns' => $gridColumns,
    //     'fontAwesome' => true,
    //     'dropdownOptions' => [
    //         'label' => 'Export',
    //         'class' => 'btn btn-info'
    //     ],
    //     'exportConfig' => [
    //         ExportMenu::FORMAT_TEXT => false,
    //         ExportMenu::FORMAT_CSV => false,
    //         ExportMenu::FORMAT_EXCEL => false,
    //         ExportMenu::FORMAT_HTML => false,
            
    //     ]
    // ]) . "<hr>\n".
    
    
    echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'toolbar' =>  [
        '{toggleData}',

        ['content' => 
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
                'showColumnSelector' =>true,
                'dropdownOptions' => [
                    'label' => 'Export',
                    'class' => 'btn btn-info'
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_CSV => false,
                    ExportMenu::FORMAT_EXCEL => false,
                    ExportMenu::FORMAT_HTML => false,                    
                ]
            ])
        ],
        
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true,
    ],


    'pjax' => true, // pjax is set to always true for this demo
    'showPageSummary'=>true,
    'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            // 'heading' => 'ddd',
        ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],

    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],

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
<!-- <button class="btn btn-info btn-raised pull-right" id="printbtn">Print</button> -->
<br style="clear:both">


<?php
// Form::print_array($models);
$this->registerJs("
 $('.edit-money-icon').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
$('#printbtn').click(function(){
    var printContents = document.getElementById('print').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

})
    
", $this::POS_READY); 
?>