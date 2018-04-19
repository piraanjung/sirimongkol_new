<div id="equipment_div">
<?php
    $title ='หัก ค่าเครื่องมือ';
    $subtitle = "";
    $a_text = "";
    $action= "";
    $btn_color = "btn-info";
    $display = false;
    \app\models\Methods::card_header($title, $subtitle, $a_text, $action, $btn_color, $display); 
?>
    <div class="col-md-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                            <input type="text" name="deduction[equipment_deduction][amount]" id="equipment_deduction_money" class="form-control">
                            </div>
                            <div class="col-md-4">บาท</div>
                        </div>
                        
                        
                        <input type="hidden" name="deduction[equipment_deduction][type]" value="4">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <?=\app\models\Methods::card_footer();?>
</div>