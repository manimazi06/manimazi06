<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>

 <?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header>Fund Request View</header>
         </div>
		
			<div class="card-body">				
				  <h4 class = "sub-tile">Project Fund Request Details</h4>		 
				 <?php if($projectFundRequestdetails > 0){  ?>
				        <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;">
						<div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 bol">Request Date<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-4 lower bol">
                                    <?php echo date('d-m-Y',strtotime($projectFundRequest['request_date'])); ?>
									<?php echo $this->Form->control('request_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequest['id']]) ?>

                                </div>
								<div class="col-md-2"></div>
								<div class="col-md-4">
								 <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;" onclick="getrequest(<?php echo $projectFundRequest['id']; ?>);"><button type="button" class ="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i>view Stages</button></a>

								</div>
                            </div>								
                         </div> <br>
						
					     <div class="form-group">
							 <table id="answerTable" class="table  table-bordered  order-column"
								 style="max-width: 99%;margin-left: 1%;" bgcolor="white">
								 <thead>
									 <tr align="center">
										<th style="width:1%">S.No</th>
										<th style="width:8%">Work ID</th>
										<th style="width:10%">Work Name</th>
										<th style="width:5%">District</th>
										<th style="width:5%">Division</th>
										<th style="width:5%">Circle</th>
										<th style="width:10%">Agreement Amount<br>(in Rs.)</th>
										<th style="width:5%">Balance Payment<br>(in Rs.)</th>
										<th style="width:5%">Request Amount <br>(in Rs.)</th> 
										<?php  if($projectFundRequest['is_approved'] == 1){	 ?>
										<th style="width:5%">Transaction Amount <br>(in Rs.)</th> 
										<th style="width:10%">Balance Amount <br>(in Rs.)</th>
										<?php  } ?>										
									</tr>
								 </thead>
								 <tbody>
								  <?php  $i = 0;  foreach ($projectFundRequestdetails as $projectFundRequestdetail): ?>	
									 <tr align="center">
									   <td class="trcount"><?php echo $i+1; ?></td>
										<?php echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequestdetail['work_id']]); ?>
										 <td><?php echo $projectFundRequestdetail['work_code']; ?></td>
										 <td><?php echo $projectFundRequestdetail['work_name']; ?></td>
										 <td><?php echo $projectFundRequestdetail['district_name']; ?></td>								    
										 <td><?php echo $projectFundRequestdetail['division_name']; ?></td>
										 <td><?php echo $projectFundRequestdetail['circle_name']; ?></td>                                   
										 <td align="right"><?php echo ($projectFundRequestdetail['agreement_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['agreement_amount'],'INR'),'₹'):'0.00'; ?></td>
										 <td align="right"><?php echo ($projectFundRequestdetail['balance_payment'])?$projectFundRequestdetail['balance_payment']:ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['agreement_amount'],'INR'),'₹'); ?></td> 
										 <td align="right"><?php echo ($projectFundRequestdetail['request_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['request_amount'],'INR'),'₹'):'0.00'; ?></td>													 
										 <?php  if($projectFundRequest['is_approved'] == 1){	 ?>
										 <td align="right"><?php echo ($projectFundRequestdetail['transaction_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['transaction_amount'],'INR'),'₹'):'0.00'; ?></td>													 
										 <td align="right"><?php echo ($projectFundRequestdetail['final_balance'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['final_balance'],'INR'),'₹'):'0.00'; ?></td>													 
									     <?php } ?>
									</tr>
									  <?php 
									  $total_request_amount += $projectFundRequestdetail['request_amount'];									   
									  $total_trans_amount += $projectFundRequestdetail['transaction_amount'];									   
									  $i++;   endforeach; ?>
								 </tbody>
								 <tfoot>
									<tr>
									   <td colspan="8" align="right"><b>Total (in Rs.)</b></td>
									   <td align="right"><b><?php echo ($total_request_amount)?ltrim($fmt->formatCurrency((float)$total_request_amount,'INR'),'₹'):'0.00';   ?></b></td>
									    <?php  if($projectFundRequest['is_approved'] == 1){	 ?>
									   <td align="right"><b><?php echo ($total_trans_amount)?ltrim($fmt->formatCurrency((float)$total_trans_amount,'INR'),'₹'):'0.00';   ?></b></td>
									   
									   <td></td>
										<?php } ?>
									</tr>
								</tfoot>
							 </table>
						 </div>
					 </fieldset>
					  <?php  if($projectFundRequest['is_approved'] == 1){	 ?>

					  <h4 class = "sub-tile">Transaction Details</h4>
					    <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;">
						 
						 <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3 bol">Transaction Date<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php echo date('d-m-Y',strtotime($projectFundRequest['transaction_date'])); ?>

                                </div>
								 <label class="control-label col-md-3 bol">Transaction No<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php echo $projectFundRequest['transaction_ref_no']; ?>

                                </div>
                            </div>	
                             <div class="form-group row">
                                <label class="control-label col-md-3 bol">Transaction Amount (in Rs.)<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php //echo $projectFundRequest['total_transaction_amount']; ?>
                                    <?php echo ($projectFundRequest['total_transaction_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequest['total_transaction_amount'],'INR'),'₹'):'0.00'; ?>

                                </div>
								 
                            </div>								
                         </div>
					  </fieldset>
				   <?php }else if($projectFundRequest['is_approved'] == 2){  ?>
				   <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;">
						 
						 <div class="col-md-12">
                        
                             <div class="form-group row">
                                <label class="control-label col-md-3 bol">Remarks<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php echo $projectFundRequest['remarks']; ?>
                                </div>
								 
                            </div>								
                         </div>
					  </fieldset><br>
				   <?php } ?>
				   <?php }  ?>
				   <?php  if($projectFundRequest['received_flag'] == 1){ ?>

					  <h4 class = "sub-tile">Fund Received Details</h4>
					    <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;">
						 
						 <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3 bol">Received Date<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php echo date('d-m-Y',strtotime($projectFundRequest['amount_received_date'])); ?>

                                </div>
								 <label class="control-label col-md-3 bol">Remarks<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php echo $projectFundRequest['remarks']; ?>

                                </div>
                            </div>	
                      							
                         </div>
					  </fieldset><br>
				   <?php }  ?>

				 <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-5 col-md-6">				  
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
        'remarks': {
            required: false
        }
    },

    messages: {
     
        'fund_amount': {
            required: "Enter Request Amount"
        },
        'request_date': {
            required: "Select Request date"
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


	function calculateTotal(){		
	 var amount = 0;
	   $(".divided_amount").each(function() {
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }
			 
		});
		
		//alert(amount);
		 if(!isNaN(amount)){
		
		$('#total-transaction-amount').val(amount);
		
		}else{
			
		$('#total-transaction-amount').val('');

		}
		
	}


function calculatebalance(val,count){
var val;
var count;
var bal_amount = $('#project-'+count+'-balance-payment').val();
var balance      = parseFloat(bal_amount) - parseFloat(val); 

// alert(bal_amount);

  if(!isNaN(balance)){
	  
	$('#project-'+count+'-final-balance').val(balance);  
	var tot_tran = $('#total-transaction-amount').val();
	//alert(tot_tran);
	$('#transaction_amount').val(tot_tran);
  }
}		
	 
 </script>
