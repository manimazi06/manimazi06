<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>License Renewal Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($licenseRenewalDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <div class="col-md-12">



                            <div class="form-group row">
                                <label class="control-label col-md-2">License Renewal Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('license_renewal_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select Renewal date', 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">License Validity upto<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('license_validity_upto', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select Renewal validity date', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Renewal File Upload<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('license_file_upload', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'file',  'label' => false, 'error' => false,  'required']); ?>
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="col-md-12">
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
            'license_renewal_date': {
                required: true
            },
            'license_validity_upto': {
                required: true
            },
            '	license_file_upload': {
                required: true
            }

        },

        messages: {
            'license_renewal_date': {
                required: "Select License renewal date"
            },
            'license_validity_upto': {
                required: "Select Renewal/license validity upto"
            },
            'license_file_upload': {
                required: "Select Renewal file"
            }

        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });
</script>