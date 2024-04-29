
 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
                     <?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header> Detailed Estimate</header>
            </div>
			     <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;">     
				   
				 </div>
            	 
				<?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>  			
				  <div class="card-body">
					<div class="form-body row">
						<div class="col-md-12 addpage">
						 <h4 class = "sub-tile">Detailed Estimate :</h4> 
					 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
					 <div class="col-md-12" style="margin-top:">						 
					<div class="form-group row">
					  <label class="control-label col-md-4 bol">Detailed Estimate Upload<span class="required">* <br>(xls,xlsx Format only)&nbsp;&nbsp;(Maximum 8MB Only) </span></label>
						<div class="col-md-5">
							 <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
					   </div>								
					</div>	
                    <div class="form-group row">
					  <label class="control-label col-md-4 bol">Total Estimate Amount (in Rs.)<span class="required">*</span></label>
						<div class="col-md-5">
							 <?php echo $this->Form->control('detailed_estimate_amount', ['class' => 'form-control amount', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'required','type'=>'text','min'=>1,'maxlength'=>15]); ?>
					   </div>								
					</div>	   				
				  </div> 
				  </fieldset>
						</div>                    
					</div>
				 </div>		
				<?php  } ?>	
          	
			
			   <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
					    <?php //echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>
						<button type="submit" class="btn btn-success"> Submit</button>
					</div>
				</div>
		
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>

    $("#FormID").validate({
        rules: {
            'detailed_estimate_upload': {
                required: true
            },
            'detailed_estimate_amount': {
                 required: true
            }
        },

        messages: {
            'detailed_estimate_upload': {
                required: "Upload Detailed Estimate"
            },
            'detailed_estimate_amount': {
                required: "Enter Total Estimate Amount"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
	
	
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
	
	function validdocs(oInput) {
    var _validFileExtensions = [".xls", ".xlsx"];
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
</script>
