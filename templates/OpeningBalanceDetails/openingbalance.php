<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add PD Account Balance</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($openingBalanceDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

                <div class="col-md-10 offset-2">
                    <?php //if ($role_id == 4) { ?>
                        <div class="form-body row">
                            <?php if ($openingBalanceDetails == 0) { ?>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">PD Account Balance<span class=" required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <?php echo $this->Form->control('opening_balance', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false,'min'=>1,'maxlength'=>13, 'error' => false, 'placeholder' => 'Opening Balance', 'required']); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php } elseif ($openingBalanceDetails > 0) { ?>

                                <div class="col-md-12">

                                    <div class="form-group row">
                                        <label class="control-label col-md-4">PD Account Balance<span class=" required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <?php echo $this->Form->control('opening_balance', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $balanceDetail->opening_balance, 'required']); ?>
                                            <?php echo $this->Form->control('id', ['type' => 'hidden', 'templates' => ['inputContainer' => '{{content}}'], 'value' => $balanceDetail->id, 'required']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
                'opening_balance': {
                    required: true
                }

            },

            messages: {
                'opening_balance': {
                    required: "Enter Opening Balance"
                }
            },
            submitHandler: function(form) {
                form.submit();
                $(".btn").prop('disabled', true);
            }
        });
    </script>