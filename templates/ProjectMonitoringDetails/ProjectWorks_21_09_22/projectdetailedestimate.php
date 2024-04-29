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
                        <label class="control-label col-md-2 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
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
                        <label class="control-label col-md-2 bol">Rough Cost (Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower"> 
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
                         </div>
                        <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>              
                        </div>
                    </div>
                    <!--div class="form-group row">
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
                    </div-->
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['scheme_type']['name']; ?>              
                        </div>
						<label class="control-label col-md-2 bol">Project Description<span class="required">&nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>                  
					
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Proposal Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                        </div>
						<!--label class="control-label col-md-2 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div-->
                    </div>
					
                </div>
               </fieldset>		 
		</div> 
		<?php   if ($administrativesanctioncount > 0) {   ?>
			    <?php   //if (count($administrativesanction) > 0) {   ?>
					  <legend class="bol" style="color: #0047AB; text-align: center;">Administrative Sanction Details</legend>

				      <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                         <div class="col-md-12" style="margin-top:">
						   <div class="form-group row">
							  <label class="control-label col-md-2 bol">GO No. <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
									<?php  echo $administrativesanction['go_no']; ?>                       
							   </div>
								<label class="control-label col-md-2 bol">GO Date <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
								  <?php  echo date('d-m-Y',strtotime($administrativesanction['go_date'])); ?>              
								</div>
							</div>
							
							<div class="form-group row">
							  <label class="control-label col-md-2 bol">GO Upload <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
									<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $administrativesanction['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a>                    
							   </div>
								<label class="control-label col-md-2 bol">Sanctioned Amount<span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
								 <?php  echo ($administrativesanction['sanctioned_amount'])?ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'],'INR'),'₹'):'0.00'; ?>               
								</div>
							</div>                                  
                         </div>
					</fieldset><br>			   
				<?php } //} ?>
				 	 <legend class="bol" style="color: #0047AB; text-align: center;"> Project Work Details</legend>

				    <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"> S.No</th>
												<th style="width:20%">Work ID</th>
                                                <th style="width:20%">Division</th>
											    <th style="width:20%">Circle</th>
                                                <th style="width:20%">Amount (in Rs.)</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
										   <?php
                                            $i = 0;
                                            foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>
                                            <tr class="present_row">
                                                <td class="trcount"><?php echo $i + 1; ?></td>
												 <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
                                                <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
                                                <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
                                                <td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                      
                                                <td>
											       
												 <?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 0){ ?>
												   <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
												 <?php   } else if($projectWorkSubdetail['detailed_estimate_flag'] == 1){  ?>
												   <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>

												 <?php } ?>

											  </td>                                                
                                            </tr>
											  <?php $i++;
                                            endforeach; ?>
                                        </tbody>
									
                                    </table>
                                </fieldset>                     
                            </div>
						</fieldset>
         <!--div class="card-body">
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
										<td><?php echo $this->Form->control('material_id', ['class' => 'form-select select2', 'label' => false, 'error' => false, 'options' => $materials, 'empty' => 'Select code','required','style'=>'width:170px;','onchange'=>'loaddescription(this.value)']) ?>
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
                            <div class="offset-md-5 col-md-6">
                                <button type="submit" class="btn btn-info m-r-20">ADD</button>
                                <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>

                    
                </div>

            </div>
			
			  <div class="card-body">
			  
			  <div class="table-scrollable">
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
									<th style="width:10%"> Actions </th>
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
										<td class="text-center" style="margin-top:10px;">
											<span style="margin-top:10px;">
												<?php //echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',base64_encode($projectWork['id'])], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
												
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'projectdetailedestimateedit',$id,$detailed_estimate['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
												
										</td>                                               
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>
						</table>
					</div>
			  
			  
             </div-->
			  <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
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
</script>
