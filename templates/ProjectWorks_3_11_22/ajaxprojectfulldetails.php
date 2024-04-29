<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>
<div class="card-body">
    <!--legend class="bol" style="color: #0047AB; text-align: center;">Project Details</legend-->
	 <h4 class = "sub-tile">Project - <?php  echo $projectWorkSubdetails[0]['work_code']; ?> &nbsp;[<?php  echo $projectWorkSubdetails[0]['project_work_status']['name']; ?>]</h4>
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;background-color:ghostwhite;padding:5px;">
				 <div class="col-md-12">
				    <div class="form-group row">                      
                        <label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-8 lower">                           
						   <?php  echo $projectWork['project_name']; ?>   
                        </div>
                    </div>
					 <div class="form-group row">                       
						<label class="control-label col-md-2 bol">Project Description<span class="required">&nbsp;&nbsp;: </span></label>
                        <div class="col-md-8 lower">                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>              
					
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['department']['name']; ?>                       
					   </div>
                        <label class="control-label col-md-2 bol">Financial Year <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['financial_year']['name']; ?>              
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['building_type']['name']; ?>              
                        </div>
                         <label class="control-label col-md-2 bol">Rough Cost (Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower"> 
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
                         </div>
                    </div>                 
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>              
                        </div>
                        <label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['scheme_type']['name']; ?>              
                        </div>
                    </div>                   
                    <div class="form-group row">                    
                       <label class="control-label col-md-2 bol">Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a> 
						</div>
                        <label class="control-label col-md-2 bol">Approval Status <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-4 lower">
						  <?php  echo ($projectWork['ce_approved'] == 1)?"Approved":"Pending"; ?>              
						</div>						
					
                    </div> 
					<div class="form-group row">                    
                       <label class="control-label col-md-2 bol">Work Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                          <?php  echo $projectWork['departmentwise_work_type']['name'];  ?>
						</div>
                        						
					
                    </div>							
						<?php if($projectWork['ce_approved'] == 1){  ?>
					<div class="form-group row">
						
						<label class="control-label col-md-2 bol">Approved Date<span class="required">&nbsp;&nbsp;: </span></label>
						<div class="col-md-4 lower">                           
						   <?php  echo ($projectWork['approved_date'])?date('d-m-Y',strtotime($projectWork['approved_date'])):''; ?>   
						</div>   
					</div>
						<?php } ?>		
					
					
                </div>
               </fieldset><br>	
			    <?php   if ($projectWorkSubdetailscount > 0) {   ?>
					 <h4 class = "sub-tile">Division Wise Work Details</h4>					
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">                               
							<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
								<thead>
									<tr align="center">
										<th style="width:1%"> S.No</th>
										<th style="width:10%">Work Code</th>
										<th style="width:10%">Work Name</th>
										<th style="width:10%">District</th>
										<th style="width:10%">Division</th>
										<th style="width:10%">Circle</th>
										<th style="width:10%">Rough Cost <br>(in Rs.)</th>
										<th style="width:10%">Sanctioned Amount <br>(in Rs.)</th>
										<th style="width:10%">Work Status</th>
										
									</tr>
								</thead>
								<tbody class="add_doc">
								   <?php
									$i = 0;
									foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>										
									 <tr align="center">  
									   <td class="trcount"><?php echo $i + 1; ?></td>
									   <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
									   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
									   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
									   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
									   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
									   <td align="right"><?php echo $projectWorkSubdetail['rough_cost']; ?></td>
									   <td align="right"><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>
									    <td align="right"><?php echo $projectWorkSubdetail['project_work_status']['name']; ?></td>
				
										
									</tr>
									  <?php
										 $tot_rough    += $projectWorkSubdetail['rough_cost'];
										 $tot_sanction += $projectWorkSubdetail['sanctioned_amount'];

									  $i++;
									endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
									   <td colspan="6" align="right"><b>Total (in Rs.)</b></td>
									   <td align="right"><b><?php echo $tot_rough;  ?></b></td>
									   <td align="right"><b><?php echo ($tot_sanction)?$tot_sanction:'';  ?></b></td>
									</tr>
								</tfoot>
							</table>
							</div>
						</fieldset>
					<?php  }  ?>  
			    <?php   if ($administrativesanctioncount > 0) {   ?>
			    <?php   //if (count($administrativesanction) > 0) {   ?>
					  <h4 class = "sub-tile">Administrative Sanction Details:</h4>
				      <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
						  <div class="col-md-12" style="margin-top:">
						   <div class="form-group row">
							  <label class="control-label col-md-3 bol">GO No. <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
									<?php  echo $administrativesanction['go_no']; ?>                       
							   </div>
								<label class="control-label col-md-3 bol">GO Date <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
								  <?php  echo date('d-m-Y',strtotime($administrativesanction['go_date'])); ?>              
								</div>
							</div>
							<div class="form-group row">
                                <label class="control-label col-md-3 bol">Supervision Charges<span class="required">&nbsp;&nbsp;:</span></label>
                                <div class="col-md-3 lower">
									  <?php echo $administrativesanction['supervision_charge']['name'];  ?>
                                </div>
                                <label class="control-label col-md-3 bol">Fund Source <span class="required">&nbsp;&nbsp;:</span></label>
                                <div class="col-md-3 lower">
								    <?php echo $administrativesanction['fund_source']['name'];  ?>
                                </div>
                            </div> 							
							<div class="form-group row">
							  <label class="control-label col-md-3 bol">GO Upload <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
									<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $administrativesanction['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a>                    
							   </div>
								<label class="control-label col-md-3 bol">Sanctioned Amount (in Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
								 <?php  echo ($administrativesanction['sanctioned_amount'])?ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'],'INR'),'₹'):'0.00'; ?>               
								</div>
							</div>
                             							
                         </div>
					  </fieldset>
									
				<?php  } ?>
				<?php  /*if($abstractcount >0){ ?>
			 <div class="card-body">               		
			<h4 class = "sub-tile">Abstract List</h4> 
				 <div class="table-scrollable">
					 <table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.no</th>
									<th style="width:7%">Item code</th>
									<th style="width:45%">Item Description</th>
									<th style="width:10%">Quantity</th>
									<th style="width:10%">Rate</th>
									<th style="width:10%">Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1;
									foreach ($abstract_subdetails  as $abstract_subdetail) : ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="title"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
										<td class="title"><?php echo $abstract_subdetail['item_description'] ?></td>
										<td class="title" style="text-align:right"><?php echo $abstract_subdetail['quantity'] ?></td>
										<td class="title" style="text-align:right"><?php echo $abstract_subdetail['rate'] ?></td>
										<td class="title" style="text-align:right"><?php echo $abstract_subdetail['amount'] ?></td>										
									</tr>
								<?php 
								if($abstract_subdetail['amount'] != ''){
								 $tot_amount += $abstract_subdetail['amount']; 
								}
								  $sno++;
									endforeach; ?>
							</tbody>
							<tfoot>
							   <tr>
								  <th colspan="5" style="text-align:right;">Total &nbsp;</th>
								  <th style="text-align:right;"><?php echo ($tot_amount)?ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'):'0.00';  ?></th>						
							   </tr>
						   </tfoot>
						</table>
				</div> 
				</div>
			<?php }*/ ?>

    <?php if ($financialSanctionscount > 0) {  ?>
    <!--legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend-->
	 <h4 class = "sub-tile">Financial Sanction Details</h4>			
    <fieldset
        style="border:1px solid #00355F;border-radius:10px;background-color:ghostwhite;padding:25px;">
        <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;"
            bgcolor="white">
            <thead>
                <tr align="center">
                    <th style="width:5%"> S.No</th>
                    <th style="width:20%">GO No</th>
                    <th style="width:20%">GO Date</th>
                    <th style="width:20%">Sanction Amount (in Rs.)</th>
                    <th style="width:20%">GO Upload</th>
                </tr>
            </thead>
            <tbody class="add_doc">
                <?php
                    $i = 0;
                    foreach ($financialSanctions as $financialsanction) : ?>
                <tr align="center">
                    <td class="trcount"><?php echo $i + 1; ?></td>
                    <td><?php echo $financialsanction['go_no']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($financialsanction['go_date'])); ?></td>
                    <td><?php echo $financialsanction['sanctioned_amount']; ?></td>
                    <td>
                        <?php if ($financialsanction['sanctioned_file_upload'] != '') {  ?>
                        <a style="color:blue;"
                            href="<?php echo $this->Url->build('/uploads/financialsanction/' . $financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>"
                            target="_blank"><span>
                                <ion-icon name="document-text-outline"></ion-icon>View
                            </span></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php $i++;
                    endforeach; ?>
            </tbody>
        </table>
    </fieldset>
    <?php } ?>

   <?php  if($technicalcount !=0){  ?>
			<!--legend class="bol" style="color: #0047AB; text-align: center;"></legend-->
			<h4 class = "sub-tile">Technical Sanction Details</h4>	

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
			 </fieldset>
		 <?php } ?>

    <?php if ($projectWorkSubdetail['tender_detail_flag'] == 1) { ?>
				<h4 class = "sub-tile">Tender Details</h4>
				  <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend-->		
				   <fieldset  style="border:1px solid #00355F;border-radius:10px; padding:15px;background-color:ghostwhite;">                                  
						 
					<div class="table-scrollable">
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
			</div>
				</fieldset>
			
			<?php  } ?>
<?php  if($projectWorkSubdetail['tender_detail_flag'] == 1){  ?>
	
<h4 class = "sub-tile">Contract Agreement Details</h4>		
				  <!--legend class="bol" style="color: #0047AB; text-align: center;">Contract Agreement Details</legend-->
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
				                  
	
			<?php  } ?>
			<?php if ($planningcount > 0) { ?>
				   <h4 class = "sub-tile">Planning Permission</h4>
					   <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;background-color:ghostwhite;">                              

                          <div class="form-body row">
                              <div class="col-md-12">
                                  <div class="form-group row">
                                      <label class="control-label col-md-2">Send Date<span class=" required">&nbsp;&nbsp;:
                                          </span></label>
                                      <div class="col-md-4 lower">
                                          <?php echo date('d-m-Y',strtotime($planningdetail['send_date'])); ?>
                                      </div>
                                      <label class="control-label col-md-2">Project Approved <span class="required">&nbsp;&nbsp;:
                                          </span></label>
                                      <div class="col-md-4 lower">
									       <?php echo ($planningdetail['is_permission_approved'] == 1)?"Approved":"Rejected"; ?>
                                      </div>
                                  </div>
                                  <div class="form-group row approved" <?php  if($planningdetail['is_permission_approved'] == 0){ ?>  style="display:none;" <?php } ?>>
                                      <label class="control-label col-md-2">Approved Date<span class=" required">&nbsp;&nbsp;:
                                          </span></label>
                                      <div class="col-md-4 lower" >
									     <?php echo date('d-m-Y',strtotime($planningdetail['approved_date'])); ?>
                                      </div>
                                      <label class="control-label col-md-2" >File
                                          Upload<span class=" required"> &nbsp;&nbsp;:
                                          </span></label>
                                      <div class="col-md-4 lower" >
                                        <?php if ($planningdetail['permission_apporved_copy'] != '') { ?>
                                          <a style="color:blue;"
                                              href="<?php echo $this->Url->build('/uploads/PlanningPermissions/' . $planningdetail['permission_apporved_copy'], ['fullBase' => true]); ?>"
                                              target="_blank"><span>
                                                  <ion-icon name="document-text-outline"></ion-icon>View
                                              </span></a>
                                          <?php  } ?>  
										  </div>
                                  </div>
								   <?php  if($planningdetail['is_permission_approved'] == 0){ ?>
                                  <div class="form-group row">
                                      <label class="control-label col-md-2 ">Remarks<span
                                              class=" required"> &nbsp;&nbsp;:
                                          </span></label>
                                      <div class="col-md-4 lower" >
									       <?php echo $planningdetail['remarks']; ?>
                                      </div>
                                  </div>
								   <?php } ?>
                              </div>
                          </div>
						  </fieldset>
					 <?php } ?>
	
	
   <?php  if($projectWorkSubdetail['site_handover_flag'] == 1){  ?>
				
			
                 	<h4 class = "sub-tile">Site Handover Details</h4>		
		
				   <!--legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend-->
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
		<?php  } ?>
	
   <?php  if($projectWorkSubdetail['fund_request_flag'] == 1){  ?> 
   	<h4 class = "sub-tile">Project Fund Request Details</h4>	
    <fieldset   style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:1%; background-color:ghostwhite;">
        <div class="form-group">
                <table id="answerTable" class="table  table-bordered  order-column"
                    style="max-width: 99%;margin-left: 1%;" bgcolor="white">
                    <thead>
                        <tr align="center">
                            <th style="width:5%"> S.No</th>
                            <th style="width:20%">Request Date</th>
                            <th style="width:20%">Fund Amount (in Rs.)</th>
                            <th style="width:20%">Balance Amount (in Rs.)</th>
                            <th style="width:20%">Status</th>
                            <th style="width:20%">Approved Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $i = 0;  foreach ($fundrequests as $fundrequest): ?>
                        <tr align="center">
                            <td class="trcount"><?php echo $i+1; ?></td>
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
                            <td> <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;"
                                    onclick="getrequeststages(<?php echo $fundrequest['id']; ?>);"><button type="button"
                                        class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i>view
                                        Stages</button></a>
                            </td>
                        </tr>
                        <?php $i++;   endforeach; ?>
                    </tbody>
                </table>
				</div>
    </fieldset>
    <?php } ?>
</div>


</div>
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true"
    class="modal fade col-lg-12">
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
    // alert(id);
    $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
    $("#modal-add-unsent").modal('show');
    $.ajax({
        async: true,
        dataType: "html",
        type: "post",
        url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxgetrequeststages/' + id,
        success: function(data, textStatus) {
            // alert(data);
            $(".add-unsent-form").html(data);
        }
    });
}
</script>