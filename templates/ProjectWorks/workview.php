 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">  
   <div class="card card-topline-aqua">
     <div style="margin-left:90%;"><a onClick="print_receipt('div_vc')"><i class="fa fa-print"></i> Print</a></div>
     <div  id="div_vc_1">
		<div class="card-body">			     	
			<?php  if($projectWorkSubdetails[0]['work_type'] == 1){ ?>	 
			<h4 class = "sub-tile">Project - <?php  echo $projectWorkSubdetails[0]['work_code']; ?> &nbsp;[<?php  echo $projectWorkSubdetails[0]['project_work_status']['name']; ?>]</h4>
			<?php  }else{ ?>
			<h4 class = "sub-tile">Project - <?php  echo $projectWorkSubdetails[0]['project_work']['project_code']; ?> &nbsp;[<?php  echo $projectWorkSubdetails[0]['project_work_status']['name']; ?>]</h4>
			<?php } ?>
			<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">
				<div class="form-group row"> 
					<table  style="max-width:98%;margin-left: 1%;" >
					   <?php if($projectWork['ref_no'] != ''){ ?>
					   <tr>
						  <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Ref No</td>
						  <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php  echo $projectWork['ref_no']; ?></td>
					   </tr>
					   <?php } ?>
					   <tr>
						  <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Project Name</td>
						  <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php  echo $projectWork['project_name']; ?></td>
					   </tr>
					   <?php  if($projectWork['project_description'] != ''){ ?>
					   <tr>
						  <td  style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Project Description</td>
						  <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php  echo $projectWork['project_description']; ?></td>
					   </tr>
					   <?php } ?>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Departments</td>
						  <td style="padding:13px;width:30%;border: 1px solid black"><?php  echo $projectWork['department']['name']; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Financial Year</td>
						  <td style="padding:13px;width:30%;border: 1px solid black"><?php  echo $projectWork['financial_year']['name']; ?> </td>
					   </tr>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Rough Cost (Rs.)</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Coastal Area</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo ($projectWork['coastal_area'] == 1)?'Yes':'No'; ?>     </td>
					   </tr>
						<?php  if($projectWork['building_type_id'] != 0){ ?>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Building Type</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo $projectWork['building_type']['name']; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Scheme Type</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo $projectWork['scheme_type']['name']; ?></td>
					   </tr>
						<?php } ?>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Work Type</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo $projectWork['departmentwise_work_type']['name']; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Upload</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;">
                                    <?php if ($projectWork['file_upload'] != '') {  ?>

                                                <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                        <ion-icon name="document-text-outline"></ion-icon>View
                                                    </span></a>
                                            <?php  } ?>						  </td>
					   </tr>
						<tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Approval Status</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo ($projectWork['ce_approved'] == 1)?"Approved":"Pending"; ?></td>
						   <?php //if($projectWork['approved_date'] != ''){ ?>
						  <td style="padding:13px;width:20%;background-color: #244f96;color:#fff;border:1px solid #fff;font-weight:600;">Approved Date</td>
						  <td style="padding:13px;width:30%;border: 1px solid black;"><?php  echo ($projectWork['approved_date'])?date('d-m-Y',strtotime($projectWork['approved_date'])):''; ?></td>
						   <?php  /*}else{ ?>
						   <td style="padding:13px;width:30%;border: 1px solid black;"></td>
						   <td style="padding:13px;width:30%;border: 1px solid black;"></td>
						   <?php  }*/ ?>
					  </tr>
					</table>                       
				</div>
			</fieldset>					 
			<?php if ($projectWorkSubdetailscount > 0) {   ?>
			 <h4 class = "sub-tile">Division Wise Work Details</h4>					
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
				  <div class="form-group">                               
					<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 0%;">
						<thead>
							<tr align="center">
								<th style="width:1%">S.No</th>
								<th style="width:10%">Work Code</th>
								<th style="width:25%">Work Name</th>
								<th style="width:10%">Place / Area Name</th>
								<th style="width:8%">District</th>
								<th style="width:8%">Division</th>
								<th style="width:8%">Circle</th>
								<th style="width:8%">Rough Cost <br>(in Rs.)</th>
								<th style="width:8%">AS Sanctioned Amount <br>(in Rs.)</th>
								<th style="width:9%">Work Status</th>
							</tr>
						</thead>
						<tbody class="add_doc">
						   <?php
							$i = 0;
							foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>										
							 <tr align="center">  
							   <td class="trcount"><?php echo $i + 1; ?></td>
							   <td><?php echo ($projectWorkSubdetail['work_code'])?$projectWorkSubdetail['work_code']:$projectWorkSubdetail['project_work']['project_code']; ?></td>
							   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
							   <td><?php echo $projectWorkSubdetail['place_name']; ?></td>
							   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
							   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
							   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
							   <td align="right"><?php echo number_format((float)$projectWorkSubdetail['rough_cost'], 2, '.', '') ; ?></td>
							   <td align="right"><?php echo number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', '') ; ?></td>									 
							   <td align="right"><?php echo $projectWorkSubdetail['project_work_status']['name']; ?></td>									
							</tr>
							  <?php
								 $tot_rough    += $projectWorkSubdetail['rough_cost'];
								 $tot_sanction += $projectWorkSubdetail['sanctioned_amount'];
							  $i++;
							endforeach;
							?>
						</tbody>
						<tfoot>
							<tr>
							   <td colspan="7" align="right"><b>Total (in Rs.)</b></td>
							   <td align="right"><b><?php echo number_format((float)$tot_rough, 2, '.', '') ;  ?></b></td>
							   <td align="right"><b><?php echo ($tot_sanction)?number_format((float)$tot_sanction, 2, '.', ''):'';  ?></b></td>
							   <td></td>
							</tr>
						</tfoot>
					</table>
					</div>
				</fieldset>
				<?php  }  ?> 
				<?php if ($DevelopmentWorkscount >0) {  ?>
				 <h4 class = "sub-tile">Development Work List</h4>
				 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">								
					<div class="row">
						<div class="table-scrollable">
							<table class="table table-hover table-bordered table-advanced tablesorter display" style="width:99%">
								<thead>
									<tr class="text-center">
										<th style="width:1%;">Sno</th>
										<th style="width:10%;">Work Name</th>
										<th style="width:25%;">Description</th>
										<th style="width:10%;">Estimated Cost</th>
										<th style="width:10%;">File Upload</th>
									</tr>
								</thead>
								<tbody>
								 <?php if (count($DevelopmentWorkslists) > 0) { 
									$sno = 1;
									foreach ($DevelopmentWorkslists as $DevelopmentWorkslist) : ?>  
										<tr>
											<td><?php echo ($sno); ?></td>
											<td align="left"><?php echo $DevelopmentWorkslist['work_name']; ?></td>
											<td align="left"><?php echo $DevelopmentWorkslist['work_description']; ?></td>
											<td align="left"><?php echo $DevelopmentWorkslist['estimated_cost']; ?></td>
											<td align="left">														
											<?php if ($DevelopmentWorkslist['file_upload'] != '') {  ?>
												<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectwiseDevelopmentWork/'.$DevelopmentWorkslist['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
														<ion-icon name="document-text-outline"></ion-icon>View
													</span></a>
											<?php  } ?>														
											</td>																	
										</tr>
									<?php $sno++;
									endforeach; ?>
								<?php } ?>											
								</tbody>
							</table>
						</div>
				   </div>								  
			 </fieldset>
			 <?php } ?>			   
			 <?php if ($administrativesanctioncount  > 0) { ?>
				<h4 class="sub-tile">Administrative Sanction Details:</h4>
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
				  <div class="table-scrollable">
					<table class="table  table-bordered table-checkable order-column" style="width: 98%">
						<thead>
							<tr class="text-center">
								<th style="width:1%">S.No.</th>
								<th style="width:10%">GO No.</th>
								<th style="width:10%">GO Date</th>
								<th style="width:10%">Supervision Charges</th>
								<th style="width:10%">Fund Source</th>
								<th style="width:10%">GO Upload</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1;
								foreach ($administrativesanction  as $administrativesanctions) : ?>
								<tr class="odd gradeX">
									<td class="text-center"><?php echo $sno; ?></td>
									<td class="title"><?php echo  $administrativesanctions['go_no']; ?></td>
									<td class="title"><?php echo date('d-m-Y', strtotime($administrativesanctions['go_date'])); ?></td>
									<td class="title"><?php echo $administrativesanctions['supervision_charge']['name'] ?></td>
									<td class="title"><?php echo $administrativesanctions['fund_source']['name'] ?></td>
									<td class="title"> <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/'.$administrativesanctions['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
												<ion-icon name="document-text-outline"></ion-icon>View
											</span></a></td>
								</tr>
							<?php
								$sno++;
							   endforeach; ?>
						</tbody>
					</table>
				</div>
			</fieldset>
		   <?php } ?>
		   
		   
		   <?php if ($projectwiseQuartersDetailcount  > 0) { ?>
				<h4 class="sub-tile">Quarter's Details:</h4>
				<fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:5px;margin-bottom:1%">
				  <div class="table-scrollable">
					<table class="table  table-bordered table-checkable order-column" style="width: 50%">
						<thead>
							<tr class="text-center">
								<th>S.No</th>
								<th> Designation</th>
								<th >No of Quarters</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1;
								foreach ($projectwiseQuartersDetail_lists as $projectwiseQuartersDetail) : ?>
								<tr class="odd gradeX">
									<td class="text-center"><?php echo $sno; ?></td>
									<td class="text-center"><?php echo $projectwiseQuartersDetail['police_designation']['name'] ?></td>
									<td style="text-align:right;"><?php echo $projectwiseQuartersDetail['no_of_quarters'] ?></td>
								</tr>
							<?php 
							  $totalq += $projectwiseQuartersDetail['no_of_quarters'];												
							  $sno++;
							  endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
							   <td colspan="2" style="text-align:right;"><b>Total (in Rs.)</b></td>
							   <td style="text-align:right;"><?php echo $totalq;  ?></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</fieldset><br>
		   <?php } ?>
		   
		   
		   <?php if ($projectWorkSubdetails[0]['detailed_estimate_upload'] != '') {  ?>
			<h4 class = "sub-tile">Detailed Estimate :</h4> 
			<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
			  <div class="col-md-12" style="margin-top:">						 
				  <div class="form-group row">
				   <label class="control-label col-md-3 bol">Detailed Estimate <span class="required">&nbsp;&nbsp;:</span></label>
					<div class="col-md-3 lower">
						<div class="btn btn-outline-primary btn-sm"><i class="fa fa-download"></i>&nbsp;<a style="color:red;" href="<?php echo $this->Url->build('/uploads/DetailedEstimates/'.$projectWorkSubdetails[0]['detailed_estimate_upload'], ['fullBase' => true]); ?>"
							target="_blank"><span>Download</span></a> </div>
					   
				   </div>
				   <label class="control-label col-md-3 bol">Detailed Estimate Amount<span class="required">&nbsp;&nbsp;:</span></label>
					<div class="col-md-3 lower">
					  <?php echo $projectWorkSubdetails[0]['detailed_estimate_amount'];  ?>
				   </div>						   
				 </div>              			 
			 </div> 
		  </fieldset>
		   <?php } ?>				
		  <?php if ($financialSanctionscount > 0) {  ?>
			 <h4 class = "sub-tile">Financial Sanction Details</h4>			
			  <fieldset style="border:1px solid #00355F;border-radius:10px;background-color:ghostwhite;padding:25px;">
				 <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;" bgcolor="white">
					<thead>
						<tr align="center">
							<th style="width:5%"> S.No.</th>
							<th style="width:20%">GO No.</th>
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
									href="<?php echo $this->Url->build('/uploads/financialsanction/'.$financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>"
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
		  </fieldset><br>
		<?php } ?>
		<?php  if($abstractcount >0){ ?>
		 <div class="card-body">               		
			<h4 class = "sub-tile">Abstract List</h4> 
			 <div class="table-scrollable">
				<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
					<thead>
						<tr class="text-center">
							<th style="width:1%">S.No.</th>
							<th style="width:2%">Item code</th>
							<th style="width:50%">Item Description</th>
							<th style="width:5%">Quantity</th>
							<th style="width:4%">Unit</th>
							<th style="width:8%">Rate</th>
							<th style="width:8%">Amount</th>
							<?php  if($contractor_detail_count >0){ ?>
							<th style="width:8%">Contractor Rate</th>
							<th style="width:8%">Final Amount</th>
							<?php  } ?>
						</tr>
					</thead>
					<tbody>
						<?php $sno = 1;
							foreach ($abstract_subdetails  as $abstract_subdetail): ?>
							<tr class="odd gradeX">
								<td class="text-center"><?php echo $sno; ?></td>
								<td class="title"><?php echo ($abstract_subdetail['new_item_code'] != '')?$abstract_subdetail['new_item_code']:$abstract_subdetail['item_code'] ?></td>
								<td class="title"><?php echo ($abstract_subdetail['new_item_description'])?$abstract_subdetail['new_item_description']:$abstract_subdetail['item_description']; ?></td>
								<td class="title" style="text-align:right"><?php echo $abstract_subdetail['quantity']; ?></td>
								<td class="title" style="text-align:right"><?php echo $abstract_subdetail['unit']['name']; ?></td>
								<td class="title" style="text-align:right"><?php echo $abstract_subdetail['rate']; ?></td>
								<td class="title" style="text-align:right"><?php echo ($abstract_subdetail['amount'])?$abstract_subdetail['amount']:''; ?></td>										
								<?php  if($contractor_detail_count >0){ ?>
								<td class="title" style="text-align:right"><?php echo ($abstract_subdetail['contractor_rate'])?$abstract_subdetail['contractor_rate']:''; ?></td>										
								<td class="title" style="text-align:right"><?php echo ($abstract_subdetail['final_amount'])?$abstract_subdetail['final_amount']:''; ?></td>										
								<?php  } ?>
							</tr>
						<?php 
						if($abstract_subdetail['amount'] != ''){
						 $tot_amount += $abstract_subdetail['amount']; 
						}							
						if($contractor_detail_count >0){							
						if($abstract_subdetail['final_amount'] != ''){
						 $tot_final_amount += $abstract_subdetail['final_amount']; 
						}	
						}							
					  $sno++;
							endforeach; ?>
					</tbody>
					<tfoot>
					   <tr>
						  <th colspan="6" style="text-align:right;">SUB TOTAL I (in Rs.) &nbsp;</th>
						  <th style="text-align:right;"><?php echo ($tot_amount)?ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'):'0.00';  ?></th>	
						<?php  if($contractor_detail_count >0){ ?>							  
						  <th></th>
						  <th  style="text-align:right;"><?php echo ($tot_final_amount)?ltrim($fmt->formatCurrency((float)$tot_final_amount,'INR'),'₹'):'0.00';  ?></th>
						  <?php  } ?>
					  </tr>
				   </tfoot>
				</table>
				<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
				  <tr>
					 <th style="width:80%;">GST at 18% (SGST at 9%+ CGST at 9%)</th>
					 <td style="width:20%;text-align:right;">
						 <?php echo $gst = ($abstract_detail['gst_at_18'])?ltrim($fmt->formatCurrency((float)$abstract_detail['gst_at_18'],'INR'),'₹'):ltrim($fmt->formatCurrency((float)$technical['gst'],'INR'),'₹'); ?>
					 </td>
				  </tr>
				  <tr>
				   <th style="text-align:right;width:80%;"><b>SUB TOTAL II (in Rs.)</b>&nbsp;&nbsp;</th>
				   <td style="text-align:right;width:20%;text-align:right;">
						 <?php if($abstract_detail['sub_total_2'] != ''){   ?>
						 <?php echo ($abstract_detail['sub_total_2'])?ltrim($fmt->formatCurrency((float)$abstract_detail['sub_total_2'],'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
						 <?php }else{  
						   $total_2 = $tot_amount+$technical['gst']; 
						   
						 ?>
						  <?php echo ($total_2)?ltrim($fmt->formatCurrency((float)$total_2,'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
						 
						 <?php } ?>
				  </td>
				  </tr>
				</table>
				<!--center><button type="button" class="btn btn-danger btn-xs" onclick="addnorms();"><i class="fa fa-plus-circle"></i>Add Description / Amount</button></center><br-->
				<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
				  <tbody class="adding_norms">
				  <?php if($additional_count > 0){  
				   foreach($additional_details as $key1 =>$additional){										  
				   ?>										  
					<tr>  
						
						<td style="width:5%;"><?php echo $key1 + 1; ?></td>
						<td style="width:75%;">
							<?php echo $additional['description']; ?>  
						</td>	
						<td style="width:20%;text-align:right;">
							<?php echo ($additional['amount'])?ltrim($fmt->formatCurrency((float)$additional['amount'],'INR'),'₹'):'0.00'; ?>
						</td>   
					</tr>										        
				   <?php  } } ?>
				  </tbody>
				  <tr>
				   <th style="text-align:right;width:80%;" colspan="2"><b>SUB TOTAL III (in Rs.)</b>&nbsp;&nbsp;</th>
				   <td style="text-align:right;width:20%;text-align:right;">
						 <?php if($abstract_detail['sub_total_3'] != ''){   ?>

						 <?php echo ($abstract_detail['sub_total_3'])?ltrim($fmt->formatCurrency((float)$abstract_detail['sub_total_3'],'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
				         <?php }else{  
						   $total_3 = $tot_amount+$technical['gst']; 
						 ?>
						  <?php echo ($total_3)?ltrim($fmt->formatCurrency((float)$total_3,'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
						 
						 <?php } ?>
				   </td>
				  </tr>
				</table>
				<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
				  <tr>
					 <td style="width:60%;">Labour Welfare fund at 1%</td>
					 <td style="width:20%;">As Per PWD Norms</td>
					 <td style="width:20%;text-align:right;">
						<?php echo ($abstract_detail['labour_welfare'])?ltrim($fmt->formatCurrency((float)$abstract_detail['labour_welfare'],'INR'),'₹'):'0.00'; ?>
					</td>
				  </tr>
				  <tr>
					 <td style="width:60%;">Provision for Contigency Petty Supervision Charge at 2.5%</td>  
					 <td style="width:20%;">As Per PWD Norms</td>
					 <td style="width:20%;text-align:right;">
						<?php echo ($abstract_detail['contigency_petty_supervision_1'])?ltrim($fmt->formatCurrency((float)$abstract_detail['contigency_petty_supervision_1'],'INR'),'₹'):'0.00'; ?>
					</td>
				  </tr>
				  <tr>
					 <td style="width:60%;">Supervision Charge at 7.5%</td>
					 <td style="width:20%;">As Per PWD Norms</td>
					 <td style="width:20%;text-align:right;">
						<?php echo ($abstract_detail['supervision_2'])?ltrim($fmt->formatCurrency((float)$abstract_detail['supervision_2'],'INR'),'₹'):'0.00'; ?>
					</td>
				  </tr>
				  <tr>
					 <td style="width:60%;">GST at 18% for Supervision Charges 7.5%</td>
					 <td style="width:20%;"></td>
					 <td style="width:20%;text-align:right;">
						<?php echo ($abstract_detail['gst_supervision_2'])?ltrim($fmt->formatCurrency((float)$abstract_detail['gst_supervision_2'],'INR'),'₹'):'0.00'; ?>
					</td>
				  </tr>
				  <tr>
				   <th colspan="2" style="text-align:right;width:80%;"><b>TOTAL (in Rs.)</b>&nbsp;&nbsp;</th>
				   <td style="text-align:right;width:20%;">
				   	  <?php if($abstract_detail['total'] != ''){   ?>
					 <?php echo ($abstract_detail['total'])?ltrim($fmt->formatCurrency((float)$abstract_detail['total'],'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
				      <?php }else{  
						   $total= $tot_amount+$technical['gst']; 
						 ?>
						  <?php echo ($total)?ltrim($fmt->formatCurrency((float)$total,'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
						 
						 <?php } ?>
				   </td>
				  </tr>
				</table>
				<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
				  <tr>
					 <td style="width:80%;">Advertisement Charges</td>
					 <td style="width:20%;text-align:right;">
						<?php echo ($abstract_detail['advertisement'])?ltrim($fmt->formatCurrency((float)$abstract_detail['advertisement'],'INR'),'₹'):'0.00'; ?>

					</td>
				  </tr>
				  <tr>
				   <th style="text-align:right;width:80%;"><b>Grand TOTAL (in Rs.)</b>&nbsp;&nbsp;</th>
				   <td style="text-align:right;width:20%;text-align:right;">
					 <?php if($abstract_detail['grand_total'] != ''){   ?>

					 <?php echo ($abstract_detail['grand_total'])?ltrim($fmt->formatCurrency((float)$abstract_detail['grand_total'],'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
                     <?php }else{  
						   $grand_total= $tot_amount+$technical['gst']; 
						 ?>
						  <?php echo ($grand_total)?ltrim($fmt->formatCurrency((float)$grand_total,'INR'),'₹'):ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'); ?>
						 
						 <?php } ?>
				   </td>
				  </tr>
				</table>
			</div><br>			
		</div>	  			
		<?php } ?>
		 <?php  if($detailed_approval_stages_count > 0){  ?> 
			   <h4 class = "sub-tile">Abstract Approval Stages</h4>
				 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
				 <div class="table-scrollable">
					<table class="table table-hover table-bordered table-advanced tablesorter display" style="width:98%" bgcolor="white">
						<thead>
							<tr class="text-center">
								<th style="width:1%">S.No.</th>
								<th style="width:10%">Date</th>
								<th style="width:10%">Status</th>
								<th style="width:10%">Progress</th>
								<th style="width:10%">Remarks</th>
							</tr>
						</thead>
						<tbody>							
							<?php $sno = 1;
							foreach ($detailed_approval_stages as $detailed_approval) : ?>
								<tr>
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
					</div>
				</fieldset><br>								
		 <?php } ?>         
		 <?php  if($technicalcount !=0){  ?>
				<h4 class = "sub-tile">Technical Sanction Details</h4>
				 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">  
                   <div class="table-scrollable">				 
					 <table id="answerTable" class="table  table-bordered  order-column" style="width: 99%;margin-left: 0%;" bgcolor="white">
						 <thead>
							 <tr align="center">
								 <th style="width:1%"> S.No.</th>
								 <th style="width:10%">Sanction No.</th>
								 <th style="width:10%">Sanctioned Date</th>
								 <th style="width:10%">Sanctioned Amount</th>
								 <th style="width:10%">Description</th>
								 <th style="width:10%">File Upload</th>
							 </tr>
						 </thead>
						 <tbody class="add_doc">
							 <?php	$i = 0;  ?>
							 <tr align="center">
								 <td class="trcount"><?php echo $i + 1; ?></td>
								 <td><?php echo $technical['sanction_no']; ?></td>
								 <td><?php echo date('d-m-Y',strtotime($technical['sanctioned_date'])); ?></td>   
								 <td><?php echo $technical['amount']; ?></td>
								 <td><?php echo $technical['description']; ?></td>
								 <td>
								   <?php  if($technical['detailed_estimate_upload'] != ''){ ?>										 
									 <a style="color:blue;"
										 href="<?php echo $this->Url->build('/uploads/technicalsanctions/'.$technical['detailed_estimate_upload'], ['fullBase' => true]); ?>"
										 target="_blank"><span>
											 <ion-icon name="document-text-outline"></ion-icon>View
										 </span></a>
									 <?php  } ?>
								 </td>
							 </tr>
							 <?php $i++;   ?>
						 </tbody>
					 </table>
					 </div>
				 </fieldset><br>		
			 <?php } ?>
			  <?php if ($project_tender_statusescount  > 0) { ?>
				<h4 class="sub-tile">Tender Status Details:</h4>
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
				  <div class="table-scrollable">
					<table class="table  table-bordered table-checkable order-column" style="width: 98%">
						<thead>
							<tr class="text-center">
								<th style="width:1%">S.No.</th>
								<th style="width:10%">Date</th>
								<th style="width:10%">Tender Status</th>
								<th style="width:10%">Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php $a = 1;
								foreach ($project_tender_statuses  as $tender_statuses) : ?>
								<tr class="odd gradeX">
									<td class="text-center"><?php echo $a; ?></td>
									<td class="title"><?php echo date('d-m-Y', strtotime($tender_statuses['submit_date'])); ?></td>
									<td class="title"><?php echo  $tender_statuses['tender_status']['name']; ?></td>
									<td class="title"><?php echo $tender_statuses['remarks']; ?></td>
								</tr>
							<?php
								$a++;
							   endforeach; ?>
						</tbody>
					</table>
				</div>
			</fieldset><br>		
		   <?php } ?> 				 
			 <?php if ($projectWorkSubdetails[0]['tender_detail_flag'] == 1) { ?>
			   <h4 class = "sub-tile">Tender Details</h4>
			   <fieldset  style="border:1px solid #00355F;border-radius:10px; padding:15px;background-color:ghostwhite;">                                
				<div class="table-scrollable">
					<table class="table table-bordered order-column" style="width: 100%" bgcolor="white">
						<thead>
							<tr class="text-center">
								<th width="5%">S.No.</th>
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
									<td><?php echo ($projectTenderDetail['project_work_subdetail']['work_code'])?$projectTenderDetail['project_work_subdetail']['work_code']:$projectTenderDetail['project_work']['project_code']; ?></td>
									<td><?php echo $projectTenderDetail['tender_type']['name']; ?></td>
									<?php  if($projectTenderDetail['tender_type_id'] == 1){  ?>
									<td><?php echo $projectTenderDetail['etenderID']; ?></td>
									<?php  }else if($projectTenderDetail['tender_type_id'] == 2){ ?>
									<td><?php echo $projectTenderDetail['tender_no']; ?></td>
									<?php } ?>
									<td class="title"><?php echo date('d-m-Y', strtotime($projectTenderDetail['tender_date'])); ?></td>
									<td class="title"><?php echo $projectTenderDetail['tender_amount']; ?> </td>
									<td class="title"><a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/'.$projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank">
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
			</fieldset><br>		
		<?php  } ?>
		<?php  if($projectWorkSubdetails[0]['tender_detail_flag'] == 1){  ?>  
		 <div class="card-body">
			 <h4 class = "sub-tile">Contract Agreement Details</h4>
			   <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">                             
				<div class="form-body row">
				<table  style="max-width:98%;margin-left:1%;">						  
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Contractor / Company Name</td>
						  <td style="padding:13px;width:30%;border:1px solid black"><?php echo $contractor_details['contractor']['name']; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Contractor Mobile No.</td>
						  <td style="padding:13px;width:30%;border:1px solid black"><?php  echo $contractor_details['contractor']['mobile_no']; ?> </td>
					   </tr>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Work Order Reference No</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['work_order_refno']; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Work Order Copy</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"> <?php if ($contractor_details['work_order_copy'] != '') {  ?>
									 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/WorkOrders/'.$contractor_details['work_order_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
											 <ion-icon name="document-text-outline"></ion-icon>View
										 </span></a>
								 <?php   }  ?> </td>
					   </tr>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Agreement No.</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['agreement_no']; ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Agreement Date</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo date('d-m-Y', strtotime($contractor_details['agreement_date'])); ?></td>
					   </tr>
					   <tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Agreement Copy</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"> <?php if ($contractor_details['agreement_copy'] != '') {  ?>
									 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/'.$contractor_details['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
											 <ion-icon name="document-text-outline"></ion-icon>View
										 </span></a>
								 <?php   }  ?></td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Agreement Amount (Rs.)</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo ($contractor_details['agreement_amount'])?ltrim($fmt->formatCurrency((float)$contractor_details['agreement_amount'],'INR'),'₹'):'0.00'; ; ?>     </td>
					   </tr>
						<tr>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Percentage(%)</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['perc_deduction']; ?>%</td>
						  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Agreement Period</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['agreement_period']; ?></td>
					   </tr>
					</table> 
				</div>
			</fieldset>
			</div>
			<?php  } ?>				
			<?php if ($planningcount > 0) { ?>
				<div class="card-body">
					<h4 class="sub-tile">Planning Clearance:</h4>
					<fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;background-color:white;">                             
					  <div class="table-scrollable">
						<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No.</th>
									<th style="width:7%">Send Date</th>
									<th style="width:7%">Project Approved</th>
									 <?php if ($planningdetail[0]['is_permission_approved'] == 1) { ?>
									<th style="width:10%" >Approved Date</th>
									<th style="width:10%">Planning Clearance Upload </th>
									<th style="width:10%">Drawing Upload </th>
									 <?php }else if ($planningdetail[0]['is_permission_approved'] == 0) { ?>
										<th style="width:10%">Remarks </th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1;
								foreach ($planningdetail as $planningdetails) : ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="title"><?php echo  date('d-m-Y', strtotime($planningdetails['send_date'])); ?></td>
										<td class="title"><?php echo ($planningdetails['is_permission_approved'] == 1) ? "Approved" : "Rejected"; ?></td>
										<?php if ($planningdetails['is_permission_approved'] == 1) { ?>
										<td class="title"><?php echo date('d-m-Y', strtotime($planningdetails['approved_date'])); ?></td>
										<td class="title"> <?php if ($planningdetails['permission_apporved_copy'] != '') { ?>
												<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/PlanningPermissions/'.$planningdetails['permission_apporved_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
														<ion-icon name="document-text-outline"></ion-icon>View
													</span></a>
											<?php  } ?>
										</td>
										<td class="title"> <?php if ($planningdetails['drawing_copy'] != '') { ?>
												<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/DrawingCopy/'.$planningdetails['drawing_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
														<ion-icon name="document-text-outline"></ion-icon>View
													</span></a>
											<?php  } ?>
										</td>
									   <?php }else if ($planningdetails['is_permission_approved'] == 0) { ?>
											<td> <?php echo $planningdetails['remarks']; ?></td>
										<?php } ?>
									</tr>
								<?php
									$sno++;
								endforeach; ?>
							</tbody>
						</table>
					</div>
				  </fieldset>
				</div>
				<?php } ?>
				<?php if ($projectWorkSubdetails[0]['architect_drawing_flag'] == 1) {  ?>
				<div class="card-body">
				<h4 class = "sub-tile">Architect Final Drawing :</h4> 
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:10px;margin-bottom:0%">
				  <div class="col-md-12" style="margin-top:">						 
					  <div class="form-group row">
					   <label class="control-label col-md-3 bol">Final Drawing <span class="required">&nbsp;&nbsp;:</span></label>
						<div class="col-md-3 lower">
							<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ArchitectDrawings/'.$projectWorkSubdetails[0]['architect_drawing_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
														<ion-icon name="document-text-outline"></ion-icon>View
													</span></a>
						</div>					  						   
					 </div>              			 
				 </div> 
			    </fieldset>
				</div> 
			   <?php } ?>					
				<?php if ($projectWorkSubdetail['site_handover_flag'] == 1) {  ?>
				<div class="card-body">
				  <h4 class="sub-tile">Site Handover Details:</h4>
				   <fieldset  style="border:1px solid #00355F;border-radius:10px;background-color:ghostwhite;padding:25px;">                                
					 <div class="table-scrollable">
						<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No.</th>
									<th style="width:7%">Site Handover Date</th>
									<th style="width:7%">Due Date of Completion</th>
									<th style="width:7%">Remarks</th>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1;
								foreach ($projectWorkSubdetails  as $projectWorkSubdetail) : ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="title"><?php echo date('d-m-Y', strtotime($projectWorkSubdetail['site_handover_date'])); ?>
										<td class="title"><?php echo date('d-m-Y', strtotime($projectWorkSubdetail['tentative_completion_date'])); ?>
										<td class="title"><?php echo $projectWorkSubdetail['site_handover_remarks']; ?>
										</td>
									</tr>
								<?php
									$sno++;
								endforeach; ?>
							</tbody>
					  </table>
					</div>
				</fieldset><br>	
			  </div>
		   <?php  } ?>	  			
		<?php if($requestcount > 0){  ?>  					 
		   <div class="card-body">
			  <h4 class = "sub-tile">Project Fund Request Details</h4>
				<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:1%; background-color:ghostwhite;">
				  <div class="form-group">	
                    <div class="table-scrollable">				  
					 <table id="answerTable" class="table  table-bordered  order-column"
					 style="max-width: 99%;margin-left: 1%;" bgcolor="white">
					 <thead>
						 <tr align="center">
							 <th  style="width:5%">S.No.</th>
							 <th style="width:10%">Request Date</th>
							 <th style="width:10%">Fund Amount (in Rs.)</th>
							 <th style="width:10%">Balance Amount (in Rs.)</th>
							 <th style="width:10%">Status</th>
							 <th style="width:10%">Approved Date</th>
							 <th style="width:10%">Transaction Date</th>
							 <th style="width:10%">Transaction Amount <br>(in Rs.)</th>
							 <th></th>
						 </tr>
					 </thead>
					 <tbody>
					  <?php  $i = 0;  foreach ($fundrequests as $fundrequest): ?>	
						 <tr align="center">
						   <td class="trcount"><?php echo $i+1; ?></td>
							 <td><?php echo date('d-m-Y',strtotime($fundrequest['project_fund_request']['request_date'])) ?>										 
							 </td>
							 <td><?php echo $fundrequest['request_amount']; ?>
							 </td>
							 <td><?php echo $fundrequest['balance_amount']; ?>
							 </td>  
							 <td><?php echo ($fundrequest['project_fund_request']['is_approved'] == 1)?'Approved':(($fundrequest['project_fund_request']['is_approved'] == 2)?'Rejected':'Processing'); ?>
							 </td> 
							 <td><?php echo ($fundrequest['project_fund_request']['approval_date'] != '')?date('d-m-Y',strtotime($fundrequest['project_fund_request']['approval_date'])):''; ?>
							 </td>
							 <td><?php echo ($fundrequest['project_fund_request']['transaction_date'] != '')?date('d-m-Y',strtotime($fundrequest['project_fund_request']['transaction_date'])):''; ?>
							 </td>
							 <td><?php echo ($fundrequest['transaction_amount'] != '')?$fundrequest['transaction_amount']:""; ?>
							 </td>
							 <td> <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;" onclick="getrequeststages(<?php echo $fundrequest['id']; ?>);"><button type="button" class ="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i>view Stages</button></a>
							 </td>   													 
						 </tr>
						  <?php $i++;   endforeach; ?>
					 </tbody>
				 </table>
			  </div>
			  </div>
			</fieldset>						 
		</div>	                  				   
		<?php } ?>  
       <?php if ($monitoringDetailscount > 0) { ?>
		 <div class="card-body">
			 <h4 class = "sub-tile">Project Monitoring Details List</h4>
			  <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
				<div class="table-scrollable">
					<table class="table table-bordered order-column" style="width: 100%">
						<thead>
							<tr class="text-center">
								<th width="5%"> S.No.</th>
								<th style="width:10%">Monitoring Date</th>
								<th style="width:10%">Work Stage</th>
								<th style="width:10%">Physical Percentage</th>
								<th style="width:10%">Financial Percentage</th>
								<th style="width:10%">Photo Upload</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1;
							  foreach($monitorings as $MonitoringDetail): ?>
								<tr class="odd gradeX">
									<td class="text-center"><?php echo ($sno); ?></td>
									<td><?php echo (date('d-m-Y', strtotime($MonitoringDetail['monitoring_date']))); ?></td>
									<td><?php echo $MonitoringDetail['description']; ?></td>  
									<td class="title"> <?php echo $MonitoringDetail['work_percentage']['name']; ?></td>
									<td class="title"> <?php echo $MonitoringDetail['financial_percentage']['name']; ?></td>
									<!--td class="title">
										<a href="javascript:void(0);" onclick="getrequestimages(<?php echo $MonitoringDetail['id'] ?>);">View</a>
									</td-->  
									<td class="title">
										<?php $i = 1;    foreach ($photo_uploads[$MonitoringDetail['id']] as $key => $photo_upload){ ?>
									   <a href="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photo_upload['file_upload'], ['fullBase' => true]); ?>" data-fancybox="gallery_<?php echo $MonitoringDetail['id']  ?>" data-caption="photo_<?php echo ($key+1); ?>"  onclick="loadphotos(<?php echo $MonitoringDetail['id'];  ?>)" >
									   <span <?php if($key != 0){ ?>style="display:none" <?php } ?>>View</span>
									  </a>
									
									 <?php  } ?>
									</td>									
								</tr>
							<?php $sno++;
							endforeach; ?>
						</tbody>
					</table>
				</div>
			</fieldset> 
		</div>
	 <?php  } ?>
	 <?php if ($utilizationCertificatecount > 0) { ?>  
	  <div class="card-body">
			<h4 class="sub-tile">Utilization Certificate:</h4>
			  <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
			<div class="table-scrollable">
				<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
					<thead>
						<tr class="text-center">
							<th style="width:1%">S.No.</th>
							<th style="width:7%">Cerificate date</th>
							<th style="width:7%">Amount</th>
							<th style="width:7%">Certificate Upload</th>
							<th style="width:7%">Remarks</th>
						</tr>
					</thead>
					<tbody>
						<?php $sno = 1;
						   foreach ($utilizationCertificate  as $utilizationCertificates) : ?>
							<tr class="odd gradeX">
								<td class="text-center"><?php echo $sno; ?></td>
								<td class="title"><?php echo date('d-m-Y', strtotime($utilizationCertificates['certificated_date'])); ?></td>
								<td class="title"><?php echo $utilizationCertificates['amount']; ?></td>
								<td class="title"><?php if($utilizationCertificates['certificate_upload'] != '') {  ?>
										<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/utilizationCertificates/'.$utilizationCertificates['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
												<ion-icon name="document-text-outline"></ion-icon>View
											</span>
										</a>
									<?php  } ?>
								</td>
								<td class="title"><?php echo $utilizationCertificates['remarks']; ?></td>
							</tr>
						<?php
							$sno++;
						endforeach; ?>
					</tbody>
				</table>
			</div>
			</fieldset>
		  </div>
	   <?php } ?>	
       <?php if ($handovercount > 0) { ?>
		<div class="card-body">
			<h4 class="sub-tile">Project Handover To User Department Details:</h4>
			 <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
				<div class="table-scrollable">
					<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
						<thead>
							<tr class="text-center">
								<th style="width:1%">S.No.</th>
								<th style="width:10%">Handover Date</th>
								<th style="width:10%">Inaguration Date</th>
								<th style="width:10%">Photo Upload (Foundation Stone)</th>
								<th style="width:10%">Final Executive Drawing Upload</th>
								<th style="width:10%">Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1;
							foreach ($handoverdetails  as $handoverdetail) : ?>
								<tr class="odd gradeX">
									<td class="text-center"><?php echo $sno; ?></td>
									<td class="title"><?php echo date('d-m-Y', strtotime($handoverdetail['handover_date'])); ?>
									<td class="title"><?php echo date('d-m-Y', strtotime($handoverdetail['inauguration_date'])); ?>
									<td class="title"><?php if ($handoverdetail['photo_upload'] != '') {  ?>
											<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectHandover/'.$handoverdetail['photo_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
													<ion-icon name="document-text-outline"></ion-icon>View
												</span>
											</a>
										<?php  } ?>
									</td>
									<td class="title"><?php if ($handoverdetail['execution_drawing_file'] != '') {  ?>
											<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/DrawingFile/'.$handoverdetail['execution_drawing_file'], ['fullBase' => true]); ?>" target="_blank"><span>
													<ion-icon name="document-text-outline"></ion-icon>View
												</span>
											</a>
										<?php  } ?>
									</td>
									<td class="title"><?php echo $handoverdetail['remarks']; ?>
									</td>
								</tr>  
							<?php
								$sno++;
							endforeach; ?>
						</tbody>
					</table>
				</div>
				</fieldset>
			</div>
			<?php } ?>			
			<?php if ($completioncount > 0) { ?>  
				<div class="card-body">				
					<h4 class="sub-tile">Project Completion Report:</h4>
					<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
					<div class="table-scrollable">
						<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No.</th>
									<th style="width:7%">Completed Date</th>
									<th style="width:7%">CR Amount</th>
									<th style="width:7%">Status</th>
									<th style="width:7%">Completion Report</th>
									<th style="width:7%">Remarks</th>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1;
								foreach ($completiondetails  as $completiondetail): ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="title"> <?php echo date('d-m-Y', strtotime($completiondetail['completed_date'])); ?>
                                        <td class="title"> <?php echo $completiondetail['completion_amount']; ?>
                                        <td class="title"> <?php echo $completiondetail['completion_status']; ?>
										<td class="title"><?php if ($completiondetail['file_upload'] != '') {  ?>
											<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectCompletionDetails/' . $completiondetail['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
													<ion-icon name="document-text-outline"></ion-icon>View
												</span>
											</a>
										<?php  } ?>
										</td>
										<td class="title"><?php echo $completiondetail['remarks']; ?>
										</td>
									</tr>
								<?php
									$sno++;
								endforeach; ?>
							</tbody>
						</table>
					</div>
					</fieldset>
				</div>
			<?php } ?>			
			 <?php if ($placedtoboardcount > 0) { ?>  
				<div class="card-body">				
					<h4 class="sub-tile">Project Placed to Board Details:</h4>
					<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
					<div class="table-scrollable">
						<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No.</th>
									<th style="width:7%">Placed Date</th>
									<th style="width:7%">File Copy </th>
									<th style="width:7%">Remarks</th>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1;
								foreach ($placedtoboarddetails as $placedtoboarddetail) : ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="title"> <?php echo date('d-m-Y', strtotime($placedtoboarddetail['placed_date'])); ?></td>
										<td class="title">
										 <?php if ($placedtoboarddetail['file_upload'] != '') {  ?>
											<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/projectplacedtoboard/'.$placedtoboarddetail['file_upload'], ['fullBase' => true]); ?>" target="_blank">
											 <ion-icon name="document-text-outline"></ion-icon>View
											</a>
									 	<?php  } ?>
										</td>
										<td class="title"><?php echo $placedtoboarddetail['remarks']; ?>  
										</td>
									</tr>
								<?php
									$sno++;
								endforeach; ?>
							</tbody>
						</table>
					</div>
					</fieldset>
				</div>
				<?php } ?>						
				<?php if ($projectwiseTimeExtensionDetailcount > 0) { ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box">
							<div class="card-body">
								<h4 class="sub-tile">Time Extension Detail list</h4>
								<!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details List</legend-->
								<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
									<div class="table-scrollable">
										<table class="table table-bordered order-column" style="width: 98%">
											<thead>
												<tr class="text-center">
													<th width="1%">S.No</th>
													<th width="10%">Extention Date</th>
													<th width="10%">Status</th>  
													<th width="5%">Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php $sno = 1;
												foreach ($projectwiseTimeExtensionDetailists as $projectwiseTimeExtensionDetailist) : ?>
													<tr class="text-center">
														<td class="text-center"><?php echo ($sno); ?></td>
														<td class="title"><?php echo date('d-m-Y', strtotime($projectwiseTimeExtensionDetailist['extension_date_of_ee'])); ?></td>
														<td class="title"><?php if($projectwiseTimeExtensionDetailist['is_approved'] == 0){ echo "Forward to ".$curr_role[$projectwiseTimeExtensionDetailist['approval_role']];}else{   echo "Approved"; } ?></td>
														<td class="text-center">
															<span style="overflow: visible; position: relative; width: 177px;">												   
																<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectwiseTimeExtensionDetails','action' => 'view', $id, $work_id, $projectwiseTimeExtensionDetailist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>
															</span>
														</td>
													</tr>
												<?php $sno++;
												endforeach; ?>
											</tbody>
										</table>
									</div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>   
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
<div class="col-md-12 pdfreport" style="display:none;">      
	<div  id="div_vc">
		<div class="card-body">			     	
			<?php  if($projectWorkSubdetails[0]['work_type'] == 1){ ?>	 
			<h4 class = "sub-tile">Project - <?php  echo $projectWorkSubdetails[0]['work_code']; ?> &nbsp;[<?php  echo $projectWorkSubdetails[0]['project_work_status']['name']; ?>]</h4>
			<?php  }else{ ?>
			<h4 class = "sub-tile">Project - <?php  echo $projectWorkSubdetails[0]['project_work']['project_code']; ?> &nbsp;[<?php  echo $projectWorkSubdetails[0]['project_work_status']['name']; ?>]</h4>
			<?php } ?>
			  <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">  
				<div class="form-group"> 
					<table  style="width:100%;">
					     <?php if($projectWork['ref_no'] != ''){ ?>
					   <tr>
						  <td style="padding:10px;width:20%;border: 1px solid #fff;font-weight:600;">Ref No</td>
						  <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php  echo $projectWork['ref_no']; ?></td>
					   </tr>
					   <?php } ?>
					   <tr>
						  <td style="padding:10px;width:20%;border:1px solid black;font-weight:600;">Project Name</td>
						  <td colspan="3" style="padding:13px;width:80%;border: 1px solid black;"><?php  echo $projectWork['project_name']; ?></td>
					   </tr>
					   <?php  if($projectWork['project_description'] != ''){ ?>
					   <tr>
						  <td  style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Project Description</td>
						  <td colspan="3" style="padding:13px;width:80%;border: 1px solid black;"><?php  echo $projectWork['project_description']; ?></td>
					   </tr>
					   <?php } ?>
					   <tr>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Departments</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo $projectWork['department']['name']; ?></td>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Financial Year</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo $projectWork['financial_year']['name']; ?> </td>
					   </tr>
					   <tr>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Rough Cost (Rs.)</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?></td>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Coastal Area</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo ($projectWork['coastal_area'] == 1)?'Yes':'No'; ?>     </td>
					   </tr>
						<?php  if($projectWork['building_type_id'] != 0){ ?>
					   <tr>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Building Type</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo $projectWork['building_type']['name']; ?></td>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Scheme Type</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo $projectWork['scheme_type']['name']; ?></td>
					   </tr>
						<?php } ?>
					   <tr>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Work Type</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo $projectWork['departmentwise_work_type']['name']; ?></td>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Upload</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo ($projectWork['coastal_area'] == 1)?'Yes':'No'; ?>     </td>
					   </tr>
						<tr>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Approval Status</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo ($projectWork['ce_approved'] == 1)?"Approved":"Pending"; ?></td>
						  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Approved Date</td>
						  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo ($projectWork['approved_date'])?date('d-m-Y',strtotime($projectWork['approved_date'])):''; ?></td>
					   </tr>
					</table>                       
				</div>
			  </fieldset>					 
			   <?php if ($projectWorkSubdetailscount > 0){  ?>
				    <h4>Division Wise Work Details</h4>					
					<fieldset style="border:1px solid #00355F;border-radius:10px;padding:10px;">
					  <div class="form-group">                               
						<table style="width:100%;">
							<thead>  
								<tr align="center">
									<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;"> S.No</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Work Code</th>
									<th style="width:30%;padding:13px;border:1px solid black;font-weight:600;">Work Name</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Place / Area Name</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">District</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Division</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Circle</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Rough Cost <br>(in Rs.)</th>
									<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">AS Sanctioned Amount <br>(in Rs.)</th>
									<th style="width:9%;padding:13px;border:1px solid black;font-weight:600;">Work Status</th>
								</tr>
							</thead>
							<tbody>
							   <?php
								$i = 0;
								foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>										
								 <tr align="center">  
								   <td style="padding:13px;border:1px solid black;"><?php echo $i + 1; ?></td>
								   <td style="padding:13px;border:1px solid black;"><?php echo ($projectWorkSubdetail['work_code'])?$projectWorkSubdetail['work_code']:$projectWorkSubdetail['project_work']['project_code']; ?></td>
								   <td style="padding:13px;border:1px solid black;"><?php echo $projectWorkSubdetail['work_name']; ?></td>
								   <td style="padding:13px;border:1px solid black;"><?php echo $projectWorkSubdetail['place_name']; ?></td>
								   <td style="padding:13px;border:1px solid black;"><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
								   <td style="padding:13px;border:1px solid black;"><?php echo $projectWorkSubdetail['division']['name']; ?></td>
								   <td style="padding:13px;border:1px solid black;"><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
								   <td style="padding:13px;border:1px solid black;" align="right"><?php echo number_format((float)$projectWorkSubdetail['rough_cost'], 2, '.', '') ; ?></td>
								   <td style="padding:13px;border:1px solid black;" align="right"><?php echo number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', '') ; ?></td>									 
								   <td style="padding:13px;border:1px solid black;" align="right"><?php echo $projectWorkSubdetail['project_work_status']['name']; ?></td>
								</tr>  
								  <?php
									 $tot_rough1    += $projectWorkSubdetail['rough_cost'];
									 $tot_sanction1 += $projectWorkSubdetail['sanctioned_amount'];
								     $i++;
								endforeach;
								?>
							</tbody>
							<tfoot>
								<tr>
								   <td style="padding:13px;border:1px solid black;" colspan="7" align="right"><b>Total (in Rs.)</b></td>
								   <td style="padding:13px;border:1px solid black;" align="right"><b><?php echo number_format((float)$tot_rough1, 2, '.', '') ;  ?></b></td>
								   <td style="padding:13px;border:1px solid black;" align="right"><b><?php echo ($tot_sanction1)?number_format((float)$tot_sanction1, 2, '.', ''):'';  ?></b></td>
								   <td style="padding:13px;border:1px solid black;"></td>
								</tr>	
						   </tfoot>
						</table>
						</div>
					</fieldset>
				<?php  }  ?> 
				<?php if ($DevelopmentWorkscount >0) {  ?>
					 <h4 >Development Work List</h4>
					 <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">								
						<table style="width:100%">
							<thead>
								<tr align="center">
									<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.no</th>
									<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Work Name</th>
									<th style="width:25%;padding:13px;border:1px solid black;font-weight:600;">Description</th>
									<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Estimated Cost</th>
								</tr>
							</thead>
							<tbody>
							<?php if (count($DevelopmentWorkslists) > 0) { ?>
								<?php $sno = 1;
								foreach ($DevelopmentWorkslists as $DevelopmentWorkslist) : ?>  
									<tr >
										<td style="padding:13px;border:1px solid black;"><?php echo ($sno); ?></td>
										<td style="padding:13px;border:1px solid black;"><?php echo $DevelopmentWorkslist['work_name']; ?></td>
										<td style="padding:13px;border:1px solid black;"><?php echo $DevelopmentWorkslist['work_description']; ?></td>
										<td style="padding:13px;border:1px solid black;"><?php echo $DevelopmentWorkslist['estimated_cost']; ?></td>
									</tr>
								<?php $sno++;
								endforeach; ?>
								<?php } ?>											
							</tbody>
						</table>										
				 </fieldset>
			 <?php } ?>			   
			 <?php if($administrativesanctioncount > 0) { ?>
			 <h4>Administrative Sanction Details:</h4>
			 <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">
				<table style="width:100%;">
					<thead>
						<tr align="center">
							<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
							<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">GO No.</th>
							<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">GO Date</th>
							<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Supervision Charges</th>
							<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Fund Source</th>
						</tr>
					</thead>
					<tbody>
						<?php $sno = 1;
							foreach ($administrativesanction  as $administrativesanctions) : ?>
							<tr align="center">
								<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
								<td style="padding:13px;border:1px solid black;"><?php echo  $administrativesanctions['go_no']; ?></td>
								<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($administrativesanctions['go_date'])); ?></td>
								<td style="padding:13px;border:1px solid black;"><?php echo $administrativesanctions['supervision_charge']['name'] ?></td>
								<td style="padding:13px;border:1px solid black;"><?php echo $administrativesanctions['fund_source']['name'] ?></td>
							</tr>
						<?php
							$sno++;
						   endforeach; ?>
					</tbody>
				</table>
			 </fieldset>
		   <?php } ?>
		  <?php if ($financialSanctionscount > 0) {  ?>
			 <h4>Financial Sanction Details</h4>			
			  <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
				 <table style="width:100%;">
					<thead>
						<tr align="center">
							<th style="width:5%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
							<th style="width:20%;padding:13px;border:1px solid black;font-weight:600;">GO No.</th>
							<th style="width:20%;padding:13px;border:1px solid black;font-weight:600;">GO Date</th>
							<th style="width:20%;padding:13px;border:1px solid black;font-weight:600;">Sanction Amount (in Rs.)</th>
					   </tr>
					</thead>
					<tbody>
						<?php
							$i = 0;
							foreach ($financialSanctions as $financialsanction) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $i + 1; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $financialsanction['go_no']; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($financialsanction['go_date'])); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $financialsanction['sanctioned_amount']; ?></td>
						</tr>
						<?php $i++;
							endforeach; ?>
					</tbody>
				</table>
		  </fieldset><br>
		<?php } ?>			
		 <?php  if($detailed_approval_stages_count > 0){  ?> 
		 <h4>Abstract Approval Stages</h4>
		 <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width:100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Date</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Status</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Progress</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody align="center">				
					<?php $sno = 1;
					foreach ($detailed_approval_stages as $detailed_approval) : ?>
						<tr >
							<td style="padding:13px;border:1px solid black;"><?php echo ($sno); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y',strtotime($detailed_approval['submit_date'])); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $detailed_approval['approval_status']['name']; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $detailed_approval['current_status']; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $detailed_approval['remarks']; ?></td>
						</tr>
					<?php $sno++;
					endforeach; ?>								
				</tbody>							
			</table>
		</fieldset>						
		 <?php } ?>         
		 <?php  if($technicalcount !=0){  ?>
		 <h4>Technical Sanction Details</h4>
		 <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">                                
			 <table	style="width:100%;">
				 <thead>
					 <tr align="center">
						 <th style="width:1%;padding:13px;border:1px solid black;font-weight:600;"> S.No.</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Sanction No.</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Sanctioned Date</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Sanctioned Amount</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Description</th>
					 </tr>
				 </thead>
				 <tbody>
					 <?php	$i = 0;  ?>
					 <tr align="center">
						 <td style="padding:13px;border:1px solid black;"><?php echo $i + 1; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo $technical['sanction_no']; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y',strtotime($technical['sanctioned_date'])); ?></td>   
						 <td style="padding:13px;border:1px solid black;"><?php echo $technical['amount']; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo $technical['description']; ?></td>
					 </tr>
					 <?php $i++;   ?>
				 </tbody>
			 </table>
		 </fieldset>
		 <?php } ?>
		 <?php if ($project_tender_statusescount  > 0) { ?>
		  <h4>Tender Status Details:</h4>
		  <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width:100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Date</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Tender Status</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php $a = 1;
						foreach ($project_tender_statuses  as $tender_statuses) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $a; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($tender_statuses['submit_date'])); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $tender_statuses['tender_status']['name']; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $tender_statuses['remarks']; ?></td>
						</tr>
					<?php
						$a++;
					   endforeach; ?>
				</tbody>
			</table>
		 </fieldset>
		<?php } ?> 				 
		<?php if ($projectWorkSubdetails[0]['tender_detail_flag'] == 1) { ?>
		   <h4>Tender Details</h4>
		   <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">                                  
			 <table style="width:100%">
				<thead>
					<tr align="center">
						<th style="width:5%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Work ID</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Tender Type</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Tender No/<br>Etender ID</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Tender Date </th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Tender Amount </th>  
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($tenders as $projectTenderDetail) : ?>
						 <tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo ($sno); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo ($projectTenderDetail['project_work_subdetail']['work_code'])?$projectTenderDetail['project_work_subdetail']['work_code']:$projectTenderDetail['project_work']['project_code']; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $projectTenderDetail['tender_type']['name']; ?></td>
							<?php  if($projectTenderDetail['tender_type_id'] == 1){  ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $projectTenderDetail['etenderID']; ?></td>
							<?php  }else if($projectTenderDetail['tender_type_id'] == 2){ ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $projectTenderDetail['tender_no']; ?></td>
							<?php } ?>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($projectTenderDetail['tender_date'])); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $projectTenderDetail['tender_amount']; ?> </td>
						</tr>
					<?php $sno++;
					endforeach; ?>
				</tbody>
			 </table>
		   </fieldset>
		<?php  } ?>
		<?php  if($projectWorkSubdetails[0]['tender_detail_flag'] == 1){  ?>  
	    <h4>Contract Agreement Details</h4>
	    <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">                             
		   <table style="width:100%;">						  
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Contractor / Company Name</td>
				  <td style="padding:13px;width:30%;border:1px solid black"><?php echo $contractor_details['contractor']['name']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Contractor Mobile No.</td>
				  <td style="padding:13px;width:30%;border:1px solid black"><?php  echo $contractor_details['contractor']['mobile_no']; ?> </td>
			   </tr>	
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Work Order Reference No.</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['work_order_refno']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Agreement Amount</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php  echo ($projectWork['coastal_area'] == 1)?'Yes':'No'; ?></td>
			   </tr>
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Agreement No.</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['agreement_no']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Agreement Date</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo date('d-m-Y', strtotime($contractor_details['agreement_date'])); ?></td>
			   </tr>						   
				<tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Percentage(%)</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['perc_deduction']; ?>%</td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Agreement Period</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['agreement_period']; ?></td>
			   </tr>
			</table> 
	    </fieldset>
		<?php  } ?>				
		<?php if ($planningcount > 0) { ?>
		<h4>Planning Clearance:</h4>
		<fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">                             
			<table style="width:100%" >
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Send Date</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Project Approved</th>
						 <?php if ($planningdetail[0]['is_permission_approved'] == 1) { ?>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Approved Date</th>
						 <?php }else if ($planningdetail[0]['is_permission_approved'] == 0) { ?>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Remarks </th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($planningdetail as $planningdetails) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo  date('d-m-Y', strtotime($planningdetails['send_date'])); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo ($planningdetails['is_permission_approved'] == 1) ? "Approved" : "Rejected"; ?></td>
						   <?php if ($planningdetails['is_permission_approved'] == 1) { ?>
						   <td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($planningdetails['approved_date'])); ?></td>
						   <?php }else if ($planningdetails['is_permission_approved'] == 0) { ?>
						   <td style="padding:13px;border:1px solid black;"> <?php echo $planningdetails['remarks']; ?></td>
						   <?php } ?>
						</tr>
					<?php
						$sno++;
					endforeach; ?>
				</tbody>
			</table>
		</fieldset>
		<?php } ?>
		<?php if ($projectWorkSubdetail['site_handover_flag'] == 1) {  ?>
		  <h4>Site Handover Details:</h4>
		   <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">                                
			<table style="width: 100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Site Handover Date</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Due Date of Completion</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($projectWorkSubdetails  as $projectWorkSubdetail) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($projectWorkSubdetail['site_handover_date'])); ?>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($projectWorkSubdetail['tentative_completion_date'])); ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $projectWorkSubdetail['site_handover_remarks']; ?>
							</td>
						</tr>
					<?php
						$sno++;
					endforeach; ?>
				</tbody>
		  </table>
		</fieldset>
		<?php  } ?>	  			
		<?php if($requestcount > 0){  ?>  					 
			<h4>Project Fund Request Details</h4>
			<fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			  <div class="form-group">						
				 <table	 style="width:100%;">
				 <thead>
					 <tr align="center">
						 <th style="width:5%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Request Date</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Fund Amount (in Rs.)</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Balance Amount (in Rs.)</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Status</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Approved Date</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Transaction Date</th>
						 <th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Transaction Amount <br>(in Rs.)</th>
					 </tr>
				 </thead>
				 <tbody>
				  <?php  $i = 0;  foreach ($fundrequests as $fundrequest): ?>	
					 <tr align="center">
					     <td style="padding:13px;border:1px solid black;"><?php echo $i+1; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y',strtotime($fundrequest['project_fund_request']['request_date'])) ?></td>	
						 <td style="padding:13px;border:1px solid black;"><?php echo $fundrequest['request_amount']; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo $fundrequest['balance_amount']; ?></td>  
						 <td style="padding:13px;border:1px solid black;"><?php echo ($fundrequest['project_fund_request']['is_approved'] == 1)?'Approved':(($fundrequest['project_fund_request']['is_approved'] == 2)?'Rejected':'Processing'); ?></td> 
						 <td style="padding:13px;border:1px solid black;"><?php echo ($fundrequest['project_fund_request']['approval_date'] != '')?date('d-m-Y',strtotime($fundrequest['project_fund_request']['approval_date'])):''; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo ($fundrequest['project_fund_request']['transaction_date'] != '')?date('d-m-Y',strtotime($fundrequest['project_fund_request']['transaction_date'])):''; ?></td>
						 <td style="padding:13px;border:1px solid black;"><?php echo ($fundrequest['transaction_amount'] != '')?$fundrequest['transaction_amount']:""; ?></td>									 												 
					 </tr>
					  <?php $i++;   endforeach; ?>
				 </tbody>
			 </table>
		  </div>
		</fieldset>						 
		<?php } ?>  
		<?php if ($monitoringDetailscount > 0) { ?>
		 <h4>Project Monitoring Details List</h4>
		 <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width: 100%">
				<thead>
					<tr align="center">
						<th style="width:5%;padding:13px;border:1px solid black;font-weight:600;"> Sno </th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Monitoring Date</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Work Stage</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Physical Percentage</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Financial Percentage</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Photo Upload</th>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					  foreach ($monitorings as $MonitoringDetail) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo ($sno); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo (date('d-m-Y', strtotime($MonitoringDetail['monitoring_date']))); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $MonitoringDetail['description']; ?></td>  
							<td style="padding:13px;border:1px solid black;"><?php echo $MonitoringDetail['work_percentage']['name']; ?> </td>
							<td style="padding:13px;border:1px solid black;"><?php echo $MonitoringDetail['financial_percentage']['name']; ?></td>
							<td style="padding:5px;border:1px solid black;"><img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$MonitoringDetail['photo_upload']) ?>" height="120px" width="120px">
							</td>                                        
						</tr>
					<?php $sno++;
					endforeach; ?>
				</tbody>
			</table>
		</fieldset> 										
		 <?php  } ?>
		 <?php if ($utilizationCertificatecount > 0) { ?>  
			<h4>Utilization Certificate:</h4>
			<fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			  <table style="width:100%">
				<thead>
					<tr align="center">  
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Cerificate Date</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Amount</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($utilizationCertificate  as $utilizationCertificates) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($utilizationCertificates['certificated_date'])); ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $utilizationCertificates['amount']; ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $utilizationCertificates['remarks']; ?>
							</td>
						</tr>
					<?php
						$sno++;
					endforeach; ?>
				</tbody>
			</table>
		</fieldset>
	<?php } ?>         
	 <?php if ($handovercount > 0) { ?>
	   <h4>Project Handover To User Department Details:</h4>
	   <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width: 100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Handover Date</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Inaguration Date</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($handoverdetails  as $handoverdetail) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($handoverdetail['handover_date'])); ?>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($handoverdetail['inauguration_date'])); ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $handoverdetail['remarks']; ?>
							</td>
						</tr>
					<?php
						$sno++;
					endforeach; ?>
				</tbody>
			</table>					
		</fieldset>				
		<?php } ?>			
		<?php if ($completioncount > 0) { ?>  
		<h4>Project Completion Report:</h4>
		<fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width: 100%">
				<thead>   
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Completed Date</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">CR Amount</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Status</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($completiondetails  as $completiondetail) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($completiondetail['completed_date'])); ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $completiondetail['completion_amount']; ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $completiondetail['completion_status']; ?>
							<td style="padding:13px;border:1px solid black;"><?php echo $completiondetail['remarks']; ?>
							</td>
						</tr>
					<?php
						$sno++;
					endforeach; ?>
				</tbody>
			</table>
		</fieldset>
		<?php } ?>			
		 <?php if ($placedtoboardcount > 0) { ?>  
		<h4>Project Placed to Board Details:</h4>
		 <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width:100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Placed Date</th>
						<th style="width:7%;padding:13px;border:1px solid black;font-weight:600;">Remarks</th>
					</tr>
				</thead>
				<tbody>
				<?php $sno = 1;
				foreach ($placedtoboarddetails  as $placedtoboarddetail) : ?>
					<tr align="center">
						<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
						<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($placedtoboarddetail['placed_date'])); ?></td>
						<td style="padding:13px;border:1px solid black;"><?php echo $placedtoboarddetail['remarks']; ?>
						</td>
					</tr>
				<?php
					$sno++;
				endforeach; ?>
				</tbody>
			</table>
		 </fieldset>
		<?php } ?>						
		<?php if ($projectwiseTimeExtensionDetailcount > 0) { ?>
		<h4>Time Extension Detail list</h4>
		<fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
			<table style="width:100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Extention Date</th>
						<th style="width:10%;padding:13px;border:1px solid black;font-weight:600;">Status</th>     
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
					foreach ($projectwiseTimeExtensionDetailists as $projectwiseTimeExtensionDetailist) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo ($sno); ?></td>  
							<td style="padding:13px;border:1px solid black;"><?php echo date('d-m-Y', strtotime($projectwiseTimeExtensionDetailist['extension_date_of_ee'])); ?></td>
							<td style="padding:13px;border:1px solid black;"><?php if($projectwiseTimeExtensionDetailist['is_approved'] == 0){ echo "Forward to ".$curr_role[$projectwiseTimeExtensionDetailist['approval_role']];}else{   echo "Approved"; } ?></td>
						</tr>
					<?php $sno++;
					endforeach; ?>
				</tbody>
			</table>
		</fieldset>
		<?php } ?>
		<?php /*if($administrativesanctioncount > 0){  ?>
			<p style="page-break-before:always;">&nbsp;</p>
			<h4>GO Upload</h4>
			 <table style="width:100%;">
			   <tr>
			     <td>
			       <iframe src="<?php echo $this->Url->build('tnphc/uploads/AdministrativeSanctions/'.$administrativesanction[0]['go_file_upload'],['fullBase' => true]); ?>#toolbar=0" height="1200" width="930"  style="overflow: hidden;"></iframe>  
			       <!--iframe src="http://localhost/tnphc/uploads/AdministrativeSanctions/<?php //echo $administrativesanction[0]['go_file_upload']; ?>#toolbar=0" height="1350" width="1100"  style="overflow: hidden;"></iframe--> 
		         </td>
		       </tr>
			</table>
		<?php  } */ ?>			
		<?php if($abstractcount > 0){  ?>
			<p style="page-break-before:always;">&nbsp;</p>
			<h4>Abstract List</h4>
			 <table style="width: 100%">
				<thead>
					<tr align="center">
						<th style="width:1%;padding:13px;border:1px solid black;font-weight:600;">S.No.</th>
						<th style="width:2%;padding:13px;border:1px solid black;font-weight:600;">Item code</th>
						<th style="width:50%;padding:13px;border:1px solid black;font-weight:600;">Item Description</th>
						<th style="width:5%;padding:13px;border:1px solid black;font-weight:600;">Quantity</th>
						<th style="width:4%;padding:13px;border:1px solid black;font-weight:600;">Unit</th>
						<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Rate</th>
						<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Amount</th>
						<?php  if($contractor_detail_count >0){ ?>
						<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Contractor Rate</th>
						<th style="width:8%;padding:13px;border:1px solid black;font-weight:600;">Final Amount</th>
						<?php  } ?>
					</tr>
				</thead>
				<tbody>
					<?php $sno = 1;
						foreach ($abstract_subdetails  as $abstract_subdetail) : ?>
						<tr align="center">
							<td style="padding:13px;border:1px solid black;"><?php echo $sno; ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
							<td style="padding:13px;border:1px solid black;"><?php echo $abstract_subdetail['item_description']; ?></td>
							<td style="padding:13px;border:1px solid black;text-align:right;"><?php echo $abstract_subdetail['quantity']; ?></td>
							<td style="padding:13px;border:1px solid black;text-align:right;"><?php echo $abstract_subdetail['unit']['name']; ?></td>
							<td style="padding:13px;border:1px solid black;text-align:right;"><?php echo $abstract_subdetail['rate']; ?></td>
							<td style="padding:13px;border:1px solid black;text-align:right;"><?php echo ($abstract_subdetail['amount'])?$abstract_subdetail['amount']:''; ?></td>										
							<?php  if($contractor_detail_count >0){ ?>
							<td style="padding:13px;border:1px solid black;text-align:right;"><?php echo ($abstract_subdetail['contractor_rate'])?$abstract_subdetail['contractor_rate']:''; ?></td>										
							<td style="padding:13px;border:1px solid black;text-align:right;"><?php echo ($abstract_subdetail['final_amount'])?$abstract_subdetail['final_amount']:''; ?></td>										
							<?php  } ?>
						</tr>
					<?php 
					if($abstract_subdetail['amount'] != ''){
					 $tot_amount1 += $abstract_subdetail['amount']; 
					}						
					if($contractor_detail_count >0){							
						if($abstract_subdetail['final_amount'] != ''){
						 $tot_final_amount1 += $abstract_subdetail['final_amount'];   
						}	
					}							
				  $sno++;
				 endforeach; ?>
				</tbody>
				<tfoot>
				   <tr>
					  <th colspan="6" style="padding:13px;border:1px solid black;text-align:right;">Total &nbsp;</th>
					  <th style="padding:13px;border:1px solid black;text-align:right;"><?php echo ($tot_amount1)?ltrim($fmt->formatCurrency((float)$tot_amount1,'INR'),'₹'):'0.00';  ?></th>	
					  <?php  if($contractor_detail_count >0){ ?>							  
					  <th style="padding:13px;border:1px solid black;text-align:right;"></th>
					  <th style="padding:13px;border:1px solid black;text-align:right"><?php echo ($tot_final_amount1)?ltrim($fmt->formatCurrency((float)$tot_final_amount1,'INR'),'₹'):'0.00';  ?></th>
					  <?php } ?>
				  </tr>
			   </tfoot>
			</table>
		<?php  } ?>
	 </div>
   </div>
</div>
 <script>
   function loadphotos(id){
	 var id;
			$('[data-fancybox="gallery_"'+id+'""]').fancybox({
			  buttons: [
				"thumbs",
				"zoom",
				"fullScreen",
				"close"
			  ],
			  loop: false,
			  protect: true
			});
   }
   function print_receipt() {
	   $('.pdfreport').show();
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
		 $('.pdfreport').hide();
    }
	
	
   function getrequeststages(id) {
        // alert(val);
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxgetrequeststages/'+ id,
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
			url: '<?php echo $this->Url->webroot ?>/ProjectMonitoringDetails/ajaxphotoupload/' + id,
			success: function(data, textStatus) {
				// alert(data);
				$(".add-unsent-form").html(data);
			}
		});
	}
 </script>

