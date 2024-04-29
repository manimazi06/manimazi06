<?php echo $this->Form->create($projectHandoverDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">

        <div id="addpage">	      
            <div class="card-body">
			<h4 class="sub-tile">Project Handover To User Department Details</h4>
				 <div class="form-group" style="padding-top: 10px">
				  <div class="offset-md-1 col-md-2">
				    <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
				  </div>
			    </div>
			   <div id ="project" style="display:none;"> </div>
              
                    			   
                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;">
                    <div class="col-md-11">
                        <div class="form-body row">
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Handover Date<span class="required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('handover_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>
                                    <label class="control-label col-md-2">Inauguration Date<span class="required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('inauguration_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Photo Upload (Foundation Stone)<span class="required"> *  <br>(upload .jpg,.jpeg,.png) <br> (Maximum 5mb only)
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('photo_upload', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                    </div>
                                    <label class="control-label col-md-2">Final Executive Drawing Upload<span class="required"> *<br>(upload .jpg,.jpeg,.png) <br> (Maximum 5mb only)
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('execution_drawing_file', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Remarks<span class="required"> 
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="form-group addpagess" style="padding-top: 10px;">
            <div class="offset-md-5 col-md-10">
                <button type="submit" class="btn btn-info m-r-20">Submit</button>
                <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
$('.datepicker1').flatpickr({
    dateFormat: "d-m-Y",
    allowInput: false
});

$("#FormID").validate({
    rules: {
        'handover_date': {
            required: true
        },
        'inauguration_date': {
            required: true
        },
        'remarks': {
            required: false
        },
        'photo_upload': {
            required: true
        },
        'execution_drawing_file': {
            required: true
        }
    },

    messages: {
        'handover_date': {
            required: "Select Handover Date"
        },
        'inauguration_date': {
            required: "Select Inauguration Date"
        },
        'remarks': {
            required: "Enter Remarks"
        },
        'photo_upload': {
            required: "Select Foundation Stone photo"
        },
        'execution_drawing_file': {
            required: "Select Final Executive Drawing File"
        }
    },
    submitHandler: function(form) {

        form.submit();
        $(".btn").prop('disabled', true);

    }
});

function validdocs(oInput) {
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];
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


 function toggledetail(){
    $('#project').toggle();

    }

  $(document).ready(function() {
        var ProjectID    = <?php echo $id;  ?>;
        var ProjectSubID = <?php echo $work_id;  ?>;
        if (ProjectID !='' && ProjectSubID != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
</script>