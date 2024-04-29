<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Building Items</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($buildingType, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-10 offset-2">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Building Type<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('building_item_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select Building type', 'options' => $buildingItemTypes]); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Item Code<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-6">
                                        <?php echo $this->Form->control('item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Item Code', 'minlength' => 1, 'maxlength' => 10, 'onchange' => 'calling(this.value)']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Item Description<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-6">
                                        <?php echo $this->Form->control('item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'rows' => 3, 'label' => false, 'error' => false, 'placeholder' => 'Item Description']); ?>
                                    </div>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="control-label col-md-4">Unit<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select Unit', 'options' => $units]); ?>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                                <div class="offset-md-5 col-md-10">
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                    <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default"  onclick="this.form.reset();">Cancel</button>
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
                'item_code': {
                    required: true
                },
                'building_item_type_id': {
                    required: true
                },
                'item_description': {
                    required: true
                }
            },

            messages: {
                'item_code': {
                    required: "Enter Item Code"
                },
                'building_item_type_id': {
                    required: "Select Building Type"
                },
                'item_description': {
                    required: "Enter Item Description"
                }
            },
            submitHandler: function(form) {
                form.submit();
                $(".btn").prop('disabled', true);
            }
        });

        function calling(id) {

            // alert(month);
            //alert(id);

            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/NewBuildingItems/ajaxbuildingitems/' + id,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    //alert(data);
                    if (data == 1) {
                        alert('Item Code is already present');
                        $('#item-code').val('').trigger('change');


                    }
                    //alert(data);
                }
            });
        }
    </script>