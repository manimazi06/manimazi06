<div class="col-md-12">
    <?php echo $this->Form->create($projectwiseDevelopmentWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Projectwise Development Work</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="control-label col-md-2">Work Name <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('work_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Work Name',  'required']); ?>
                            </div>
                            <label class="control-label col-md-2">Description<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('work_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description', 'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 ">Estimated Cost (in Rs.)<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('estimated_cost', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'required']); ?>
                            </div>
                            <label class="control-label col-md-2">File Upload <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('file_upload', ['class' => 'form-control ', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)', 'required']); ?>
                                <?php if ($projectwiseDevelopmentWork['file_upload'] != '') {  ?>
                                <?php echo $this->Form->control('file_upload1', ['type' => 'hidden', 'value' => $projectwiseDevelopmentWork['file_upload']]); ?>
                                <a style="color:blue;"
                                    href="<?php echo $this->Url->build('/uploads/ProjectwiseDevelopmentWork/' . $projectwiseDevelopmentWork['file_upload'], ['fullBase' => true]); ?>"
                                    target="_blank"><span>
                                        <ion-icon name="document-text-outline"></ion-icon>View
                                    </span></a>
                                <?php  } ?>
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
            'work_description': {
                required: true
            },
            'estimated_cost': {
                required: true
            },
            'file_upload': {
                required: false
            }
        },

        messages: {
            'work_name': {
                required: "Enter Work Name"
            },
            'work_description': {
                required: "Enter Description"
            },
            'estimated_cost': {
                required: "Enter Estimated Cost"
            },
            'file_upload': {
                required: "Select Document"
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

</script>