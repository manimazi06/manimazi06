<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Administrative Sanction</header>  
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
 </div><br>
  <?php echo $this->Form->End(); ?>

	<?php if(isset($approved_project_count)){  ?>	  
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID2', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data','action'=>'insertadminsanction']); ?>

<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">   
	<?php if($approved_project_count[0]['pcount'] > 0){  ?>	  
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
				       <h4 class = "sub-tile">Administrative Sanction Details</h4>         
					  	<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:3%">
					    	<div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">GO No <span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('go_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>

                                </div>
                                <label class="control-label col-md-2">GO Date<span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('go_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="control-label col-md-2">Supervision Charges<span class="required">*
                                    </span></label>
                                <div class="col-md-4">
									  <?php echo $this->Form->control('supervision_charge_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $supervision_charges, 'label' => false, 'error' => true, 'empty' => 'Select']) ?>
                                </div>
                                <label class="control-label col-md-2">Fund Source <span class="required">* </span></label>
                                <div class="col-md-4">
									  <?php echo $this->Form->control('fund_source_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $fund_sources, 'label' => false, 'error' => true, 'empty' => 'Select']) ?>
                                </div>

                            </div> 
                            <div class="form-group row">
                                <label class="control-label col-md-2">Sanctioned Amount<span class="required">*
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">GO Upload <span class="required">* <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)</span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('go_file_upload', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                </div>
                            </div> 		
                        </div>
					</fieldset> 
                     <?php   if (isset($approved_sub_projects)) {   ?>
						<h4 class = "sub-tile">Division Wise Work Details</h4>						 
							<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:0%">
							 <div class="form-group">                               
								<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
									<thead>
										<tr align="center">
										   <th style="width:1%"><!--input type="checkbox" class ="select_all" id='allcb'> Select All</input--></th>
											<th style="width:1%"> S.No</th>
											<th style="width:10%">Work Name</th>
											<th style="width:10%">District</th>
											<th style="width:10%">Division</th>
											<th style="width:10%">Circle</th>
											<th style="width:10%">Rough Cost <br>(in Rs.)</th>
										</tr>
									</thead>
									<tbody >
									   <?php
										$i = 0;
										foreach ($approved_sub_projects as $projectWorkSubdetail) : ?>										
										 <tr> 
										   <td>	    <?php //echo $this->Form->control('project.'. $i.'.project_id', ['class' => 'form-control checkboxFour', 'label' => false, 'error' => false, 'type' => 'checkbox', 'value'=>$projectWork['id']]); ?>
											<input name ='as_project[<?php echo $i; ?>][project_id]' type="checkbox" class ="checkboxFour" id="project_<?php echo $projectWorkSubdetail['id'] ?>" value="<?php echo $projectWorkSubdetail['project_work_id'];?>" onclick="loadproject(<?php echo $projectWorkSubdetail['id'];?>)">
											<!--input name ='project[<?php echo $i; ?>][project_subdetail_id]' type="hidden"  value="<?php echo $projectWorkSubdetail['id'];?>"-->
										   </td>										 
										   <td class="trcount"><?php echo $i + 1; ?></td>
										   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
										   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
										   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
										   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
										   <td align="right"><?php   echo  number_format((float)$projectWorkSubdetail['rough_cost'], 2, '.', ''); ?></td>										
											
										</tr>
										  <?php
											 $tot_rough    += $projectWorkSubdetail['rough_cost'];
										     $i++;
										     endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
										   <td colspan="6" align="right"><b>Total (in Rs.)</b></td>
										   <td align="right"><b><?php echo  number_format((float)$tot_rough, 2, '.', '');  ?></b></td>
										</tr>
									</tfoot>
								</table>
						    </div>			
							</fieldset>
					    	<?php  }  ?> 
						    <div id="confirm_as" style="display:none;">  
							<h4 class = "sub-tile">Work Wise Sanction Amount</h4>						 
							<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
							 <div class="form-group">                               
								<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
									<thead>
										<tr align="center">
											<th style="width:1%"> S.No</th>
											<th style="width:15%">Work Name</th>
											<th style="width:8%">District</th>
											<th style="width:8%">Division</th>
											<th style="width:8%">Circle</th>
											<th style="width:10%">Rough Cost <br>(in Rs.)</th>
											<th style="width:12%">Sanctioned Amount <br>(in Rs.)</th> 
											<th style="width:8%">Total Units</th> 
											<th style="width:5%"></th>
										</tr>
									</thead>
									<tbody class="add_doc">									   
									</tbody>
									<tfoot>
										<tr>
										   <td colspan="5" align="right"><b>Total (in Rs.)</b></td>
										   <td ><?php echo $this->Form->control('rough_total', ['id'=>'rough_total','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly']) ?></td>
										   <td><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Total','readonly']) ?></td>
										   <td></td>
										   <td></td>
										</tr>
									</tfoot>
								</table>
						    </div>			
							</fieldset>
						</div>
				   </div>				 
				 <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">Submit</button>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
					</div>
				</div>				
            </div>
        </div>
	<?php }elseif($approved_project_count[0]['pcount'] == 0){ echo  '<center><span>No Projects Found</span></center>';    }  ?>
    </div>
</div>
	<?php  } ?>
 <?php echo $this->Form->End(); ?>
<script>
function loadproject(id){
	var i = ($('.checkboxFour:checked').length - 1);	
	isChecked = $('#project_'+id).is(':checked');
	//alert(isChecked);	
	if(isChecked === true){	
	 $.ajax({
			async: true,
			dataType: "html",
			url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxsubproject/'+id+'/'+i,

			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
			},
			success: function(data, textStatus) { //alert(data);
			    $('#confirm_as').show();
				$('.add_doc').append(data);	
                roughtotal();				
			}
		});		
	}else if(isChecked === false){	
	    
	   if($('.checkboxFour:checked').length == 0){			
		  $('#confirm_as').hide();
	   }		
	   $('.delete_docdetails_class_'+id).remove();
	      calculateTotal();
          roughtotal();	
	     
	}
}



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

    $("#FormID2").validate({
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
                required: "Enter GO No"
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
            'fund_source_id': {
                required: "Select Fund Source"
            }
        },
        submitHandler: function(form) {  

          
			 if ($('input:checkbox').filter(':checked').length === 0){
				alert("Please Check at least one Check Box");
				//e.preventDefault();
				return false;
			 }else if ($('input:checkbox').filter(':checked').length > 0){
				   var sanctioned_amount = $('#sanctioned-amount').val();
		   
				   var amount = 0;
				   $(".divided_amount").each(function() {
						 amount += parseFloat(this.value);
					});
					 //alert(sanctioned_amount);
					 //alert(amount);  
					//exit();  
				   if(parseFloat(sanctioned_amount) == parseFloat(amount.toFixed(2))){
					form.submit();
					$(".btn").prop('disabled', true);			
				   }else{			   
					   alert('Total Sanctioned Amount should be equal to Administrative Sanctioned Amount');
						return false;			   
				   }
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
	
	
	
	function calculateTotal(){		
	 var amount = 0;
	   $(".divided_amount").each(function() {
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }
			 
		});
		
		//alert(amount);
		 if(!isNaN(amount)){
		
		$('#total-amount').val(amount.toFixed(2));
		
		}else{
			
		$('#total-amount').val('');

		}
		
	}
	
	
	function roughtotal(){		
	 var roughamount = 0;
	   $(".rough_cost").each(function() {
		   
		   if(parseFloat(this.value) != 'NAN'){
			 roughamount += parseFloat(this.value);
		   }
			 
		});
		
		 if(!isNaN(roughamount)){
		
		$('#rough_total').val(roughamount.toFixed(2));
		
		}else{
			
		$('#rough_total').val('');

		}
		
	}
	
	
	 
		
</script>
