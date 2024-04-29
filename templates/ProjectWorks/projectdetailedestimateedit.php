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
                <header>Edit Detailed Estimate</header>
            </div>

            	  <div class="card-body">       
				   <!--h4 class = "sub-tile">Project Details:</h4-->				  
				    <legend class="bol" style="color: #0047AB; text-align: center;">Project Details</legend>
                   
				 	<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
     
				    <div class="col-md-12">
					<div class="form-group row">
                        <label class="control-label col-md-2 bol">Project Code <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['project_code']; ?>              
                        </div>
                        <label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo $projectWork['project_name']; ?>   
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2 bol bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['department']['name']; ?>                       
					   </div>


                        <label class="control-label col-md-2 bol">Financial Year <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['financial_year']['name']; ?>              
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['building_type']['name']; ?>              
                        </div>


                        <label class="control-label col-md-2 bol">Project Status<span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						    <?php  echo $projectWork['project_status']['name']; ?>              
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Project Cost <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower"> 
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
 
                        </div>
                        <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>              
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">District <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                          <?php  echo $projectWork['district']['name']; ?>           

					   </div>
                        <label class="control-label col-md-2 bol">Division <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['division']['name']; ?>           
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Latitude <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['latitude']; ?>                          
						</div>
                        <label class="control-label col-md-2 bol">longitude <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['longitude']; ?>                         
						
						</div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                        </div>
						<label class="control-label col-md-2 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>
                    </div>                    
                </div>
               </fieldset>	 
		</div> 
         <div class="card-body">
                <div class="form-body row">

                    <div class="col-md-12">
		
					  <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;margin-left:5px;margin-bottom:1%">

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
										<td><?php echo $this->Form->control('material_id', ['class' => 'form-select select2', 'label' => false, 'error' => false, 'options' => $materials, 'empty' => 'Select code','required','style'=>'width:170px;','onchange'=>'loaddescription(this.value)','value'=>$detailed_estimate['material_id']]) ?>
									    </td>
										<td><?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Description','type'=>'textarea','readonly','value'=>$detailed_estimate['material']['item_description']]) ?>  
										</td>
										
										<td><?php echo $this->Form->control('quantity', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','required','onkeyup'=>'calculatetotal(this.value)','value'=>$detailed_estimate['quantity']]) ?>
										</td>
										<td><?php echo $this->Form->control('unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $units, 'empty' => 'Select unit','required','value'=>$detailed_estimate['unit_id']]) ?>
									    </td>
										<td><?php echo $this->Form->control('approved_estimate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','onkeyup'=>'calculatetotal(this.value)','value'=>$detailed_estimate['approved_estimate']]) ?>
										</td>
										<td><?php echo $this->Form->control('total_cost', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Total','required','readonly','value'=>$detailed_estimate['total_cost']]) ?>
										</td>
									</tr>
								</tbody>
							</table>
						</fieldset>
                        <div class="form-group" style="padding-top: 10px">
                            <div class="offset-md-5 col-md-6">
                                <button type="submit" class="btn btn-info m-r-20">update</button>
                                <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
                            </div>
                        </div>
                    </div>

                    
                </div>

            </div>		
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>

  function loaddescription(id){	  
	  var id;
	  //alert(id);
	  
	  $.ajax({
		async: true,
		dataType: "html",
		url: '<?php echo $this->Url->webroot ?>/tnphc_staging/ProjectWorks/ajaxgetdescription/' +id,

		beforeSend: function(xhr) {
			xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
		},
		success: function(data, textStatus) { //alert(data);
			$('#description').val(data);
		 
		}
	});  
	  
  }
  
  
  
  function calculatetotal(id){
	  var val      = $('#approved-estimate').val();;
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
</script>
