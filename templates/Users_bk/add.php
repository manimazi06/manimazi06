<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add User</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($user, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data',]); ?>
                <div class="col-md-10 offset-2">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Role<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('role_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $roles, 'label' => false, 'error' => false, 'empty' => 'Select roles', 'required']); ?>

                                    <!-- <?php echo $this->Form->control('role_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => '', 'required', 'options' => $roles]); ?> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">District<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false,'id'=>'district', 'empty' => 'Select districts', 'required']); ?>
                                    <!-- <?php echo $this->Form->control('district_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => '', 'required', 'options' => $districts]); ?> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Division</label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => '', 'label' => false, 'error' => true, 'id' => 'division', 'empty' => 'Division', 'readonly']); ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">User Name<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('username1', ['class' => 'form-control name', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Username', 'value' => '', 'required']); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-4">Name<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control name titleCase', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Mobile No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('mobile_no', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Mobile', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Password<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('password1', ['class' => 'form-control', 'type' => 'password', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Password', 'require', 'value' => '']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Email<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('email', ['class' => 'form-control email', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Email', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Address<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('address', ['class' => 'form-control name titleCase', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Address', 'required']); ?>
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
            'role_id': {
                required: true
            },
            'district_id': {
                required: true
            },
            'username1': {
                required: true,
                minlength: 3
            },
            'password1': {
                required: true,
                minlength: 8,
                maxlength: 15
            },
            'name': {
                required: true
            },
            'mobile_no': {
                required: true,
                minlength: 8,
                maxlength: 10,
                min: "6000000000",
                number: true
            },
            'email': {
                required: true
            },
            'address': {
                required: true
            },
        },

        messages: {
            'role_id': {
                required: "Select Role"
            },
            'district_id': {
                required: "Select District"
            },
            'username1': {
                required: "Enter Username",
                minlength: "Enter a 3-charcters"
            },
            'password1': {
                required: "Enter Username",
                minlength: "Enter a 8-charcter Number",
                maxlength: "Enter a 15-charcter Number"
            },
            'name': {
                required: "Enter Name"
            },
            'mobile_no': {
                required: "Enter Mobile Number",
                minlength: "Enter a 10-Digit Mobile Number",
                maxlength: "Enter a 10-Digit Mobile Number",
                min: "Enter Vaild Mobile Number",
                number: "Enter Vaild Mobile Number"
            },
            'email': {
                required: "Enter Email"
            },
            'address': {
                required: "Enter Address"
            },
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
    $(document).ready(function() {
        $('#district').on('change', function() {
            // alert(distID);
            var distID = $(this).val();
            //  alert(distID);
            //var path = "<?php //echo $this->Url->webroot 
                            ?>/firstproject/Students/ajaxtaluks/" + distID;
            // alert(path);
            if (distID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc_staging/Users/ajaxdivisions/' + distID,
                    success: function(data, textStatus) {
                        // alert(data)
                        $('#division').html(data);
                    }
                });
            } else {
                $('#division').html('<option value="">Select division</option>');

            }
        });


    });
</script>