<?php if($projectdetails != ""){  ?>
	<center><b><h3><?php echo $projectdetails[0]['division_name'];  ?>&nbsp;&nbsp; Division</h3></b></center>
	<div class="table-scrollable">
		<table class="table table-bordered table-advanced display" id="example4">
			<thead>
				<tr class="text-center">
					<th>Sno</th>
					<th>Department Name</th>
					<th>Financial Year</th>
					<th>Work Code</th>
					<th>Work Name</th>
					<th>FS Sanctioned <br>(in Rs.)</th>  
					<th>Project Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $sno =1; foreach ($projectdetails as $project): ?>
				<tr class="odd gradeX">
					<td><?php echo($sno); ?></td>
					<td><?php echo $project['dname']; ?></td>
					<td><?php echo $project['financial_yeartname']; ?></td>
					<td><?php echo $project['work_code']; ?></td>
					<td><?php echo $project['work_name']; ?></td>
					<td><?php echo $project['fs_amount']; ?></td>  
					<td><?php echo $project['pws']; ?></td>
					<td>
					   <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectWorks','action' => 'workview',$project['project_id'],$project['work_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?><br><br>
					</td>
				</tr>
				<?php $sno++; endforeach; ?>
			</tbody>
		</table>
	</div>
<?php } ?>