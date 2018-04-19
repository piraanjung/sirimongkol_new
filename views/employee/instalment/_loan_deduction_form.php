<div class="row">
    <!-- หัก เงินกู้ยืม / ค่าเครื่องมือ -->
    <div class="col-md-6 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
            <h3 class="box-title">หัก เงินกู้ยืม</h3>
            </div>
            <div class="box-body">
            <div class="row">
                <div class="col-xs-12- col-md-6">
                <input type="text" name="deduction[loan_deduction][amount]" 
                        id="loan_deduction_money" class="form-control">
                </div>
                <input type="hidden" name="deduction[loan_deduction][type]" value="3">
            </div>
            </div>
            <!-- /.box-body -->s
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
            <h3 class="box-title">หัก ค่าเครื่องมือ</h3>
            </div>
            <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                <input type="text" name="deduction[equipment_deduction][amount]" 
                        id="equipment_deduction_money" class="form-control">
                
                <input type="hidden" name="deduction[equipment_deduction][type]" value="4">
                </div>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?= $form->field($model, 'house_id')->hiddenInput(['value' => 0])->label(false) ?>
<?= $form->field($model, 'instalment_id')->hiddenInput(['value' => $instalment['id']])->label(false) ?>
<?= $form->field($model, 'workclassify_id')->hiddenInput(['value' => 0])->label(false) ?>
<input type="hidden" name="Laborcostdetails[workgroup]" value="0">   
<input type="hidden" name="Laborcostdetails[works]" value="0">   

