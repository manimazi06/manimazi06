<style>
    .area {
        resize: none;
    }
</style>
<div class="col-md-12">
    <?php echo $this->Form->create($repairworkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Repair work Detail</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="control-label col-md-2">Work Name <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('work_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'placeholder' => 'Enter Work Name',  'required']); ?>
                            </div>
                            <label class="control-label col-md-2">Place/Area Name<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('place_of_work', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'text', 'error' => false, 'placeholder' => 'Enter Place Area', 'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Departments <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required','onchange'=>'loaddepartmenttype(this.value)']); ?>
                            </div>
                            <label class="control-label col-md-2">Financial Year <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Districts<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select Districts','onchange'=>'loadcircle(this.value)', 'required']); ?>
                            </div>
                            <label class="control-label col-md-2">Divisions <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => false,'id'=>'project-division-id', 'empty' => 'Select Division', 'required']); ?>
                                <?php //echo $this->Form->control('project_division_id1', ['type'=>'hidden', 'label' => false, 'error' => true]) ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Circles<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('circle_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => false, 'empty' => 'Select Circle', 'id'=>'project-circle-id','required', 'disabled']); ?>
                                <?php echo $this->Form->control('project_circle_id1', ['type'=>'hidden', 'label' => false, 'error' => true]) ?>

                            </div>
                            <label class="control-label col-md-2 ">Estimated Cost (in Rs.)<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('estimated_cost', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','min'=>1,'maxlength'=>13,'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Work Type <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('departmentwise_work_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departmentwiseWorkTypes, 'label' => false, 'error' => false, 'empty' => 'Select Work Type', 'required']); ?>
                            </div>
                            <label class="control-label col-md-2">File Upload <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('work_file_upload', ['class' => 'form-control ', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)','required']); ?>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 10px;">
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
    <?php echo $this->Form->End(); ?>
</div>
<script>
    $("#FormID").validate({
        rules: {
            'work_name': {
                required: true
            },
            'department_id': {
                required: true
            },
            'financial_year_id': {
                required: true
            },
            'district_id': {
                required: true
            },
            'division_id': {
                required: true
            },
            'circle_id': {
                required: true
            },
            'place_of_work': {
                required: true
            },
            'estimated_cost': {
                required: true
            },
            'work_file_upload': {
                required: true
            },
            'departmentwise_work_type_id': {
                required: true
            }
        },
        messages: {
            'work_name': {
                required: "Enter Work Name"
            },
            'department_id': {
                required: "Select Department"
            },
            'financial_year_id': {
                required: "Select Financial year"
            },
            'district_id': {
                required: "Select District"
            },
            'division_id': {
                required: "Select Division"
            },
            'circle_id': {
                required: "Select Circle"
            },
            'place_of_work': {
                required: "Enter Place/Area Name"
            },
            'estimated_cost': {
                required: "Enter Estimated Cost"
            },
            'work_file_upload': {
                required: "Select Document"
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

    function validdocs(oInput) {
        var _validFileExtensions = [".jpg", ".png", ".jpeg", ".pdf"];
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
    function loadcircle(id){
        // alert(id);
        if(id){
            $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxcircles/'+ id,
                    success: function(data, textStatus) {
						var value1 = parseInt(data);
                        //   alert(value1)
                        $('#project-circle-id').val(value1);
                        $('#project-circle-id1').val(value1);
                       
                    }
                });
				 $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxdivisions/'+ id,
                    success: function(data1, textStatus1) {
						var value2 = parseInt(data1);
                        // alert(value2)
                        $('#project-division-id').val(value2);
                        $('#project-division-id1').val(value2);
                      
                    }
                });
        }else{
            $('#project-division-id').html('<option value="">Select division</option>');
            $('#project-circle-id').html('<option value="">Select Circle</option>');

        }
    }

    function loaddepartmenttype(dept_id){
        // alert(dept_id);
        var dept_id;
        if(dept_id){
            $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxdepartmentworktype/'+dept_id,
                    success: function(data, textStatus) {
                         //alert(data);
                        $('#departmentwise-work-type-id').html(data);
                    }
                });
        }else{
            $('#departmentwise-work-type-id').html('<option value="">Select Work Type</option>');
        }
    }
</script>