<div class="row">
    <div class="col-md-12">     
		<div class="card">
			<div class="card-head">
				 <header>Proposed Projects</header>
				<!--span class="mx-3" style="float:right">
					<?php //echo $this->Html->link(__('<i class="fa fa-plus"></i> Add Project'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-info btn-sm']); ?>
				</span-->
				<div class="tools">
					<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
				</div>
			</div>
			 <div class="card-body ">   
			  <div class="row" style="margin-top:10px;">
			  
				<div class="col-md-6 col-sm-6 col-6">
				<?php if($role_id == 6){  ?>
				<?php echo $this->Html->link(__('<i class="fa fa-plus"></i> Add Project'), ['action' => 'add'], ['escape' => false, 'class'=>'btn btn-info' ]); ?>
				<?php  } ?>
				</div>
				 </div><br>	
			   <?php if ($projectWorks != '') {  ?>									
				 <div class="row" style="margin-top:10px;">                  
					<div class="table-scrollable">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th > Sno </th>
									<th  align="center"> Project Code</th>
									<th  align="center"> Departments</th>
									<th align="center"> Financial Year </th>
									<th style="width:20%"> Project Name </th>
									<th style="width:10%"> Status </th>
									<th align="center"> Actions </th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($projectWorks)) { ?>
								<?php if (count($projectWorks) > 0) { ?>
				
								<?php $sno = 1;
								foreach ($projectWorks as $projectWork) : ?>
									<tr>
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo $projectWork['project_code']; ?></td>
										<td align="center" class="alignment"><?php echo $projectWork['department']['name']; ?></td>
										<td align="center" class="alignment"><?php echo $projectWork['financial_year']['name']; ?></td>
										<td align="left"   class="alignment"><?php echo $projectWork['project_name']; ?></td>
										<td align="left"   class="alignment"><?php echo ($projectWork['ce_approved'] == 0)?"<span style='color:blue;'>Pending</span>":(($projectWork['ce_approved'] == 2)?"<span style='color:red;'>Rejected</span>":""); ?></td>
										<td class="text-center" style="margin-top:10px;">
											<span style="margin-top:10px;">
												<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
											    <?php if($role_id == 6){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit/Approve'), ['action' => 'edit',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
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