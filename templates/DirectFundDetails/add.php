<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Direct fund details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($department, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-11">
                    <div class="form-body row">
					     <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Project<span class=" required"> *
                                    </span></label>
                                <div class="col-md-9">
									<?php echo $this->Form->control('project_work_subdetail_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $project_list, 'label' => false, 'error' => false, 'empty' => '-Select-']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Fund received date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-9">
                                    <?php echo $this->Form->control('fund_received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select date', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Cheque No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-9">
                                    <?php echo $this->Form->control('cheque_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Cheque No', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Amount<span class=" required"> *
                                    </span></label>
                                <div class="col-md-9">
                                    <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount', 'required']); ?>
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
        'fund_received_date': {
            required: true
        },
        'amount': {
            required: true
        },
        'cheque_no': {
            required: true
        }
    },

    messages: {
        'fund_received_date': {
            required: "Select Fund received date"
        },
        'amount': {
            required: "Enter Amount"
        },
        'cheque_no': {
            required: "Enter Cheque no."
        }
    },
    submitHandler: function(form) {
        form.submit();
        $(".btn").prop('disabled', true);
    }
});
</script>