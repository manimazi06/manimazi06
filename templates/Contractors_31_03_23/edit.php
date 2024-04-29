<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit Contractors</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($contractor, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Contractor/Company Name<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required']); ?>
                                </div>


                                <label class="control-label col-md-2">Contractor Classes<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('contractor_class_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $contractorClass, 'label' => false, 'error' => false, 'empty' => 'Select Contractor Class', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Mobile No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('mobile_no', ['class' => 'form-control num', 'maxlength' => 10, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Mobile Number', 'required']); ?>
                                </div>


                                <label class="control-label col-md-2">Email<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('email', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'placeholder' => 'Email', 'error' => false, 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">GST No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('gst_no', ['class' => 'form-control', 'maxlength' => 15, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'GST Number', 'required']); ?>
                                </div>


                                <label class="control-label col-md-2">Registration No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('reg_no', ['class' => 'form-control', 'maxlength' => 15, 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'placeholder' => 'Registration number', 'error' => false, 'required']); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-2">Address<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('address', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'textarea', 'rows' => 3, 'label' => false, 'error' => false, 'placeholder' => 'Address', 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">Register Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('register_date1', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select Registration date', 'value' => date('d-m-Y', strtotime($contractor_detail['register_date']))]);
                                    // echo "<pre>";
                                    // print_r($contractor['register_date']);
                                    // exit();
                                    ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Certificate Upload<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('certificate_upload', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'file',  'label' => false, 'error' => false]); ?>
                                    <?php if ($contractor['certificate_upload'] != '') {  ?>
                                        <?php echo $this->Form->control('certificate_upload1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $contractor['certificate_upload']]); ?>
                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ContractorCertificate/' . $contractor['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                <ion-icon name="document-text-outline"></ion-icon>View
                                            </span>
                                        </a>
                                    <?php  } ?>
                                </div>
                                <label class="control-label col-md-2">Validity upto<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('validity_upto1', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select validity date', 'value' => date('d-m-Y', strtotime($contractor_detail['validity_upto']))]);

                                    // echo "<pre>";
                                    // print_r($contractor['validity_upto']);
                                    // exit(); 
                                    ?>
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
            'name': {
                required: true
            },
            'contractor_class_id': {
                required: true
            },
            'mobile_no': {
                required: true
            },
            'email': {
                required: true
            },
            'address': {
                required: true
            },
            'gst_no': {
                required: true
            },
            'reg_no': {
                required: true
            },
            'register_date': {
                required: true
            },
            'validity_upto': {
                required: true
            },
            'certificate_upload': {
                required: false
            }

        },

        messages: {
            'name': {
                required: "Enter Name"
            },
            'contractor_class_id': {
                required: "Select contractor class"
            },
            'mobile_no': {
                required: "Enter mobile no"
            },
            'email': {
                required: "Enter Email"
            },
            'address': {
                required: "Enter Address"
            },
            'gst_no': {
                required: "Enter Gst no"
            },
            'reg_no': {
                required: "Enter Registration no"
            },
            'register_date': {
                required: "Select Registration date"
            },
            'validity_upto': {
                required: "Select validity date"
            },
            'certificate_upload': {
                <?php if ($contractor['certificate_upload'] != '') { ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php } ?>
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