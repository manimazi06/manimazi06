<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Financialyearwise Material Cost Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($financialyearwiseMaterialCostSubdetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-11">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Financial Year<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'options' => $financial_year, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">Building Material<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('building_material_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $building, 'empty' => 'Select Building Material', 'required']) ?>
                                </div>

                            </div>
                            <div class="form-group row ">
                                <label class="control-label col-md-2">Units<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $units, 'empty' => 'Select units', 'required']) ?>
                                </div>
                                <label class="control-label col-md-2">Rate<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate', 'required']) ?>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-2">Submit Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('submit_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select submit date', 'required']) ?>
                                </div>
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
<script>
    $("#FormID").validate({
        rules: {
            'name': {
                required: true
            },
            'division_id': {
                required: true
            }
        },

        messages: {
            'name': {
                required: "Enter Name"
            },
            'division_id': {
                required: "Select division"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function calling(id) {
        alert(id);
        // $("th").hide();
        var count;
        //alert(count);

        if (id == 1) {

            $(".yes").show();
            // $(".yes").val('');

            //alert('Enter request amount and select date');
        } else if (id == 2) {
            $('#received-date').val('');
            $('#received-amount').val('');
            $(".yes").hide();
            $(".yes").val('');
            // alert('amount selected as No');

        }


    }
</script>