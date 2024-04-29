 <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>
 <?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header>Edit Project Tender Details</header>
         </div>
         <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-3">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
         
         <div class="card-body">
              <h4 class = "sub-tile">Tender Details</h4>
             <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
                 <div class="form-body row">
                     <div class="col-md-12">
                         <div class="form-group row">

                             <label class="control-label col-md-3">Tender type <span class="required"> * </span></label>
                             <div class="col-md-3">
                                 <?php echo $this->Form->control('tender_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false,  'error' => false, 'empty' => 'Select Tender Type',  'options' => $tender_type, 'required', 'onchange' => 'load_details(this.value)']); ?>
                             </div>                         
                                 <label class="control-label col-md-3 etender" <?php if($projectTenderDetail['tender_type_id'] == 2){ ?> style="display:none;" <?php } ?>>E-tender <span class="required"> * </span></label>

                                 <div class="col-md-3 etender" <?php if($projectTenderDetail['tender_type_id'] == 2){ ?> style="display:none;" <?php } ?>>
                                     <?php echo $this->Form->control('etenderID', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'placeholder' => 'Enter E-Tender Id', 'label' => false,   'error' => false, 'type' => 'text']); ?>
                                 </div>

                                 <label class="control-label col-md-3 boxtender" <?php if($projectTenderDetail['tender_type_id'] == 1){ ?> style="display:none;" <?php } ?>>Tender No<span class="required"> * </span></label>

                                 <div class="col-md-3 boxtender" <?php if($projectTenderDetail['tender_type_id'] == 1){ ?> style="display:none;" <?php } ?>>
                                     <?php echo $this->Form->control('tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'Enter tender No', 'error' => false, 'type' => 'text']); ?>
                                 </div>
                             
                         </div>

                         <div class="form-group row">
                             <label class="control-label col-md-3">Tender Date<span class="required"> * </span></label>
                             <div class="col-md-3">
                                 <?php echo $this->Form->control('tender_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>($projectTenderDetail['tender_date'])?date('d-m-Y',strtotime($projectTenderDetail['tender_date'])):'']); ?>
                             </div>

                             <label class="control-label col-md-3">Tender Copy<span class="required"> * </span></label>
                             <div class="col-md-3">
                                 <?php echo $this->Form->control('tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                 <?php if ($projectTenderDetail['tender_copy'] != '') {  ?>
                                     <?php echo $this->Form->control('tender_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $projectTenderDetail['tender_copy']]); ?>
                                     <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                             <ion-icon name="document-text-outline"></ion-icon>View
                                         </span>
                                     </a>
                                 <?php  } ?>

                             </div>
                         </div>

                         <div class="form-group row">
                             <label class="control-label col-md-3">Estimate Amount put to Tender <br>(in Rs.)<span class="required"> * </span></label>
                             <div class="col-md-3">
                                 <?php echo $this->Form->control('tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                             </div>
                         </div>
                     </div>
                 </div>
         </div>
         </fieldset>
     </div>
     <div class="form-group" style="padding-top: 10px;">
         <div class="offset-md-5 col-md-10">
             <button type="submit" class="btn btn-info m-r-20">Update</button>
             <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
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
             'project_work_id': {
                 required: true
             },
             'tender_no': {
                 required: true
             },
             'tender_date': {
                 required: true
             },
             'tender_copy': {
                 required: false
             },
             'tender_amount': {
                 required: true
             }

         },

         messages: {
             'project_work_id': {
                 required: "Select Project Work"
             },
             'tender_no': {
                 required: "Select Tender No"
             },
             'tender_date': {
                 required: "Select Tender Date"
             },
             'tender_copy': {
                 required: " Select Tender Copy"
             },
             'tender_amount': {
                 required: "Enter Tender Amount"
             }
         },
         submitHandler: function(form) {
             form.submit();
             /*var admin_sanction = <?php echo $administrativesanction['sanctioned_amount'];  ?>;
             var tender_amount = $('#tender-amount').val();
             if (parseFloat(tender_amount) <= parseFloat(admin_sanction)) {
                 form.submit();
                 $(".btn").prop('disabled', true);
             } else {
                 alert('Estimate Amount put to Tender should be less than or equal to  Technical Sanction');
                 return false;

             }*/

         }
     });

     function load_details(id) {
         //alert(id);

         if (id == 1) {
             $('#tender-no').val('');
             $(".etender").show();
             $(".boxtender").hide();
            // alert('Enter E-Tender No');
         } else if (id == 2) {
			 $('#etenderid').val('');
             $(".boxtender").show();
             $(".etender").hide();
            // alert('Enter Box-Tender id');
         }


     }

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

     $(document).ready(function() {
         $('#financialyear').on('change', function() {
             // alert(distID);
             var financialID = $(this).val();
             //  alert(distID);
             //var path = "<?php //echo $this->Url->webroot 
                            ?>/firstproject/Students/ajaxtaluks/" + distID;
             // alert(path);
             if (financialID) {
                 $.ajax({
                     type: 'POST',
                     url: '<?php echo $this->Url->webroot ?>/tnphc_staging/projectTenderDetails/ajaxproject/' + financialID,
                     success: function(data, textStatus) {
                         //alert(data)
                         $('#project').html(data);
                     }
                 });
             } else {
                 $('#project').html('<option value="">Select Project</option>');

             }
         });


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
 </script>