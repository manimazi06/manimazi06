<?php if($projectdetails != ""){  ?>
	<?php if($type == 1){  ?>
	<center><b><h3>Contractor Details</h3></b></center>
	<div class="table-scrollable">
		<table class="table table-bordered table-advanced display">
			<thead>
				<tr class="text-center">
					<th>Sno</th>
					<th>Contractor Name</th>
					<th>Contractor Class</th>
					<th>Mobile No</th>
					<th>Email</th>
					<th>GST No.</th>
					<th>Address</th>
					<th>Register Date</th>
					<th>Valid Upto</th>					
				</tr>
			</thead>
			<tbody>
				<?php $sno =1; foreach ($projectdetails as $project): ?>
				<tr class="odd gradeX">
					<td><?php echo($sno); ?></td>
					<td><?php echo $project['name']; ?></td>
					<td><?php echo 'Class - '.$project['contract_class']; ?></td>
					<td><?php echo $project['mobile_no']; ?></td>
					<td><?php echo $project['email']; ?></td>
					<td><?php echo $project['gst_no']; ?></td>
					<td><?php echo $project['address']; ?></td>  
					<td><?php echo date('d-m-Y',strtotime($project['register_date'])); ?></td>
					<td><?php echo date('d-m-Y',strtotime($project['validity_upto'])); ?></td>				
				</tr>
				<?php $sno++; endforeach; ?>
			</tbody>
		</table>
	</div>
  <?php }else if($type == 2 || $type == 3){  ?>
  <center><b><h3><?php echo $projectdetails[0]['division_name'];  ?>&nbsp;&nbsp; Division</h3></b></center>
	<div class="table-scrollable">
		<table class="table table-bordered table-advanced display" id="example4">
			<thead>
				<tr class="text-center">
					<th>Sno</th>
					<th>Department Name</th>
					<th>Work Code</th>
					<th>Work Name</th>
					<th>FS Sanctioned <br>(in Rs.)</th>  
					<th>Agreement Amount <br>(in Rs.)</th>  
					<?php if($type == 3){ ?>
					<th>Expenditure Incurred <br>(in Rs.)</th> 
					<?php } ?>					
					<th>Project Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $sno =1; foreach ($projectdetails as $project): ?>
				<tr class="odd gradeX">
					<td><?php echo($sno); ?></td>
					<td><?php echo $project['dname']; ?></td>
					<td><?php echo $project['work_code']; ?></td>
					<td><?php echo $project['work_name']; ?></td>
					<td style="text-align:right;"><?php echo $project['fs_amount']; ?></td>  
					<td style="text-align:right;"><?php echo $project['agreement_amount']; ?></td> 
                    <?php if($type == 3){ ?>					
					<td style="text-align:right;"><?php echo $project['expenditure_incurred']; ?></td>  
					<?php } ?>
					<td><?php echo $project['pws']; ?></td>
					<td>
					   <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectWorks','action' => 'workview',$project['project_id'],$project['work_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?><br><br>
					</td>
				</tr>
				<?php 
				$tot_aggr                += $project['agreement_amount'];
				$totexpenditure_incurred                += $project['expenditure_incurred'];
				$sno++; endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="5" style="text-align:right;">Total&nbsp;&nbsp;</th>
					<th style="text-align:right;"><?php echo number_format((float)$tot_aggr, 2, '.', '') ;  ?>&nbsp;</th>
					<?php if($type == 3){ ?>
					<th style="text-align:right;"><?php echo number_format((float)$totexpenditure_incurred, 2, '.', '') ;  ?>&nbsp;</th>
					<?php } ?>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
  <?php } ?>	
<?php } ?>