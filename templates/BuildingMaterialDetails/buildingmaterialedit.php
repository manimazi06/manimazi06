<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit Building Material Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($buildingMaterialDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-11 offset-1">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->

                        <?php if ($buildingMaterialcount > 0) { ?>
                            <div class="form-group row">


                                <label class="control-label col-md-2">Material Type<span class=" required"> &nbsp; :
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo  $building['building_material']['name']; ?>
                                   
                                </div>


                            </div>
                            <!-- </div> -->
                            <div class="form-group">
                                <fieldset>
								   <div align="right" style="margin-right:100px;">
                                    <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button><br><br>
                                   </div>
								   <table class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">S.no</th>
                                                <th style="width:10%">Material Sub Type</th>
                                                <th style="width:10%">Quantity</th>
                                                <th style="width:10%">Units</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="adding">
                                            <?php $i = 0;
                                            foreach ($buildingdetails as $buildingMaterialDetail) : ?>
                                                <tr class="present_row_in_post">
                                                    <td class="trcount"><?php echo  $i + 1; ?></td>
                                                    <td>
                                                        <?php echo $this->Form->control('building.' . $i . '.building_submaterial_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $buildingSubmaterials, 'value' => $buildingMaterialDetail['building_submaterial_id'], 'empty' => 'Select Building Material', 'required']) ?>
                                                        <?php echo $this->Form->control('building.' . $i . '.id', ['type' => 'hidden', 'label' => false, 'error' => false, 'value' => $buildingMaterialDetail['id']]); ?>
                                                        <?php echo $this->Form->control('building.' . $i . '.building_material_id', ['type' => 'hidden', 'label' => false, 'error' => false, 'value' => $buildingMaterialDetail['building_material_id']]); ?>
                                                    </td>                                                   
                                                    <td>
                                                        <?php echo $this->Form->control('building.' . $i . '.quantity', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $buildingMaterialDetail['quantity'], 'placeholder' => 'Enter Quantitys', 'required']) ?>
                                                    </td>
													 <td>
                                                        <?php echo $this->Form->control('building.' . $i . '.unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $units, 'value' => $buildingMaterialDetail['unit_id'], 'empty' => 'Select units', 'required']) ?>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
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
    function pageadding() {
        var j = ($('.present_row_in_post').length);
        //alert(j);
        var row_no = j - 1;
        var submaterial_id = $("#building-" + row_no + "-building-submaterial-id").val();
        var unit = $("#building-" + row_no + "-unit-id").val();
        var quantity = $("#building-" + row_no + "-quantity").val();

        if (submaterial_id != '' && unit != '' && quantity != ''){
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/BuildingMaterialDetails/ajaxbuildingdetails/' +j,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    $('.adding').append(data);
                }
            });
        } else if (submaterial_id == '') {
            alert("Select Sub Type");
            $("#building-" + row_no + "-building-submaterial-id").focus();



        } else if (unit == '') {
            alert("Select Unit");
            $("#building-" + row_no + "-unit-id").focus();

        } else if (quantity = '') {
            alert("Enter Quantity");
            $("#building-" + row_no + "-quantity").focus();
        }
    }

    $("#FormID").validate({
        rules: {
            'building[0][building_submaterial_id]': {
                required: true
            },
            'building[0][submit_date]': {
                required: true
            },
            'building[0][building_material_id]': {
                required: true
            },
            'building[0][unit_id]': {
                required: true
            },
            'building[0][quantity]': {
                required: true
            }

        },

        messages: {
            'building[0][building_submaterial_id]': {
                required: "Select Sub-Material details"
            },
            'building[0][submit_date]': {
                required: "Select Date"
            },
            'building[0][building_material_id]': {
                required: "Select Building Material"
            },
            'building[0][unit_id]': {
                required: "Select Unit"
            },
            'building[0][quantity]': {
                required: "Enter Quantity"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    
</script>