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
                         <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required','onchange'=>'loadprojects(this.value)']); ?>
					</div>
				</div>
                  <div class="form-group row">
					<label class="control-label col-md-2">Projects<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('project_work_id', ['class' => 'form-select select2', 'templates' => ['inputContainer' => '{{content}}'], 'options' => ($ProjectWorks)?$ProjectWorks:'', 'label' => false, 'error' => false, 'empty' => 'Select Project', 'required']); ?>
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

	<?php if(isset($approved_sub_projects)){  ?>	  
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
				
                 	 
                         <?php   if (isset($approved_sub_projects)) {   ?>
							<!--legend class="bol" style="color: #0047AB; text-align: center;">Division Wise Work Details</legend-->
						      <h4 class = "sub-tile">Division Wise Sanctioned Details:</h4>
							<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:0%">
							 <div class="form-group">                               
								<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
									<thead>
										<tr align="center">
										   <!--th style="width:1%"><input type="checkbox" class ="select_all" id='allcb'> Select All</input></th-->
											<th style="width:1%"> S.No</th>
											<th style="width:10%">Work Code</th>
											<th style="width:10%">Work Name</th>
											<th style="width:10%">District</th>
											<th style="width:10%">Division</th>
											<th style="width:10%">Circle</th>
											<th style="width:10%">Sanctioned Amount <br>(in Rs.)</th>
										</tr>
									</thead>
									<tbody >
									   <?php
										$i = 0;
										foreach ($approved_sub_projects as $projectWorkSubdetail) : ?>										
										 <tr> 
										   <!--td>	    <?php //echo $this->Form->control('project.'. $i.'.project_id', ['class' => 'form-control checkboxFour', 'label' => false, 'error' => false, 'type' => 'checkbox', 'value'=>$projectWork['id']]); ?>
											<input name ='fs_project[<?php echo $i; ?>][project_id]' type="checkbox" class ="checkboxFour" id="project_<?php echo $projectWorkSubdetail['id'] ?>" value="<?php echo $projectWorkSubdetail['project_work_id'];?>" onclick="loadproject(<?php echo $projectWorkSubdetail['id'];?>,<?php echo $i; ?>)">
											<input name ='project[<?php echo $i; ?>][project_subdetail_id]' type="hidden"  value="<?php echo $projectWorkSubdetail['id'];?>">
										   </td-->										 
										   <td class="trcount"><?php echo $i + 1; ?></td>
										   <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
										   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
										   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
										   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
										   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
										   <td align="right"><?php echo number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', ''); ?>
										       <?php echo $this->Form->control('project.'.$i.'.id', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['id']]) ?>
										   </td>								
										</tr>
										  <?php
											 $tot_sanctioned    += $projectWorkSubdetail['sanctioned_amount'];
										     $i++;
										     endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
										   <td colspan="6" align="right"><b>Total (in Rs.)</b></td>
										   <td align="right"><?php echo  number_format((float)$tot_sanctioned, 2, '.', '') ;  ?></td>
										   	<?php //echo $this->Form->control('total_sanctioned', ['class'=>'sanctioned','label' => false, 'error' => false, 'type' =>'hidden','value'=>0]) ?>

										</tr>
										<!--tr>
										   <td colspan="7" align="right"><b>Total Selected (in Rs.)</b></td>
										   <td align="right"><?php echo $this->Form->control('total_sanctioned', ['class'=>'form-control','label' => false, 'error' => false, 'type' =>'text','value'=>0,'readonly']) ?></td>
										   	

										</tr-->
									</tfoot>
								</table>
						    </div>			
							</fieldset>
							 <h4 class = "sub-tile">Financial Sanction Details:</h4>
					         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:25px;margin-left:5px;margin-bottom:0%">
                            <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">GO No</th>
											    <th style="width:20%">GO Date</th>
                                                <th style="width:20%">Sanction Amount (in Rs.)</th>
                                                <th style="width:20%">File Upload</th>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>                     
                            </div>
							</fieldset>
						<?php  }  ?> 						
				   </div>
				 
				 <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
				  <?php echo $this->Form->control('project_work_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $approved_sub_projects[0]['project_work_id']]) ?>

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
function loadproject(id,count){
	var i = ($('.checkboxFour:checked').length - 1);	
	isChecked = $('#project_'+id).is(':checked');
	//alert(isChecked);	
	
	if(isChecked === true){	
	   var san = $('#project-'+count+'-sanctioned-amount').val();
	   var tot = $('#total-sanctioned').val();
	   
       if(tot == 0){
		   if(!isNaN(san)){
             $('#total-sanctioned').val(san);
		   }
	   }else{
	     var tot_sac = parseFloat(tot)+parseFloat(san);	  
		
	     $('#total-sanctioned').val(tot_sac);
	   }
	 
	}else if(isChecked === false){	
	    
	   if($('.checkboxFour:checked').length == 0){			
		  $('#total-sanctioned').val(0);
	   }
	   
	    var tot = $('#total-sanctioned').val();
		var san = $('#project-'+count+'-sanctioned-amount').val();
		
		if(tot != 0){
			  var tot_sac = parseFloat(tot)-parseFloat(san);	  
		   if((tot_sac != 0) && (!isNaN(tot_sac))){
	        $('#total-sanctioned').val(tot_sac);
		   }
			
		}
	   
	   // $('.delete_docdetails_class_'+id).remove();
	      // calculateTotal();
          // roughtotal();	
	     
	}
	// var total = $('#total-sanctioned').val();
	//alert(total);
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
			 form.submit();
					 $(".btn").prop('disabled', true);
			 /*if ($('input:checkbox').filter(':checked').length === 0){
				alert("Please Check at least one Check Box");
				//e.preventDefault();
				return false;
			 }else if ($('input:checkbox').filter(':checked').length > 0){
				     form.submit();
					 $(".btn").prop('disabled', true);
				  /* var sanctioned_amount = $('#sanctioned-amount').val();
				   var total_sanctioned  = $('#total-sanctioned').val();	
				   // alert(sanctioned_amount);
				   // alert(total_sanctioned);
				 
				   if(parseFloat(sanctioned_amount) == parseFloat(total_sanctioned)){  
					 form.submit();
					 $(".btn").prop('disabled', true);			
				   }else{			   
					  alert('Total Sanctioned Amount should be equal to Financial Sanctioned Amount');
					  return false;			   
				   }
			 }*/	
        }
    });
	
	

    $("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: true
            },
            'department_id': {
                required: true
            },
            'project_work_id': {
                required: true
            }           
        },

        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            },
            'department_id': {
                required: "Select Department"
            },
            'project_work_id': {
                required: "Select Project"
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


function loadprojects(dept_id){
	var dept_id;
	var fin_id = $('#financial-year-id').val();
	// alert(dept_id);
	// alert(fin_id);
	
	if(fin_id != ''){
		
			 $.ajax({
			async: true,
			dataType: "html",
			url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectlist/'+dept_id+'/'+fin_id,

			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
			},
			success: function(data, textStatus) { //alert(textStatus);
				$('#project-work-id').html(data);	
			}
		});	
		
		
	}else{
		alert('Select Financial Year');
		
	}



}	
		
</script>
