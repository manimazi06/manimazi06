<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add User</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($user, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data',]); ?>
                <div class="col-md-11">
                    <div class="form-body row">
					    <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Role<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('role_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $roles, 'label' => false, 'error' => false, 'empty' => 'Select roles', 'required']); ?>

                                    <!-- <?php echo $this->Form->control('role_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => '', 'required', 'options' => $roles]); ?> -->
                                </div>
                                  <label class="control-label col-md-2">Email<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('email', ['class' => 'form-control email', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Email', 'required']); ?>
                                </div>                             
                            </div>
							 <!--div class="form-group row">                          

                                <label class="control-label col-md-2">District<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select districts', 'required']); ?>

                                </div>
								 <label class="control-label col-md-2">Division</label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => true, 'id' => 'division', 'empty' => 'select', 'readonly']); ?>
                                </div>								
                            </div-->
							<div class="form-group row">                       

                                <label class="control-label col-md-2 ae" <?php if(in_array($user->role_id,array(1,3,4,5,6,7))){   ?>  style="display:none;" <?php  } ?>>District<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4 ae"  <?php if(in_array($user->role_id,array(1,3,4,5,6,7))){   ?>  style="display:none;" <?php } ?>>
                                    <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select districts', 'required']); ?>

                                </div>
								 <label class="control-label col-md-2 ae ee aee" <?php if(in_array($user->role_id,array(1,5,6,7))){   ?> style="display:none;" <?php  } ?>> Division</label>
                                <div class="col-md-4 ae ee aee" <?php if(in_array($user->role_id,array(1,5,6,7))){   ?> style="display:none;" <?php } ?>>
                                    <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => true, 'empty' => 'Select Division']); ?>
                                </div>								
                            </div>							
							 <div class="form-group row">                        

                                <label class="control-label col-md-2 ae ee aee se" <?php if(in_array($user->role_id,array(1,6,7))){   ?> style="display:none;" <?php  } ?>>Circle<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4 ae ee aee se" <?php if(in_array($user->role_id,array(1,6,7))){   ?> style="display:none;" <?php  } ?>>
                                    <?php echo $this->Form->control('circle_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => false, 'empty' => 'Circle', 'required', 'readonly']); ?>
                                </div>							
								
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">User Name<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('username1', ['class' => 'form-control', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Username','value' => $user->username, 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">Name<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control name titleCase', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                               
                                <label class="control-label col-md-2">Mobile No<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('mobile_no', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Mobile', 'required']); ?>
                                </div>
								<label class="control-label col-md-2">Address<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('address', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'],'type'=>'textarea','rows'=>3, 'label' => false, 'error' => false, 'placeholder' => 'Address', 'required']); ?>
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
        $('#district-id').on('change', function() {
            var distID = $(this).val();
            
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