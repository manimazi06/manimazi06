<?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header> Project Final Drawing </header>
            </div>
			     <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;">     
				   
				 </div>            	 
				<?php // if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>  			
				  <div class="card-body">
					<div class="form-body row">
						<div class="col-md-12 addpage">
						 <h4 class = "sub-tile">Project Final Drawing  :</h4> 
					 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
					 <div class="col-md-12" style="margin-top:">						 
					<div class="form-group row">
					  <label class="control-label col-md-4 bol">Project Final Drawing Upload<span class="required">* <br>(.jpeg,.jpg,.png,.pdf Format only)&nbsp;&nbsp;(Maximum 8MB Only) </span></label>
						<div class="col-md-5">
							 <?php echo $this->Form->control('architect_drawing_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
					        <?php  if($projectWorkSubdetail['architect_drawing_flag'] == 1){  ?>  
								 <?php echo $this->Form->control('architect_drawing_upload1', ['type' => 'hidden', 'label' => false,'value'=>$projectWorkSubdetail['architect_drawing_upload']]); ?>
                                 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ArchitectDrawings/'.$projectWorkSubdetail['architect_drawing_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
										<i class="fa fa-file-image-o" aria-hidden="true">&nbsp;</i>View</span></a>
							  
					        <?php }  ?>
					  </div>								
					</div>
                    	   				
				  </div> 
				  </fieldset>
						</div>                    
					</div>
				 </div>		
				<?php  //} ?>	       	
			   <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
					    <?php //echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>
						<button type="submit" class="btn btn-success"> Submit</button>
					</div>
				</div>
		
        </div>
    </div>
</div>
<br>
 <?php  if($projectWorkSubdetail['architect_drawing_flag'] == 1){  ?>  
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">           
			  <div class="card-body">
				 <div class="row" >   
				<div class="table-scrollable user-table">
				 <table width="100%">  
				 <tr>
				    <td>
				   <iframe src="<?php echo $this->Url->build('/uploads/ArchitectDrawings/'.$projectWorkSubdetail['architect_drawing_upload'], ['fullBase' => true]); ?>#toolbar=0" height="750" width="1000" style="overflow: hidden;"></iframe><br>
				    </td>
				 </tr>
				 </table>			  
				</div>
				</div>
			 </div>	 
        </div>
    </div>
</div>
 <?php } ?>
<?php echo $this->Form->End(); ?>
<script>
    $("#FormID").validate({
        rules: {
            'architect_drawing_upload': {
                required: true
            }
        },
        messages: {
            'architect_drawing_upload': {
                required: "Upload Drawing"
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
        if (file_size >= 8388608) {
            alert("File Maximum size is 8MB");
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
