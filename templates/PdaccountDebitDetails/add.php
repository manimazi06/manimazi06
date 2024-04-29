<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add PD Account Debit Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($pdaccountDebitDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-11">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Fund Debit date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('fund_debit_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select date', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Debit Amount<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('fund_debit_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Debit Amount', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Remarks<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control','type'=>'textarea','rows'=>3, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Remarks', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$("#FormID").validate({
    rules: {
        'fund_debit_date': {
            required: true
        },
        'fund_debit_amount	': {
            required: true
        },
        'remarks': {
            required: true
        }
    },

    messages: {
        'fund_debit_date': {
            required: "Select Fund Debit date"
        },
        'fund_debit_amount': {
            required: "Enter Fund Debit Amount	"
        },
        'remarks': {
            required: "Enter Remarks"
        }
    },
    submitHandler: function(form) {
        form.submit();
        $(".btn").prop('disabled', true);
    }
});
</script>