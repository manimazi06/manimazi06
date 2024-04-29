<div class="row">
    <div class="col-md-12">     
		<div class="card">
			<div class="card-head">
				 <header>Users</header>
			
				<div class="tools">
					<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
				</div>
			</div>
			 <div class="card-body ">   
			  <div class="row" style="margin-top:10px;">
				<div class="col-md-6 col-sm-6 col-6">
                        <?php echo $this->Html->link(__('Add Users <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false,'class'=>'mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 btn btn-info']); ?>
				</div>
				 </div><br>	
			   <?php if ($users != '') {  ?>									
				 <div class="row" style="margin-top:10px;">                  
					<div class="table-scrollable">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						  <table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">

							<thead>
								<tr class="text-center">
									<th style="width:1%"> Sno </th>
									<th style="width:10%"> Role </th>
									<th style="width:10%"> Name </th>
									<th style="width:10%"> Username </th>
									<th style="width:10%"> Email </th>
									<th style="width:10%"> Mobile Number </th>
									<th style="width:20%"> Actions </th>
								</tr>
							</thead>
							<tbody>
								 <?php if(isset($users)){ ?>
								<?php if(count($users) >0){ ?>
								<?php $sno =1; foreach ($users as $user): ?>
								<tr >
									<td align="center" ><?php echo $sno; ?></td>
									<td align="center" class="alignment"><?php echo $user['role']['name']; ?></td>
									<td align="center" class="alignment"><?php echo $user['name'] ?></td>
									<td align="center" class="alignment"><?php echo $user['username']; ?></td>
									<td align="center" class="alignment"><?php echo $user['email']; ?></td>
									<td align="center" class="alignment"><?php echo $user['mobile_no']; ?>
									</td>
									 <td  align="center" style="margin-top:10px;">
										<?php  echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',base64_encode($user['id'])], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
										<?php  echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',base64_encode($user['id'])], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
									
									 </td>
								
								</tr>
								<?php $sno++; endforeach; ?>
								 <?php }else{ echo "<center><hr>No Data available!</center>"; }  ?>
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