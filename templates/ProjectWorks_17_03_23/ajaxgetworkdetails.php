 <style>
.red-tooltip + .tooltip > .tooltip-inner {background-color: #939393}
.cursor{
	cursor:pointer;
}
.table.table-advanced thead tr th{border-width: 1px !important;text-align:center;}
#district_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;color: #FFF;}
#division_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;}
#scheme_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;}
#asset_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;}
tr.shown td.details-control {
    background: rgba(0, 0, 0, 0) url("<?php echo $this->Url->build('/img/minus.png', ['fullBase' => true]); ?>") no-repeat scroll center 10px;
	padding:15px !important;
	background-size: 13px;
}
td.details-control {
    background: rgba(0, 0, 0, 0) url("<?php echo $this->Url->build('/img/plus.png', ['fullBase' => true]); ?>") no-repeat scroll center 10px;  
    cursor: pointer;
	padding:15px !important;
	background-size: 13px;
}

.info{	
	background-color:#222c3c !important;
	color:white !important;
}
</style>
<?php if($projectWorkSubdetailscount > 0) { ?>
 <div class="form-group" style= "background-color:#f3f4f6 !important">
	<fieldset>
		<table class="table table-hover table-bordered" style="max-width: 99%;margin-left: 1%;">
			<thead class="info">
				<tr  align="center">
					<th style="width:5%"> S.No</th>
					<th style="width:10%">Work ID</th>
					<th style="width:15%">Work Name</th>
					<th style="width:10%">District</th>
					<th style="width:7%">Division</th>
					<th style="width:7%">Circle</th>
					<th style="width:10%">Sanctioned Amount <br>(in Rs.)</th>
					<th style="width:10%">Technical Sanction<br> Approval</th>
					<th style="width:10%">Work Status</th>
					<!--th style="width:10%">Sanction Approval By</th-->
					<!--th style="width:10%">Actions</th-->
				</tr>
			</thead>
			<tbody class="add_doc">
			   <?php
				$i = 0;
				foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>
				<tr >
					<td class="trcount"><?php echo $i + 1; ?></td>
					<td><a class="ex1" style="color:red;" href="<?php echo $this->Url->build('/project-works/workview/'.$id.'/'. $projectWorkSubdetail['id'], ['fullBase' => true]); ?>"
                                          target="_blank"><?php echo ($projectWorkSubdetail['work_code'])?$projectWorkSubdetail['work_code']:$projectWorkSubdetail['project_work']['project_code']; ?></a></td>
					<td><?php echo $projectWorkSubdetail['work_name']; ?></td>  
					<td><?php echo $projectWorkSubdetail['district']['name']; ?></td>
					<td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
					<td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
					<td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                   
					<td><?php echo ($projectWorkSubdetail['is_approved'] == 1)?"<span class='badge badge-pill badge-success'>Approved</span>":"<span class='badge badge-pill badge-Danger'>Not Approved</span>"; ?></td>                                                                                   
					<td><?php echo $projectWorkSubdetail['project_work_status']['name']; ?></td>                                                                                   
					<!--td align="center"-->
					  <?php //if($projectWorkSubdetail['detailed_estimate_flag'] == 1){ ?>
					  <?php //echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectWorks','action' => 'workview',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?>
					 <?php //} ?>	

                        <?php /*if($division_id == $projectWorkSubdetail['division_id']){ ?>											
						 
					 <?php if($projectWorkSubdetail['detailed_estimate_flag'] == 0){ ?>
					 		<?php echo $this->Html->link(__('<i class="fa fa-money"></i>Detailed Estimate'), ['action' => 'projectwisedevelopmentwork',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

						  <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

					 <?php } } ?>  

					 <?php   if($projectWorkSubdetail['detailed_estimate_flag'] == 1 && $projectWorkSubdetail['detailed_estimate_current_role'] == $role_id){  ?>												 
							  <?php if(($division_id == $projectWorkSubdetail['division_id'] && ($role_id ==3 || $role_id ==4)) || ($circle_id == $projectWorkSubdetail['circle_id'] && $role_id ==5) || ($projectWorkSubdetail['detailed_estimate_current_role'] == 6)){ ?>	   	

							  <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Detailed Estimate Approval'), ['action' => 'projectdetailedestimateapproval',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

					 <?php } } ?>  
														
					  <?php   if($projectWorkSubdetail['detailed_estimate_approval'] == 1){  ?>  
					  <?php if(($division_id == $projectWorkSubdetail['division_id'] && $role_id == 14)){ ?>	   	
						<?php  if($projectWorkSubdetail['is_approved'] == 0){ ?>
						 <?php echo $this->Html->link(__('<i class="fa fa-plus"></i> Technical Sanction'), ['action' => 'technicalsanction',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>


					  <?php } } } ?>
					       <?php   if($projectWorkSubdetail['approval_role'] == $role_id){  ?>
					        <?php   if($projectWorkSubdetail['technical_sanction_flag'] == 1){  ?>
							   <?php   if($projectWorkSubdetail['is_approved'] == 0){ ?>
								<?php echo $this->Form->postLink(__('<i class="fa fa-pencil"></i>&nbsp;Approve'), ['action' => 'approval',$id,$projectWorkSubdetail['id']], ['confirm' => __('Are you sure you want to Approve {0}?',  $projectWorkSubdetail['work_code']),'escape' => false,'class'=>'btn btn-danger btn-xs']); ?><br><br>
						   <?php  }} }  ?>
					     <?php   if($projectWorkSubdetail['is_approved'] == 1){   ?> 		   
						    <?php if(($division_id == $projectWorkSubdetail['division_id'] && $role_id == 14)){ ?>
						  <?php  if($projectWorkSubdetail['tender_detail_flag'] == 0){  ?>
						  <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Tender Details'), ['action' => 'tenderdetails',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						  <?php  } } }   ?>
						  <?php  if($projectWorkSubdetail['tender_detail_flag'] == 1){  ?>
						   <?php if(($division_id == $projectWorkSubdetail['division_id'] && $role_id == 13)){ ?>
							<?php  if($projectWorkSubdetail['planning_permission_flag'] == 0){  ?>
						  <?php  echo $this->Html->link(__('<i class="fa fa-pencil"></i> Planning Permission'), ['action' => 'planningpermission',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						  <?php  } } } ?>
						 
						 
						  <?php if(($division_id == $projectWorkSubdetail['division_id'] && $role_id == 14)){ ?>
							   <?php  if($projectWorkSubdetail['planning_permission_flag'] == 1 && $projectWorkSubdetail['site_handover_flag'] == 0){  ?>
							   <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Site H/O to Contractor'), ['action' => 'sitehandover',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
								<?php } ?>
							<?php } ?>
						

						   <?php  if($projectWorkSubdetail['site_handover_flag'] == 1){    ?>													   
						   <?php if($role_id == 13){ ?>
						   <?php if($division_id == $projectWorkSubdetail['division_id']){ ?>
							 <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Project Monitoring'), ['controller'=>'ProjectMonitoringDetails','action' => 'projectmonitoring',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
						     <?php if($division_id == $projectWorkSubdetail['division_id'] && $projectWorkSubdetail['fund_request_flag'] == 0){ ?>
							 <?php echo $this->Html->link(__('<i class="fa fa-money"></i>New Fund Request'), ['action' => 'fundrequest',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						   <?php }  ?>
						   <?php } }  ?>	
 						    <?php echo $this->Html->link(__('<i class="fa fa-clock-o"></i>Project Minute Details'), ['action' => 'projectminutedetail', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
					
						   <?php } ?>	
							 <?php  /*if($projectWorkSubdetail['site_handover_flag'] == 1){  ?>
							 <?php if($role_id == 14 || ($user_id == $projectWorkSubdetail['fund_approval_user_id'])){ ?>
						   <?php if($division_id == $projectWorkSubdetail['division_id'] && $projectWorkSubdetail['fund_request_flag'] == 0){ ?>
							 <?php echo $this->Html->link(__('<i class="fa fa-money"></i>New Fund Request'), ['action' => 'fundrequest',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						   <?php } } ?>
																			   
						   <?php }*/  ?>	
						   <?php  /*if($projectWorkSubdetail['fund_request_flag'] == 1){ ?>
						   <?php  if($user_id == $projectWorkSubdetail['fund_approval_user_id']){ ?>
								<?php echo $this->Html->link(__('<i class="fa fa-money"></i> Fund Request Approval'), ['action' => 'fundrequest',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						   <?php  }   ?>	
						   <?php  }   ?>
							<?php if($role_id == 8){ ?> 
							  <?php  if($projectWorkSubdetail['site_handover_flag'] == 1){  ?>
								<?php echo $this->Html->link(__('<i class="fa fa-money"></i> Fund Details'), ['action' => 'funddetails',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						  <?php } }*/ ?>                     
			
				   <!--/td-->                                                
				</tr>
				  <?php $i++;
				endforeach; ?>
			</tbody>
		
		</table>
	</fieldset>                     
</div>
<?php }else{ ?>
	<div style="text-align:center" class="info">
		<b>No Records Found </b>
	</div>
<?php } ?>