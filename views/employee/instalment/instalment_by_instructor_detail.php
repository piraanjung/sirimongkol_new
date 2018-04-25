<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\Form;
use yii\widgets\ActiveForm;
$this->title = 'สรุปข้อมูลการจ่ายงวด';
$this->params['breadcrumbs'][] = ['label' => 'งวดจ่ายเงิน', 'url' => ['employee/instalment/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php if(!empty($models)){ ?>
    <?php
        $title = $this->title;
        $subtitle = 'รายการการเบิกจ่ายเงินงวดงาน';
        $a_text = "สร้างงวดเบิกจ่าย";
        $action= "create";
        $btn_color = "btn-info";
        $display = false;
        \app\models\Methods::card_header($title,  $subtitle, $a_text, $action, $btn_color, $display); 
    ?>
        <div class="box box-success">
            <div class="box-body">
                <div class="tab-content">
                    <div class="card card-nav-tabs">
                        <div class="card-header" data-background-color="blue">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Tasks:</span>
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="active">
                                            <a href="#instructors" data-toggle="tab">
                                                <i class="material-icons">supervisor_account</i> ผู้รับเหมา
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                    
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="material-icons">code</i>สรุปการวิธีจ่ายเงินให้ช่าง
                                                <!-- <span class="notification">5</span> -->
                                                <p class="hidden-lg hidden-md">Notifications</p>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="#paidcash" data-toggle="tab">จ่ายเงินสด</a>
                                                </li>
                                                <li>
                                                    <a href="#transferbank"  data-toggle="tab">โอนเงินผ่านธนาคาร</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="material-icons">compare_arrows</i>สรุปการโอนเงินแต่ละธนาคาร
                                                <!-- <span class="notification">5</span> -->
                                                <p class="hidden-lg hidden-md">Notifications</p>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="#allbanks" data-toggle="tab">สรุปการโอนเงินผ่านบัญชีธนาคาร</a>
                                                </li>
                                                <li>
                                                    <a href="#bbl" data-toggle="tab">ธนาคารกรุงเทพ</a>
                                                </li>
                                                <li>
                                                    <a href="#ktb" data-toggle="tab">ธนาคารกรุงไทย</a>
                                                </li>
                                                <li>
                                                    <a href="#kb" data-toggle="tab">ธนาคารกสิกรไทย</a>
                                                </li>
                                                <li>
                                                    <a href="#scb" data-toggle="tab">ธนาคารไทยพาณิชย์</a>
                                                </li>
                                                <li>
                                                    <a href="#tmb" data-toggle="tab">ธนาคารทหารไทย</a>
                                                </li>
                                                <li>
                                                    <a href="#gsb" data-toggle="tab">ธนาคารออมสิน</a>
                                                </li>
                                                <li>
                                                    <a href="#bay" data-toggle="tab">ธนาคารกรุงศรีอยุธยา</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="tab-content">
                                <div class="tab-pane active" id="instructors">
                                    <?=$this->render("_instalmentdetails_by_constructors.php",[
                                        'models' => $models,
                                        'editable' => 0,
                                        'searchModel' => $searchModel,
                                        'dataProvider' => $dataProvider,
                                    ]);?>
                                </div>

                                 <div id="paidcash" class="tab-pane">
                                    <button class="btn btn-info btn-raised pull-right" id="paidcashbtn">Print</button>
                                    <div id="_paidcash">
                                        <?=$this->render("paidbycash",[
                                                'paidbycashs' => $paidbycash
                                        ]);?>
                                    </div>
                                </div>

                                <div id="transferbank" class="tab-pane">
                                    <button class="btn btn-info btn-raised pull-right" id="transferbankbtn">Print</button>
                                    <div id="_paidbank">
                                        <?=$this->render("paidbybank",[
                                            'paidbybanks' => $paidbybanks
                                        ]);?>
                                    </div>
                                </div>

                                <div id="allbanks" class="tab-pane">
                                    <?=$this->render("_banksumary",[
                                            'allbanks'=>['
                                                bkb' =>['data'=>$bkb, 'name' => 'กรุงเทพ'],
                                                'ktb' =>['data'=>$ktb, 'name' => 'กรุงไทย'],
                                                'kb'  =>['data'=>$kb, 'name' => 'กสิกรไทย'],
                                                'scb' =>['data'=>$scb, 'name' => 'ไทยพาณิชย์'],
                                                'tmb' => ['data'=>$tmb, 'name' => 'ทหารไทย'],
                                                'gsb' => ['data'=>$gsb, 'name' => 'ออมสิน'],
                                                'ksb' => ['data'=>$ksb, 'name' => 'กรุงศรีอยุทธยา'],
                                            ]

                                    ]);?>
                                </div>

                                <div id="bbl" class="tab-pane">
                                    <?=$this->render("banksummary",[
                                            'bank' => $bkb,
                                            'bankname' => 'ธนาคารกรุงเทพ',
                                            'bankname_eng'=> 'bkb'
                                    ]);?>
                                </div>
                                <div id="ktb" class="tab-pane">
                                    <?=$this->render("banksummary",[
                                            'bank' => $ktb,
                                            'bankname' => 'ธนาคารกรุงไทย',
                                            'bankname_eng' => 'ktb'
                                    ]);?>
                                </div>
                                <div id="kb" class="tab-pane fade">
                                    <?=$this->render("banksummary",[
                                            'bank' => $kb,
                                            'bankname' => 'ธนาคารกสิกรไทย',
                                            'bankname_eng' => 'kb'
                                        ]);?>
                                </div>
                                <div id="scb" class="tab-pane">
                                    <?=$this->render("banksummary",[
                                            'bank' => $scb,
                                            'bankname' => 'ธนาคารไทยพาณิชย์',
                                            'bankname_eng' => 'scb'
                                        ]);?>
                                </div>
                                <div id="tmb" class="tab-pane">
                                    <?=$this->render("banksummary",[
                                            'bank' => $tmb,
                                            'bankname' => 'ธนาคารทหารไทย',
                                            'bankname_eng' => 'tmb'
                                        ]);?>
                                </div>
                                <div id="gsb" class="tab-pane">
                                    <?=$this->render("banksummary",[
                                            'bank' => $gsb,
                                            'bankname' => 'ธนาคารออมสิน',
                                            'bankname_eng' => 'gsb'
                                        ]);?>
                                </div>
                                <div id="bay" class="tab-pane">
                                    <?=$this->render("banksummary",[
                                            'bank' => $ksb,
                                            'bankname' => 'ธนาคารกรุงศรีอยุธยา',
                                            'bankname_eng' => 'bay'
                                        ]);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=\app\models\Methods::card_footer();?>
 <?php } else{
    $alert_title = $this->title;
    $alert_subtitle = 'แสดงรายงานสรุปการเบิกจ่ายเงินงวดงานให้กับช่างหรือผู้รับเหมา';
    $alert_content = 'ยังไม่มีข้อมูลการเบิกจ่ายงวด'; 
    $alert_bgcolor = 'orange';
    \app\models\Methods::alert_card($alert_title ,$alert_subtitle,$alert_content, $alert_bgcolor);
}
?>
            <?php
// Form::print_array($models);
$this->registerJs("
    $('.paymethod').click(function(){
        id = $(this).attr('id')

        $('#paymethod'+id).toggle('fadein')
    })

    $('#paidcashbtn').click(function(){
        _print('_paidcash')
    })
    $('#transferbankbtn').click(function(){
        _print('_paidbybank')
    })
    
    function _print(div){
        var printContents = document.getElementById(div).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }




    
", $this::POS_READY); 
?>