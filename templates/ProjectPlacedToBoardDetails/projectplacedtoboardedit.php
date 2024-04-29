
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Project Placed Board Detail</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectPlacedToBoardDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-10 offset-2">
                    <div class="form-body row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Place Date<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('placed_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date','required','value'=>$projectPlacedToBoardDetail['placed_date']]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                
                                <label class="control-label col-md-4">File upload<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('file_upload', ['class' => 'form-control','type'=>'file' ,'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Document','onchange' => 'validdocs(this)','required','accept'=>'.pdf,.png']); ?>
                                </div>

                                <?php if ($projectPlacedToBoardDetail['file_upload'] != '') {  ?>
                                     <?php echo $this->Form->control('file_upload1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $projectPlacedToBoardDetail['file_upload']]); ?>
                                     <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/Projectplacedtoboards/' . $projectPlacedToBoardDetail['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                             <ion-icon name="document-text-outline"></ion-icon>View
                                         </span>
                                     </a>
                                 <?php  } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-4">Remarks<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control','templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'rows'=>3,'placeholder' => 'Enter Remarks','required','value'=>$projectPlacedToBoardDetail['remarks']]); ?>
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
            'placed_date': {
                required: true
            },
            'file_upload': {
                required: true
            },
            'remarks': {
                required: true
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
                    if (file_size >= 2097152) {
                        alert("File Maximum size is 2MB");
                        oInput.value = "";
                        return false;
                    }

                }
                return true;
            }

</script>