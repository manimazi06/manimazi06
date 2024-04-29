<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Building Item</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($buildingItem, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Item Code<span class=" required"> *
                                    </span></label>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Item Code', 'onblur' => 'code(this.value)', 'required']); ?>
                                </div>
                            </div>
                      
                        <div class="form-group row">
                            <label class="control-label col-md-2">Item Description<span class=" required">*
                                </span></label>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'],  'label' => false, 'error' => false, 'placeholder' => 'Item Decription', 'rows' =>5, 'required']); ?>
                            </div>

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
            'item_code': {
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
            'item_description': {
                required: "Enter Item Desription"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
	
	 function code(code) {
        var code;
        var id = 0;
        if (code) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/BuildingItems/ajaxcode/' + code + '/'+id,
                success: function(data, textStatus) {
                    // alert(data);
                    if (data == 1) {
						$('#item-code').val('');
                        alert('This Item Code already exists');
                        $(".btn").prop('disabled', true);

                    }else{
                        $(".btn").prop('disabled', false);

                    }
                }
            });
        }
    }
</script>