 <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>

 <?php echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header>Add Project Tender Details</header>
         </div>
          <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-3">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
        
         <div class="card-body">
             <div class="form-body row">
                 <div class="col-md-12">
                     <legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend>
                     <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;">
                         <div class="form-body row">
                             <div class="col-md-12">

                                 <div class="form-group row">

                                     <label class="control-label col-md-3">Tender Type <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo $projectTenderDetail['tender_type']['name'] ?>
                                     </div>
									<?php if($projectTenderDetail['tender_type_id'] == 1){ ?> 
									 <label class="control-label col-md-3">E Tender ID <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo $projectTenderDetail['etenderID']; ?>
                                     </div>
									<?php }elseif($projectTenderDetail['tender_type_id'] == 1){ ?> 
									 <label class="control-label col-md-3">Tender No <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo $projectTenderDetail['tender_no']; ?>
                                     </div>
									<?php } ?>
                                 </div>
                                 <div class="form-group row">
                                     <label class="control-label col-md-3">Tender Date<span class="required"> &nbsp;&nbsp;:</span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo date('d-m-Y', strtotime($projectTenderDetail['tender_date'])); ?>
                                     </div>
                                     <label class="control-label col-md-3">Amount put to Tender (in Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower" id="tender_amount">
                                         <?php echo $projectTenderDetail['tender_amount'] ?>
                                     </div>
                                    
                                 </div>
								 <div class="form-group row">
                                    
                                     <label class="control-label col-md-3">Tender Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower" style="margin-top:8px;">
                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                             </span></a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </fieldset>
                 </div>
                 <div class="card-body">
                     <div class="form-body row">
                         <legend class="bol" style="color: #0047AB; text-align: center;">Contract Agreement Details</legend>
                         <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">

                             <div class="form-body row">
                                 <div class="col-md-12">
                                     <?php if ($contractor_detail_count == 0) { ?>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Contractor /Company<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_id', ['empty' => 'Select Contractor/Company', 'class' => 'form-select', 'options' => $contractor_type, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required']); ?>

                                             </div>                                            
                                         </div>
										   <div class="form-group row">
										    <label class="control-label col-md-3">Work Order Reference No<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('work_order_refno', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                             </div>
                                             <label class="control-label col-md-3">Work Order Copy <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('work_order_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                             </div>                                            
                                         </div>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement No. <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'agreement_no', 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                             </div>
                                             <label class="control-label col-md-3">Agreement Date<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                             </div>
                                         </div>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Period From <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_fromdate', ['class' => 'form-control datepicker1', 'label' => false, 'error' => true, 'onchange' => 'validdocs(this)']); ?>
                                             </div>

                                             <label class="control-label col-md-3">Agreement Period To<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_todate', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                             </div>
                                         </div>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Copy <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                             </div>

                                             <label class="control-label col-md-3">Agreement Amount (in Rs.) <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'id' => 'agreement_amount', 'value' => $contractor_details['agreement_amount'], 'type' => 'text', 'onblur' => 'calculation(this.value)']); ?>
                                             </div>
                                         </div>                                       

                                         <div class="form-group row" id="calc_perc">
                                             <label class="control-label col-md-3">Percentage(%) <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('perc_deduction', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'perc_deduction', 'label' => false, 'error' => false, 'type' => 'text', 'readonly']); ?>
                                             </div>
                                         </div>
                                         <?php } elseif ($contractor_detail_count > 0) {
                                            if ($projectWorkSubdetail['tender_detail_flag'] == 0) {  ?>


                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Contractor / Company Name<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('contractor_id', ['class' => 'form-select', 'options' => $contractor_type, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required']); ?>

                                                     <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $contractor_details['id']]) ?>

                                                 </div>
                                                 
                                             </div>
											   <div class="form-group row">
											    <label class="control-label col-md-3">Work Order Reference No <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $this->Form->control('work_order_refno', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $contractor_details['work_order_refno'], 'type' => 'text']); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Work Order Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $this->Form->control('work_order_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                                     <?php if ($contractor_details['work_order_copy'] != '') {  ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/WorkOrders/' . $contractor_details['work_order_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>
                                                
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement No.<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'agreement_no', 'label' => false, 'error' => false, 'value' => $contractor_details['agreement_no'], 'type' => 'text']); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Date<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => date('d-m-Y', strtotime($contractor_details['agreement_date'])), 'required']); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement Period From <span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_fromdate', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => date('d-m-Y', strtotime($contractor_details['agreement_fromdate'])), 'required']); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Period To<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_todate', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => date('d-m-Y', strtotime($contractor_details['agreement_todate'])), 'required']); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement Copy <span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                                     <?php if ($contractor_details['agreement_copy'] != '') {  ?>
                                                         <?php echo $this->Form->control('agreement_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $contractor_details['agreement_copy']]); ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $contractor_details['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>

                                                 <label class="control-label col-md-3">Agreement Amount (in Rs.)<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'agreement_amount', 'label' => false, 'onblur' => 'calculation(this.value)', 'error' => false, 'value' => $contractor_details['agreement_amount'], 'type' => 'text']); ?>
                                                 </div>
                                             </div>
                                           
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3"> Percentage(%) <span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('perc_deduction', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'perc_deduction', 'label' => false, 'error' => false, 'placeholder' => 'Percentage Calculation', 'readonly', 'required', 'type' => 'text', 'value' => $contractor_details['perc_deduction']]); ?>
                                                 </div>
                                             </div>


                                         <?php } else { ?>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Contractor / Company Name<span class="required"> &nbsp;&nbsp;:</span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['contractor_name']; ?>

                                                 </div>
                                                 <!--label class="control-label col-md-3">Contact Mobile No <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['contractor_mobile_no']; ?>
                                                 </div-->
                                             </div>
											  <div class="form-group row">
											    <label class="control-label col-md-3">Work Order Reference No <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['work_order_refno']; ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Work Order Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php if ($contractor_details['work_order_copy'] != '') {  ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/WorkOrders/' . $contractor_details['work_order_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>
                                                
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement No. <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['agreement_no']; ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Date<span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo date('d-m-Y', strtotime($contractor_details['agreement_date'])); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement Period From <span class="required"> &nbsp;&nbsp;:</span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo date('d-m-Y', strtotime($contractor_details['agreement_fromdate'])); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Period To<span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo date('d-m-Y', strtotime($contractor_details['agreement_todate'])); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php if ($contractor_details['agreement_copy'] != '') {  ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $contractor_details['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Amount <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['agreement_amount']; ?>
                                                 </div>
                                             </div>
                                             
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Percentage(%) <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['perc_deduction']; ?>
                                                 </div>
                                             </div>


                                     <?php }
                                        } ?>
                                 </div>

                             </div>
                         </fieldset>
                     </div>
                 </div>
                 <?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) {  ?>
                     <div class="form-group" style="padding-top: 10px;">
                         <div class="offset-md-5 col-md-10">
                             <button type="submit" class="btn btn-info m-r-20">Submit</button>
                             <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                         </div>
                     </div>
                 <?php  } else { ?>
                     <div class="form-group" style="padding-top: 10px;">
                         <div class="offset-md-5 col-md-10">
                             <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
                         </div>
                     </div>
                 <?php } ?>
             </div>
         </div>
   </div>
 </div>
     <?php echo $this->Form->End(); ?>

     <script>
         function calculation(val) {
             var tender = <?php echo ($projectTenderDetail['tender_amount']) ? $projectTenderDetail['tender_amount'] : 0 ?>;
             var agreement = $("#agreement_amount").val();
              // alert(tender);
              // alert(agreement);

             if (agreement > tender) {
                 var calc = Math.round((parseFloat(agreement - tender) / tender) * 100);
                 $("#perc_deduction").val('+' + calc);
             } else if (agreement <= tender) {
                 var calc = Math.round((parseFloat(tender - agreement) / tender) * 100);
                 $("#perc_deduction").val('-' + calc);
             }
         }


         $('.datepicker1').flatpickr({
             dateFormat: "d-m-Y",
             allowInput: false
         });

         $("#FormID").validate({
             rules: {
                 'contractor_name': {
                     required: true
                 },
                 'contractor_mobile_no': {
                     required: true
                 },
                 'agreement_no': {
                     required: true
                 },
                 'agreement_date': {
                     required: true
                 },
                 'agreement_copy': {
                     <?php if ($contractor_detail_count == 0) { ?>
                         required: true
                     <?php } else { ?>
                         required: false
                     <?php } ?>
                 },
                 'agreement_fromdate': {
                     required: true
                 },
                 'agreement_todate': {
                     required: true
                 },
                 'agreement_amount': {
                     required: true
                 },
                 'work_order_refno': {
                     required: true
                 },
                 'work_order_copy': {
                    <?php if ($contractor_detail_count == 0) { ?>
                         required: true
                     <?php } else { ?>
                         required: false
                     <?php } ?>
                 }
             },
             messages: {
                 'contractor_name': {
                     required: "Enter Contractor Name"
                 },
                 'contractor_mobile_no': {
                     required: "Enter Contractor Mobile No"
                 },
                 'agreement_no': {
                     required: "Enter Agreement No"
                 },
                 'agreement_date': {
                     required: "Select Agreement Date"
                 },
                 'agreement_copy': {
                     required: "Select Agreement Copy"
                 },
                 'agreement_fromdate': {
                     required: "Select Agreement fromdate"
                 },
                 'agreement_todate': {
                     required: "Select Agreement todate"
                 },
                 'agreement_amount': {
                     required: "Enter Agreement amount"
                 },
                 'work_order_refno': {
                     required: "Enter Work Order Reference No."
                 },
                 'work_order_copy': {
                     required: "Select Work Order Copy"
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