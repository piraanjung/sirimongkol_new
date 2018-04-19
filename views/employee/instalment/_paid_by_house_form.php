<div class="card card-stats" style="background-color:#EAF7FB; border-radius:10px 10px">
    <div class="card-header" data-background-color="blue">
        <i class="material-icons">store</i>
    </div>
    <div class="card-content">
        <p class="category">Revenue</p>
        <h3 class="title">
            <?=$title;?>
        </h3>
        <div class="row" >
            <div class="col-md-4 col-xs-12">

                <?= $form->field($model, 'house_id')->dropDownList($houses,[
                'prompt' => 'เลือก...'])->label('แปลงบ้าน'); ?>
            </div>

            <div class="col-md-4 col-xs-12">
                <?= $form->field($model, 'money_type_id')->dropDownList($moneyType,[
                    'prompt' => 'เลือก...'])->label('ประเภทงวดที่จ่าย'); ?>
            </div>

            <div class="col-md-4 col-xs-12">
                <div class="form-group">
                    <label class="control-label">งวดที่</label>
                    <input type="text" value="<?=$inst;?>" class="form-control" readonly="readonly">
                    <?= $form->field($model, 'instalment_id')->hiddenInput(['value' => $instalment['id']])->label(false) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-xs-12">
                <?= $form->field($model, 'workclassify_id')->dropDownList($workClassify,[
        'prompt' => 'เลือก...'])->label('หมวดงาน'); ?>
            </div>
            <div class="col-md-3 col-xs-12 form-group">
                <label class="control-label ">กลุ่มงาน</label>
                <select id="workgroup" name="Laborcostdetails[workgroup]" class="form-control"></select>
            </div>
            <div class="col-md-3 col-xs-12 form-group">
                <label class="control-label ">งาน</label>
                <select id="works" name="Laborcostdetails[works]" class="form-control"></select>
            </div>
            <div class="col-md-3 col-xs-12 form-group">
                <label class="control-label">งบควบคุม</label>
                <input type="text" value="" class="form-control" id="w_controlstatement" name="w_controlstatement" readonly="readonly">

            </div>


        </div>
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <?= $form->field($model, 'amount')->textInput()->label('จำนวนจ่าย');?>
            </div>
            <div class="col-md-9 col-xs-12">
                <?= $form->field($model, 'comment')->textArea(['rows' => 1])->label('หมายเหตุ');?>
            </div>
        </div>
    </div>

</div>