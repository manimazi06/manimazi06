
 <?php echo $this->Form->create($projectPlacedToBoardDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Project Placed Board Detail</header>   
            </div>
			 <div class="form-group" style="padding-top: 5px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;">     
				   
				 </div>
               <div class="card-body">
                <div class="col-md-12">
                    <div class="form-body row">
					   <div class="card-body">
						<fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:1px;margin-bottom:1%">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Placed Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('placed_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date','required']); ?>
                                </div>
								 <label class="control-label col-md-2">File upload<span class=" required"> * <br>(upload .pdf,.jpg,.png) <br> (Maximum 5mb only)
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('file_upload', ['class' => 'form-control','type'=>'file' ,'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Document','onchange' => 'validdocs(this)','required']); ?>
                                </div>
                            </div>
							<div class="form-group row">
                              <label class="control-label col-md-2">Remarks<span class=" required">
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control','templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'rows'=>3,'placeholder' => 'Enter Remarks']); ?>
                                </div>
                            </div>
                        </div>
						</fieldset>
                        </div>
                    </div>                        
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                      
                </div>
            </div>
        </div>
    </div>
  <?php echo $this->Form->End(); ?>
<script>
    $("#FormID").validate({
        rules: {
            'placed_date': {
                required: true
            },
            'file_upload': {
                required: true
            },
            'remarks': {
                required: false
            }
        },

        messages: {
            'placed_date': {
                required: "Select Placed Date"
            },
            'file_upload': {
                required: "Select Document"
            },
            'remarks': {
                required: "Enter Remarks"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
   

    function validdocs(oInput) {
                var _validFileExtensions = [".jpg", ".png", ".jpeg",".pdf"];
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