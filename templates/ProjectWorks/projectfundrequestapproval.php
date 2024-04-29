<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
 <?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header>Fund Request Approval</header>
         </div>		
			<div class="card-body">				
				  <h4 class = "sub-tile">Project Fund Request Details</h4>				 
				 <?php if($projectFundRequestdetails > 0){  ?>
				        <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;">
						<div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2 bol">Request Date<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-1 lower bol">
                                    <?php echo date('d-m-Y',strtotime($projectFundRequest['request_date'])); ?>
									<?php echo $this->Form->control('request_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequest['id']]) ?>
                                </div>
								 <label class="control-label col-md-2 bol">Division<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-1 lower bol">
                                    <?php echo $projectFundRequestdetails[0]['division_name']; ?>
                                </div>
								<label class="control-label col-md-2 bol">Circle<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-1 lower bol">
                                    <?php echo $projectFundRequestdetails[0]['circle_name']; ?>
                                </div>
								<div class="col-md-1"></div>
								<div class="col-md-1">
								 <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;" onclick="getrequest(<?php echo $projectFundRequest['id']; ?>);"><button type="button" class ="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i>view Stages</button></a>
								</div>
                            </div>								
                         </div> <br>						
					     <div class="form-group">
							 <table id="answerTable" class="table  table-bordered  order-column"
								 style="max-width: 99%;margin-left: 1%;" bgcolor="white">
								 <thead>
									 <tr align="center">
										<th style="width:1%"> S.No</th>
										<th style="width:8%">Work ID</th>
										<th style="width:20%">Work Name</th>
										<!--th style="width:5%">District</th-->
										<th style="width:5%">GO No.</th>
										<th style="width:5%">Financial Sanction Excluding SC <br>(in Rs.)</th>	
                                        <th style="width:10%">Expenditure Incurred So Far <br>(in Rs.)</th>										
										<!--th style="width:5%">Balance Payment<br>(in Rs.)</th-->
										<th style="width:10%">Request Amount <br>(in Rs.)</th> 
									    <?php  if($role_id == 4 && $projectFundRequest['is_approved'] == 1){	 ?>
										<th style="width:5%">Transaction Amount <br>(in Rs.)</th> 
									    <?php } ?>							
										<th style="width:12%">Balance Amount <br>(in Rs.)</th> 
									</tr>
								 </thead>
								 <tbody>
								  <?php  $i = 0;  foreach ($projectFundRequestdetails as $projectFundRequestdetail): ?>	
									 <tr align="center">
									   <td class="trcount"><?php echo $i+1; ?></td>
										<?php echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequestdetail['work_id']]); ?>
										<?php echo $this->Form->control('project.'.$i.'.subrequest_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequestdetail['request_detail_id']]); ?>
										 <td><?php echo $projectFundRequestdetail['work_code']; ?></td>
										 <td><?php echo $projectFundRequestdetail['work_name']; ?></td>
										 <!--td><?php echo $projectFundRequestdetail['district_name']; ?></td-->
										 <td align="right"><?php echo $projectFundRequestdetail['fsgo_no']; ?></td>                                        
										 <td align="right"><?php echo ($projectFundRequestdetail['fs_excluding_sc'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['fs_excluding_sc'],'INR'),'₹'):'0.00'; ?></td>
										 <td align="right"><?php echo ($projectFundRequestdetail['expenditure_incurred'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['expenditure_incurred'],'INR'),'₹'):0; ?></td> 
										 <?php //echo ($projectFundRequestdetail['request_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['request_amount'],'INR'),'₹'):'0.00'; ?>
										 <td>
										   <?php echo $this->Form->control('project.'.$i.'.request_amount', ['class' => 'form-control amount divided_amount req_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Request Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal();calculatebalance(this.value,'.$i.')','data-rule-required'=>true,'data-msg-required'=>'Enter Request Amount','value'=>$projectFundRequestdetail['request_amount']]) ?>
										   <?php echo $this->Form->control('project.'.$i.'.expenditure_incurred', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> ($projectFundRequestdetail['expenditure_incurred'])?$projectFundRequestdetail['expenditure_incurred']:0]) ?>
										   <?php echo $this->Form->control('project.'.$i.'.fs_excluding_sc', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> ($projectFundRequestdetail['fs_excluding_sc'])?$projectFundRequestdetail['fs_excluding_sc']:0]) ?>
											<?php echo $this->Form->control('project.'.$i.'.project_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectFundRequestdetail['project_id']]) ?>
										</td>								 
										<?php  if($role_id == 4 && $projectFundRequest['is_approved'] == 1){	 ?>
										 <td align="right"><?php echo ($projectFundRequestdetail['transaction_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['transaction_amount'],'INR'),'₹'):'0.00'; ?></td>													 
										 <td align="right"><?php echo ($projectFundRequestdetail['final_balance'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['final_balance'],'INR'),'₹'):'0.00'; ?></td>													 
										 <?php }else{ ?>				
										 <!--td align="right"><?php //echo ($projectFundRequestdetail['balance_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['balance_amount'],'INR'),'₹'):'0.00'; ?></td-->													 
										 <td>
										   <?php echo $this->Form->control('project.'.$i.'.balance_amount', ['class' => 'form-control amount bal_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Balance Amount','min'=>0,'maxlength'=>13,'readonly','value'=>$projectFundRequestdetail['balance_amount']]) ?>
										</td>
										<?php } ?>							 
									 </tr>
									  <?php 
									  $total_request_amount += $projectFundRequestdetail['request_amount'];									   
									  $total_trans_amount += $projectFundRequestdetail['transaction_amount'];									   
									  $i++;   endforeach; ?>
								 </tbody>
								 <tfoot>
									<tr>
									   <td  <?php  if($role_id == 4 && $projectFundRequest['is_approved'] == 1){	 ?> colspan="6" <?php }else{ ?> colspan="6" <?php } ?> align="right"><b>Total (in Rs.)</b></td>
									   <!--td align="right"><b><?php //echo ($total_request_amount)?ltrim($fmt->formatCurrency((float)$total_request_amount,'INR'),'₹'):'0.00';   ?></b></td-->
									   	 <td><?php echo $this->Form->control('total_request_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly','value'=>$total_request_amount]) ?></td>

									   <?php  if($role_id == 4 && $projectFundRequest['is_approved'] == 1){	 ?>
									   <td align="right"><b><?php echo ($total_trans_amount)?ltrim($fmt->formatCurrency((float)$total_trans_amount,'INR'),'₹'):'0.00';   ?></b></td>
									   <?php } ?>
									   <td></td>
									</tr>
								</tfoot>
							 </table>
						 </div>
					 </fieldset><br>
					  <?php  if($role_id == 4 && $projectFundRequest['is_approved'] == 1){	 ?>
					  <h4 class = "sub-tile">Transaction Details</h4>
					    <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;">
						 
						 <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3 bol">Transaction Date<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php echo date('d-m-Y',strtotime($projectFundRequest['transaction_date'])); ?>
                                </div>
								<label class="control-label col-md-3 bol">Total Transaction Amount (in Rs.)<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php //echo $projectFundRequest['total_transaction_amount']; ?>
                                    <?php echo ($projectFundRequest['total_transaction_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequest['total_transaction_amount'],'INR'),'₹'):'0.00'; ?>
                                </div>
								 <!--label class="control-label col-md-3 bol">Transaction No<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php //echo $projectFundRequest['transaction_ref_no']; ?>
                                </div-->  
                            </div>	
                             <!--div class="form-group row">
                                <label class="control-label col-md-3 bol">Transaction Amount (in Rs.)<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-3 lower bol">
                                    <?php //echo $projectFundRequest['total_transaction_amount']; ?>
                                    <?php echo ($projectFundRequest['total_transaction_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequest['total_transaction_amount'],'INR'),'₹'):'0.00'; ?>
                                </div>
                            </div-->  								
                         </div>
					  </fieldset><br>                      
				   <?php }  ?>
				   <?php }  ?>	  
				  <?php  if(($role_id == 4 ||$role_id == 5 || $role_id == 6) && $projectFundRequest['is_approved'] == 0){ 
					      if($currentuser_id == $projectFundRequest['user_id']){
					   ?>
					 	<fieldset	 style="border:1px solid #00355F;border-radius:10px; padding:15px;margin-left:1px;margin-bottom:1%">

					     <div class="col-md-12" style="margin-top:">
						   <div class="form-group row">
							  <label class="control-label col-md-2 bol">Remarks. <span class="required">  </span></label>
								<div class="col-md-8">
									<?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							   </div>								
							</div>						                                 
                         </div> 
						</fieldset>						 
						<?php } }else if($role_id == 16){ 
					      if($currentuser_id == $projectFundRequest['user_id']){
					   ?>
					    <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;margin-bottom:1%">
					     <div class="col-md-12" style="margin-top:">						 
						    <div class="form-group row">
							  <label class="control-label col-md-2 bol">Status. <span class="required">  </span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('fund_status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'options' => $fundStatuses ,'empty'=>'-Select-','onchange'=>'loadstatus(this.value)']) ?>                     
							   </div>
							     <label class="control-label col-md-2 approved bol" style="display:none;">Transaction Date <span class="required">  </span></label>
								<div class="col-md-4 approved" style="display:none;">
										<?php echo $this->Form->control('transaction_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Transaction Date','required']) ?>			
								</div>							
							</div>	
                             <div class="form-group row approved" style="display:none;">							  
								  <!--label class="control-label col-md-2 bol">Transaction Ref No. <span class="required">  </span></label>
								   <div class="col-md-4">
									<?php //echo $this->Form->control('transaction_ref_no', ['id'=>'transaction_ref_no','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Transaction Ref No.','required']) ?>
									</div-->						
							 </div><br>  
							 <div class="form-group approved" style="display:none;margin-top:10px;">
							  <h4 class = "sub-tile">Division of Transaction Amount</h4>
							 <table id="answerTable" class="table  table-bordered  order-column"
								 style="max-width: 99%;margin-left: 1%;" bgcolor="white">
								 <thead>
									 <tr align="center">
										<th style="width:1%"> S.No</th>
										<th style="width:8%">Work ID</th>
										<th style="width:20%">Work Name</th>
										<th style="width:5%">Financial Sanction Excluding SC <br>(in Rs.)</th>										
										<th style="width:8%">Expenditure Incurred So Far <br>(in Rs.)</th>	
										<th style="width:5%">Request Amount <br>(in Rs.)</th>   
										<th style="width:10%">Transaction Amount <br>(in Rs.)</th>   
										<th style="width:10%">Balance Amount <br>(in Rs.)</th> 
									</tr>
								 </thead>  
								 <tbody>
								     <?php  $j = 0;  foreach ($projectFundRequestdetails as $projectFundRequestdetail): ?>	
									 <tr align="center">
									   <td class="trcount"><?php echo $j+1; ?></td>
										<?php echo $this->Form->control('project1.'.$j.'.id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequestdetail['work_id']]); ?>
										<?php  echo $this->Form->control('project1.'.$j.'.request_detail_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $projectFundRequestdetail['request_detail_id']]); ?>
										 <td><?php echo $projectFundRequestdetail['work_code']; ?></td>
										 <td><?php echo $projectFundRequestdetail['work_name']; ?></td>
										 <td align="right"><?php echo ($projectFundRequestdetail['fs_excluding_sc'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['fs_excluding_sc'],'INR'),'₹'):'0.00'; ?></td>
										 <td align="right"><?php echo ($projectFundRequestdetail['expenditure_incurred'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['expenditure_incurred'],'INR'),'₹'):0; ?></td> 
										 <td align="right"><?php echo ($projectFundRequestdetail['request_amount'])?ltrim($fmt->formatCurrency((float)$projectFundRequestdetail['request_amount'],'INR'),'₹'):'0.00'; ?></td>													 
									     <td align="right"> <?php echo $this->Form->control('project1.'.$j.'.transaction_amount', ['class' => 'form-control amount divided_amount1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Request Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal1();calculatebalance1(this.value,'.$j.')','data-rule-required'=>true,'data-msg-required'=>'Enter Request Amount','value'=>$projectFundRequestdetail['request_amount']]) ?>
										   <?php // echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectFundRequestdetail['project_work_subdetail_id']]) ?>
										   <?php echo $this->Form->control('project1.'.$j.'.project_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectFundRequestdetail['project_work_id']]) ?>
										    <?php //echo $this->Form->control('project1.'.$j.'.balance_payment', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> ($projectFundRequestdetail['final_balance'])?$projectFundRequestdetail['final_balance']:$projectFundRequestdetail['agreement_amount']]) ?>
											<?php //echo $this->Form->control('project1.'.$j.'.balance_payment', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> ($projectFundRequestdetail['balance_amount'])?$projectFundRequestdetail['balance_amount']:$projectFundRequestdetail['sanctioned_amount']]) ?>
										    <?php echo $this->Form->control('project1.'.$j.'.fs_excluding_sc', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=>  $projectFundRequestdetail['fs_excluding_sc']]) ?>
										    <?php echo $this->Form->control('project1.'.$j.'.expenditure_incurred', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=>  $projectFundRequestdetail['expenditure_incurred']]) ?>

										</td>
										<td>
										   <?php echo $this->Form->control('project1.'.$j.'.final_balance', ['class' => 'form-control amount bal_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Balance Amount','min'=>0,'maxlength'=>13,'readonly','value'=>$projectFundRequestdetail['balance_amount']]) ?>
										</td>
									 </tr>
									  <?php 
									  $total_request_amount1 += $projectFundRequestdetail['request_amount'];									   
									  //$total_request_amount1 += $projectFundRequestdetail['request_amount'];									   
									  $j++;   endforeach; ?>
								 </tbody>
								 <tfoot>
									<tr>
									   <td colspan="6" align="right"><b>Total (in Rs.)</b></td>
									   <td align="right"><b><?php echo ($total_request_amount1)?ltrim($fmt->formatCurrency((float)$total_request_amount1,'INR'),'₹'):'0.00';   ?></b></td>
									   <td><?php echo $this->Form->control('total_transaction_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly','value'=>$total_request_amount1]) ?></td>
									</tr>
								</tfoot>
							 </table>
						 </div>
                            <div class="form-group row approved" style="display:none;">							 
							  <label class="control-label col-md-2 bol">Total Transaction Amount (in Rs.). <span class="required">  </span></label>
								<div class="col-md-4">
								<?php echo $this->Form->control('transaction_amount', ['id'=>'transaction_amount','class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Transaction Amount', 'type' => 'text','readonly','value'=>$total_request_amount1]) ?>	
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
					<?php } }else  if($role_id == 15 && $projectFundRequest['is_approved'] == 1){  ?>
	                     <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;margin-bottom:1%">
							<div class="col-md-12" style="margin-top:10px;">  
							   <div class="form-group row">
								  <label class="control-label col-md-2 bol">Status. <span class="required">  </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('fund_status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'options' => $fundStatuses ,'empty'=>'-Select-','onchange'=>'loaddetails(this.value)']) ?>                     
								   </div>								
								</div>						                                 
							 </div><br><br>	
                          <div class="col-md-12 amount_received" style="display:none;">		 
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
					    <?php  if($role_id == 4 && $projectFundRequest['is_approved'] == 0){  ?> 
						<?php echo $this->Form->control('fund_status_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => 2]) ?>						 
						 <button type="submit" class="btn btn-info m-r-20">Forward to SE</button>
					    <?php }elseif($role_id == 5){ 
                        if($currentuser_id == $projectFundRequest['user_id']){
 					    ?>
					    <?php echo $this->Form->control('fund_status_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => 3]) ?>
						 <button type="submit" class="btn btn-info m-r-20">Forward to CE</button>
						<?php } }elseif($role_id == 6){ 
                          if($currentuser_id == $projectFundRequest['user_id']){
						?>	 
					    <?php echo $this->Form->control('fund_status_id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => 4]) ?>
						 <button type="submit" class="btn btn-info m-r-20">Forward to GM</button>
						<?php } }elseif($role_id == 16){  ?>	 
						 <button type="submit" class="btn btn-info m-r-20">Submit</button>
					  <?php }else if($role_id == 15 && $projectFundRequest['is_approved'] == 1){ ?>
						<?php echo $this->Form->control('request_date', ['label' => false, 'error' => false, 'type' => 'hidden','value' => date('d-m-Y',strtotime($projectFundRequest['request_date']))]) ?>						 
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
 
 <?php if($role_id == 16 || ($role_id == 4 && $projectFundRequest['is_approved'] == 1)){ ?>
 $(".req_amount").prop('disabled', true);  
 <?php } ?>
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
            url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxgetrequeststages/' + id,
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
		$('#total-request-amount').val(amount);		
		}else{			
		$('#total-request-amount').val('');
		}		
	}


/*function calculatebalance(val,count){
var val;
var count;
var bal_amount = $('#project-'+count+'-balance-payment').val();
var balance      = parseFloat(bal_amount) - parseFloat(val); 
//alert(balance);
  if(!isNaN(balance)){	  
	$('#project-'+count+'-balance-amount').val(balance);  
  }
}*/

function calculatebalance(val,count){
var val;
var count;
var inn_expen  = $('#project-'+count+'-expenditure-incurred').val();
var req_amt    = $('#project-'+count+'-request-amount').val();

if(inn_expen == ''){		
inn_expen = 0;
}

if(req_amt == ''){		
req_amt = 0;
}

var tot_ex      = parseFloat(inn_expen) + parseFloat(req_amt);
var fin_sc      = $('#project-'+count+'-fs-excluding-sc').val();
 // alert(fin_sc);
 // alert(inn_expen);
 // alert(req_amt);  
if(!isNaN(tot_ex)){
//var bal_amount = $('#project-'+count+'-balance-payment').val();
var balance      = parseFloat(fin_sc) - parseFloat(tot_ex); 
}
// alert(balance);
  if(!isNaN(balance)){
	  
	$('#project-'+count+'-balance-amount').val(balance);  
  }
}	

function calculateTotal1(){		
 var amount1 = 0;
   $(".divided_amount1").each(function() {		   
	   if(parseFloat(this.value) != 'NAN'){
		 amount1 += parseFloat(this.value);
	   }			 
	});		
	//alert(amount);
	 if(!isNaN(amount1)){		
	$('#total-transaction-amount').val(amount1);		
	}else{			
	$('#total-transaction-amount').val('');
	}		
}

/*function calculatebalance1(val1,count1){
var val1;
var count1;
var bal_amount = $('#project1-'+count1+'-balance-payment').val();
var balance1      = parseFloat(bal_amount) - parseFloat(val1); 

//alert(balance1);

  if(!isNaN(balance1)){
	  
	$('#project1-'+count1+'-final-balance').val(balance1);  
	var tot_tran = $('#total-transaction-amount').val();
	//alert(tot_tran);
	$('#transaction_amount').val(tot_tran);
  }
}*/	


function calculatebalance1(val,count1){
var val;
var count;
var inn_expen1  = $('#project1-'+count1+'-expenditure-incurred').val();
var req_amt1    = $('#project1-'+count1+'-transaction-amount').val();

 // alert(inn_expen1);
  // alert(req_amt1);

if(inn_expen1 == ''){		
inn_expen1 = 0;
}

if(req_amt1 == ''){		
req_amt1 = 0;
}

var tot_ex1      = parseFloat(inn_expen1) + parseFloat(req_amt1);
var fin_sc1      = $('#project1-'+count1+'-fs-excluding-sc').val();
  
if(!isNaN(tot_ex1)){
//var bal_amount = $('#project-'+count+'-balance-payment').val();
var balance1      = parseFloat(fin_sc1) - parseFloat(tot_ex1); 
}
// alert(balance);
  if(!isNaN(balance1)){
	  
	$('#project1-'+count1+'-final-balance').val(balance1); 
   var tot_tran = $('#total-transaction-amount').val();
	//alert(tot_tran);
	$('#transaction_amount').val(tot_tran);
  }
}	
	 
 </script>
