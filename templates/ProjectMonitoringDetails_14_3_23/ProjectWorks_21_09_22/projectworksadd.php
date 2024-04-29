<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Project Work Details</header>  
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
                        <label class="control-label col-md-2 bol">Proposal upload <span class="required"> &nbsp;&nbsp;: </span></label>
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
					<div class="form-group row">
                        <label class="control-label col-md-2 bol">Project Status <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo ($projectWork['ce_approved'] == 1)?"Approved":""; ?>              
                        </div>
						<label class="control-label col-md-2 bol">Approved Date<span class="required">&nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo ($projectWork['approved_date'])?date('d-m-Y',strtotime($projectWork['approved_date'])):''; ?>   
                        </div>                  
					
                    </div> 
					
                </div>
               </fieldset><br>
			  	<?php   if ($administrativesanctioncount > 0) {   ?>
			    <?php   //if (count($administrativesanction) > 0) {   ?>
					  <legend class="bol" style="color: #0047AB; text-align: center;">Administrative Sanction Details</legend>

				      <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                         <div class="col-md-12" style="margin-top:">
						   <div class="form-group row">
							  <label class="control-label col-md-3 bol">GO No. <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
									<?php  echo $administrativesanction['go_no']; ?>                       
							   </div>
								<label class="control-label col-md-3 bol">GO Date <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
								  <?php  echo date('d-m-Y',strtotime($administrativesanction['go_date'])); ?>              
								</div>
							</div>
							<div class="form-group row">
                                <label class="control-label col-md-3 bol">Supervision Charges<span class="required">&nbsp;&nbsp;:</span></label>
                                <div class="col-md-3 lower">
									  <?php echo $administrativesanction['supervision_charge']['name'];  ?>
                                </div>
                                <label class="control-label col-md-3 bol">Fund Source <span class="required">&nbsp;&nbsp;:</span></label>
                                <div class="col-md-3 lower">
								    <?php echo $administrativesanction['fund_source']['name'];  ?>
                                </div>
                            </div> 							
							<div class="form-group row">
							  <label class="control-label col-md-3 bol">GO Upload <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
									<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $administrativesanction['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a>                    
							   </div>
								<label class="control-label col-md-3 bol">Sanctioned Amount (in Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-3 lower">
								 <?php  echo ($administrativesanction['sanctioned_amount'])?ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'],'INR'),'₹'):'0.00'; ?>               
								</div>
							</div>                                  
                         </div>
					</fieldset><br>			   
				<?php } //} ?>
		</div>        
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                  	<!--fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:3%;padding:15px;margin-left:5px;margin-bottom:3%"-->
				
                    <?php 
					
					if ($projectWorkSubdetailscount == 0) { //add 
                    ?>					    
						  <legend class="bol" style="color: #0047AB; text-align: center;">Project Work Details</legend>
						 <div align="right">
							  <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
												More</button>
							</div><br>
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:3%">
						 <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr align="center">
                                                <th style="width:5%"> S.No</th>
                                                <th style="width:20%">District</th>
                                                <th style="width:20%">Division</th>
											    <th style="width:20%">Circle</th>
                                                <th style="width:20%">Amount (in Rs.)</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
                                            <tr class="present_row">
                                                <td class="trcount">1</td>
												<td>
												   <?php echo $this->Form->control('project.0.district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => true, 'empty' => 'Select District','onchange'=>'loadcircle(this.value,0)','data-rule-required'=>true,'data-msg-required'=>'Select District']) ?>
                                                   <?php echo $this->Form->control('project.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']) ?>
											   </td>
                                                <td>
												  <?php echo $this->Form->control('project.0.division_id1', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => true, 'empty' => 'Select Division','disabled']) ?>
											      <?php echo $this->Form->control('project.0.division_id', ['type'=>'hidden', 'label' => false, 'error' => true]) ?>
											   </td>
                                                <td>
												<?php echo $this->Form->control('project.0.circle_id1', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => true, 'empty' => 'Select Circle','disabled']) ?>
												<?php echo $this->Form->control('project.0.circle_id', ['type'=>'hidden', 'label' => false, 'error' => true]) ?>
                                               </td>                                   
                                               <td><?php echo $this->Form->control('project.0.amount', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter Sanction Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal()','data-rule-required'=>true,'data-msg-required'=>'Enter Sactioned Amount']) ?>
                                               </td>                                                                                      
                                                <td>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
										<tfoot>
										    <tr>
											   <td colspan="4" align="right"><b>Total</b></td>
											   <td><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Total Amount','readonly']) ?></td>
										       <td></td>
											</tr>
										</tfoot>
                                    </table>
                                </fieldset>                     
                            </div>
						</fieldset>
                    <?php   } elseif ($projectWorkSubdetailscount > 0) {  ?>
							
						  <legend class="bol" style="color: #0047AB; text-align: center;">Project Work Details</legend>

						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr align="center">
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
											<tr >
											     <td class="trcount"><?php echo $i + 1; ?></td>
                                                <td><?php echo $projectWorkSubdetail['work_code']; ?>
											   </td>
											     <td><?php echo $projectWorkSubdetail['division']['name']; ?>
											   </td>
                                                <td>
												<?php echo $projectWorkSubdetail['circle']['name']; ?>
                                               </td>                                   
                                               <td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?>
											   <?php echo $this->Form->control('sanctioned_amount', ['label' => false, 'error' => false, 'type' =>'hidden','class'=>'divided_amount','value'=>$projectWorkSubdetail['sanctioned_amount']]); ?>

                                               </td>
													<?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 1){  ?>											   
													<td>
													 
													  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
													  
													 
													</td>	
													<?php }else{ ?>
                                                       <td>	<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'projectworkedit',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
														</td>													
													<?php } ?>  						
										       
                                            </tr>
											  <?php $i++;
                                            endforeach; ?>
                                        </tbody>
										<tfoot>
										    <tr>
											   <td colspan="4" align="right"><b>Total</b></td>
											   <td><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Total Amount','readonly']) ?></td>
										       <td></td>
											</tr>
										</tfoot>
                                    </table>
                                </fieldset>                     
                            </div>
						</fieldset>
                    <?php } ?> 				 
                </div>				 
				 <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
					 <?php  if ($projectWorkSubdetailscount == 0) { ?>

					  <?php echo $this->Form->control('sanctioned_amount', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $administrativesanction['sanctioned_amount']]) ?>
					  <?php echo $this->Form->control('go_date', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => date('d-m-Y',strtotime($administrativesanction['go_date']))]) ?>
                                    
						<button type="submit" class="btn btn-info m-r-20">Submit</button>
						 <?php  } ?>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
					</div>
				</div>				
            </div>
        </div>
    </div>
