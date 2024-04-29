<?php echo $this->Form->create($projectWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active">Basic<br>Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Administrative <br>Sanction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Detailed<br>Estimate</a>
        </li>
		<?php  if($oldProjectWorkDetail['skip_fs_flag'] == 0){ ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Financial<br>Sanction</a>
        </li>
		<?php } ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Technical<br>Sanction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tender<br>Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Contractor<br>Details</a>
        </li>
		<li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planning<br>Clearance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">SiteHand<br>Over</a>
        </li>
    </ul>
    <div id="tabs-1">
        <div class="col-md-12">
            <div class="card card-topline-aqua">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-body row">
                            <div class="col-md-12">							
							   <?php  if($work_id != ''){ ?>
							    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;margin-left:2px;margin-bottom:1%">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Project Name <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('project_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                                        </div>
                                        <label class="control-label col-md-2">Project Description<span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('project_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3]); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Departments <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required', 'onchange' => 'loaddepartmenttype(this.value)']); ?>
                                        </div>

                                        <label class="control-label col-md-2">Financial Year <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Building Type <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('building_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $buildingTypes, 'label' => false, 'error' => false, 'empty' => 'Select Building Type', 'required']); ?>
                                        </div>
                                        <label class="control-label col-md-2">Scheme Type <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('scheme_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $schemeTypes, 'label' => false, 'error' => false, 'empty' => 'Select Scheme Type', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Coastal Area <span class="required">*
                                            </span></label>
                                        <div class="col-md-4 ">
                                            <?php echo $this->Form->control('coastal_area', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => ['1' => 'Yes', '2' => 'No'], 'label' => false, 'error' => false, 'empty' => 'Select Coastal Area', 'required', 'id' => 'coastal']); ?>
                                        </div>
                                        <label class="control-label col-md-2 ">Rough Cost (in Rs.)<span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('project_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'id' => 'project_cost']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Proposal Upload <span class="required">* (upload .pdf,.jpg,.jpeg,.png Only) <br> (Maximum 5mb only)</span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('file_upload', ['class' => 'form-control num', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                            <?php if ($projectWork['file_upload'] != '') {  ?>
                                                <?php echo $this->Form->control('file_upload1', ['type' => 'hidden', 'value' => $projectWork['file_upload']]); ?>

                                                <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                        <ion-icon name="document-text-outline"></ion-icon>View
                                                    </span></a>
                                            <?php  } ?>

                                        </div>
                                        <label class="control-label col-md-2">Work Type <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('departmentwise_work_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $work_types ? $work_types : '', 'label' => false, 'error' => false, 'empty' => 'Select Work Type', 'required', 'id' => 'departmentwise-work-type-id']); ?>

                                        </div>
                                    </div>
                                </fieldset><br>                   
                                <legend class="bol" style="color: #0047AB; text-align: center;">Location Details</legend>
                                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:2px;margin-bottom:0%">
                                    <div class="form-group">
                                        <fieldset>
                                            <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left:0%;">
                                                <thead>
                                                    <tr align="center">
                                                        <th style="width:1%"> S.No</th>
                                                        <th style="width:18%">Work Name</th>
                                                        <th style="width:12%">Place / Area Name</th>
                                                        <th style="width:12%">District</th>
                                                        <th style="width:12%">Division</th>
                                                        <th style="width:12%">Circle</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="add_doc">
                                                    <tr class="present_row">
                                                        <td class="trcount">1</td>
                                                        <td>
                                                            <?php echo $this->Form->control('work_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => true, 'type' => 'textarea', 'rows' => 3, 'data-rule-required' => true, 'data-msg-required' => 'Enter Work Name', 'value' => $projectWorkSubdetail['work_name']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('place_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => true, 'type' => 'textarea', 'rows' => 2, 'data-rule-required' => true, 'data-msg-required' => 'Enter Place Name', 'value' => $projectWorkSubdetail['place_name']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts ? $districts : '', 'label' => false, 'error' => true, 'empty' => 'Select District', 'onchange' => 'loadcircle(this.value,0)', 'data-rule-required' => true, 'data-msg-required' => 'Select District', 'value' => ($projectWorkSubdetail['district_id']) ? $projectWorkSubdetail['district_id'] : $oldProjectWorkDetail['district_id']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions ? $divisions : '', 'label' => false, 'error' => true, 'empty' => 'Select Division', 'value' => ($projectWorkSubdetail['division_id']) ? $projectWorkSubdetail['division_id'] : $oldProjectWorkDetail['division_id']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('circle_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles ? $circles : '', 'label' => false, 'error' => true, 'empty' => 'Select Circle', 'value' => ($projectWorkSubdetail['circle_id']) ? $projectWorkSubdetail['circle_id'] : $oldProjectWorkDetail['circle_id']]) ?>
                                                        </td>
                                                       
                                                    </tr>
                                                </tbody>
                                                
                                            </table>
                                        </fieldset>
                                    </div>
                                </fieldset>							   
							   <?php  }else{ ?>                               
							    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;margin-left:2px;margin-bottom:1%">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Project Name <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('project_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required', 'value' => $oldProjectWorkDetail['project_name']]); ?>
                                        </div>
                                        <label class="control-label col-md-2">Project Description<span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('project_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'value' => $oldProjectWorkDetail['project_name']]); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Departments <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required', 'value' => $oldProjectWorkDetail['department_id'], 'onchange' => 'loaddepartmenttype(this.value)']); ?>
                                        </div>

                                        <label class="control-label col-md-2">Financial Year <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required', 'value' => $oldProjectWorkDetail['financial_year_id']]); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Building Type <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('building_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $buildingTypes, 'label' => false, 'error' => false, 'empty' => 'Select Building Type', 'required']); ?>
                                        </div>
                                        <label class="control-label col-md-2">Scheme Type <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('scheme_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $schemeTypes, 'label' => false, 'error' => false, 'empty' => 'Select Scheme Type', 'required']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Coastal Area <span class="required">*
                                            </span></label>
                                        <div class="col-md-4 ">
                                            <?php echo $this->Form->control('coastal_area', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => ['1' => 'Yes', '2' => 'No'], 'label' => false, 'error' => false, 'empty' => 'Select Coastal Area', 'required', 'id' => 'coastal']); ?>
                                        </div>
                                        <label class="control-label col-md-2 ">Rough Cost (in Rs.)<span class="required">*</span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('project_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'id' => 'project_cost']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2">Proposal Upload <span class="required">* (upload .pdf,.jpg,.jpeg,.png Only) <br> (Maximum 5mb only)</span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('file_upload', ['class' => 'form-control num', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                            <?php if ($projectWork['file_upload'] != '') {  ?>
                                                <?php echo $this->Form->control('file_upload1', ['type' => 'hidden', 'value' => $projectWork['file_upload']]); ?>

                                                <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                        <ion-icon name="document-text-outline"></ion-icon>View
                                                    </span></a>
                                            <?php  } ?>

                                        </div>
                                        <label class="control-label col-md-2">Work Type <span class="required">* </span></label>
                                        <div class="col-md-4">
                                            <?php echo $this->Form->control('departmentwise_work_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $work_types ? $work_types : '', 'label' => false, 'error' => false, 'empty' => 'Select Work Type', 'required', 'id' => 'departmentwise-work-type-id']); ?>

                                        </div>
                                    </div>
                                </fieldset><br>                   
                                <legend class="bol" style="color: #0047AB; text-align: center;">Location Details</legend>
                                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:2px;margin-bottom:0%">
                                    <div class="form-group">
                                        <fieldset>
                                            <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left:0%;">
                                                <thead>
                                                    <tr align="center">
                                                        <th style="width:1%"> S.No</th>
                                                        <th style="width:20%">Work Name</th>
                                                        <th style="width:18%">Place / Area Name</th>
                                                        <th style="width:12%">District</th>
                                                        <th style="width:12%">Division</th>
                                                        <th style="width:12%">Circle</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="add_doc">
                                                    <tr class="present_row">
                                                        <td class="trcount">1</td>
                                                        <td>
                                                            <?php echo $this->Form->control('work_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => true, 'type' => 'textarea', 'rows' => 3, 'data-rule-required' => true, 'data-msg-required' => 'Enter Work Name', 'value' =>$oldProjectWorkDetail['project_name']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('place_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => true, 'type' => 'textarea', 'rows' => 2, 'data-rule-required' => true, 'data-msg-required' => 'Enter Place Name', 'value' => $oldProjectWorkDetail['place_name']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts ? $districts : '', 'label' => false, 'error' => true, 'empty' => 'Select District', 'onchange' => 'loadcircle(this.value,0)', 'data-rule-required' => true, 'data-msg-required' => 'Select District', 'value' => ($projectWorkSubdetail['district_id']) ? $projectWorkSubdetail['district_id'] : $oldProjectWorkDetail['district_id']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions ? $divisions : '', 'label' => false, 'error' => true, 'empty' => 'Select Division', 'value' => ($projectWorkSubdetail['division_id']) ? $projectWorkSubdetail['division_id'] : $oldProjectWorkDetail['division_id']]) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->control('circle_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles ? $circles : '', 'label' => false, 'error' => true, 'empty' => 'Select Circle', 'value' => ($projectWorkSubdetail['circle_id']) ? $projectWorkSubdetail['circle_id'] : $oldProjectWorkDetail['circle_id']]) ?>
                                                        </td>
                                                        
                                                       
                                                    </tr>
                                                </tbody>
                                                
                                            </table>
                                        </fieldset>
                                    </div>
                                </fieldset>
							   <?php } ?>
                                <div class="form-group" style="padding-top: 20px;">
                                    <div class="offset-md-5 col-md-10">
                                        <button type="submit" class="btn btn-info m-r-20">Save & continue</button>
                                        <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</body>
<?php echo $this->Form->End(); ?>

<script>
    $("#FormID").validate({
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
                <?php if ($work_id != '') { ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php } ?>
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
			form.submit();
                $(".btn").prop('disabled', true);
          
        }
    });


    function loaddepartment(id) {
        var id;
        if (id == 1) {
            $('#department-id').val('');
            $('.department').hide();
        } else if (id == 2) {
            $('.department').show();
        }
    }

    function loaddepartmenttype(dept_id) {
        var dept_id;
        if (dept_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxdepartmentworktype/' + dept_id,
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


    $(document).ready(function() {
        $('#district').on('change', function() {
            var distID = $(this).val();
            if (distID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxdivisions/' + distID,
                    success: function(data, textStatus) {
                        $('#division').html(data);
                    }
                });
            } else {
                $('#division').html('<option value="">Select division</option>');

            }
        });
    });

    jQuery('body').on('keyup', '.num1', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').replace(/  +/g, ' ');
    });

    jQuery('body').on('keyup', '.amount1', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });


    function getaddempdoc() {
        var j = ($('.present_row').length);
        alert(j);
        var serial_id = ($('.present_row').length - 1);
        // alert(serial_id);
        var district = $("#project-" + serial_id + "-district-id").val();
        // alert(district);
        var amount = $("#project-" + serial_id + "-amount").val();


        if (district != '' && amount != '') {
            // alert(district);

            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxproject/' + j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) { //alert(data);
                    $('.add_doc').append(data);

                }
            });
        } else if (district == '') {
            alert("Select District");
            $("#project-" + serial_id + "-district-id").focus();
        } else if (amount == '') {
            alert("Enter Amount");
            $("#project-" + serial_id + "-amount").focus();
        }
    }


    function loadcircle(id, count) {
        var id;
        //var type_id = 2;
        if (id) {

            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxcircles/' + id,
                success: function(data, textStatus) {
                    var value1 = parseInt(data);
                    //alert(value1)
                    $('#circle-id').val(value1);
                    $('#circle-id').val(value1);
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxdivisions/' + id,
                success: function(data1, textStatus1) {
                    var value2 = parseInt(data1);
                    //alert(value2);
                    if (id == 2) {
                        // $("#division-id").prop('disabled', false);
                        $('#division-id').val('');
                        $('#division-id').val('');
                        /*$.ajax({
								type: 'POST',
								url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxchennaidivisions/'+id,
								success: function(data2, textStatus2) {
									 //alert(data2);
									$("#project-"+count+"-division-id1").html(data2);
								}
							 });*/
                    } else {
                        //$("#project-"+count+"-division-id1").html('');
                        // $("#division-id").prop('disabled', true);
                        /*$.ajax({
                        	type: 'POST',
                        	url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxchennaidivisions/'+id,
                        	success: function(data3, textStatus3) {
                        		// alert(data3);
                        		$("#project-"+count+"-division-id1").html(data3);
                        	}
                         });*/

                        //alert(value2);

                        $('#division-id').val(value2);
                        $('#division-id').val(value2);
                        //alert('hi');
                    }
                }
            });
        } else {
            //$('#division-id').html('<option value="">Select division</option>');

        }
    }


    // function calculateTotal() {
        // // alter('hii');
        // var amount = 0;
        // $(".divided_amount").each(function() {

            // if (parseFloat(this.value) != 'NAN') {
                // amount += parseFloat(this.value);
            // }

        // });
        // if (!isNaN(amount)) {

            // $('#total-amount').val(amount.toFixed(2));

        // } else {

            // $('#total-amount').val('');

        // }
    // }

    $('.datepicker').flatpickr({
        maxDate: "today",
        dateFormat: "d-m-Y",
        allowInput: false
    });
</script>
