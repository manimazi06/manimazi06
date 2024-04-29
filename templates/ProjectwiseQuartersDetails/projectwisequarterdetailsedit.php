<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit Projectwise Quarter Details</header>
            </div>        
            <div class="card-body">
                <div class="form-body row">
                    <?php echo $this->Form->create($projectwiseQuartersDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

                    <div class="col-md-12">
                        <?php ///if (count($projectwiseQuartersDetail) > 0) { ?>
                            <div class="form-group">
                                <fieldset>
                                    <!-- <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button> -->
                                    <table class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%">S.no</th>
                                                <th style="width:10%">Designation</th>
                                                <th style="width:10%">Quarters</th>

                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        </tbody class="adding">
                                        <?php $i = 0; ?>

                                        <tr class="present_row_in_post">
                                            <td class="trcount"><?php echo $i + 1; ?></td>
                                            <td><?php echo $this->Form->control('quarters.' . $i . '.police_designation_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $policeDesignations, 'label' => false, 'error' => false, 'empty' => 'Select Designation', 'value' => $projectwiseQuartersDetail->police_designation_id]); ?>
                                                <?php echo $this->Form->control('quarters.' . $i . '.id', ['type' => 'hidden', 'value' => $projectwiseQuartersDetail->id]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('quarters.' . $i . '.no_of_quarters', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quarters',  'value' => $projectwiseQuartersDetail->no_of_quarters]); ?>
                                            </td>

                                        </tr>

                                        <?php $i++;
                                        ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        <?php// } ?>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->End(); ?>
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
        // var file = $("#technical-" + serial_id + "-detailed-estimate-upload").val();
        var designation = $("#quarters-" + row_no + "-police-designation-id").val();
        var quarters = $("#quarters-" + row_no + "-no-of-quarters").val();
        //alert(designation);

        if (designation != '' && quarters != '') {

            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/ProjectwiseQuartersDetails/ajaxquarters/' +
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

        } else if (designation == '') {
            alert("Select Designation");
            $("#quarters-" + row_no + "-police-designation-id").focus();
        } else if (quarters == '') {
            alert("Enter Quarters");
            $("#quarters-" + row_no + "-no-of-quarters").focus();
        }
    }

    $("#FormID").validate({
        rules: {
            'quarters[0][police_designation_id]': {
                required: true
            },
            'quarters[0][no_of_quarters]': {
                required: true
            }
        },

        messages: {
            'quarters[0][police_designation_id]': {
                required: "Select Designation"
            },
            'quarters[0][no_of_quarters]': {
                required: "Enter Quarters"
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
</script>

