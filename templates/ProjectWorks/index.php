<?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        	<div class="card-head">
				 <header>Proposed Projects				 	
				 </header>
				 <?php if($role_id == 9){  ?>
				     <div class="tools">
					  <?php echo $this->Html->link(__('Add Project<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				    </div>
					<?php  } ?>				
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
                    <label class="control-label col-md-2">District<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select District']); ?>
					</div>					
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
<div class="row">
    <div class="col-md-12">     
		<div class="card">
		    <!--div class="card-head">
				 <header>Proposed Projects				 	
				 </header>
					
			</div-->
			 <div class="card-body ">   
			  <div class="row">	  

			   <?php if ($projectWorks != '') {  ?>									
				 <div class="row">                  
					<div class="table-scrollable">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%;">S.no</th>
									<th style="width:5%;">Project Code</th>
									<th style="width:25%;">Project Name </th>
									<th style="width:10%;">Departments</th>
									<th style="width:10%;">Financial Year </th>
									<th style="width:10%;">Rough Cost (Rs.) </th>
									<th style="width:10%">Approval Status </th>
									<th align="center" style="width:10%;"> Actions </th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($projectWorks)) { ?>
								<?php if (count($projectWorks) > 0) { ?>
				
								<?php $sno = 1;
								foreach ($projectWorks as $projectWork) : ?>
									<tr>
										<td ><?php echo ($sno); ?></td>
										<td align="left"><?php echo $projectWork['project_code']; ?></td>
										<td align="left"><?php echo $projectWork['project_name']; ?></td>
										<td align="left"><?php echo $projectWork['department_name']; ?></td>
										<td align="left"><?php echo $projectWork['financial_year']; ?></td>
										<td align="left"><?php echo $projectWork['project_amount']; ?></td>
										<td align="left"><?php echo ($projectWork['ce_approved'] == 0)?"<span style='color:blue;'>Pending</span>":(($projectWork['ce_approved'] == 2)?"<span style='color:red;'>Rejected</span>":""); ?></td>
										<td class="text-center">
											<span style="margin-top:15px;">
												<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
											    <?php if($role_id == 9 && $projectWork['ce_approved'] == 0){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
												<?php echo $this->Html->link(__('<i class="fa fa-trash"></i>Delete'), ['action' => 'deleteproposalwork',$projectWork['id']], ['confirm' => __('Are you sure you want to delete Project - {0}?',  $projectWork['project_name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?><br><br>

												 <?php } ?>
												 <?php if($role_id == 6 && $projectWork['ce_approved'] == 0){  ?>
												 	<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Approve'), ['action' => 'projectapprove',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>&nbsp;&nbsp;&nbsp;
											    <?php } ?>
												 
											</span>
										</td>                                               
									</tr>
								<?php $sno++;
								endforeach; ?>
								<?php } else {
									//echo "<center><hr>No Data available!</center>";
									 } ?>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php } ?>
			</div>
			
		</div>
                
    </div>
</div>

<script>   
    function print_receipt() {
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=842,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
    }

    $(".comp").attr("data-placeholder", "Select Company");
    $(".client").attr("data-placeholder", "Select Client");
</script>