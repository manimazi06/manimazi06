<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Change Passworssd</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($role, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data','onSubmit'=>'return valid()']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Current Password<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('cpass', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">New Password<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('npass', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4"> Confirm Password<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('cfpass', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Name', 'required']); ?>
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
            }

        },

        messages: {
            'name': {
                required: "Enter Name"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function valid() {
        if (document.chngpwd.cpass.value == "") {
            alert("Current Password Filed is Empty !!");
            document.chngpwd.cpass.focus();
            return false;
        } else if (document.chngpwd.npass.value == "") {
            alert("New Password Filed is Empty !!");
            document.chngpwd.npass.focus();
            return false;
        } else if (document.chngpwd.cfpass.value == "") {
            alert("Confirm Password Filed is Empty !!");
            document.chngpwd.cfpass.focus();
            return false;
        } else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.chngpwd.cfpass.focus();
            return false;
        }
        return true;
    }
</script>