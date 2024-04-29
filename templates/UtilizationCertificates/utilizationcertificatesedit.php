<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit utilizationCertificate</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($utilizationCertificate, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-11">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Cerificate date<span class=" required">*
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('certificated_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select date', 'required','value'=>$utilizationCertificate->certificated_date]); ?>
                                </div>
                                 <label class="control-label col-md-2">Amount<span class=" required">*
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount', 'required','maxlength'=>13,'min'=>1]); ?>
                                </div>

                                </div>
                          
                            <div class="form-group row">
							 <label class="control-label col-md-2">Certificate Upload<span class=" required"> <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('certificate_upload', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'file','label' => false, 'error' => false, 'placeholder' => 'Select File upload','accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                    
                                    <?php if ($utilizationCertificate['certificate_upload'] != '') {  ?>
                                     <?php echo $this->Form->control('certificate_upload1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $utilizationCertificate['certificate_upload']]); ?>
                                     <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/utilizationCertificates/' . $utilizationCertificate['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                             <ion-icon name="document-text-outline"></ion-icon>View
                                         </span>
                                     </a>
                                 <?php  } ?>
                            
                            </div>
							<label class="control-label col-md-2">Remarks<span class=" required">
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'textarea', 'rows' => 3, 'label' => false, 'error' => false, 'placeholder' => 'Remarks','value'=>$utilizationCertificate->remarks]); ?>
                                </div>
                        </div>
                        </div>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#FormID").validate({
        rules: {
            'certificated_date': {
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
            'certificated_date': {
                required: "Select Certificated Date"
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