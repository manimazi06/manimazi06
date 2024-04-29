  <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>
	<div class="row">
    <div class="col-md-12">
           <div class="card card-topline-aqua">
		      <div class="card-head">
                <header><?php echo $project['project_name']; ?>		
				</header>				
            </div>
            </div><br><br>
		    <div >
			  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>&nbsp;View Items Codes with Description'), ['controller'=>'NewBuildingItems','action' => 'index'], ['escape' => false, 'class' => ' btn btn-info','target'=>'_blank']); ?>
			</div>		
    </div>
</div><br>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
	            
         <div class="card-body">
             <!--div class="form-body row"-->
                 <div class="card-body">
                     <div class="form-body row">					 
				 <h4 class = "sub-tile">Abstract List (Update New item Codes) </h4> 
					<?php  if($contractor_detailcount > 0){ ?>	  
					 <div class="table-scrollable">
						 <table class="table  table-bordered table-checkable order-column" style="width: 100%">
								<thead>
									<tr class="text-center">
										<th style="width:1%">S.no</th>
										<th style="width:3%">Item code</th>
										<th style="width:40%">Item Description</th>
										<th style="width:3%">New Item code</th>
										<th style="width:35%">New Item Description</th>
										<th style="width:5%">Quantity</th>
										<th style="width:5%">Unit</th>
										<th style="width:3%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $sno = 1;
										foreach ($abstract_subdetails  as $key => $abstract_subdetail) : ?>
										 <?php echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

										<tr class="odd gradeX">
											<td class="text-center"><?php echo $sno; ?></td>
											<td class="title" style="text-align:center;"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
											<td class="title"><?php echo ($abstract_subdetail['item_description'])?$abstract_subdetail['item_description']:'' ?></td>
											 <td>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $newbuildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,'.$key.')','data-rule-required'=>true,'data-msg-required'=>'Select Item Code','value'=>$abstract_subdetail['new_building_item_id']]); ?>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_code_'.$key.'','value'=>$abstract_subdetail['new_item_code']]); ?>
                                            </td>											
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Item Description', 'rows' => 5,'id'=>'description_'.$key.'', 'readonly','value'=>$abstract_subdetail['new_item_description']]); ?>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_id_'.$key.'','value'=>$abstract_subdetail['id']]); ?>
                                            </td>
											<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['quantity'] ?></td>
											<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['unit']['name'] ?></td>
											<td>
											  <?php if($contractorcount[$abstract_subdetail['id']] != 0 ){ ?>
											  		  <?php echo $this->Form->control('workdetail.'.$key.'.contractor_rate_id', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>$contractoratedetails[$abstract_subdetail['id']]['id']]); ?>
								  
											  <?php } ?>
											 <?php echo $this->Form->control('type', ['label' => false, 'error' => false,'type'=>'hidden', 'readonly','value'=>1]); ?>

											   <button type="button" class="btn btn-info m-r-20" onclick="submit(<?php echo $key  ?>)">Update</button>     

											</td>
										</tr>
									<?php 
									
									  $sno++;
									   echo $this->Form->End(); 
										endforeach; ?>
										
								</tbody>				
							</table>
					 </div>
					<?php  }else{ ?>
					  <center><h4 style="color:red;">Enter Contractor details before updating Abstract</h4></center>
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
                         <!--button type="submit" class="btn btn-info m-r-20" onclick="finalsubmit()">Final Submit</button-->
                         <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
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
 if($abstract_subdetail['new_item_description'] != ''){
	 ?>
	 var i =   <?php echo $key+1; ?>	  
	  $('#description_'+i ).focus();
	 // $('#select2-workdetail-'+i+'-building-item-id-container').focus();
	 // alert('hi');
  
 <?php } } ?>
   
      
	  function submit(count){
		  //alert(rate);
		  var count;
		  var code = $('#item_code_'+count).val();
		  alert(code);
		  if(code != ''){
			 // form.submit();
             //$(".btn").prop('disabled', true);
			 return true; 
		  }else{
			  alert('Select Code');
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


function descriptionid(id,count) {
    var id;
	var count;
	//alert(count);
    if (id != '') {
        $.ajax({
            async: true,
            dataType: "html",
            url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxitemcode/' + id,

            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data, textStatus) {
                var detail = JSON.parse(data);
                $('#description_'+count).val(detail.item_description);
                $('#item_code_'+count).val(detail.item_code);
            }
        });
    }
}	  
	 
	 
	
 </script>
