<?php
use kartik\widgets\Select2;
?>
<style>
    .card-stats .card-content{
        text-align:left !important
    }
    .text-alert{
        color:green
    }
    #w_paid{
        color:red
    }
</style>
<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>
<div class="card card-stats" style="background-color:#EAF7FB; border-radius:10px 10px">
    <div class="card-header" data-background-color="blue">
        <i class="material-icons">store</i>
    </div>
    <div class="card-content">
        <p class="category">Revenue</p>
        <h3 class="title">
            <?=$title;?>
        </h3>
        <div class="row">
            <div class="col-md-3 col-xs-12"  style="background:#FFFFFF;padding:10px; border-radius:10px">
                    <?= $form->field($model, 'contructor_id')->widget(Select2::classname(), [
                        'data' => $instructor,
                        'options' => ['placeholder' => 'เลือก...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('เลือกช่าง'); ?>
                <div class="row">
                    <div class="col-md-6 colxs12">
                    <?= $form->field($model, 'house_id')->widget(Select2::classname(), [
                                'data' => $houses,
                                'options' => ['placeholder' => 'เลือก...', 'class=' => 'div_disable'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('แปลงบ้าน'); ?>
                    </div>
                    <div class="col-md-6 colxs12">
                        <div class="form-group">
                            <label class="control-label">งวดที่</label>
                            <input type="text" value="<?=$inst;?>" class="form-control" readonly="readonly">
                            <?= $form->field($model, 'instalment_id')->hiddenInput(['value' => $instalment['id']])->label(false) ?>
                        </div>
                    </div>
                </div>
                  
                       
                            <?= $form->field($model, 'money_type_id')->dropDownList($moneyType,[
                                'prompt' => 'เลือก...'])->label('ประเภทงวดที่จ่าย'); ?>
                    
                      
            </div>
            <div class="col-md-9 col-xs-12" style="padding-left:10px; border-radius:10px;">
                <div id="activity">
                    
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <?= $form->field($model, 'workclassify_id')->dropDownList($workClassify,[
                        'prompt' => 'เลือก...'])->label('หมวดงาน'); ?>
                        </div>
                        <div class="col-md-4 col-xs-12 form-group">
                            <label class="control-label ">กลุ่มงาน</label>
                            <select id="instalmentcostdetails-worktype_id" name="Instalmentcostdetails[worktype_id]" class="form-control"></select>
                        </div>
                        <div class="col-md-4 col-xs-12 form-group">
                            <label class="control-label ">งาน</label>
                            <select id="instalmentcostdetails-work_id" name="Instalmentcostdetails[work_id]" class="form-control"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <?= $form->field($model, 'amount')->textInput()->label('จำนวนจ่าย');?>
                        </div>
                        <div class="col-md-3 col-xs-12 form-group">
                            <label class="control-label">งบควบคุม</label>
                            <input type="text" value="" class="form-control" id="w_controlstatement" name="w_controlstatement" readonly="readonly">
                        </div>
                        <div class="col-md-3 col-xs-12 form-group">
                            <label class="control-label">เบิกจ่ายแล้ว</label>
                            <input type="text" value="" class="form-control" id="w_paid" name="w_paid" readonly="readonly">
                        </div>
                        <div class="col-md-3 col-xs-12 form-group">
                            <label class="control-label">เหลือที่เบิกจ่ายได้</label>
                            <input type="text" value="" class="form-control text-alert" id="w_remain" name="w_remain" readonly="readonly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-xs-12">
                            <?= $form->field($model, 'comment')->textArea(['rows' => 1])->label('หมายเหตุ');?>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <input type="hidden" name="hidden" value="addlists">
                            <button type="submit" class="btn btn-round btn-success submit">เพิ่มรายการ</button>
                        
                        </div>
                    </div>
                </div> <!-- activity -->

                <div id="loan_div" style="display:none">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">จำนวนเงินกู้ยืม</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12- col-md-4">
                                        <input type="text" name="deduction[loan_deduction][amount]" 
                                            id="loan_deduction_money" class="form-control" required>
                                        <input type="hidden" name="deduction[loan_deduction][type]" value="3">
                                    </div>
                                    <div class="col-md-10 col-xs-12">
                            <?= $form->field($model, 'comment')->textArea(['rows' => 1])->label('หมายเหตุ');?>
                        </div>
                                    
                                    <div class="col-md-3 col-xs-12">
                                        <input type="hidden" name="hidden" value="addlists">
                                        <button type="submit" class="btn btn-round btn-success submit">เพิ่มรายการ</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                </div><!-- loan-div -->


                <div id="equipment_div" style="display:none">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">จำนวนเงินค่าเครื่องมือช่าง</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" name="deduction[equipment_deduction][amount]" 
                                                id="equipment_deduction_money" class="form-control" required>
                                        
                                        <input type="hidden" name="deduction[equipment_deduction][type]" value="4">
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <input type="hidden" name="hidden" value="addlists">
                                        <button type="submit" class="btn btn-round btn-success submit">เพิ่มรายการ</button>
                                    
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                </div><!-- equipment_div -->
               

            </div><!-- col-md-9 -->
        </div>
       
        
    </div><!-- card content -->

</div>
<?php yii\widgets\Pjax::end() ?>  