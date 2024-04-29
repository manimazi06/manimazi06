
 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>

<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
     <div class="col-md-12">
    <div class="card card-topline-aqua">
	         <div class="card-body">

				<div class="card-head">
					<header>Work Details - <?php echo $projectWorkSubdetail['work_code']; ?></header>
				</div>
		<?php  if($detailed_estimates_count > 0){ ?>		
			<div class="card-body" style="margin-top:20px;">			  
			  <div class="table-scrollable">
					<legend class="bol" style="color: #0047AB; text-align: center;">Detailed Estimate List</legend>  
						<table class="table table-hover table-bordered table-advanced display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%"> S.No</th>
									<th style="width:10%">Item Code</th>
									<th style="width:20%">Item Description</th>
									<th style="width:10%">Quantity</th>
									<th style="width:10%">Unit</th>
									<th style="width:10%">Approved Estimate (per unit)</th>
									<th style="width:10%">Total Cost</th>								
								</tr>
							</thead>
							<tbody>							
				
								<?php $sno = 1;
								foreach ($detailed_estimates as $detailed_estimate) : ?>
									<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo $detailed_estimate['material']['item_code']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_estimate['material']['item_description']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_estimate['quantity']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_estimate['unit']['name']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_estimate['approved_estimate']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_estimate['total_cost']; ?></td>										
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>
							<tfoot>
							   <tr>
								  <th colspan="6" style="text-align:right;">Total</th>
								  <th><?php echo $total_estimate;  ?></th>						
							   </tr>
						   </tfoot>
						</table>
						
					</div> 		  
             </div><br><br>
		    <?php } ?>
			 <?php  if($detailed_approval_stages_count > 0){  ?> 
			 <div class="card-body">               			 
					<legend class="bol" style="color: #0047AB; text-align: center;">Approval Stages</legend>  
			         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width:98%" bgcolor="white">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No</th>
									<th style="width:10%">Date</th>
									<th style="width:10%">Status</th>
									<th style="width:10%">Progress</th>
									<th style="width:10%">Remarks</th>
								</tr>
							</thead>
							<tbody>							
				
								<?php $sno = 1;
								foreach ($detailed_approval_stages as $detailed_approval) : ?>
									<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo date('d-m-Y',strtotime($detailed_approval['submit_date'])); ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['approval_status']['name']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['current_status']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_approval['remarks']; ?></td>
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>							
						</table>
                    </fieldset>						
             </div><br><br>
			 <?php } ?>
         
					<?php  if($technicalcount !=0){  ?>
					    <br><legend class="bol" style="color: #0047AB; text-align: center;">Technical Sanction Details</legend>

				         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">                                  
						
                             <table id="answerTable" class="table  table-bordered  order-column"
                                 style="max-width: 98%;margin-left: 1%;" bgcolor="white">
                                 <thead>
                                     <tr align="center">
                                         <th style="width:1%"> S.No</th>
                                         <th style="width:10%">Sanction No.</th>
                                         <th style="width:10%">Sanctioned Date</th>
                                         <th style="width:10%">Sanctioned Amount</th>
                                         <th style="width:10%">Description</th>
                                         <th style="width:10%">File Upload</th>
                                     </tr>
                                 </thead>
                                 <tbody class="add_doc">
                                     <?php
                                        $i = 0;
                                       ?>
                                     <tr class="present_row"  align="center">
                                         <td class="trcount"><?php echo $i + 1; ?></td>
										 <td><?php echo $technical['sanction_no']; ?></td>
                                         <td><?php echo date('d-m-Y',strtotime($technical['sanctioned_date'])); ?></td>   
                                         <td><?php echo $technical['amount']; ?></td>
                                         <td><?php echo $technical['description']; ?></td>
                                         <td>
										   <?php  if($technical['detailed_estimate_upload'] != ''){ ?>										 
                                             <a style="color:blue;"
                                                 href="<?php echo $this->Url->build('/uploads/technicalsanctions/' . $technical['detailed_estimate_upload'], ['fullBase' => true]); ?>"
                                                 target="_blank"><span>
                                                     <ion-icon name="document-text-outline"></ion-icon>View
                                                 </span></a>
											 <?php  } ?>
                                         </td>
                                     </tr>
                                     <?php $i++;
                                       ?>
                                 </tbody>
                             </table>
                         </fieldset><br>
					 <?php } ?>
					

				 <?php if ($projectWorkSubdetail['tender_detail_flag'] == 1) { ?>
				 <div class="card-body">
				   <div class="form-body row">      
				<div class="table-scrollable">
				  <legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend>		
				   <fieldset  style="border:1px solid #00355F;border-radius:10px; padding:15px;background-color:ghostwhite;">                                  
						 
				<table class="table table-bordered order-column" style="width: 100%" bgcolor="white">
					<thead>
						<tr class="text-center">
							<th width="5%"> Sno </th>
							<th>Work ID</th>
							<th>Tender Type</th>
							<th>Tender No/<br>Etender ID</th>
							<th>Tender Date </th>
							<th>Tender Amount </th>
							<th>Tender Copy</th> 
						  
						</tr>
					</thead>
					<tbody>
						<?php $sno = 1;
						foreach ($tenders as $projectTenderDetail) : ?>
							<tr class="text-center">
								<td class="text-center"><?php echo ($sno); ?></td>
								<td><?php echo $projectTenderDetail['project_work_subdetail']['work_code']; ?></td>
								<td><?php echo $projectTenderDetail['tender_type']['name']; ?></td>
								<?php  if($projectTenderDetail['tender_type_id'] == 1){  ?>
								<td><?php echo $projectTenderDetail['etenderID']; ?></td>
								<?php  }else if($projectTenderDetail['tender_type_id'] == 2){ ?>
								<td><?php echo $projectTenderDetail['tender_no']; ?></td>
								<?php } ?>
								<td class="title"><?php echo date('d-m-Y', strtotime($projectTenderDetail['tender_date'])); ?></td>
								<td class="title"><?php echo $projectTenderDetail['tender_amount']; ?> </td>
								<td class="title"><a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank">
										<ion-icon name="document-text-outline"></ion-icon>View
										</span>
									</a>
								</td>
											
							</tr>
						<?php $sno++;
						endforeach; ?>
					</tbody>
				</table>
				</fieldset>
			</div>
			</div>
			</div>
			<?php  } ?>
				<?php  if($projectWorkSubdetail['tender_detail_flag'] == 1){  ?>
             <div class="card-body">
                    <div class="form-body row">                       
                              <legend class="bol" style="color: #0047AB; text-align: center;">Contract Agreement Details</legend>
			               <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;background-color:ghostwhite;">                              

                            <div class="form-body row">
                                <div class="col-md-12">                                 
									   <div class="form-group row">
                                                 <label class="control-label col-md-3">Contractor / Company Name<span class="required"> &nbsp;&nbsp;:</span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['contractor']['name']; ?>

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
								 </div>                   
                            </div>
							</fieldset>
                        </div>                    
                </div>
				<?php  } ?>
	
				<?php  if($projectWorkSubdetail['site_handover_flag'] == 1){  ?>
				
				     <div class="card-body">
                    <div class="form-body row">                       
                           <legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend>
			               <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">  
						    <div class="col-md-12">
                            <div class="form-group row">
                              
                                <label class="control-label col-md-2">Site Handover Date<span class="required">  &nbsp;&nbsp;:  </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y',strtotime($projectWorkSubdetail['site_handover_date'])); ?>
                                </div>
								  <label class="control-label col-md-2">Remarks<span class="required">  &nbsp;&nbsp;: 
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $projectWorkSubdetail['site_handover_remarks']; ?>
                                </div>
								
                            </div>                            
                           </div>		   
						   
						   </fieldset>
                      </div>                    
                </div>
				<?php  } ?>
				 <?php if($requestcount > 0){  ?>
					 <legend class="bol" style="color: #0047AB; text-align: center;">Project Fund Request Details
					 </legend>
				   <div class="card-body">
				      <fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:1%; background-color:ghostwhite;">
					   <div class="form-group">
						
							 <table id="answerTable" class="table  table-bordered  order-column"
								 style="max-width: 99%;margin-left: 1%;" bgcolor="white">
								 <thead>
									 <tr align="center">
										 <th  style="width:5%"> S.No</th>
										 <th style="width:10%">Request Date</th>
										 <th style="width:10%">Fund Amount (in Rs.)</th>
										 <th style="width:10%">Balance Amount (in Rs.)</th>
										 <th style="width:10%">Status</th>
										 <th style="width:10%">Approved Date</th>
										 <th style="width:10%">Transaction Ref No</th>
										 <th style="width:10%">Transaction Date</th>
										 <th style="width:10%">Transaction Amount <br>(in Rs.)</th>
										 <th></th>
									 </tr>
								 </thead>
								 <tbody>
								  <?php  $i = 0;  foreach ($fundrequests as $fundrequest): ?>	
									 <tr align="center">
									   <td class="trcount"><?php echo $i+1; ?></td>
										<?php //echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden','value' => $fundrequest['id']]) ?>

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
                                         <td><?php echo ($fundrequest['transaction_ref_no'] != '')?$fundrequest['transaction_ref_no']:""; ?>
										 </td> 
										  <td><?php echo ($fundrequest['transaction_date'] != '')?date('d-m-Y',strtotime($fundrequest['transaction_date'])):''; ?>
										  
										 </td>
										  <td><?php echo ($fundrequest['transaction_amount'] != '')?$fundrequest['transaction_amount']:""; ?>
										 <td> <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;" onclick="getrequeststages(<?php echo $fundrequest['id']; ?>);"><button type="button" class ="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i>view Stages</button></a>

										 
										 </td> 													 
									 </tr>
									  <?php $i++;   endforeach; ?>
								 </tbody>
							 </table>
					 </div>
						 </fieldset><br>								 
					 </div>
				
                   				   
				 <?php } ?>  
                <?php if ($monitoringDetailscount > 0) { ?>
            <div class="card-body">
                <legend class="bol" style="color: #0047AB; text-align: center;">Project Monitoring Details List
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
                </legend>
                <?php //if ($monitoring) { ?>
                    <div class="table-scrollable">
                        <table class="table table-bordered order-column" style="width: 100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> Sno </th>
                                    <th style="width:20%">Monitoring Date</th>
                                    <th style="width:20%">Work Stage</th>
                                    <th style="width:20%">Percentage</th>
                                    <th style="width:20%">Photo Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sno = 1;
                                foreach ($monitorings as $MonitoringDetail) : ?>
                                    <tr class="odd gradeX">
                                        <td class="text-center"><?php echo ($sno); ?></td>
                                        <td><?php echo (date('d-m-Y', strtotime($MonitoringDetail['monitoring_date']))); ?></td>

                                        <td><?php echo $MonitoringDetail['work_stage']['name']; ?></td>
                                        <td class="title"> <?php echo $MonitoringDetail['work_percentage']['name']; ?> </td>

                                        <td class="title">
                                            <a href="javascript:void(0);" onclick="getrequestimages(<?php echo $MonitoringDetail['id'] ?>);">View</a>
                                        </td>
                                        
                                    </tr>
                                <?php $sno++;

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php  //} ?>
                </fieldset>   

            </div>
			  <?php  } ?>				 
				
				
				
    </div>
	
		  <div class="form-group" style="padding-top: 10px;">
				<div class="offset-md-6 col-md-10">
					<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
				</div>
			</div>
	</div>
	</div>
    <?php echo $this->Form->End(); ?>
   <div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form add-unsent-form">

                </div>
            </div>
        </div>
    </div>
	</div>	

 <script>
   function getrequeststages(id) {
        // alert(val);
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxgetrequeststages/'+ id,
            success: function(data, textStatus) {
                // alert(data);
                $(".add-unsent-form").html(data);
            }
        });
    }
	
	
	        function getrequestimages(id) {
                // alert(val);
                $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
                $("#modal-add-unsent").modal('show');
                $.ajax({
                    async: true,
                    dataType: "html",
                    type: "post",
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectMonitoringDetails/ajaxphotoupload/' + id,
                    success: function(data, textStatus) {
                        // alert(data);
                        $(".add-unsent-form").html(data);
                    }
                });
            }
 </script>

