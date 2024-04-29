 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
           <div class="card-head">
            <header><?php echo $title;  ?></header>  
          </div>  
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Financial Year<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year']); ?>
					</div>
					<label class="control-label col-md-2">Department<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department']); ?>
					</div>
				</div>
                <div class="form-group row">
					<label class="control-label col-md-2">Project Code<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('project_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
					</div>
					<?php if($role_id == 6 || $role_id == 8){ ?>
                    <label class="control-label col-md-2">District<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select District']); ?>
					</div>	
                    <?php } ?>					
				</div>  				
		    </div> 
		      <div class="form-group" style="margin-top:10px;">
				<div class="offset-md-6 col-md-10">
					<button type="submit" class="btn btn-info ">Get Details</button>  
				</div>
			 </div>
		  </div>		  
	 </div>
 </div><br>
  <?php echo $this->Form->End(); ?>
   <?php if ($projectWorks != '') {  ?>				
<div class="row">
    <div class="col-md-12">     
		<div class="card">
			 <div class="card-body ">		
			  					
				 <div class="row" >                  
					<div class="table-scrollable user-table">
						<table class="table table-bordered table-advanced  display" id="example4">
							<thead>
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
								<th style="width:10%">Actions</th>
							  </tr>
							</thead>
							<tbody>							
								<?php $sno = 1;
								foreach ($projectWorks as $projectWorkSubdetail) : ?>
									<tr>
										<td class="trcount"><?php echo $sno; ?></td>
										<td><?php echo $projectWorkSubdetail['work_code']; ?></td>
									    <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
										<td><?php echo $projectWorkSubdetail['district_name']; ?></td>
										<td><?php echo $projectWorkSubdetail['division_name']; ?></td>
										<td><?php echo $projectWorkSubdetail['circle_name']; ?></td>                                   
										<td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                   
										<td><?php echo ($projectWorkSubdetail['is_approved'] == 1)?"<span class='badge badge-pill badge-success'>Approved</span>":"<span class='badge badge-pill badge-Danger'>Not Approved</span>"; ?></td>                                                                                   
										<td><?php echo $projectWorkSubdetail['work_status']; ?></td> 
										<td class="text-center">
											<span>
											 <?php //if($projectWorkSubdetail['detailed_estimate_flag'] == 1){ ?>
											  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectWorks','action' => 'workview',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?><br><br>
											 <?php //} ?>	
											   <?php //echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'workview',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
											   <?php //Detailed Estimate ?>
											   <?php if($type ==1){ ?>
												<?php if($division_id == $projectWorkSubdetail['division_id']){ ?>									
						                        <?php if($projectWorkSubdetail['detailed_estimate_flag'] == 0 && $role_id == 2){ ?>					
 											       <?php echo $this->Html->link(__('<i class="fa fa-money"></i>Detailed Estimate'), ['action' => 'projectwisedevelopmentwork',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
						                           <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
											    <?php } } ?>
												<?php   if($projectWorkSubdetail['detailed_estimate_flag'] == 1 && $projectWorkSubdetail['detailed_estimate_current_role'] == $role_id){  ?>												 
												<?php   if(($division_id == $projectWorkSubdetail['division_id'] && ($role_id == 14 || $role_id ==4)) || ($circle_id == $projectWorkSubdetail['circle_id'] && $role_id ==5) || ($projectWorkSubdetail['detailed_estimate_current_role'] == 6)){ ?>	   	
												  <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Detailed Estimate Approval'), ['action' => 'projectdetailedestimateapproval',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
										       <?php } } ?> 
                                               <?php  } ?>
											   
											    <?php //Technical Sanction ?>
											   
											     <?php if($type ==2){ ?>  
											   	 <?php if($projectWorkSubdetail['detailed_estimate_approval'] == 1 && $projectWorkSubdetail['technical_sanction_flag'] == 0){  ?>  
												 <?php if(($division_id == $projectWorkSubdetail['division_id'] && ($role_id == 14))){ ?>	   	
												     <?php  if($projectWorkSubdetail['is_approved'] == 0){ ?>
													 <?php echo $this->Html->link(__('<i class="fa fa-plus"></i> Technical Sanction'), ['action' => 'technicalsanction',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
  											     <?php } } } ?>
												 	 <?php   if($projectWorkSubdetail['approval_role'] == $role_id){  ?>
													<?php   if($projectWorkSubdetail['technical_sanction_flag'] == 1){  ?>
													   <?php   if($projectWorkSubdetail['is_approved'] == 0){ ?>
														<?php echo $this->Form->postLink(__('<i class="fa fa-pencil"></i>&nbsp;Approve'), ['action' => 'approval',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['confirm' => __('Are you sure you want to Approve {0}?',  $projectWorkSubdetail['work_code']),'escape' => false,'class'=>'btn btn-danger btn-xs']); ?><br><br>
												   <?php  }} }  ?>
												 <?php  } ?>
												
												   
											    <?php  //Tender Details ?>
											    <?php if($type ==3){ ?>
											    <?php if($projectWorkSubdetail['is_approved'] == 1){   ?> 		   
												<?php if(($projectWorkSubdetail['approval_role'] == 4 && $division_id == $projectWorkSubdetail['division_id'] && $role_id == 14) || ($projectWorkSubdetail['approval_role'] == 5 && $circle_id == $projectWorkSubdetail['circle_id'] && $role_id == 12) || ($projectWorkSubdetail['approval_role'] == 6 && $role_id == 10)){ ?>
											    <?php if($projectWorkSubdetail['tender_detail_flag'] == 0){  ?>
											    <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Tender Details'), ['action' => 'tenderdetails',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
											    <?php  } } }   ?>												 
												<?php  } ?>		

                                                  <?php  //Planning Permissions ?>
												<?php if($type ==4){ ?>
													<?php  if($projectWorkSubdetail['tender_detail_flag'] == 1){  ?>
												    <?php // if(($projectWorkSubdetail['approval_role'] == 4 && $division_id == $projectWorkSubdetail['division_id'] && $role_id == 13) || ($projectWorkSubdetail['approval_role'] == 5 && $circle_id == $projectWorkSubdetail['circle_id'] && $role_id == 11)  || ($projectWorkSubdetail['approval_role'] == 6 && $role_id == 9)){ ?>
												    <?php  if(($division_id == $projectWorkSubdetail['division_id'] && $role_id == 13)){ ?>
												 	<?php  if($projectWorkSubdetail['planning_permission_flag'] == 0){  ?>
												    <?php  echo $this->Html->link(__('<i class="fa fa-pencil"></i> Planning Permission'), ['action' => 'planningpermission',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
												    <?php  } } } ?>
												
												<?php  } ?>
												
												
												 <?php  //Site Handover ?>
												 
												 <?php if($type ==5){ ?>
												 <?php if(($division_id == $projectWorkSubdetail['division_id'] && $role_id == 14)){ ?>
												 <?php if($projectWorkSubdetail['planning_permission_flag'] == 1 && $projectWorkSubdetail['site_handover_flag'] == 0){  ?>
												 <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Site H/O to Contractor'), ['action' => 'sitehandover',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
												 <?php } ?>
												 <?php } ?>
												 <?php } ?>
												 
												 <?php  //Fund Request ?>
												 <?php if($type ==6){ ?>
												     <?php if($division_id == $projectWorkSubdetail['division_id'] && $role_id == 13 && $projectWorkSubdetail['fund_request_flag'] == 0){ ?>
													 <?php echo $this->Html->link(__('<i class="fa fa-money"></i>New Fund Request'), ['action' => 'fundrequest',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
												     <?php }  ?>
												   
												       <?php  if($projectWorkSubdetail['fund_request_flag'] == 1){ ?>
													   <?php  if($user_id == $projectWorkSubdetail['fund_approval_user_id']){ ?>
															<?php echo $this->Html->link(__('<i class="fa fa-money"></i> Fund Request Approval'), ['action' => 'fundrequest',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
													   <?php  }   ?>	
													   <?php  }   ?>
												   <?php }  ?>
												   
												    <?php if($type ==7){ ?>
												     <?php if($division_id == $projectWorkSubdetail['division_id'] && $role_id == 13){ ?>
												   
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Project Monitoring'), ['controller'=>'ProjectMonitoringDetails','action' => 'projectmonitoring',$projectWorkSubdetail['project_work_id'],$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>

												    <?php  }   ?>
												   <?php }  ?>
												   
												
												
											</span>
										</td>                                               
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>
						</table>
					</div>
				</div>		
			</div>			
		</div>                
    </div>
</div>
<?php } ?>
<script>
    $("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: false
            },
            'department_id': {
                required: false
            }          
        },

        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            },
            'department_id': {
                required: "Select Department"
            }
        },
        submitHandler: function(form) {
			
			var fin_id = $('#financial-year-id').val();
			var dep_id = $('#department-id').val();
			var project_code = $('#project-code').val();
			var district_id = $('#district-id').val();
			
			if(fin_id != '' || dep_id != '' || project_code != '' || district_id != ''){
           
               form.submit();
			 
			}else{
				alert('Select any one input!');
				return false;
				
			}
        }
    });   
</script>