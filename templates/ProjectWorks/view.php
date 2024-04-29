<?php echo $this->Form->create($projectWork,['id'=>'FormID','class'=>'form-horizontal', "autocomplete"=>"off",'enctype'=>'multipart/form-data']); ?>
<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">      
        <div class="card-body">
		   <h4 class = "sub-tile">Project - <?php  echo $projectWork['project_code']; ?> &nbsp;[<?php  echo ($projectWork['ce_approved'] == 1)?"Project Approved":"Pending" ; ?>]</h4>
			<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;background-color:ghostwhite;padding:5px;">
			 <div class="col-md-12">
				<div class="form-group row">                      
					<label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;: </span></label>
					<div class="col-md-8 lower">                           
					   <?php  echo $projectWork['project_name']; ?>   
					</div>
				</div>
				<?php if($projectWork['project_description'] != ''){ ?>
				 <div class="form-group row">                       
					<label class="control-label col-md-2 bol">Project Description<span class="required">&nbsp;&nbsp;: </span></label>
					<div class="col-md-8 lower">                           
					   <?php  echo $projectWork['project_description']; ?>   
					</div>           
				</div> 
			   <?php } ?>					
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
					<?php if($projectWork['building_type_id'] != 0){ ?>

					<label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
					<div class="col-md-4 lower">
					  <?php  echo $projectWork['building_type']['name']; ?>              
					</div>
					<?php  } ?>
					 <label class="control-label col-md-2 bol">Rough Cost (Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
					<div class="col-md-4 lower"> 
						<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
					 </div>
				</div>
				 <?php  if($projectWork['scheme_type_id'] != '0'){ ?>   
				<div class="form-group row">
					<label class="control-label col-md-2 bol">Is Coastal Area ?<span class="required"> &nbsp;&nbsp;: </span></label>
					<div class="col-md-4 lower">
						 <?php  echo ($projectWork['coastal_area'] == 1)?'Yes':'No'; ?>              
					</div>
					<label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;: </span></label>
					<div class="col-md-4 lower">
					  <?php  echo $projectWork['scheme_type']['name']; ?>              
					</div>
				</div>
				<?php } ?>					
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
		   </fieldset>	
			<?php   if ($projectWorkSubdetailscount > 0) {   ?>
			<h4 class = "sub-tile">Division Wise Work Details</h4>					
			<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
			 <div class="form-group">                               
				<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
					<thead>
						<tr align="center">
							<th style="width:1%"> S.No</th>
							<th style="width:10%">Work Code</th>
							<th style="width:20%">Work Name</th>
							<th style="width:8%">Place /Area Name</th>
							<th style="width:8%">District</th>
							<th style="width:8%">Division</th>
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
						   <td><?php echo $projectWorkSubdetail['place_name']; ?></td>
						   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
						   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
						   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
						   <td align="right"><?php echo number_format((float)$projectWorkSubdetail['rough_cost'], 2, '.', '') ; ?></td>
						   <td align="right"><?php echo number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', '') ; ?></td>
						   <td align="right"><?php echo $projectWorkSubdetail['project_work_status']['name']; ?></td>
							<!--td>										
							   <?php if($projectWorkSubdetail['detailed_estimate_flag'] == 1){ ?>
							   <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['action' => 'workview',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
							   <?php } ?>										   
							</td-->			
						</tr>
						  <?php
							 $tot_rough    += $projectWorkSubdetail['rough_cost'];
							 $tot_sanction += $projectWorkSubdetail['sanctioned_amount'];
						  $i++;
						endforeach; ?>
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
			<?php   if ($administrativesanctioncount > 0) {   ?>
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
			  </fieldset><br><br>				
			<?php  }if ($financialsanctionscount > 0){ ?> 					
			 <h4 class = "sub-tile">Financial Sanction Details:</h4>
			 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">                                  
				<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;"  bgcolor="white">
					<thead>
						<tr align="center">
							<th  style="width:5%"> S.No</th>
							<th style="width:20%">GO No</th>
							<th style="width:20%">GO Date</th>
							<th style="width:20%">Sanction amount (in Rs.)</th>
							<th style="width:20%">File Upload</th>
						</tr>
					</thead>
					<tbody class="add_doc">
						<?php
						$i = 0;
						foreach ($financialsanctions as $financialsanction) : ?>
							<tr  align="center">
								<td class="trcount"><?php echo $i + 1; ?></td>
								<td><?php echo $financialsanction['go_no']; ?></td>
								<td><?php echo date('d-m-Y', strtotime($financialsanction['go_date'])); ?></td>
								<td><?php echo $financialsanction['sanctioned_amount']; ?></td>
								<td>
								<?php if($financialsanction['sanctioned_file_upload'] != ''){  ?>
									<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' .$financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
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
        </div>
    </div>
</div>
<?php echo $this->Form->End();?>