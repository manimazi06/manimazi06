
 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
                  <?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Detailed Estimate Approval</header>
            </div>
			     <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;">     
				   
				 </div>
			<div class="card-body">			  
			  <div class="table-scrollable">
					<legend class="bol" style="color: #0047AB; text-align: center;">Detailed Estimate List</legend>  
						<table class="table table-hover table-bordered table-advanced display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:1%"> S.No</th>
									<th style="width:10%">Item Code</th>
									<th style="width:20%">Item Description</th>
									<th style="width:10%">Quantity</th>
									<th style="width:10%">Unit</th>
									<th style="width:10%">Approved Estimate (per unit)</th>
									<th style="width:10%">Total Cost</th>								
								</tr>
							</thead>
							<tbody>							
				
								<?php $sno = 1;
								foreach ($detailed_estimates as $detailed_estimate) : ?>
									<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo $detailed_estimate['material']['item_code']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_estimate['material']['item_description']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_estimate['quantity']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_estimate['unit']['name']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_estimate['approved_estimate']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_estimate['total_cost']; ?></td>										
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>
							<tfoot>
							   <tr>
								  <th colspan="6" style="text-align:right;">Total</th>
								  <th><?php echo $total_estimate;  ?></th>						
							   </tr>
						   </tfoot>
						</table>
						
					</div> 		  
             </div><br><br>
			 <?php  if($detailed_approval_stages_count > 0){  ?> 
			 <div class="card-body">               			 
					<legend class="bol" style="color: #0047AB; text-align: center;">Detailed Estimate Approval Stages</legend>  
			         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width:98%" bgcolor="white">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No</th>
									<th style="width:10%">Date</th>
									<th style="width:10%">Status</th>
									<th style="width:10%">Process</th>
									<th style="width:10%">Remarks</th>
								</tr>
							</thead>
							<tbody>							
				
								<?php $sno = 1;
								foreach ($detailed_approval_stages as $detailed_approval) : ?>
									<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo date('d-m-Y',strtotime($detailed_approval['submit_date'])); ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['approval_status']['name']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['current_status']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_approval['remarks']; ?></td>
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>							
						</table>
                    </fieldset>						
             </div><br><br>
			 <?php } ?>
	  
			<?php  if($projectWorkSubdetail['detailed_estimate_current_role'] == $role_id){  ?> 
                 <div class="card-body">
                   	<legend class="bol" style="color: #0047AB; text-align: center;">Detailed Estimate Approval</legend>  
				 
					<fieldset	 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:1px;margin-bottom:1%">
					 <div class="col-md-12" style="margin-top:">
					 
						<div class="form-group row">
						  <label class="control-label col-md-2 bol">Status. <span class="required">  </span></label>
							<div class="col-md-4">
								<?php echo $this->Form->control('approval_status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'options' => $approvalStatuses ,'empty'=>'-Select-','onchange'=>'loaddetails(this.value);']) ?>                     
						   </div>
						   <label class="control-label col-md-2 bol clarification">Remarks. <span class="required">  </span></label>
							<div class="col-md-4 clarification">
								<?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks','type' => 'textarea','rows'=>'3']) ?>                     
							</div>								
						</div>						                                 
					 </div> 
					</fieldset>			
             	  </div>
            <?php  } ?>		
          	
	
			<div class="form-group" style="padding-top: 10px;">
				<div class="offset-md-5 col-md-10">
					<button type="submit" class="btn btn-success" >Submit</button>
				</div>
			</div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script> 

   // function loaddetails(id){ //alert(id);
	  // var id;
      // if(id == 1){
         // $('#remarks').val('');
         // $('.clarification').hide();
	  // }else if(id == 2){
        // $('.clarification').show();
	  // }	
	   
   // }

    $("#FormID").validate({
        rules: {
            'approval_status_id': {
                required: true
            }
        },

        messages: {
            'approval_status_id': {
                required: "Select Status"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
	
	
	 function toggledetail(){
    $('#project').toggle();

 }

$(document).ready(function() {
        var ProjectID    = <?php echo $id;  ?>;
        var ProjectSubID = <?php echo $work_id;  ?>;
        if (ProjectID !='' && ProjectSubID != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
</script>
