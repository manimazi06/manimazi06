<!-- <div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                echo $this->Form->control('role_id', ['options' => $roles]);
                echo $this->Form->control('username');
                echo $this->Form->control('password');
                echo $this->Form->control('name');
                echo $this->Form->control('mobile_no');
                echo $this->Form->control('email');
                echo $this->Form->control('address');
                echo $this->Form->control('is_active');
                echo $this->Form->control('created_on');
                echo $this->Form->control('created_by');
                echo $this->Form->control('modified_on');
                echo $this->Form->control('modified_by');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit User</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($user, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
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
                                    <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select districts', 'required']); ?>
                                    <!-- <?php echo $this->Form->control('district_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => '', 'required', 'options' => $districts]); ?> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">User Name<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('username', ['class' => 'form-control name titleCase', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Username', 'required']); ?>
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
            'username': {
                required: true
            },
            'password': {
                required: true
            },
            'name': {
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
        },

        messages: {
            'username': {
                required: "Enter Username"
            },
            'password': {
                required: "Enter Username"
            },
            'name': {
                required: "Enter Name"
            },
            'mobile_no': {
                required: "Enter Mobile"
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
</script>