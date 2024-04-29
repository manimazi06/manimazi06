<?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        	<div class="card-head">
				 <header>Users			 	
				 </header>
				 <?php //if($role_id == 1){  ?>
				     <div class="tools">
					<?php echo $this->Html->link(__('Add Users <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false,'class'=>'  btn btn-info']); ?>
				    </div>
					<?php // } ?>				
			</div>
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Roles<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('role_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $roles, 'label' => false, 'error' => false, 'empty' => 'Select Role']); ?>
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
			<div class="card-head">
				<div class="tools">
					<?php //echo $this->Html->link(__('Add Users <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false,'class'=>'  btn btn-info']); ?>
				
					<!--<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>-->
				</div>
			</div>
			 <div class="card-body ">
			   <?php if ($users != '') {  ?>									
				 <div class="row">                  
					<div class="table-scrollable user-table">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						  <table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">

							<thead>
								<tr class="text-center">
									<th > Sno </th>
									<th > Role </th>
									<th > Name </th>
									<th > Username </th>
									<th > Email </th>
									<th > Mobile Number </th>
									<th > Actions </th>
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
									 <td  align="center">
										<?php  echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',base64_encode($user['id'])], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
										<?php  echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',base64_encode($user['id'])], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
									    <?php  echo $this->Html->link(__('<i class="fa fa-key"></i> resetpassword'), ['action' => 'resetpassword',($user['id'])],['confirm' => __('Are you sure you want to reset your password {0}?',  $user['name']),'escape' => false, 'class' => 'btn btn-outline-info btn-sm']); ?><br><br>
										<?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'userdelete',$user['id']], ['confirm' => __('Are you sure you want to delete user - {0}?',  $user['name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?>

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
 $("#FormID").validate({
        rules: {
            'role_id': {
                required: true
            }
        },
        messages: {
            'role_id': {
                required: "Select Role"
            }
        },
        submitHandler: function(form) {
         
		    form.submit();
            $(".btn").prop('disabled', true);			
		   
        }
    });

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