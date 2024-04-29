<div class="row">
    <div class="col-md-12">     
		<div class="card">
		    <div class="card-head">
				 <header>Notifications				 	
				 </header>
					
			</div>
			 <div class="card-body ">   
			  <div class="row">
					<div class="table-scrollable">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						<table class="table table-hover table-bordered" style="width: 100%">
							<thead>
								<tr class="text-center">
									<th style="width:1%;">S.no</th>
									<th style="width:10%;">Forwarded Date</th>
									<th style="width:10%;">Notification Type </th>
									<th style="width:10%;">Forwarded From </th>								
									<th align="center" style="width:10%;"> Actions </th>
								</tr>
							</thead>
							<tbody>			
				
								<?php $sno = 1;
								foreach ($notification_list as $notification) : ?>
									<tr>
										<td ><?php echo ($sno); ?></td>
										<td align="left"><?php echo date('d-m-Y',strtotime($notification['forwarded_date'])); ?></td>
										<?php if($notification['notification_type_id'] >= 4){ ?>
										<td align="left"><?php echo $notification['notification_type']['name']." for ".$notification['project_work_subdetail']['work_code']; ?></td>
										<?php }else{ ?>
										<td align="left"><?php echo $notification['notification_type']['name']; ?></td>
										<?php  } ?>
										<td align="left"><?php echo $user[$notification['forward_user_id']]; ?></td>
										<td class="text-center">
											<span style="margin-top:15px;">		
											    <?php if($notification['notification_type_id'] == 1){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'projectfundrequestlist'], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
									            <?php }else if($notification['notification_type_id'] == 2){ ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'projectapprove',$notification['project_work_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 3){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'administrativesanctionadd'], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 4){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'projectdetailedestimateadd',$notification['project_work_id'],$notification['project_work_subdetail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 5){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'financialsanctionadd'], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 6){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'projectabstractadd',$notification['project_work_id'],$notification['project_work_subdetail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 7){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'projectabstractapproval',$notification['project_work_id'],$notification['project_work_subdetail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 8){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'tenderdetails',$notification['project_work_id'],$notification['project_work_subdetail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 9){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'planningpermission',$notification['project_work_id'],$notification['project_work_subdetail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 10){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectWorks','action' => 'sitehandover',$notification['project_work_id'],$notification['project_work_subdetail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 11){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'UcFundSanctionedDetails','action' => 'add',$notification['utilization_certificate_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php }else if($notification['notification_type_id'] == 12){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-right"></i> Go to Page'), ['controller'=>'ProjectwiseTimeExtensionDetails','action' => 'approval',$notification['project_work_id'],$notification['project_work_subdetail_id'],$notification['projectwise_time_extension_detail_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												<?php } ?>
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
