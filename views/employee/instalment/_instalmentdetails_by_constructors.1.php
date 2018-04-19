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

    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
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
    ]) . "<hr>\n".
    
    
    GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    'showPageSummary'=>true,
    'toolbar'=>[
        '{export}',
        '{toggleData}'
    ],
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

<div id="print">
    <h3>
    ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  

    <?=\app\models\Instalment::date_of_instalment($models[0]['create_date']);?> 
    (งวด <?=$models[0]['monthly']."/".$models[0]['instalment'].".".$models[0]['year']?>)
    </h3>
    <div class="tabel table-responsive">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อช่าง</th>   
                    <th>เลขแปลงบ้าน</th>
                    <th>รายละเอียดงาน</th>
                    <th>ลักษณะงาน</th>
                    <th>งบควบคุม</th>
                    <th>จำนวนเงิน</th>
                    <th>หมายเหตุ</th>
                </tr>
                
            </thead>
            <tbody>
                <?php 
                $curname = $models[0]['contructor_id'];
                $sum_by_payee=0;
                $i=0;
                $showname = 1;
                $total =0;
                foreach($models as $model){
                    if($curname != $model['contructor_id']  ){
                        echo "<tr class='payee_sum'>";
                        echo    "<td colspan='6'> รวม</td>";
                        echo    "<td class='_number'>".number_format($sum_by_payee,2)."</td>";
                        echo    "<td>
                                
                                </td>";
                        echo "</tr>";
                        
                        $curname = $model['contructor_id'];
                        $total+=$sum_by_payee;
                        $sum_by_payee =0;
                        $showname =1;
                ?>
            <tr>
                <td><?=++$i?></td>
                <td>
                    <?php 
                        $payee = app\models\Profile::find()
                            ->where(['user_id'=>$model['contructor_id']])->one();
                            if($showname ==1){
                                echo $payee['name'];
                                $showname =0;
                            }
                    ?>
                </td>   
                <td>
                    <?php
                        if($model['house_id']== 0){
                            echo " ";
                        }else{
                            $house =  \app\models\Houses::find()
                                ->select('house_name')
                                ->where(['id'=>$model['house_id']])->one(); 
                            echo $house['house_name'];
                        }
                    ?>
                </td>

                <td class="work_despt">
                    <?php 
                        $wc = \app\models\Works::find()->select('work_name, work_control_statement')
                            ->where(['id'=>$model['work_id']])->one();
                        echo $wc['work_name'];
                    ?>
                </td>
                <td>
                    <?php 
                        $mt = \app\models\MoneyType::find()
                            ->where(['id'=>$model['money_type_id']])->one();
                        echo $mt['name'];
                    ?>
                </td>
                <td class="_number">
                    <?=number_format($wc['work_control_statement'],2);?>
                </td>
                <td class="_number">
                    <?php 
                        if($editable == 1){
                            echo number_format($model['amount'],2).'<i class="material-icons edit-money-icon" 
                                value="'.\yii\helpers\Url::to(['employee/instalment/change-money-value', 
                                'id'=>$model['id']]).'">create</i>';
                         }else{
                             echo   number_format($model['amount'],2);
                         }
               
                        if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                            $sum_by_payee -= $model['amount'];
                        }else{
                            $sum_by_payee += $model['amount'];
                        }
                    ?>
                </td>
                <td><?=$model['comment'];?></td>
            </tr>
                <?php
                }else{
            ?>
                <tr>
                    <td><?=++$i?></td>
                    <td>
                        <?php 
                            $payee = app\models\Profile::find()
                                ->where(['user_id'=>$model['contructor_id']])->one();
                                if($showname ==1){
                                    echo $payee['name'];
                                    $showname =0;
                                }
                        ?>
                    </td>   
                    <td><?php
                            if($model['house_id']== 0){
                                echo " ";
                            }else{
                                $house =  \app\models\Houses::find()
                                    ->select('house_name')
                                    ->where(['id'=>$model['house_id']])->one(); 
                                echo $house['house_name'];
                            }
                           
                            ?>
                    </td>
                    <td class="work_despt">
                        <?php 
                            $wc = \app\models\Works::find()->select('work_name, work_control_statement')
                                ->where(['id'=>$model['work_id']])->one();
                            echo $wc['work_name'];
                        ?>
                    </td>
                    <td>
                        <?php 
                            $mt = \app\models\MoneyType::find()
                                ->where(['id'=>$model['money_type_id']])->one();
                            echo $mt['name'];
                        ?>
                    </td>
                    <td class="_number">
                        <?=number_format($wc['work_control_statement'],2);?>
                    </td>
                    <td class="_number">
                        <?php 
                            if($editable == 1){
                                echo number_format($model['amount'],2).'<i class="material-icons edit-money-icon" 
                                    value="'.\yii\helpers\Url::to(['employee/instalment/change-money-value', 
                                    'id'=>$model['id']]).'">create</i>';
                            }else{
                                echo   number_format($model['amount'],2);
                            }
                            if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                                $sum_by_payee -= $model['amount'];
                            }else{
                                $sum_by_payee += $model['amount'];
                            }
                        ?>
                    </td>
                    <td><?=$model['comment'];?></td>
                </tr>
            <?php
        
                 
                }//else
                if($i == count($models)){
                    echo "<tr class='payee_sum'>";
                    echo    "<td colspan='6'> รวม</td>";
                    echo    "<td class='_number'>".number_format($sum_by_payee,2)."</td>";
                    echo    "<td>

                            </td>";
                    echo "</tr>";

                    $total+=$sum_by_payee;
                    $sum_by_payee  =0;
                   // $curname = $model['contructor_id'];
                 }
            }
            ?>
            <tr class=_total>
                <td  colspan="6">รวมทั้งสิ้น</td>
                <td class="_number"><?=number_format($total,2);?></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

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