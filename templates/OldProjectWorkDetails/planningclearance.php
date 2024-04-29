 <div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
		<div class="card-body">
				 <h4 class = "sub-tile"><?php echo $projectwork['project_name']; ?></h4>
		
        </div>
        </div>
    </div>
</div><br>
 <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>
 <ul class="nav nav-tabs">
     <?php if($work_type == 1){  ?>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'basicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <?php }else{ ?>
	<li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'repairbasicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
	<?php } ?>
	 <?php //if($work_type == 1){  ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Administrative<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'administrativesanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php //} ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Detailed<br>Estimate'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php if($work_type == 1 && $oldProjectWorkDetail['skip_fs_flag'] == 0){  ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Financial<br>Sanctions'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	  <?php } ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Technical<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Tender<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'tenderdetails', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
     <?php echo $this->Html->link(__('Contractor<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'contractors', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	  <?php if($work_type == 1){  ?>
     <li class="nav-item">
         <a class="nav-link active">Planning<br>Clearance</a>
     </li>
	  <?php } ?>
	 <li class="nav-item">
         <a class="nav-link disabled">SiteHand<br>Over</a>
     </li>
 </ul>
 <?php echo $this->Form->create($planningPermissionDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
 <div class="col-md-12">
     <div class="card card-topline-aqua">       
         <div class="card-body">
		    <?php if ($totalunit) { ?>					
				<h4 class="sub-tile">Floor and Area Details</h4>
			  <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">
				  <div class="col-md-12">
					  <?php //echo $this->Form->create($tentativeFinancialProgrammeDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
					  <div class="card card-topline-aqua">                                  
						  <div class="form-group row">
							  <label class="control-label col-md-2">Total Unit<span class=" required">*</span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('total_units', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Total units', 'readonly', 'value' => $totalunit]); ?>
							  </div>
						  </div>
						  <div class="card-body">
							  <div class="col-md-10" offset="2">
								  <div class="form-body row">
									  <div class="col-md-12">
										 
										  <!-- <?php echo $projectwisefloorDetail['id']; ?> -->
										  <?php if ($projectwisefloorSubdetailcount > 0) { ?>
											  <center>
												  <table class="table table-bordered order-column" style="width: 60%">
													  <thead>
														  <tr class="text-center">
															  <th width="5%"> Sno </th>
															  <th width="15%">Floors</th>
															  <th width="15%">Area (sq.m)</th>
														  </tr>
													  </thead>
													  <tbody>
														  <?php  $s=1;
														  foreach ($projectwisefloorSubdetail as $key => $projectwisefloorSubdetai) {  // echo"<pre>";print_r($key);?>
																  <tr class="text-center">
																	  <td class="text-center"><?php echo $s; ?></td>
																	  <td class="title"><?php echo $this->Form->control('floors.' . $key . '.no_of_floor', ['class' => 'form-control num', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'No of Floors', 'data-rule-required' => true, 'data-msg-required' => 'Enter Floor', 'required', 'value' => $projectwisefloorSubdetai['no_of_floor']]); ?>
																		  <?php echo $this->Form->control('floors.' . $key . '.id', ['class' => 'form-control num', 'type' => 'hidden', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => $projectwisefloorSubdetai['id']]); ?>
																	  <td class="title"><?php echo $this->Form->control('floors.' . $key . '.area_in_square_meter', ['class' => 'form-control amount', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'Area  (sq.m)', 'data-rule-required' => true, 'data-msg-required' => 'Enter Area Square meter', 'required', 'value' => $projectwisefloorSubdetai['area_in_square_meter']]); ?></td>
																  </tr>
														  <?php $s++; }// exit();?>

													  </tbody>
												  </table>
											  </center>
										  <?php } elseif ($projectwisefloorSubdetailcount == 0) {  ?>
											<center>
											  <table class="table table-bordered order-column" style="width: 60%">
												  <thead>
													  <tr class="text-center">
														  <th width="5%"> Sno </th>
														  <th width="15%">Floors</th>
														  <th width="15%">Area (sq.m)</th>
													  </tr>
												  </thead>
												  <tbody>
													  <?php for ($x = 1; $x <= $totalunit; $x++) {


														  ?>

														  <tr class="text-center">
															  <td class="text-center"><?php echo $x; ?></td>
															  <td class="title"><?php echo $this->Form->control('floors.' . $x . '.no_of_floor', ['class' => 'form-control num', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'No of Floors', 'data-rule-required' => true, 'data-msg-required' => 'Enter Floor', 'required']); ?>
															  </td>
															  <td class="title"><?php echo $this->Form->control('floors.' . $x . '.area_in_square_meter', ['class' => 'form-control amount', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'Area (sq.m)', 'data-rule-required' => true, 'data-msg-required' => 'Enter Area Square meter', 'required']); ?></td>
														  </tr>
													  <?php } ?>
												  </tbody>
											  </table>
											  </center>
										  <?php } ?>
									  </div>
								  </div>
							  </div>
						  </div>
					  </div>
					  <?php //echo $this->Form->End(); ?>
				  </div>
			  </fieldset>
		  <?php  } ?>

		  <h4 class="sub-tile">Planning Clearance Details</h4>
		  
		  <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">
		  
		         <div class="form-body row">
					  <div class="col-md-12">
						  <div class="form-group row">
							  <label class="control-label col-md-4">Is Planning Clearance approval send ?<span class=" required">*</span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('is_planning_approval_send', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'empty' => 'select', 'options' => $apporved, 'label' => false, 'error' => false, 'required', 'onchange' => 'planningapprovalsend(this.value)','value'=>$projectWorkSubdetail['is_planning_approval_send']]); ?>
							  </div>
							  
						  </div>						  
					  </div>
				  </div>
				  <div class="form-body row approvalsend" <?php if($projectWorkSubdetail['is_planning_approval_send'] != 1){  ?>style="display:none;" <?php } ?>>
					  <div class="col-md-12">
						  <div class="form-group row">
							  <label class="control-label col-md-2">Send Date<span class=" required">*</span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('send_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required', 'value' => ($planingdetail['send_date'])?date('d-m-Y', strtotime($planingdetail['send_date'])):'']); ?>
							      <?php if ($Planningcount > 0) { ?>
								  <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $planingdetail->id]); ?>
								  <?php } ?>
							  </div>
							  <label class="control-label col-md-2">Is Project Approved ?<span class="required">*</span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('is_permission_apporved', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'empty' => 'select status', 'options' => $apporved, 'label' => false, 'error' => false, 'required', 'onchange' => 'apporvedtype(this.value)', 'value' => $planingdetail['is_permission_approved']]); ?>
							  </div>
						  </div>
						  <div class="form-group row approved" <?php if ($planingdetail['is_permission_approved'] != 1) { ?> style="display:none;" <?php } ?>>
							  <label class="control-label col-md-2">Approved Date<span class=" required">* </span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('approved_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required', 'id' => 'approveddate', 'value' => ($planingdetail['approved_date']) ? date('d-m-Y', strtotime($planingdetail['approved_date'])) : '']); ?>
							  </div>
						  </div>
						  <div class="form-group row approved" <?php if ($planingdetail['is_permission_approved'] != 1) { ?> style="display:none;" <?php } ?>>
							  <label class="control-label col-md-2">Planning Permission Upload<span class=" required">* <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)
								  </span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('permission_apporved_copy', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'id' => 'approvedfile']); ?>
							      <?php if($planingdetail['permission_apporved_copy'] != ''){ ?>
								  <?php echo $this->Form->control('permission_apporved_copy1', ['type' => 'hidden', 'label' => false,'value'=>$planingdetail['permission_apporved_copy']]); ?>
										 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/PlanningPermissions/'.$planingdetail['permission_apporved_copy'], ['fullBase' => true]); ?>"
										target="_blank"><span><ion-icon name="document-text-outline"></ion-icon>View</span></a>  
								  <?php } ?>
							</div>
							  <label class="control-label col-md-2">Plan Drawing Upload<span class=" required">* <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)
								  </span></label>
							  <div class="col-md-4">
								  <?php echo $this->Form->control('drawing_copy', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'id' => 'approvedfile', 'data-rule-required' => true, 'data-msg-required' => 'Select Document', 'required']); ?>
							      <?php if($planingdetail['drawing_copy'] != ''){ ?>
								  <?php echo $this->Form->control('drawing_copy1', ['type' => 'hidden', 'label' => false,'value'=>$planingdetail['drawing_copy']]); ?>
										 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/DrawingCopy/'.$planingdetail['drawing_copy'], ['fullBase' => true]); ?>"
										target="_blank"><span><ion-icon name="document-text-outline"></ion-icon>View</span></a>  
								  <?php } ?>
							  </div>
						  </div>
						  <div class="form-group row">

							  <label class="control-label col-md-2 remarks" <?php if ($planingdetail['is_permission_approved'] != 2) { ?> style="display: none;" <?php } ?>>Reason for Non Approval<span class=" required"> *
								  </span></label>
							  <div class="col-md-4 remarks" <?php if ($planingdetail['is_permission_approved'] != 2) { ?> style="display: none;" <?php } ?>>
								  <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks', 'type' => 'textarea', 'required', 'rows' => '3', 'id' => 'remarks','value' => $planingdetail['remarks']]); ?>
							  </div>
						  </div>
					  </div>
				  </div>
				  <div class="form-body row approvalnotsend" <?php if($projectWorkSubdetail['is_planning_approval_send'] != 2){  ?> style="display:none;" <?php } ?>>
					  <div class="col-md-12">
				       <div class="form-group row">
							  <label class="control-label col-md-4 remarks">Reason for not sending planning clearance for approval<span class=" required"> *
								  </span></label>
							  <div class="col-md-8 remarks">
								  <?php echo $this->Form->control('permission_not_send_remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks', 'type' => 'textarea', 'required', 'rows' => '3','value'=>$projectWorkSubdetail['permission_not_send_remarks']]); ?>
							  </div>
						  </div>
						</div>
				  </div>			
		  </fieldset> 
			 
         </div>
         <div class="form-group" style="padding-top: 10px;">
             <div class="offset-md-5 col-md-10">
                 <button type="submit" class="btn btn-info m-r-20">Save & Continue</button>
                 <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
             </div>
         </div>
     </div>
 </div>


 <?php echo $this->Form->End(); ?>
  <script>
      function apporvedtype(id) {
          // alert(id)
          if (id == 1) {
              $('.approved').show();
              $('.remarks').hide();
              $('#remarks').val('');
          } else if (id = 2) {
              $('.remarks').show();
              $('.approved').hide();
              $('#approveddate').val('');
              $('#approvedfile').val('');
          }
      }

      $('.datepicker1').flatpickr({
          dateFormat: "d-m-Y",
          allowInput: false
      });

      $("#FormID").validate({
          rules: {			  
              'is_planning_approval_send': {
                  required: true
              },	
              'send_date': {
                  required: true
              },
              'approved_date': {
                  required: true
              },              
              'remarks': {
                  required: true
              },
              'is_permission_apporved': {
                  required: true
              },			  
			  <?php if($Planningcount == 0){  ?>
			  'permission_apporved_copy': {
                  required: true
              },
              'drawing_copy': {
                  required: true
              }
			  <?php }else{  ?>
			    'permission_apporved_copy': {
                  required: false
              },
                'drawing_copy': {
                  required: false
              }
			  <?php } ?>

          },

          messages: {
			   'is_planning_approval_send': {
                  required: "Select"
              },	
              'send_date': {
                  required: "Select Date"
              },
              'approved_date': {
                  required: "Select Date"
              },              
              'remarks': {
                  required: "Enter Remarks"
              },
              'is_permission_apporved': {
                  required: "Select Is Permission Approved"
              },
			  'permission_apporved_copy': {
                  required: "Select Document"
              },
              'drawing_copy': {
                  required: "Select Document"
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
              if (file_size >= 5242880) {
                  alert("File Maximum size is 5MB");
                  oInput.value = "";
                  return false;
              }

          }
          return true;
      }

      // function toggledetail() {
          // $('#project').toggle();

      // }

      // $(document).ready(function() {
          // var ProjectID = <?php echo $id;  ?>;
          // var ProjectSubID = <?php echo $work_id;  ?>;
          // if (ProjectID != '' && ProjectSubID != '') {
              // $.ajax({
                  // type: 'POST',
                  // url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' +
                      // ProjectID + '/' + ProjectSubID,
                  // success: function(data, textStatus) { //alert(data);
                      // $('#project').html(data);
                  // }
              // });
          // }
      // });
	  
	  
	  function planningapprovalsend(id){
		  var id;
		  if(id == 1){
			   $('#permission-not-send-remarks').val('');	
			   $('.approvalsend').show();	
			   $('.approvalnotsend').hide();
               $("#permission-not-send-remarks").attr("required", false);			   
			   
		  }else{
               $('#send-date').val('');	
               $('#approveddate').val('');
               $('#approvedfile').val('');			   
			   $('.approvalsend').hide();
			   $('.approvalnotsend').show();	
			   $("#permission-not-send-remarks").attr("required", true);
		  }  
	  }
  </script>