</div>
 <?php echo $this->Form->End(); ?>
<script>

 <?php  if ($projectWorkSubdetailscount > 0) { ?>
           var amount = 0;
		   $(".divided_amount").each(function() {
			   
			   if(parseFloat(this.value) != 'NAN'){
				 amount += parseFloat(this.value);
			   }
				 
			});			
			$('#total-amount').val(amount);
			
 <?php   } ?>
 
    $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });

    $("#FormID").validate({
        rules: {           
            'sanctioned_amount': {
                required: true
            },
            'sanctioned_date': {
                required: true
            }
        },

        messages: {           
            'sanctioned_amount': {
                required: "Enter Sanctioned Amount"
            },
            'sanctioned_date': {
                required: "Select Sanctioned Date"
            }
        },
        submitHandler: function(form) {           
           var sanctioned_amount = $('#sanctioned-amount').val();
		   
		   var amount = 0;
		   $(".divided_amount").each(function() {
				 amount += parseFloat(this.value);
			});
		    // alert(sanctioned_amount);
		    // alert(amount);  
			//exit();  
		   if(parseFloat(sanctioned_amount) == parseFloat(amount)){
		    form.submit();
            $(".btn").prop('disabled', true);			
		   }else{			   
			   alert('Total Sum of Divided Amount should be equal to Administrative Sanctioned Amount');
			    return false;			   
		   }
        }
    });



    function validdocs(oInput) {
        var _validFileExtensions = [".pdf", ".jpg", ".jpeg", ".png"];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                        sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                if (!blnValid) {
                    alert(_validFileExtensions.join(", ") + " File Formats only Allowed");
                    //alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
            var file_size = oInput.files[0].size;
            if (file_size >= 5242880) {
                alert("File Maximum size is 5MB");
                oInput.value = "";
                return false;
            }

        }
        return true;
    }

    $(document).ready(function() {
        $('#financialyear').on('change', function() {
            // alert(distID);
            var financialID = $(this).val();
            //  alert(distID);
            //var path = "<?php //echo $this->Url->webroot 
                            ?> /firstproject/Students / ajaxtaluks / " + distID;
            // alert(path);
            if (financialID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc_staging/ProjectAdministrativeSanctions/ajaxproject/' +
                        financialID,
                    success: function(data, textStatus) {
                        //alert(data)
                        $('#project').html(data);
                    }
                });
            } else {
                $('#project').html('<option value="">Select Project</option>');

            }
        });


    });
	
	
	
	  function loadcircle(id,count){
            var id; 
             //var type_id = 2;			
            if (id) {
             				
				 $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxcircles/'+ id,
                    success: function(data, textStatus) {
						var value1 = parseInt(data);
                         //alert(value1)
                        $('#project-'+count+'-circle-id').val(value1);
                        $('#project-'+count+'-circle-id1').val(value1);
                    }
                });
				
				 $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdivisions/'+ id,
                    success: function(data1, textStatus1) {
						var value2 = parseInt(data1);
                        // alert(value2)
                        $('#project-'+count+'-division-id').val(value2);
                        $('#project-'+count+'-division-id1').val(value2);
                    }
                });
            } else {
                $('#division-id').html('<option value="">Select division</option>');

            }
			
			
        }
		
		
	function getaddempdoc() {
        var j = ($('.present_row').length);
        // alert(j);
        var serial_id =  ($('.present_row').length - 1);;
        var district  = $("#project-" + serial_id + "-district-id").val();
        var amount    = $("#project-" + serial_id + "-amount").val();
		
	
        if (district != ''  && amount != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxproject/' +j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {//alert(data);
                    $('.add_doc').append(data);
                 
                }
            });
        } else if (district == '') {
            alert("Select District");
            
            $("#project-" + serial_id + "-district-id").focus();
        }else if (amount == '') {
            alert("Enter Amount");
            $("#project-" + serial_id + "-amount").focus();
        }

    }	
	
	
	function calculateTotal(){
		
		
		 var amount = 0;
		   $(".divided_amount").each(function() {
			   
			   if(parseFloat(this.value) != 'NAN'){
				 amount += parseFloat(this.value);
			   }
				 
			});
			
			//alert(amount);
			 if(!isNaN(amount)){
			
			$('#total-amount').val(amount);
			
			}else{
				
			$('#total-amount').val('');
	
			}
		
		
	}
		
</script>
