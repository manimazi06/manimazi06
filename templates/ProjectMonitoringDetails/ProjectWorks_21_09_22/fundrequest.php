<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>

 <?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header>Fund Request for <?php  echo $projectWorkSubdetail['work_code'];  ?></header>
         </div>
  	     <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
		
			<div class="card-body">
				 <legend class="bol" style="color: #0047AB; text-align: center;">Project Fund Request Details
					 </legend>
				 <?php if($fundrequestcount > 0){  ?>
				        <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;margin-bottom:1%; background-color:ghostwhite;">
					     <div class="form-group">
									 <table id="answerTable" class="table  table-bordered  order-column"
										 style="max-width: 98%;margin-left: 2%;" bgcolor="white">
										 <thead>
											 <tr align="center">
												 <th  style="width:5%"> S.No</th>
												 <th style="width:20%">Request Date</th>
												 <th style="width:20%">Fund Amount (in Rs.)</th>
												 <th style="width:20%">Balance Amount (in Rs.)</th>
												 <th style="width:20%">Status</th>
												 <th style="width:20%">Approved Date</th>
												 <th></th>
											 </tr>
										 </thead>
										 <tbody>
										  <?php  $i = 0;  foreach ($fund_requests as $fundrequest): ?>	
											 <tr align="center">
											   <td class="trcount"><?php echo $i+1; ?></td>
											 	<?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $fundrequest['id']]) ?>

												 <td><?php echo date('d-m-Y',strtotime($fundrequest['request_date'])) ?>
												 
												 </td>
												 <td><?php echo $fundrequest['fund_amount']; ?>
												 </td>
												 <td><?php echo $fundrequest['balance_amount']; ?>
												 </td>  
												  <td><?php echo ($fundrequest['is_approved'] == 1)?'Approved':(($fundrequest['is_approved'] == 2)?'Rejected':'Processing'); ?>
												 </td> 
                                                   <td><?php echo ($fundrequest['approval_date'] != '')?date('d-m-Y',strtotime($fundrequest['approval_date'])):''; ?>
												 
												 </td>  
												 <td> <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;" onclick="getrequest(<?php echo $fundrequest['id']; ?>);"><button type="button" class ="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i>view Stages</button></a>

												 
												 </td> 													 
											 </tr>
											  <?php $i++;   endforeach; ?>
										 </tbody>
									 </table>
						 </div>
					 </fieldset><br>
				 <?php }  ?>
				  
				<?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $currentfundrequest['id']]) ?>

				 <?php  if($role_id == 4 && $projectWorkSubdetail['fund_request_flag'] == 0){  ?>
				  	 <fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:1%">

					 <div class="col-md-12">
						 <div class="form-body row">
							 <?php //if ($requestcount == 0) { ?>
							 <div class="form-group">
								 <fieldset>
									 <table id="answerTable" class="table  table-bordered  order-column"
										 style="max-width: 98%;margin-left: 1%;">
										 <thead>
											 <tr align="center">
												 <th style="width:5%"> S.No</th>
												 <th style="width:20%">Request Date</th>
												 <th style="width:20%">Fund amount</th>
												 <th style="width:20%">Balance Amount (in Rs.)</th>
												 <th style="width:20%">Remarks</th>                                        
											 </tr>
										 </thead>
										 <tbody class="add_doc">
											 <tr class="present_row">
												 <td class="trcount">1</td>
												  <td><?php echo $this->Form->control('request_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select Request Date','required']) ?>
												 </td>
												 <td><?php echo $this->Form->control('fund_amount', ['id'=>'fund_amount','class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','onblur'=>'calling(this.value)']) ?>
												 </td>                                       
												 <td><?php echo $this->Form->control('balance_amount', ['id'=>'balance_amount','class' => 'form-control','readonly', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Balance Amount', 'type' => 'text',  'required','readonly']) ?>
												 </td>                                        
												 <td><?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>
												 </td>                                       
											 </tr>
										 </tbody>
									 </table>
								 </fieldset>
							 </div>							
						 </div>
					 </div>
					 </fieldset>

					  <?php }else if($role_id == 5 || $role_id == 6){ 
					      if($currentuser_id == $projectWorkSubdetail['fund_approval_user_id']){
					   ?>
					 	<fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:3%">

					     <div class="col-md-12" style="margin-top:">
						   <div class="form-group row">
							  <label class="control-label col-md-2 bol">Remarks. <span class="required">  </span></label>
								<div class="col-md-8">
									<?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							   </div>								
							</div>						                                 
                         </div> 
						</fieldset>						 
						<?php } }else if($role_id == 8){ 
					      if($currentuser_id == $projectWorkSubdetail['fund_approval_user_id']){
					   ?>
					    <fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:3%">

					     <div class="col-md-12" style="margin-top:">
						 
						    <div class="form-group row">
							  <label class="control-label col-md-2 bol">Status. <span class="required">  </span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('fund_status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'options' => $fundStatuses ,'empty'=>'-Select-','onchange'=>'loadstatus(this.value)']) ?>                     
							   </div>
							   <!--label class="control-label col-md-2 bol">Remarks. <span class="required">  </span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							   </div-->								
							</div>	
                             <div class="form-group row approved" style="display:none;">
							  <label class="control-label col-md-2 bol">Transaction Date <span class="required">  </span></label>
								<div class="col-md-4">
										<?php echo $this->Form->control('transaction_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Transaction Date','required']) ?>			
								</div>
														
							</div>
                            <div class="form-group row approved" style="display:none;">
							  <label class="control-label col-md-2 bol">Transaction Ref No. <span class="required">  </span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('transaction_ref_no', ['id'=>'transaction_ref_no','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Transaction Ref No.','required']) ?>
									</div>
							  <label class="control-label col-md-2 bol">Transaction Amount (in Rs.). <span class="required">  </span></label>
								<div class="col-md-4">
								<?php echo $this->Form->control('transaction_amount', ['id'=>'transaction_amount','class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Transaction Amount', 'type' => 'text','required']) ?>	
								</div>								
							</div>
							
                            <div class="form-group row notapproved"  style="display:none;">
							  <label class="control-label col-md-2 bol">Remarks. <span class="required">  </span></label>
								<div class="col-md-10">
									<?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							   </div>								
							</div>							
                         </div> 
						</fieldset>								 
					<?php } }else  if($role_id == 4 && $currentfundrequest['is_approved'] == 1){  ?>
                        <br><br>
	                     <fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:3%">

							<div class="col-md-12" style="margin-top:10px;">  
							   <div class="form-group row">
								  <label class="control-label col-md-2 bol">Status. <span class="required">  </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('fund_status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'options' => $fundStatuses ,'empty'=>'-Select-','onchange'=>'loaddetails(this.value)']) ?>                     
								   </div>								
								</div>						                                 
							 </div><br><br>	
                          <div class="col-md-12 amount_received" style="display:none;"> 							 
				             <!--div class="form-group">
							 <legend class="bol" style="color: #0047AB; text-align: center;"> Fund Received Details
					             </legend>
								 <fieldset>
									 <table id="answerTable" class="table  table-bordered  order-column"
										 style="max-width: 98%;margin-left: 1%;">
										 <thead>
											 <tr align="center">
												 <th style="width:5%"> S.No</th>
												 <th style="width:20%">Received Date</th>
												 <th style="width:20%">Transaction Ref No</th>
												 <th style="width:20%">Transaction Amount (in Rs.)</th>
												 <th style="width:20%">Remarks</th>                                        
											 </tr>
										 </thead>
										 <tbody class="add_doc">
											 <tr class="present_row">
												 <td class="trcount">1</td>
												  <td><?php echo $this->Form->control('amount_received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select Received Date','required']) ?>
												 </td>
												 <td><?php echo $this->Form->control('transaction_ref_no', ['id'=>'transaction_ref_no','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Transaction Ref No.','required']) ?>
												 </td>                                       
												 <td><?php echo $this->Form->control('transaction_amount', ['id'=>'transaction_amount','class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Transaction Amount', 'type' => 'text','required']) ?>
												 </td>                                        
												 <td><?php echo $this->Form->control('received_remarks', ['id'=>'received_remarks','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>
												 </td>                                       
											 </tr>
										 </tbody>
									 </table>
								 </fieldset>
							 </div-->
							  <div class="form-group row">
							    <label class="control-label col-md-2 bol">Amount Received Date <span class="required">  </span></label>
								<div class="col-md-4">
										<?php echo $this->Form->control('amount_received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select Received Date','required']) ?>			
								</div>
								 <label class="control-label col-md-2 bol">Remarks. <span class="required">  </span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('received_remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							   </div>									
						   	</div>
							 </div>
							  <div class="col-md-12 amount_not_received" style="display:none;">
						     <div class="form-group row">
							  <label class="control-label col-md-2 bol">Remarks. <span class="required"> * </span></label>
								<div class="col-md-8">
									<?php echo $this->Form->control('notreceived_remarks', ['id'=>'notreceived_remarks','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							   </div>								
							</div>						                                 
                         </div> 
					 </fieldset>
							 
                  <?php }  ?>		  
					
				 </fieldset>
				 <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-5 col-md-6">
					   <?php if($role_id == 4 && $projectWorkSubdetail['fund_request_flag'] == 0){  ?>
					   <?php echo $this->Form->control('fund_status_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => 2]) ?>

						 <button type="submit" class="btn btn-info m-r-20">Forward to SE</button>
					    <?php }elseif($role_id == 5){ 
                        if($currentuser_id == $projectWorkSubdetail['fund_approval_user_id']){
 					    ?>
					    <?php echo $this->Form->control('fund_status_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => 3]) ?>
						 <button type="submit" class="btn btn-info m-r-20">Forward to CE</button>
						<?php } }elseif($role_id == 6){ 
                          if($currentuser_id == $projectWorkSubdetail['fund_approval_user_id']){
						?>	 
					    <?php echo $this->Form->control('fund_status_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => 4]) ?>
						 <button type="submit" class="btn btn-info m-r-20">Forward to GM</button>
						<?php } }elseif($role_id == 8){  ?>	 
						 <button type="submit" class="btn btn-info m-r-20">Submit</button>
					  <?php }else if($role_id == 4 && $currentfundrequest['is_approved'] == 1){ ?>
					    <button type="submit" class="btn btn-info m-r-20">Submit</button>

					  <?php } ?>    
						 <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
					 </div>
				 </div>
			 </div>
       </div>
 </div> 
 <?php echo $this->Form->End(); ?>
  <div id="modal-add-unsent1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form add-unsent-form1">

                </div>
            </div>
        </div>
    </div>
</div>
 <script>
$("#FormID").validate({
    rules: {
    
        'fund_amount': {
            required: true
        },
        'request_date': {
            required: true
        },
        'sanctions_date': {
            required: true
        },
        'remarks': {
            required: false
        }
    },

    messages: {
     
        'fund_amount': {
            required: "Enter Fund Amount"
        },
        'request_date': {
            required: "Select request date"
        },
       
        'remarks': {
            required: "Enter remarks"
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


function calling(val){
	 <?php if($prerequestcount > 0){  ?>
	   var san    =  <?php echo $balance_amt; ?>;

	 
	 <?php  }else{ ?>
  var san    =  <?php echo $contractor_details['agreement_amount']; ?>;
	 <?php } ?>
  var amount = $("#fund_amount").val();

  if(amount>san){
    $("#fund_amount").val('');
    $("#balance_amount").val('');
   
    alert('Agreement amount is greater than sanctioned amount');

  }else if(amount<=san){
     // alert('fund amount processed');
      var calc = parseFloat(san - amount);

      //  alert(calc);
        $("#balance_amount").val(calc);

    
  }
  
}

   function getrequest(id) {
         //alert(id);
        $(".add-unsent-form1").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent1").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxgetrequeststages/' + id,
            success: function(data, textStatus) {
                // alert(data);
                $(".add-unsent-form1").html(data);
            }
        });
    }
	
	function loaddetails(id){
		//alert(id);
		var id;
		if(id == 7){
			$('#notreceived_remarks').val('');
		  $('.amount_not_received').hide();			
		  $('.amount_received').show();				
			
		}else if(id == 8){
		$('#amount-received-date').val('');	  
		//$('#transaction_ref_no').val('');	
		//$('#transaction_amount').val('');	
		$('#received_remarks').val('');	
			
		 $('.amount_received').hide();		
		 $('.amount_not_received').show();		
		}  		
	}
	
	function loadstatus(id){
	 var id;
	// alert(id);
		if(id == 5){
              $('#remarks').val('');
              $('.approved').show();			
		      $('.notapproved').hide();					
		
		}else if(id == 6){
			   $('#transaction_ref_no').val('');	
		       $('#transaction_amount').val('');	
			   $('.approved').hide();			
		       $('.notapproved').show();					
		
			
			
		}
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
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
 </script>
