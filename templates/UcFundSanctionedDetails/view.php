<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>View UC Fund Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($utilizationCertificates, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
					<h4 class = "sub-tile">UC Details</h4> 
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;background-color:ghostwhite;padding:5px;">
                         <div class="card-body">   
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Cerificate date<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y',strtotime($utilizationCertificate['certificated_date'])); ?>
                                </div>
                                 <label class="control-label col-md-2">Amount<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $utilizationCertificate['amount'] ; ?>  
                                </div>

                                </div>
                          
                            <div class="form-group row">
							 <label class="control-label col-md-2">Certificate Upload<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4">                                   
                                    <?php if ($utilizationCertificate['certificate_upload'] != '') {  ?>
                                     <?php echo $this->Form->control('certificate_upload1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $utilizationCertificate['certificate_upload']]); ?>
                                     <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/utilizationCertificates/' . $utilizationCertificate['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                             <ion-icon name="document-text-outline"></ion-icon>View
                                         </span>
                                     </a>
                                 <?php  } ?>
                            
                            </div>
							<label class="control-label col-md-2">Remarks<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $utilizationCertificate['remarks'] ; ?>
                                </div>
                           </div>
                          </div>
                        </div>
						</fieldset><br><br>
						<h4 class = "sub-tile">UC Sanctioned Details</h4> 
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;background-color:ghostwhite;padding:5px;">

						 <div class="card-body">   
						<div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Sanctioned date<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y',strtotime($ucFundSanctionedDetail['sanctioned_date'])); ?>
                                </div>
                                 <label class="control-label col-md-2">Amount<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $ucFundSanctionedDetail['amount'] ; ?>  
                                </div>
                            </div>                          
                            <div class="form-group row">					
							<label class="control-label col-md-2">Remarks<span class=" required">&nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
								   <?php echo $ucFundSanctionedDetail['remarks'] ; ?>
								 </div>
                            </div>
                        </div>
                        </div>
						</fieldset><br>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Back</button>
                            </div>
                        </div>
                        <?php echo $this->Form->End(); ?>
                    </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#FormID").validate({
        rules: {
            'sanctioned_date': {
                required: true
            },
            'amount': {
                required: true
            },
            'remarks': {
                required: false
            }
        },

        messages: {
            'sanctioned_date': {
                required: "Select Date"
            },
            'amount': {
                required: "Enter Amount"
            },
            'remarks': {
                required: "Enter Remark",
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
                     if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
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