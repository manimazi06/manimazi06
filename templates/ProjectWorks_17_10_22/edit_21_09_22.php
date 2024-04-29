<?php echo $this->Form->create($projectWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Edit Project Work</header>
        </div>
        <div class="card-body" style="margin-top:30px ;" <div class="col-md-11">
            <div class="form-body row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="control-label col-md-2">Project Name <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('project_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                        </div>
                        <label class="control-label col-md-2">Project Description</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('project_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2">Departments <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required']); ?>
                        </div>
                        <label class="control-label col-md-2">Financial Year <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2">Building Type <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('building_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $buildingTypes, 'label' => false, 'error' => false, 'empty' => 'Select Building Type', 'required']); ?>
                        </div>
                        <label class="control-label col-md-2">Scheme Type <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('scheme_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $schemeTypes, 'label' => false, 'error' => false, 'empty' => 'Select Scheme Type', 'required']); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2">Proposal Upload <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('file_upload', ['class' => 'form-control num', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                            <?php if ($projectWork['file_upload'] != '') {  ?>
                            <?php echo $this->Form->control('file_upload1', ['type' => 'hidden', 'value' => $projectWork['file_upload']]); ?>

                            <a style="color:blue;"
                                href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>"
                                target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                            <?php  } ?>
                        </div>
                        <label class="control-label col-md-2">Project Statuses <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('ce_approved', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'],'empty' => 'select project Status', 'options' => $statusproject, 'label' => false, 'error' => false, 'required', 'onchange' => 'projecttype(this.value)']); ?>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="control-label col-md-2 coastal"<?php if($projectWork['ce_approved']!=1){ ?> style="display: none;" <?php } ?>>Coastal Area <span class="required"> *
                            </span></label>
                        <div class="col-md-4 coastal" <?php if($projectWork['ce_approved']!=1){ ?> style="display: none;" <?php } ?>>
                            <?php echo $this->Form->control('coastal_area', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => ['1' => 'Yes', '2' => 'No'], 'label' => false, 'error' => false, 'empty' => 'Select Coastal Area', 'required','id'=>'coastal']); ?>
                        </div>
                        <label class="control-label col-md-2 project_cost" <?php if($projectWork['ce_approved']!=1){ ?> style="display: none;" <?php } ?>>Project Cost <span
                                class="required"> * </span></label>
                        <div class="col-md-4 project_cost" <?php if($projectWork['ce_approved']!=1){ ?> style="display: none;" <?php } ?>>
                            <?php echo $this->Form->control('project_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','id'=>'project_cost']); ?>
                        </div>
                    </div>
                  
                    <div class="form-group row">

                        <label class="control-label col-md-2 remarks" <?php if($projectWork['ce_approved']!=2){ ?> style="display: none;" <?php } ?>>Remarks <span
                                class="required"> * </span></label>
                        <div class="col-md-4 remarks" <?php if($projectWork['ce_approved']!=2){ ?> style="display: none;" <?php } ?>">
                            <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows'=>3,'required','id'=>'remarks']); ?>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top: 10px;">
                        <div class="offset-md-5 col-md-10">
                            <button type="submit" class="btn btn-info m-r-20">Submit</button>
                            <button type="button" class="btn btn-default"
                                onclick="javascript:history.back()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>



<script>
// $('.datepicker1').flatpickr({
// dateFormat: "d-m-Y",
// allowInput: false
// });

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
        // 'district_id': {
        // required: true
        // },
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
            required: false
        },
        'remarks': {
            required: true
        },
        // 'longitude': {
        //     required: true
        // },
        'building_type_id': {
            required: true
        },
        // 'division_id': {
        // required: true
        // },
        'project_description': {
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
            required: "Enter Project Amount"
        },
        'file_upload': {
            required: "Select Document"
        },
        'remarks': {
            required: "Enter remarks"
        },
        // 'longitude': {
        //     required: "Enter Longitude"
        // },
        'building_type_id': {
            required: "Select Building Type"
        },
        // 'division_id': {
        // required: "Select division"
        // },
        'project_description': {
            required: "Enter Project Description"
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

function projecttype(id) {
    if( id == 0){
        $('.project_cost').hide();
        $('.coastal').hide();
        $('.remarks').hide();
        $('#project_cost').val('');
        $('#coastal').val('');
        $('#remarks').val('');
    }
    if (id == 1) {
        // alert(id);
        
        $('.project_cost').show();
        $('.coastal').show();
        $('.remarks').hide();
        $('#remarks').val('');
    }else if(id == 2){
        $('.remarks').show();
        $('.project_cost').hide();
        $('#project_cost').val('');
        $('.coastal').hide();
        $('#coastal').val('');
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
                url: '<?php echo $this->Url->webroot ?>/tnphc_staging/ProjectWorks/ajaxdivisions/' +
                    distID,
                success: function(data, textStatus) {
                    // alert(data)
                    $('#division').html(data);
                }
            });
        } else {
            $('#division').html('<option value="">Select division</option>');

        }
    });


});
</script>