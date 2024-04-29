<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>

<?php echo $this->Form->create($projectHandoverDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
      
        <div id="addpage">
             <h4 class = "sub-tile">Project Handover Details Edit</h4>
            <div class="card-body addpagess">
                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;">
                    <div class="col-md-11">
                        <div class="form-body row">
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Handover Date<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('handover_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => date('d-m-Y',strtotime($projectHandoverDetail['handover_date'])), 'type' => 'text', 'required']); ?>
                                    </div>


                                    <label class="control-label col-md-2">Handover Copy <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('file_upload', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                        <?php if ($projectHandoverDetail['file_upload'] != '') {  ?>

                                            <?php echo $this->Form->control('file_upload1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $projectHandoverDetail['file_upload']]); ?>
                                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectHandover/' . $projectHandoverDetail['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                    <ion-icon name="document-text-outline"></ion-icon>View
                                                </span>
                                            </a>
                                        <?php  } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Remarks<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $projectHandoverDetail['remarks'], 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </fieldset>
        </div>

        <div class="form-group addpagess" style="padding-top: 10px;">
            <div class="offset-md-5 col-md-10">
                <button type="submit" class="btn btn-info m-r-20">Update</button>
                <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
            </div>
        </div>
    </div>
    <?php // } 
    ?>



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
            'remarks': {
                required: true
            },
            'file_upload': {

                <?php if ($projectHandoverDetail['file_upload'] != '') {  ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php } ?>

            }

        },

        messages: {
            'handover_date': {
                required: "Select Handover Date"
            },
            'remarks': {
                required: "Enter Remarks"
            },
            'file_upload': {
                required: "Select File Handover Copy"
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