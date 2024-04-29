<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Fund Request</header>  
          </div>
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Financial Year<span class="required"></span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year']); ?>
					</div>
					<label class="control-label col-md-2">Department<span class="required"></span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department']); ?>
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

	<?php if(isset($projectworkdetails)){  ?>	  
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID2', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data','action'=>'insertfundrequest']); ?>

<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <!--div class="card-head">
            <header>Add Administrative Sanction</header>  
        </div-->
	<?php if($projectworkdetailcount > 0){  ?>	  
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">                  	

                        <?php   if (isset($projectworkdetails)) {   ?>
							<!--legend class="bol" style="color: #0047AB; text-align: center;">Division Wise Work Details</legend-->
							<h4 class = "sub-tile">Select Projects for Fund Request</h4>
						 
							<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:0%">
							 <div class="form-group">                               
								<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
									<thead>
										<tr align="center">
										   <th style="width:1%"><!--input type="checkbox" class ="select_all" id='allcb'> Select All</input--></th>
											<th style="width:1%"> S.No</th>
											<th style="width:10%">Work ID</th>
											<th style="width:10%">Work Name</th>
											<th style="width:10%">Division</th>
											<th style="width:10%">Circle</th>
											<th style="width:10%">GO No.</th>
											<th style="width:10%">Financial Sanction Excluding SC <br>(in Rs.)</th>
										</tr>
									</thead>
									<tbody >
									   <?php
										$i = 0;
										foreach ($projectworkdetails as $projectWorkSubdetail) : ?>										
										 <tr> 
										   <td>	    <?php //echo $this->Form->control('project.'. $i.'.project_id', ['class' => 'form-control checkboxFour', 'label' => false, 'error' => false, 'type' => 'checkbox', 'value'=>$projectWork['id']]); ?>
											<input name ='projects[<?php echo $i; ?>][project_id]' type="checkbox" class ="checkboxFour" id="project_<?php echo $projectWorkSubdetail['id'] ?>" value="<?php echo $projectWorkSubdetail['project_work_id'];?>" onclick="loadproject(<?php echo $projectWorkSubdetail['id'];?>)">
											<input name ='projects[<?php echo $i; ?>][project_subdetail_id]' type="hidden"  value="<?php echo $projectWorkSubdetail['id'];?>">
										   </td>										 
										   <td class="trcount"><?php echo $i + 1; ?></td>
										   <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
										   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
										   <td><?php echo $projectWorkSubdetail['division_name']; ?></td>
										   <td><?php echo $projectWorkSubdetail['circle_name']; ?></td>                                   
										   <td><?php echo $projectWorkSubdetail['fsgo_no']; ?></td>										
										   <td align="right"><?php echo $projectWorkSubdetail['sac_amount']; ?></td>										
											
										</tr>
										  <?php
											 $tot_fs    += $projectWorkSubdetail['sac_amount'];
										     $i++;
										     endforeach; ?>
									</tbody>
									<!--tfoot>
										<tr>
										   <td colspan="7" align="right"><b>Total (in Rs.)</b></td>
										   <td align="right"><b><?php echo $tot_fs;  ?></b></td>
										</tr>
									</tfoot-->
								</table>
						    </div>			
							</fieldset>
						<?php  }  ?> 
						    <div id="confirm_as" style="display:none;">  
						    <!--legend class="bol" style="color: #0047AB; text-align: center;">Work Wise Amount Sanction</legend-->
							<h4 class = "sub-tile">Fund Request Details</h4>
							<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
							
							<div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Request Date<span class="required">* </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('request_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                </div>
                            </div>								
                            </div><br>
						 
							 <div class="form-group">                               
								<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
									<thead>
										<tr align="center">
											<th style="width:1%"> S.No</th>
											<th style="width:10%">Work ID</th>
											<th style="width:10%">Work Name</th>
											<th style="width:5%">District</th>
											<th style="width:5%">Division</th>
											<th style="width:5%">Circle</th>
											<th style="width:10%">Agreement Amount<br>(in Rs.)</th>
											<th style="width:10%">Balance Payment<br>(in Rs.)</th>
											<th style="width:10%">Request Amount <br>(in Rs.)</th>   
											<th style="width:10%">Balance Amount <br>(in Rs.)</th>   
										</tr>
									</thead>
									<tbody class="add_doc">
									   
									</tbody>
									<tfoot>
										<tr>
										   <td colspan="8" align="right"><b>Total (in Rs.)</b></td>
										   <td><?php echo $this->Form->control('total_request_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly']) ?></td>
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
					<?php   //if ($administrativesanctioncount == 0) {                    
                    ?>
						<button type="submit" class="btn btn-info m-r-20">Forward to EE</button>
						 <?php //} ?>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
					</div>
				</div>
				
            </div>
        </div>
	<?php }elseif($projectworkdetailcount == 0){ echo  '<center><span>No Projects Found</span></center>';    }  ?>
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
			url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxfundrequestadd/'+id+'/'+i,

			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
			},
			success: function(data, textStatus) { //alert(data);
			    $('#confirm_as').show();
				$('.add_doc').append(data);	
                //calculateTotal();				
			}
		});		
	}else if(isChecked === false){	
	    
	   if($('.checkboxFour:checked').length == 0){			
		  $('#confirm_as').hide();
	   }		
	   $('.delete_docdetails_class_'+id).remove();
	      calculateTotal();
	     
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
            'request_date': {
                required: true
            }
        },

        messages: {           
            'request_date': {
                required: "Select Date"
            }
        },
        submitHandler: function(form) { 
         
		   
		    if ($('input:checkbox').filter(':checked').length === 0){
				alert("Please Check at least one Check Box");
				//e.preventDefault();
				return false;
			 }else if ($('input:checkbox').filter(':checked').length > 0){
				  form.submit();
		          $(".btn").prop('disabled', true);	
				   
			 }
             
        }
    });
	
	

    $("#FormID").validate({
        rules: {
            'financial_yea_id': {
                required: true
            }        
        },

        messages: {
            'financial_yea_id': {
                required: "Select Financial Year"
            }
        },
        submitHandler: function(form) {           
            var fin_id = $('#financial-year-id').val();
			var dep_id = $('#department-id').val();
				
			if(fin_id != '' || dep_id != ''){
           
               form.submit();
			 
			}else{
				alert('Select any one input!');
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
	
	
	
	function calculateTotal(){		
	 var amount = 0;
	   $(".divided_amount").each(function() {
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }
			 
		});
		
		//alert(amount);
		 if(!isNaN(amount)){
		
		$('#total-request-amount').val(amount);
		
		}else{
			
		$('#total-request-amount').val('');

		}
		
	}


function calculatebalance(val,count){
var val;
var count;
var bal_amount = $('#project-'+count+'-balance-payment').val();
var balance      = parseFloat(bal_amount) - parseFloat(val); 

//alert(bal_amount);

  if(!isNaN(balance)){
	  
	$('#project-'+count+'-balance-amount').val(balance);  
  }
}	
		
</script>
