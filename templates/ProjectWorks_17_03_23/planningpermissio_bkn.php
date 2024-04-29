<?php echo $this->Form->create($planningPermissionDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Planning Permission Detail</header>
            </div>
			 <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
            <div class="card-body">
                <legend class="bol" style="color: #0047AB; text-align: center;">Planning Permission Details</legend>
              <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">

			     <div class="col-md-12">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Send Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('send_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required', 'value' => date('d-m-Y', strtotime($Planning['send_date']))]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Approved Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('approved_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required', 'value' => date('d-m-Y', strtotime($Planning['approved_date']))]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">File Upload<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('permission_apporved_copy', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)',]); ?>
                                    <?php if ($Planning['permission_apporved_copy'] != '') { ?>

                                        <?php echo $this->Form->control('planningPermissionDetail1', ['type' => 'hidden', 'label' => false, 'value' => $Planning['planningPermissionDetail']]); ?>
                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploadsPlanningPermission/' . $Planning['planningPermissionDetail'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                <ion-icon name="document-text-outline"></ion-icon>View
                                            </span></a>
                                    <?php  } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-4">Remarks<span class=" required"> *
                                    </span></label>
                                <div class="col-md-6">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks', 'type' => 'textarea', 'required', 'rows' => '3', 'value' => $Planning['remarks']]); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>	
				
				</fieldset>
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
 <?php echo $this->Form->End(); ?>
<script>
      $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });

    $("#FormID").validate({
        rules: {
            'item_code': {
                required: true
            },
            'item_description': {
                required: true
            }

        },

        messages: {
            'item_code': {
                required: "Enter Item Code"
            },
            'item_description': {
                required: "Enter Item Description"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

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
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
</script>