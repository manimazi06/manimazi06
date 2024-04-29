<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>View Building Material Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($buildingMaterialDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-11 offset-1">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->
                        <?php //if ($buildingMaterialcount) { 
                        ?>

                        <div class="form-group row">

                            <label class="control-label col-md-2">Material Type<span class=" required"> &nbsp;&nbsp;:
                                </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $buildingdetails[0]['building_material']['name']; ?>
                            </div>
                        </div>
                        <!-- </div>  -->
                        <div class="form-group">

                            <fieldset>
                                <!-- <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button><br><br> -->
                                <table class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 2%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:10%">Material (SubType)</th>
                                            <th style="width:10%">Quantity</th>
                                            <th style="width:10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
                                        <?php $sno = 1;
                                        foreach ($buildingdetails as $buildingdetail) : ?>
                                            <tr class="present_row_in_post">

                                                <td class="trcount"><?php echo $sno; ?></td>

                                                <td>
                                                    <?php echo $buildingdetail['building_submaterial']['name']; ?>

                                                </td>
												<td>
                                                    <?php echo $buildingdetail['quantity']; ?>

                                                </td>
                                                <td>
                                                    <?php echo $buildingdetail['unit']['name_code'];  ?>

                                                </td>                                   

                                            </tr>
                                        <?php
                                            $sno++;
                                        endforeach;
                                        ?>
                                    </tbody>

                                </table>
                            </fieldset>
                        </div>



                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">

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
        alert(j);
        var row_no = j - 1;
        // var file = $("#technical-" + serial_id + "-detailed-estimate-upload").val();
        var ref_no = $("#building-" + row_no + "-building_submaterial_id").val();
        var date = $("#building-" + row_no + "-submit_date").val();
        var cost = $("#building-" + row_no + "-building_material_id").val();
        var unit = $("#building-" + row_no + "-unit_id").val();
        var document = $("#building-" + row_no + "-quantity").val();

        if (ref_no != '' && cost != '' && unit != '' && date != '' && document != '') {

            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/BuildingMaterialDetails/ajaxbuildingdetails/' +
                    j,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    // alert(data);
                    $('.adding').append(data);
                    //  j++;
                    // $("#serialvalue").val(j);
                }
            });
        } else if (ref_no == '') {
            alert("Select Sub materials");
            $("#building-" + row_no + "-building_submaterial_id").focus();



        } else if (cost == '') {
            alert("Select Building material");
            $("#building-" + row_no + "-building_material_id").focus();

        } else if (unit == '') {
            alert("Select Units");
            $("#building-" + row_no + "-unit_id").focus();
        } else if (document = '') {
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

    function validdocs(oInput) {
        var _validFileExtensions = ['.pdf'];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                        sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                if (!blnValid) {
                    alert(_validFileExtensions.join(", ") + " File Formats only Allowed");
                    //alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
            var file_size = oInput.files[0].size;
            if (file_size >= 2097152) {
                alert("File Maximum size is 2MB");
                oInput.value = "";
                return false;
            }

        }
        return true;
    }


    function calling(id) {
        // alert(id);
        $.ajax({
            async: true,
            dataType: "html",
            url: '<?php echo $this->Url->webroot ?>/tnphc/BuildingMaterialDetails/ajaxcalling/' +
                id,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data, textStatus) {
                alert(data);
                if (data == 1) {
                    alert('Material is already present')
                }
            }
        });
        // var a = document.getElementById("financial - year - id").val();


    }
</script>