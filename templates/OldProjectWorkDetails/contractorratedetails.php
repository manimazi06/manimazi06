
  <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>
	<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
		<div class="card-body">
				 <h4 class = "sub-tile"><?php echo $project['project_name']; ?></h4>
		
        </div>
        </div>
    </div>
</div><br>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-body">
             <!--div class="form-body row"-->
                 <div class="card-body">
                     <div class="form-body row">					 
				 <h4 class = "sub-tile">Contractor Agreement List</h4> 
					<?php  if($contractor_detailcount > 0){ ?>	  
					 <div class="table-scrollable">
						 <table class="table  table-bordered table-checkable order-column" style="width: 100%">
								<thead>
									<tr class="text-center">
										<th style="width:1%">S.no</th>
										<th style="width:3%">Item code</th>
										<th style="width:60%">Item Description</th>
										<th style="width:8%">Quantity</th>
										<th style="width:5%">Unit</th>
										<!--th style="width:10%">Rate</th>
										<th style="width:10%">Amount</th-->
										<th style="width:9%">Contractor Rate <br>(in Rs)</th>
										<th style="width:9%">Final Amount <br>(in Rs)</th>										
										 <?php  if($projectWorkSubdetail['contractor_final_submit'] == 0){  ?>
										<th style="width:5%">Action</th>
										 <?php  } ?>
									</tr>
								</thead>
								<tbody>
									<?php $sno = 1;
										foreach ($abstract_subdetails  as $key => $abstract_subdetail) : ?>
										 <?php echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

										<tr class="odd gradeX">
											<td class="text-center"><?php echo $sno; ?></td>
											<td class="title" style="text-align:center;"><?php echo ($abstract_subdetail['new_item_code'] != '')?$abstract_subdetail['new_item_code']:$abstract_subdetail['item_code'] ?></td>
											<td class="title"><?php echo ($abstract_subdetail['new_item_description'])?$abstract_subdetail['new_item_description']:$abstract_subdetail['item_description'] ?></td>
											<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['quantity'] ?></td>
											<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['unit']['name'] ?></td>
											<!--td class="title" style="text-align:right;"><?php //echo $abstract_subdetail['rate'] ?></td>
											<td class="title" style="text-align:right;"><?php //echo ($abstract_subdetail['amount'])?$abstract_subdetail['amount']:''; ?></td-->
											<td>
											  <?php if($abstract_subdetail['quantity'] != ''){ ?>
											  <?php echo $this->Form->control('workdetail.'.$key.'.rate', ['class' => 'form-control amount rate', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate','id'=>'r_'.$key.'','onkeyup'=>"product(".$key.")",'data-rule-required'=>false,'data-msg-required'=>'Enter Rate','value'=>($abstract_subdetail['contractor_rate'])?$abstract_subdetail['contractor_rate']:'']); ?>
                                             <?php echo $this->Form->control('workdetail.'.$key.'.quantity', ['type'=>'hidden','label' => false, 'error' => false,'id'=>'q_'.$key.'','value'=>$abstract_subdetail['quantity']]); ?>
                                             <?php echo $this->Form->control('workdetail.'.$key.'.id', ['type'=>'hidden','label' => false, 'error' => false,'id'=>'q_'.$key.'','value'=>$abstract_subdetail['id']]); ?>

											<?php } ?>
											</td>                                            
                                            <td>
											  <?php if($abstract_subdetail['quantity'] != ''){ ?>
											<?php echo $this->Form->control('workdetail.'.$key.'.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'cal_total_'.$key.'', 'readonly','value'=>($abstract_subdetail['final_amount'])?$abstract_subdetail['final_amount']:'0']); ?>
											  <?php } ?>
											</td>
											 <?php  if($projectWorkSubdetail['contractor_final_submit'] == 0){  ?>

											<td>
											  <?php if($contractorcount[$abstract_subdetail['id']] != 0 ){ ?>
											  		  <?php echo $this->Form->control('workdetail.'.$key.'.contractor_rate_id', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>$contractoratedetails[$abstract_subdetail['id']]['id']]); ?>

											  
											  <?php } ?>
											 <?php echo $this->Form->control('type', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>1]); ?>

											   <?php if($abstract_subdetail['quantity'] != ''){ ?>
											   <button type="submit" class="btn btn-info m-r-20" onclick="submit(<?php echo $key  ?>)">Save</button>  
											   <?php } ?>
											  <?php //echo $this->Form->control('workdetail.'.$key.'.abstract_id', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>$abstract_subdetail['id']]); ?>

											</td>
											 <?php } ?>
										</tr>
									<?php 
									if($abstract_subdetail['amount'] != ''){
									 $tot_amount += $abstract_subdetail['amount'];   
									}
									
									if($abstract_subdetail['final_amount'] != ''){
									 $final_tot_amount += $abstract_subdetail['final_amount'];   
									}
									  $sno++;
									   echo $this->Form->End(); 
										endforeach; ?>
										
								</tbody>
								
								<tfoot>
								   <tr>
									  <th colspan="3" style="text-align:right;"></th>
									  <th ><?php //echo ($tot_amount)?ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'):'0.00';  ?></th>						
									  <th></th>
									  <th style="text-align:right;">Total  (in Rs) &nbsp;</th>
									  <th>
									   <?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly','value'=>($final_tot_amount)?$final_tot_amount:'']) ?>

									  </th>
									  <th>
									  </th>
								  </tr>
								   <tr>
									  <th colspan="6" style="text-align:right;">Agreement Amount Entered in Contrator Details  (in Rs) &nbsp;</th>
									  <th>
					                       <?php echo $this->Form->control('agreement_amount', ['class' => 'form-control','label' => false, 'error' => false, 'value' => $contractor_details['agreement_amount'], 'type' => 'text','readonly']); ?>
                                           
									  </th>
									  <th>
									  </th>
								  </tr>
							   </tfoot>
							</table>
					 </div>

					<?php  }else{ ?>
					  <center><h4 style="color:red;">Enter Contractor details before Entering Rate</h4></center>
					<?php  } ?>                        
                     </div>
                 </div>
				 <?php  if($contractor_detailcount > 0){ ?>	
                 <div class="form-group" style="padding-top: 5px;">
                     <div class="offset-md-5 col-md-10">
					 	 <?php //echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data','action'=>'../../../contractorfinalsubmit']); ?>
					 	 <?php echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data','action'=>'../../../contractorfinalsubmit']); ?>

					 	 <?php echo $this->Form->control('type1', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>1]); ?>
					 	 <?php echo $this->Form->control('id', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>$id]); ?>
					 	 <?php echo $this->Form->control('pid', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>$pid]); ?>
					 	 <?php echo $this->Form->control('work_id', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>$work_id]); ?>
                         <?php  if($projectWorkSubdetail['contractor_final_submit'] == 0){  ?>
                         <button type="submit" class="btn btn-info m-r-20" onclick="finalsubmit()">Final Submit</button>
                         <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
						 <?php  } ?>
						 <?php   echo $this->Form->End();  ?>
                     </div>
                 </div>		 
				
				 <?php } ?>
             </div>
         <!--/div-->
     </div>
 </div>
 

 <script>
 <?php 	foreach ($abstract_subdetails  as $key => $abstract_subdetail) {
 if($abstract_subdetail['contractor_rate'] != 0){
	 ?>
	 var i =   <?php echo $key+1; ?>
	 //alert(i);

	
	  
	  $('#r_'+i ).focus();
  
  
 <?php } } ?>
   
  <?php  if($projectWorkSubdetail['contractor_final_submit'] == 1){  ?>
   $('.rate').prop('readonly', true);
  <?php } ?>
      
	  function submit(count){
		  alert(rate);
		  var count;
		  var rate = $('r_'+count).val();
		  alert(rate);
		  if(rate != 0){
			// form.submit();
             //$(".btn").prop('disabled', true);
			 return true; 
		  }else{
			  alert('Enter Rate');
			  return true; 			  
		  } 	  
	  }
	  
	  
	  function finalsubmit(){ 
	       //alert('hi');
	        $('#type1').val(2);	

           // alert($('#type').val());
			
		     var tot_amount = Math.round($('#total-amount').val());
             var agg_amount = Math.round($('#agreement-amount').val());				 
			 if(parseFloat(tot_amount) == parseFloat(agg_amount)){				   
			 //form.submit();
             //$(".btn").prop('disabled', true);
			 }else{
				 $('#type').val(1); 
				alert('Total Agreement Amount should be eqaul to Agreement Amount entered in Contractor Details'); 
				return false;
			 }
		  
		  
	  }   
	 
	 
	 function product(count) {
	var count;
    var num1 = parseFloat(document.getElementById("q_"+count).value);
    var num2 = parseFloat(document.getElementById("r_"+count).value);

	
	if(isNaN(num1) && isNaN(num2)){
		var n1 = 0;
		var n2 = 0;
	}else{	
		if (!isNaN(num1)) {
		   var n1 = parseFloat(document.getElementById("q_"+count).value);
		}else{
			var n1 = 1;
		}

		if (!isNaN(num2)) {
			var n2 = parseFloat(document.getElementById("r_"+count).value);
		}else{
			var n2 = 1;
		}	
	}	
	
    var tot = (n1*n2);
    //alert(tot);  
    if (tot >= 0) {
		if(tot > 0){
        document.getElementById("cal_total_"+count).value = tot.toFixed(2);
		}else{
		document.getElementById("cal_total_"+count).value = tot;	
		}
		calculateTotal();
    }
}

function calculateTotal(){	
	 var amount = 0;
	   $(".divided_amount").each(function() {       
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }			 
		});
		

		 if (!isNaN(amount)) {
		
		$('#total-amount').val(amount.toFixed(2));
		$('#agreement_amount').val(amount.toFixed(2));
		 calculation();
		
		}else{
			
		$('#total-amount').val('');

		}		
	}
 </script>
