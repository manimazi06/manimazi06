<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 120px;
  height: 120px;
  margin: -76px 0 0 -76px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}
 
</style>
<?php
// echo phpinfo();  exit();
 echo $this->Form->create($projectWorkSubdetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Project Video Upload</header>
        </div>
        <div class="form-group" style="padding-top: 10px">
            <div class="offset-md-1 col-md-2">
                <button type="button" class='btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>
            </div>
        </div>
        <div id="project" style="display:none;" ></div>
		
        <div class="card-body">
		 <?php if ($projectWorkSubdetail['video_flag'] == 0) { ?>
		      <div id="loader" class="card" style="margin-top:50px;display:none;"></div>

		    <div id="myDiv" class="animate-bottom">
            <h4 class="sub-tile">Project Video upload</h4>
            <h5 class="sub-tile">Upload video only after 100 percent physically completed (only one video can be uploaded)</h5>
            <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:5px;">
                <div class="col-md-12">
                  <div class="form-body row">
					<div class="form-group">
						<div class="col-md-12" style="margin-top:">
							<div class="form-group row">						
							<label class="control-label col-md-4 bol">Video Upload<span class="required">* <br>(upload .mp4,.avi) <br> (Maximum 45mb only)</span></label>
							<div class="col-md-4">
								<?php echo $this->Form->control('video_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)']); ?>
							</div>
							</div>							
						</div>                               
					</div><br>                           
				 </div>
				</div>
            </fieldset>
            <div class="form-group" style="padding-top: 10px">
                <div class="offset-md-5 col-md-5">
                    <button type="submit" class="btn btn-info m-r-20">Submit</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                </div>
            </div>
            </div>
		 <?php }elseif ($projectWorkSubdetail['video_flag'] == 1) { ?>
                <div class="card-body">
                    <h4 class="sub-tile">Project Video</h4>
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
                      <iframe src="<?php echo $this->Url->build('/uploads/projectvideo/'.$projectWorkSubdetail['video_filepath'], ['fullBase' => true]); ?>" title="description" style="height:400px;width:100%;border:none;overflow:hidden;"></iframe>
                    </fieldset>
                </div>
            <?php  } ?>
        </div>
        </div>
        </div>
        <?php echo $this->Form->End(); ?>


<script>
	function validdocs(oInput) {
		var _validFileExtensions = [".mp4", ".avi"];
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
			if (file_size >= 47185920) {
				alert("File Maximum size is 45MB");
				oInput.value = "";
				return false;
			}

		}
		return true;
	}

          

	$("#FormID").validate({
		rules: {
			'video_upload': {
				required: true
			}
		},

		messages: {
			'video_upload': {
				required: "upload video"
			}
		},
		submitHandler: function(form) {

			$(".btn").prop('disabled', true);
			showPage();
			form.submit();
		}
	});
	


	function showPage() {
		$('#loader').show();
		$('#myDiv').hide();
	  
	}	

	function toggledetail() {
		$('#project').toggle();

	}

	$(document).ready(function() {
		var ProjectID = <?php echo $id;  ?>;
		var ProjectSubID = <?php echo $work_id;  ?>;
		if (ProjectID != '' && ProjectSubID != '') {
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID + '/' + ProjectSubID,
				success: function(data, textStatus) {
					//alert(data);
					$('#project').html(data);
				}
			});
		}
	});       
</script>
