

  <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>
 <ul class="nav nav-tabs">
    <li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'basicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>

    </li>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Administrative<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'administrativesanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Detailed<br>Estimate'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Financial<br>Sanctions'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Technical<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Tender<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'tenderdetails', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
        <a class="nav-link active">Contractor<br>Details</a>
    </li>
	 <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planning<br>Clearance</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">SiteHand<br>Over</a>
    </li>
</ul>

 <?php echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-body">
             <!--div class="form-body row"-->
                 <div class="card-body">
                     <div class="form-body row">
                         <h4 class="sub-tile">Contract Agreement Details</h4>
                         <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;">
                             <div class="form-body row">
                                 <div class="col-md-12">
                                     <div class="form-group row">

                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Contractor / Company Name<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_id', ['class' => 'form-select', 'options' => $contractor_type, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required','empty'=>'-Select-', 'onchange' => 'get_details(this.value)','value' =>$contractor_details['contractor_id']]); ?>
                                                 <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $contractor_details['id']]) ?>
                                                 <?php echo $this->Form->control('project_tender_detail_id', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $contractor_details['project_tender_detail_id']]); ?>

                                                </div>
                                         </div>
                                         <div class="form-group row contractor"  <?php if ($contractor_details['contractor_id'] == '') {  ?> style="display:none;" <?php } ?>>
                                             <label class="control-label col-md-3">Contractor Mobile No<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_mobile_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'disabled','value' =>$contractor_details['contractor']['mobile_no']]); ?>
                                             </div>
                                             <label class="control-label col-md-3">Contractor Email<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_email', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'disabled','value' => $contractor_details['contractor']['email']]); ?>
                                             </div>
                                         </div>
                                         <div class="form-group row contractor" <?php if ($contractor_details['contractor_id'] == '') {  ?> style="display:none;"<?php } ?>>
                                             <label class="control-label col-md-3">GST No<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('gst_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'disabled','value' => $contractor_details['contractor']['gst_no']]); ?>
                                             </div>
                                             <label class="control-label col-md-3">Contractor Address<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('address', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'disabled','value' => $contractor_details['contractor']['address']]); ?>
                                             </div>
                                         </div>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Work Order Reference No <span class="required"> &nbsp;&nbsp;: </span></label>
                                             <div class="col-md-3 lower">
                                                 <?php echo $this->Form->control('work_order_refno', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $contractor_details['work_order_refno'], 'type' => 'text']); ?>
                                             </div>
                                             <label class="control-label col-md-3">Work Order Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                             <div class="col-md-3 lower">
                                                 <?php echo $this->Form->control('work_order_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                                 <?php if ($contractor_details['work_order_copy'] != '') {  ?>
												         <?php echo $this->Form->control('work_order_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $contractor_details['work_order_copy']]); ?>

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
                                                 <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => $contractor_details['agreement_date'] ? date('d-m-Y', strtotime($contractor_details['agreement_date'])) : '', 'required']); ?>
                                             </div>
                                         </div>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Period. <span class="required"> * </span></label>
                                             <div class="col-md-9">
                                                 <?php echo $this->Form->control('agreement_period', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => $contractor_details['agreement_period']]); ?>
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
                                     </div>
                         </fieldset>
                     </div>
                 </div>
                 <div class="form-group" style="padding-top: 5px;">
                     <div class="offset-md-5 col-md-10">
                         <button type="submit" class="btn btn-info m-r-20">Save & Continue</button>
                         <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                     </div>
                 </div>
             </div>
         <!--/div-->
     </div>
 </div>
 <?php echo $this->Form->End(); ?>

 <script>
      function calculation(val) {
          var tender = <?php echo ($tender_amount) ? $tender_amount : 0 ?>;
          var agreement = $("#agreement_amount").val();
          // alert(tender);
          // alert(agreement);

          if (agreement > tender) {
              var calc = Math.round((parseFloat(agreement - tender) / tender) * 100);
              $("#perc_deduction").val('+' + calc);
          } else if (agreement < tender) {
              var calc = Math.round((parseFloat(tender - agreement) / tender) * 100);
              $("#perc_deduction").val('-' + calc);
          } else if (agreement == tender) {
              //var calc = Math.round((parseFloat(tender - agreement) / tender) * 100);
              $("#perc_deduction").val(0);
          }
      }


      $('.datepicker1').flatpickr({
          dateFormat: "d-m-Y",
          allowInput: false
      });

     $("#FormID").validate({
         rules: {
             'contractor_id': {
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
                 <?php if ($contractor_details['agreement_copy'] == '') { ?>
                     required: true
                 <?php } else { ?>
                     required: false
                 <?php } ?>
             },
             'agreement_fromdate': {
                 required: true,
                 //greaterThan: "#agreement-date"
             },
             'agreement_todate': {
                 required: true,
                 greaterThan: "#agreement-fromdate"
             },
             'agreement_period': {
                 required: true
             },
             'agreement_amount': {
                 required: true
             },
             'work_order_refno': {
                 required: true
             },
             'work_order_copy': {
                 <?php if ($contractor_details['work_order_copy'] =='') { ?>
                     required: true
                 <?php } else { ?>
                     required: false
                 <?php } ?>
             }
         },
         messages: {
             'contractor_id': {
                 required: "Select Contractor /Company"
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
                 required: "Select Agreement fromdate",
                 greaterThan: "should be greater than Agreement Date"
             },
             'agreement_todate': {
                 required: "Select Agreement todate",
                 greaterThan: "should be greater than Agreement fromdate"
             },
             'agreement_period': {
                 required: "Enter Agreement Period"
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

     function get_details(id) {
        // alert(id);
         if (id != '') {
             $('.contractor').show();
             $.ajax({
                 type: 'POST',
                 url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxcontractordetails/' + id,
                 success: function(data, textStatus) { //alert(data);
                     //$('#project').html(data);

                     var detail = JSON.parse(data);
                     $('#contractor-mobile-no').val(detail.mobile_no);
                     $('#contractor-email').val(detail.email);
                     $('#gst-no').val(detail.gst_no);
                     $('#address').val(detail.address);
                 }
             });
         } else {
             $('.contractor').hide();

             $('#contractor-mobile-no').val('');
             $('#contractor-email').val('');
             $('#gst-no').val('');
             $('#address').val('');


         }
     }
 </script>
