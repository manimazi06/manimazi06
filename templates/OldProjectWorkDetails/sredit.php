<style>
    .area {
        resize: none;
    }
</style>
<div class="col-md-12">
    <?php echo $this->Form->create($oldProjectWorkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Edit WIP Special Repair Details</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <div class="col-md-12">
					   
                        <div class="form-group row">
                            <label class="control-label col-md-2">Work Name <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('project_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'placeholder' => 'Enter Work Details',  'required','type'=>'textarea','rows'=>3]); ?>
                            </div>
                            <label class="control-label col-md-2">Place/Area Name<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('place_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'text', 'error' => false, 'placeholder' => 'Enter Place Area', 'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Departments <span class="required">  </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required','onchange'=>'loaddepartmenttype(this.value)']); ?>
                            </div>
                            <label class="control-label col-md-2">Financial Year <span class="required"> </span></label>
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
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Circles<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('circle_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => false, 'empty' => 'Select Circle', 'id'=>'project-circle-id','required']); ?>
                            </div>
                            <label class="control-label col-md-2 ">FS Value (in Rs.)<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('fs_value', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','min'=>0,'maxlength'=>13,'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Ref No <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('ref_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'placeholder' => 'Enter GO Details',  'required','type'=>'textarea','rows'=>3]); ?>
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
            'project_name': {
                required: true
            },
            'department_id': {
                required: false
            },
            'financial_year_id': {
                required: false
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
            'fs_value': {
                required: true
            },
            'ref_no': {
                required: true
            },
            'go_date': {
                required: true
            },
            'place_name': {
                required: true
            }
        },
        messages: {
            'project_name': {
                required: "Enter Project Name"
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
            'fs_value': {
                required: "Enter FS Value"
            },
            'ref_no': {
                required: "Enter REF No"
            },
            'go_date': {
                required: "Select GO Date"
            },
            'place_name': {
                required: "Enter Place/Area Name"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    
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
   
</script>