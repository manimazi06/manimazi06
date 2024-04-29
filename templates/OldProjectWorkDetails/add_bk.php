<?php echo $this->Form->create($oldProjectWorkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add old Project Work </header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <div class="col-md-12">
                        <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;margin-left:2px;margin-bottom:1%">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Project Name <span class="required">* </span></label>
                                <div class="col-md-9">
                                    <?php echo $this->Form->control('project_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">District <span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select District', 'required', 'onchange' => 'loadcircle(this.value)']); ?>
                                </div>

                                <label class="control-label col-md-2">Division <span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => true, 'empty' => 'Select Division', 'disabled']) ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2"> circle<span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('circle_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => true, 'empty' => 'Select Circle', 'disabled']) ?>
                                </div>

                                <label class="control-label col-md-2">Financial Year <span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Department <span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required', 'onchange' => 'loaddepartmenttype(this.value)']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Work stage <span class="required">* </span></label>
                                <div class="col-md-4">
                                <?php echo $this->Form->control('work_stage', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                                </div>
                            </div>

                        </fieldset><br>

                        <div class="form-group" style="padding-top: 20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="btn btn-info m-r-20">Submit</button>
                                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Form->End(); ?>
<script>
function loadcircle(id, count) {
        var id;
        //var type_id = 2;
		alert(id);
        if (id) {

            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxcircles/' + id,
                success: function(data, textStatus) {
                    var value1 = parseInt(data);
                    //alert(value1)
                    $('#project-' + count + '-circle-id').val(value1);
                    $('#project-' + count + '-circle-id1').val(value1);
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdivisions/' + id,
                success: function(data1, textStatus1) {
                    var value2 = parseInt(data1);
                    //alert(value2);
                    if (id == 2) {
                        $("#project-" + count + "-division-id1").prop('disabled', false);
                        $('#project-' + count + '-division-id1').val('');
                        $('#project-' + count + '-division-id').val('');
                        /*$.ajax({
								type: 'POST',
								url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxchennaidivisions/'+id,
								success: function(data2, textStatus2) {
									 //alert(data2);
									$("#project-"+count+"-division-id1").html(data2);
								}
							 });*/
                    } else {
                        //$("#project-"+count+"-division-id1").html('');
                        $("#project-" + count + "-division-id1").prop('disabled', true);
                        /*$.ajax({
                        	type: 'POST',
                        	url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxchennaidivisions/'+id,
                        	success: function(data3, textStatus3) {
                        		// alert(data3);
                        		$("#project-"+count+"-division-id1").html(data3);
                        	}
                         });*/

                        //alert(value2);

                        $('#project-' + count + '-division-id').val(value2);
                        $('#project-' + count + '-division-id1').val(value2);
                        //alert('hi');
                    }
                }
            });
        } else {
            //$('#division-id').html('<option value="">Select division</option>');

        }
    }
 
    /*$("#FormID").validate({
        rules: {
            'department_type': {
                required: true
            },
            'department_id': {
                required: true
            },
            'financial_year_id': {
                required: true
            },
            'project_status_id': {
                required: true
            },
            'coastal_area': {
                required: true
            },
            'project_name': {
                required: true
            },
            'project_amount': {
                required: true
            },
            'file_upload': {
                required: true
            },
            'building_type_id': {
                required: true
            },
            'project_description': {
                required: true
            },
            'scheme_type_id': {
                required: true
            },
            'departmentwise_work_type_id': {
                required: true
            }
        },

        messages: {
            'department_type': {
                required: "Select Department type"
            },
            'department_id': {
                required: "Select Department"
            },
            'financial_year_id': {
                required: "Select Financial Year"
            },
            'project_status_id': {
                required: "Select Project status"
            },
            // 'district_id': {
            // required: "Select District"
            // },
            'coastal_area': {
                required: "Select Coastal Area"
            },
            'project_name': {
                required: "Enter Project Name"
            },
            'project_amount': {
                required: "Enter Project Rough Cost"
            },
            'file_upload': {
                required: "Select Document"
            },
            'building_type_id': {
                required: "Select Building Type"
            },
            'project_description': {
                required: "Enter Project Description"
            },
            'scheme_type_id': {
                required: "Enter Scheme Type"
            },
            'departmentwise_work_type_id': {
                required: "Select Work Type"
            }
        },
        submitHandler: function(form) {
            var rough_cost = $('#project_cost').val();

            var amount = 0;
            $(".divided_amount").each(function() {
                amount += parseFloat(this.value);
            });
            if (parseFloat(rough_cost) == parseFloat(amount)) {
                form.submit();
                $(".btn").prop('disabled', true);
            } else {
                alert('Total Sum of Divided Amount should be equal to Rough Cost');
                return false;
            }
        }
    });*/



    function loaddepartmenttype(dept_id) {
        var dept_id;
        if (dept_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdepartmentworktype/' + dept_id,
                success: function(data, textStatus) {
                    //alert(data);
                    $('#departmentwise-work-type-id').html(data);
                }
            });
        } else {
            $('#departmentwise-work-type-id').html('<option value="">Select Work Type</option>');

        }
    }

    function validdocs(oInput) {
        var _validFileExtensions = [".pdf", ".jpg", ".jpeg", ".png"];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
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
            if (file_size >= 5242880) {
                alert("File Maximum size is 5MB");
                oInput.value = "";
                return false;
            }
        }
        return true;
    }

    




    // $(document).ready(function() {
        // $('#district').on('change', function() {
            // var distID = $(this).val();
            // if (distID) {
                // $.ajax({
                    // type: 'POST',
                    // url: '<?php echo $this->Url->webroot ?>/tnphc_staging/ProjectWorks/ajaxdivisions/' + distID,
                    // success: function(data, textStatus) {
                        // $('#division').html(data);
                    // }
                // });
            // } else {
                // $('#division').html('<option value="">Select division</option>');

            // }
        // });
    // });

    jQuery('body').on('keyup', '.num1', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').replace(/  +/g, ' ');
    });

    jQuery('body').on('keyup', '.amount1', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });

    $(document).ready(function() {
        $('#district').on('change', function() {
            var distID = $(this).val();
            if (distID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc_staging/ProjectWorks/ajaxdivisions/' + distID,
                    success: function(data, textStatus) {
                        $('#division').html(data);
                    }
                });
            } else {
                $('#division').html('<option value="">Select division</option>');

            }
        });
    });

    function loadcircle(id, count) {
        var id;
        //var type_id = 2;
        if (id) {

            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxcircles/' + id,
                success: function(data, textStatus) {
                    var value1 = parseInt(data);
                    //alert(value1)
                    $('#project-' + count + '-circle-id').val(value1);
                    $('#project-' + count + '-circle-id1').val(value1);
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdivisions/' + id,
                success: function(data1, textStatus1) {
                    var value2 = parseInt(data1);
                    //alert(value2);
                    if (id == 2) {
                        $("#project-" + count + "-division-id1").prop('disabled', false);
                        $('#project-' + count + '-division-id1').val('');
                        $('#project-' + count + '-division-id').val('');
                        /*$.ajax({
								type: 'POST',
								url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxchennaidivisions/'+id,
								success: function(data2, textStatus2) {
									 //alert(data2);
									$("#project-"+count+"-division-id1").html(data2);
								}
							 });*/
                    } else {
                        //$("#project-"+count+"-division-id1").html('');
                        $("#project-" + count + "-division-id1").prop('disabled', true);
                        /*$.ajax({
                        	type: 'POST',
                        	url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxchennaidivisions/'+id,
                        	success: function(data3, textStatus3) {
                        		// alert(data3);
                        		$("#project-"+count+"-division-id1").html(data3);
                        	}
                         });*/

                        //alert(value2);

                        $('#project-' + count + '-division-id').val(value2);
                        $('#project-' + count + '-division-id1').val(value2);
                        //alert('hi');
                    }
                }
            });
        } else {
            //$('#division-id').html('<option value="">Select division</option>');

        }
    }
</script>
