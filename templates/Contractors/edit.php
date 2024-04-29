<style>
    textarea {
        resize: none;
    }
</style>


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
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required', 'type' => 'textarea', 'rows' => 3]); ?>
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
                                <label class="control-label col-md-2">Mobile No 2</label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('mobile_no2', ['class' => 'form-control num', 'maxlength' => 10, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Mobile Number2', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Email</label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('email', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'placeholder' => 'Email', 'error' => false]); ?>
                                </div>
                                <label class="control-label col-md-2">GST No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('gst_no', ['class' => 'form-control', 'maxlength' => 15, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'GST Number', 'required','onblur' => 'gstcal(this.value)']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Registration No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('registration_no', ['class' => 'form-control', 'maxlength' => 15, 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'placeholder' => 'Registration number', 'error' => false, 'required', 'readonly']); ?>
                                </div>
                                <label class="control-label col-md-2">File no<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('file_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'placeholder' => 'Enter File No']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Register Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('register_date1', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select Registration date', 'value' => date('d-m-Y', strtotime($contractor_detail['register_date']))]);
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Validity upto<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('validity_upto1', ['class' => 'form-control datepickerfuture', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select validity date', 'value' => date('d-m-Y', strtotime($contractor_detail['validity_upto']))]);
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
                                <label class="control-label col-md-2">Address<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('address', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'textarea', 'rows' => 3, 'label' => false, 'error' => false, 'placeholder' => 'Address', 'required']); ?>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="control-label col-md-2">Class Level<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('contractor_class_level_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $contractor_levels, 'label' => false, 'error' => false, 'empty' => 'Select Contractor Class Level', 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">Contractor Type<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('contractor_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $contractor_types, 'label' => false, 'error' => false, 'empty' => 'Select Contractor Type', 'required']); ?>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="control-label col-md-2">Registered Department<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('contractor_registered_department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $contractor_reg_depart, 'label' => false, 'error' => false, 'empty' => 'Select Registered Department', 'required']); ?>
                                </div>
                               <label class="control-label col-md-2">Renewal Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
									<?php echo $this->Form->control('renewal_date1', ['class' => 'form-control datepickerfuture', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'empty' => 'Select Renewal date', 'value' => ($contractor_detail['renewal_date'])?date('d-m-Y', strtotime($contractor_detail['renewal_date'])):'']);
                                    ?> 
									</div>
                            </div>
							<div class="form-group row">
                                <label class="control-label col-md-2">Registration No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('registration_no', ['class' => 'form-control', 'maxlength' => 100, 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'placeholder' => 'Registration number', 'error' => false, 'required']); ?>
                                </div>                                
                            </div>
							<div class="form-group row">                               
                                <label class="control-label col-md-2">Remarks<span class=" required"> 
                                    </span></label>
                                <div class="col-md-10">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false,'type'=>'textarea','rows'=>3, 'placeholder' => 'Enter Remarks']); ?>
                                </div>
                            </div>				
                        </div>

                        <div class="form-group text-center" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="col-md-12">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20 sub">Submit</button>
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
    // $('.datepicker3').flatpickr({
        // dateFormat: "d-m-Y",
        // allowInput: false
    // });
	
    function gstcal(gstno) {
        $( ".sub" ).prop( "disabled", false );
        var gstno;

        var id = <?php echo $id; ?>;
        if (gstno) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/Contractors/ajaxgst/' + gstno + '/' + id,
                success: function(data, textStatus) {
                    //alert(data);
                    if (data == 1) {
                        $('#gst-no').val('');
                        $( ".sub" ).prop( "disabled", true );
                        alert("GST No already exist");


                    }
                }
            });
        }
    }
	
    $("#FormID").validate({
        rules: {
            'name': {
                required: true
            },
            'contractor_class_id': {
                required: true
            },
            'mobile_no': {
                required: true,
                minlength: 10,
                maxlength: 10,
                min: "6000000000",
                number: true
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
                required:   <?php if ($contractor['certificate_upload'] != '') { ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php } ?>
            },
            'contractor_class_level_id': {
                required: true
            },
            'contractor_type_id': {
                required: true
            },
            'contractor_registered_department_id': {
                required: true
            },
            'renewal_date': {
                required: true
            },
            'registration_no': {
                required: true
            },
            'remarks': {
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
                required: "Enter Mobile Number",
                minlength: "Enter 10-Digit Mobile Number",
                maxlength: "Enter 10-Digit Mobile Number",
                min: "Enter Valid Mobile Number",
                number: "Enter Valid Mobile Number"
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
                required: "Select Registration Date"
            },
            'validity_upto': {
                required: "Select Validity Date"
            },
            'certificate_upload': {
                required: "Select Certificate upload"
            },
            'contractor_class_level_id': {
                required: "Select Contractor Class Level"
            },
            'contractor_type_id': {
                required: "Select Contractor Type"
            },
            'contractor_registered_department_id': {
                required: "Select Registered Department"
            },
            'renewal_date': {
                required: "Select Renewal Date"
            },
            'registration_no': {
                required: "Enter Registration No."
            },
            'remarks': {
                required: "Enter Remarks"
            }


        },
        submitHandler: function(form) {

            var gstNumber = document.getElementById("gst-no").value;
            var expr = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            if (!expr.test(gstNumber)) {
                $('#gst-no').val('');
                alert('Invalid GST Number.');
            } else {
                form.submit();
                $(".btn").prop('disabled', true);
            }
        }
    });

   
</script>
