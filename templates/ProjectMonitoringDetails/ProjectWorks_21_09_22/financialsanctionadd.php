<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
 <?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Financial Sanction</header>  
          </div>
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Financial Year<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
					</div>
					<label class="control-label col-md-2">Department<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required']); ?>
					</div>
				</div>			
		    </div> 
		       <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-6 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">Get Details</button>
					</div>
				</div>
		  </div>		  
	 </div>
 </div><br><br> 
  <?php echo $this->Form->End(); ?>

	<?php if(isset($approved_projects)){  ?>	  
 <?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID2', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data','action'=>'insertfinancialsanction']); ?>

<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <!--div class="card-head">
            <header>Add Administrative Sanction</header>  
        </div-->
	<?php if($approved_project_count > 0){  ?>	  
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                  	<!--fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:3%;padding:15px;margin-left:5px;margin-bottom:3%"-->
				
                    
					 <legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend>					

					  <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;margin-left:5px;margin-bottom:1%">

                            <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">GO No</th>
											    <th style="width:20%">GO Date</th>
                                                <th style="width:20%">Sanction Amount (in Rs.)</th>
                                                <th style="width:20%">File Upload</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $this->Form->control('go_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter GO No.', 'required']) ?>
											   </td>
											    <td><?php echo $this->Form->control('go_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Select GO Date']) ?>
                                               </td>                                   
                                               <td><?php echo $this->Form->control('sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter Sanction Amount']) ?>
                                               </td>
                                                <td><?php echo $this->Form->control('sanctioned_file_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)']); ?>
                                                </td>                                       
                                                <td>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>                     
                            </div>
					  <legend class="bol" style="color: #0047AB; text-align: center;">Approved Project List</legend>
					
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:3%;padding:15px;margin-left:5px;margin-bottom:3%">
						 <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr>
												<th style="width:5%"><input type="checkbox" class ="select_all" id='allcb'> Select All</th>
                                                <th style="width:1%"> S.No</th>
                                                <th style="width:20%">Project Code</th>
                                                <th style="width:20%">Project Name</th>
											    <th style="width:20%">Department</th>
                                                <th style="width:20%">Financial Year</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										  <?php $i= 0; foreach($approved_projects as $projectWork){  ?>
                                            <tr>
												<td>
												    <?php //echo $this->Form->control('project.'. $i.'.project_id', ['class' => 'form-control checkboxFour', 'label' => false, 'error' => false, 'type' => 'checkbox', 'value'=>$projectWork['id']]); ?>

												    <input name ='project[<?php echo $i; ?>][project_id]' type="checkbox" class ="checkboxFour" value="<?php echo $projectWork['id'];?>">
									       	    </td>
                                                <td class="trcount"><?php echo $i+1; ?></td>
												<td><?php echo $projectWork['project_code']; ?> </td>
												<td><?php echo $projectWork['project_name']; ?> </td>
												<td><?php echo $projectWork['department']['name']; ?> </td>
												<td><?php echo $projectWork['financial_year']['name']; ?> </td>
                                                <td class="text-center" style="margin-top:10px;">
													<span style="margin-top:10px;">
														<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?>
														
													</span>
												</td>												
                                           </tr>
										  <?php  $i++; } ?>
                                        </tbody>										
                                    </table>
                                </fieldset>                     
                            </div>
						</fieldset>      
				   </div>
				 
				 <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">Submit</button>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
					</div>
				</div>
				
            </div>
        </div>
	<?php }elseif($approved_project_count == 0){ echo  '<center><span>No Projects Found</span></center>';    }  ?>
    </div>
</div>
	<?php  } ?>
 <?php echo $this->Form->End(); ?>
<script>
 $('#allcb').change(function(){
	if($(this).prop('checked')){
		$('tbody tr td input[type="checkbox"]').each(function(){
		$(this).prop('checked', true);
		});
		var total = $('.checkboxFour:checked').length;
		$('#total').val(total);
	}else{
		$('tbody tr td input[type="checkbox"]').each(function(){
		$(this).prop('checked', false);
		
		});
		var total = $('.checkboxFour:checked').length;
		$('#total').val(total);
	}
  }); 
  

 $('.checkboxFour').click(function(){
       if($('.checkboxFour:checked').length == $('.checkboxFour').length){
           $('.select_all').prop('checked',true);
       	var total = $('.checkboxFour:checked').length;
	
		$('#total').val(total);
       }else{
            $('.select_all').prop('checked',false);
            
            	var total =$('.checkboxFour:checked').length;
	
		$('#total').val(total);
       }
   });
   
 
    $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });

    /*$("#FormID2").validate({
        rules: {         
            'go_no': {
                required: true
            },
            'go_date': {
                required: true
            },
            'go_file_upload': {                
                 required: true
            },
            'sanctioned_amount': {
                required: true
            },
            'sanctioned_date': {
                required: true
            },
            'supervision_charge_id': {
                required: true
            },
            'fund_source_id': {
                required: true
            }
        },

        messages: {           
            'go_no': {
                required: "Select GO No"
            },
            'go_date': {
                required: "Select GO Date"
            },
            'go_file_upload': {
                required: " Select GO Upload"
            },
            'sanctioned_amount': {
                required: "Enter Sanctioned Amount"
            },
            'sanctioned_date': {
                required: "Select Sanctioned Date"
            },
            'supervision_charge_id': {
                required: "Select Supervision Charges"
            },
            'sanctioned_date': {
                required: "Select Fund Source"
            }
        },
        submitHandler: function(form) {  

          
			 if ($('input:checkbox').filter(':checked').length === 0){
				alert("Please Check at least one Check Box");
				//e.preventDefault();
				return false;
			 }else if ($('input:checkbox').filter(':checked').length > 0){
				   form.submit();			 
				   return true;
			 }		
             
        }
    });
	*/
	
    $("#FormID2").validate({
        rules: {
            'go_no': {
                required: true
            },
            'go_date': {
                 required: true
            },
            'sanctioned_amount': {
                required: true
            },
            'sanctioned_file_upload': {
                required: true
            }
        },

        messages: {
            'go_no': {
                required: "Enter GO No"
            },
            'go_date': {
                required: "select Date"
            },
            'sanctioned_amount': {
                required: "Enter Sanctioned Amount"
            },
            'sanctioned_file_upload': {
                required: "Select Document"
            }
        },
        submitHandler: function(form) {
			 if ($('input:checkbox').filter(':checked').length === 0){
				alert("Please Check at least one Check Box");
				//e.preventDefault();
				return false;
			 }else if ($('input:checkbox').filter(':checked').length > 0){
				   form.submit();			 
				   return true;
			 }	
        }
    });
	
	

    $("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: true
            },
            'department_id': {
                required: true
            }          
        },

        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            },
            'department_id': {
                required: "Select Department"
            }
        },
        submitHandler: function(form) {
           
           form.submit();
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
		
</script>
