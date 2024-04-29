
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
                <header>Add Detailed Estimate</header>
            </div>
			     <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;">     
				   
				 </div>
            	 
			<?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>  			
              <div class="card-body">
                <div class="form-body row">
                    <div class="col-md-12 addpage">
		               <legend class="bol" style="color: #0047AB; text-align: center;">Detailed Estimate</legend>
					  <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:25px;margin-left:5px;margin-bottom:1%">

                           <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
								<thead>
									<tr align="center">
										<th style="width:5%"> S.No</th>
										<th style="width:9%">Item Code</th>
										<th style="width:20%">Item Description</th>
										<th style="width:10%">Quantity</th>
										<th style="width:10%">Unit</th>
										<th style="width:10%">Approved Estimate (per unit)</th>
										<th style="width:10%">Total Cost</th>
									</tr>
								</thead>
								<tbody class="add_doc">
									<tr class="present_row">
										<td class="trcount">1</td>
										<td><?php echo $this->Form->control('material_id', ['id'=>'material_id','class' => 'form-select select2', 'label' => false, 'error' => false, 'options' => $materials, 'empty' => 'Select code','required','style'=>'width:170px;','onchange'=>'loaddescription(this.value)']) ?>
									    </td>
										<td><?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Description','type'=>'textarea','readonly']) ?>  
										</td>
										
										<td><?php echo $this->Form->control('quantity', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','required','onkeyup'=>'calculatetotal(this.value)']) ?>
										</td>
										<td><?php echo $this->Form->control('unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $units, 'empty' => 'Select unit','required']) ?>
									    </td>
										<td><?php echo $this->Form->control('approved_estimate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','onkeyup'=>'calculatetotal(this.value)']) ?>
										</td>
										<td><?php echo $this->Form->control('total_cost', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Total','required','readonly']) ?>
										</td>
									</tr>
								</tbody>
							</table>
						</fieldset>
                        <div class="form-group" style="padding-top: 10px">
                            <div class="offset-md-6 col-md-5">
                                <button type="submit" class="btn btn-info m-r-20">ADD</button>
                                <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
                            </div>
                        </div>
                    </div>                    
                </div>
             </div>		
            <?php  } ?>	
          	
			 <div class="card-body">			  
			  <div class="table-scrollable">
			      <h4 class = "sub-tile">Detailed Estimate List</h4>
					<!--legend class="bol" style="color: #0047AB; text-align: center;"></legend-->  
						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th style="width:5%"> S.No</th>
									<th style="width:9%">Item Code</th>
									<th style="width:20%">Item Description</th>
									<th style="width:10%">Quantity</th>
									<th style="width:10%">Unit</th>
									<th style="width:10%">Approved Estimate (per unit)</th>
									<th style="width:10%">Total Cost</th>
									<?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>
									<th style="width:10%"> Actions </th>
									<?php  } ?>
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
										<?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>
										<td class="text-center" style="margin-top:10px;">
											
											<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'projectdetailedestimateedit',$id,$work_id,$detailed_estimate['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
										</td>                                               
										<?php  } ?>
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>
							<tfoot>
						   <tr>
						      <th colspan="6" style="text-align:right;">Total</th>
						      <th><?php echo $total_estimate;  ?></th>
							  <?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>
						      <th></th>
							  <?php  } ?>
						   </tr>
						</tfoot>
						</table>
						
					</div> 		  
             </div>
			 <?php  if($total_estimate != ''){  ?>
			 <?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>
			   <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
					    <?php echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>
						<button type="submit" class="btn btn-success" onclick="setvalue()">Forward to Drawing Branch / Final Submit</button>
					</div>
				</div>
			 <?php  } } ?>	
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
//$('.select2-selection__placeholder').html('');
/*$('.select2').select2({
    placeholder: "Please select a country"
});*/
    
function setvalue(){  
	//alert('hi');
 var sanctioned_amount = <?php echo $projectWorkSubdetail['sanctioned_amount']; ?>;
 <?php  if($total_estimate != ''){  ?>var estimate_amount   = <?php echo $total_estimate;  ?>; <?php } ?>
  if(parseFloat(estimate_amount) > parseFloat(sanctioned_amount)){	   
	   alert('Total Estimate cannot be greater than Sanctioned Amount');
	   return false;	
   }else{
		if(confirm('Are you sure for final submit')){		
			$('.addpage').hide();
			$('#completed-flag').val(1);
			$("#FormID").validate({
				rules: {
					'material_id1': {
						required: true
					}
				},
				messages: {
					'material_id1': {
						required: "Enter Reference No"
					}
				},
				submitHandler: function(form) {
					form.submit();
					$(".btn").prop('disabled', true);
				}
			});            	  
		}else{
		  return false;	
		}	
	}	
}

  function loaddescription(id){	  
	  var id; 
	 // alert(id);
	  $.ajax({
		async: true,
		dataType: "html",
		url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxgetdescription/' +id,

		beforeSend: function(xhr) {
			xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
		},
		success: function(data, textStatus) { //alert(data);
			$('#description').val(data);
		 
		}
	}); 	  
  }
  
  
  
  function calculatetotal(val){
	  var val= $('#approved-estimate').val();
	  var quantity = $('#quantity').val();
	  
	  
	  var total = parseFloat(quantity)*parseFloat(val);
	 
     if(!isNaN(total)){
	   $('#total-cost').val(total);
 
     }else{		 
		  $('#total-cost').val('');		 
	 } 	  
  }
   

    $("#FormID").validate({
        rules: {
            'material_id': {
                required: true
            },
            'financial[0][sanctioned_date]': {
                 required: true
            },
            'financial[0][sanctioned_amount]': {
                required: true
            },
            'financial[0][sanctioned_file_upload]': {
                required: true
            }
        },

        messages: {
            'material_id': {
                required: "Enter Reference No"
            },
            'financial[0][sanctioned_date]': {
                required: "select Date"
            },
            'financial[0][sanctioned_amount]': {
                required: "Enter Sanctioned Amount"
            },
            'financial[0][sanctioned_file_upload]': {
                required: "Select Document"
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
