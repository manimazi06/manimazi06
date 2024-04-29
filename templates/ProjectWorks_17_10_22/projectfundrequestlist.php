
<div class="row">
    <div class="col-md-12">     
		<div class="card">
		   <div class="card-head">
				 <header>Fund Request List			 	
				 </header>
				 <?php if($role_id == 13){  ?>
				     <div class="tools">
					  <?php echo $this->Html->link(__('Add New Fund Request<i class="fa fa-plus"></i>'), ['action' => 'projectfundrequestadd'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				    </div>
					<?php  } ?>				
			</div>
			 <div class="card-body ">   
			  <div class="row">	  

			   <?php if ($projectFundRequests != '') {  ?>									
				 <div class="row">                  
					<div class="table-scrollable">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th>Sno</th>
									<th align="center">Division</th>
									<th align="center">Request Date</th>
									<th align="center">Total Request Amount (Rs.) </th>
									<th align="center">Current Status</th>
									<th align="center"> Actions </th>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1;
								foreach ($projectFundRequests as $projectFundRequest) : ?>
									<tr>
										<td ><?php echo ($sno); ?></td>
										<td align="left"><?php echo $projectFundRequest['division']['name']; ?></td>
										<td align="left"><?php echo date('d-m-Y',strtotime($projectFundRequest['request_date'])); ?></td>
										<td align="left"><?php echo $projectFundRequest['total_request_amount']; ?></td>
										<td align="left"><?php echo $projectFundRequest['fund_status']['name']; ?></td>
										<td class="text-center">
										
										<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'projectfundrequestview',$projectFundRequest['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
										<?php if($projectFundRequest['user_id'] == $currentuser_id){ ?>
										<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>  Fund Approval'), ['action' => 'projectfundrequestapproval',$projectFundRequest['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>
                                        <?php } ?>
											
										</td>                                               
									</tr>
								<?php $sno++;
								endforeach; ?>
								
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