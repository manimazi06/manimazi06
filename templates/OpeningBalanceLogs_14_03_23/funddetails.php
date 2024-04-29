<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Fund Request to User Department</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($openingBalanceLog, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                   <div class="col-md-12">
					 <div class="form-body row">
					   <?php   if (isset($fund_request_projects)) {   ?>
					   <h4 class = "sub-tile">Fund Request</h4>						 
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:0%">
						   <div class="form-group">                               
							<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
								<thead>
									<tr align="center">
									   <th style="width:1%"><input type="checkbox" class ="select_all" id='allcb'> Select All</input></th>
										<th style="width:1%"> S.No</th>
										<th style="width:10%">GO No</th>
										<th style="width:10%">Work Name</th>
										<th style="width:10%">Division</th>
										<th style="width:10%">Request Amount</th>
									</tr>  
								</thead>
								<tbody>
								   <?php $i = 0;
								      foreach ($fund_request_projects as $projectWorkSubdetail): ?>										
									 <tr> 
									    <td><?php //echo $this->Form->control('project.'. $i.'.project_id', ['class' => 'form-control checkboxFour', 'label' => false, 'error' => false, 'type' => 'checkbox', 'value'=>$projectWork['id']]); ?>
										<input name ='project[<?php echo $i; ?>][project_id]' type="checkbox" class ="checkboxFour"  id="project_<?php echo $projectWorkSubdetail['project_work_id'] ?>"  value="<?php echo $projectWorkSubdetail['project_work_id'];?>" onclick="loadproject(<?php echo $projectWorkSubdetail['project_work_id'];?>,<?php echo $i; ?>)">
										<!--input name ='project[<?php echo $i; ?>][project_subdetail_id]' type="hidden"  value="<?php echo $projectWorkSubdetail['id'];?>"-->
									   </td>										 
									   <td class="trcount"><?php echo $i + 1; ?></td>
									   <td><?php echo $projectWorkSubdetail['fsgo_no']; ?></td>
									   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
									   <td><?php echo $projectWorkSubdetail['division_name']; ?></td>
									   <td align="right"><?php echo number_format((float)$projectWorkSubdetail['request_amount'], 2, '.', ''); ?></td> 
										 <?php echo $this->Form->control('project.'.$i.'.request_amount', ['class'=>'request_amount','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['request_amount']]) ?>
										 <?php echo $this->Form->control('project.'.$i.'.work_id', ['class'=>'work_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['work_id']]) ?>
									</tr>
									<?php
										 $tot_rough    += $projectWorkSubdetail['request_amount'];
										 $i++;  endforeach;
									?>     
								</tbody>
								<tfoot>  
									<tr>
									   <td colspan="5" align="right"><b>Total (in Rs.)</b></td>
									   <td align="right"><b><?php echo  number_format((float)$tot_rough, 2, '.', '');  ?></b></td>
									</tr>
								</tfoot>
							</table>
						  </div>			
						</fieldset>
						<?php  }  ?> 
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:0%">
						  <div class="col-md-12">
							<div class="form-group row">
								<label class="control-label col-md-2">Fund Request Date<span class=" required"> *
									</span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('request_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Fund request date', 'required']); ?>
								</div>
								<label class="control-label col-md-2">Fund Request Amount<span class=" required">*
									</span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('tot_request_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Request amount', 'required','maxlength'=>13,'value'=>0]); ?>
								</div>
							</div>
							<div class="form-group row ">
								<label class="control-label col-md-2">Is Amount Received?<span class=" required">*
									</span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('is_amount_receive_id', ['class' => 'form-select', 'options' => $amount_received, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select amount status', 'onchange' => 'calling(this.value)', 'required']); ?>
								</div>								
							</div>
							<div class="form-group row yes" style="display: none;">
							   <label class="control-label col-md-2" >Fund Received Date<span class=" required"> *
									</span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select received Date', 'required']); ?>
								</div>
								<label class="control-label col-md-2">Fund Received Amount<span class=" required"> *
									</span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('received_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Received amount', 'required','min'=>1,'maxlength'=>13]); ?>
								</div>
							</div>
						</div>
					</fieldset>
					</div>                   
                    <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                        <div class="offset-md-5 col-md-10">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                        </div>
                    </div>
                    <?php echo $this->Form->End(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function loadproject(id,count){
	var i = ($('.checkboxFour:checked').length - 1);	
	isChecked = $('#project_'+id).is(':checked');
	//alert(isChecked);	
	if(isChecked === true){	
	   var san = $('#project-'+count+'-request-amount').val();
	   //alert(san);	
	   var tot = $('#tot-request-amount').val();
	   
       if(tot == 0){
		   if(!isNaN(san)){
             $('#tot-request-amount').val(san);
		   }
	   }else{
	     var tot_sac = parseFloat(tot)+parseFloat(san);	  
		
	     $('#tot-request-amount').val(tot_sac);
	   }
	 
	}else if(isChecked === false){	
	    
	   if($('.checkboxFour:checked').length == 0){			
		  $('#tot-request-amount').val(0);
	   }
	   
	    var tot = $('#tot-request-amount').val();
		var san = $('#project-'+count+'-request-amount').val();
		
		if(tot != 0){
			  var tot_sac = parseFloat(tot)-parseFloat(san);	  
		   if((tot_sac != 0) && (!isNaN(tot_sac))){
	        $('#tot-request-amount').val(tot_sac);
		   }			
		}	     
	}	
}

 $('#allcb').change(function(){
	if($(this).prop('checked')){
		$('tbody tr td input[type="checkbox"]').each(function(){
		$(this).prop('checked', true);
		});
		var total = $('.checkboxFour:checked').length;
		$('#total').val(total);
		var tot_amount = <?php echo $tot_rough ?>;
		$('#tot-request-amount').val(tot_amount);
	}else{
		$('tbody tr td input[type="checkbox"]').each(function(){
		$(this).prop('checked', false);
		
		});
		var total = $('.checkboxFour:checked').length;
		$('#total').val(total);
		$('#tot-request-amount').val(0);
	}
  }); 

jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {

		if (!/Invalid|NaN/.test(new Date(value))) {
			return new Date(value) > new Date($(params).val());
		}

		return isNaN(value) && isNaN($(params).val()) 
			|| (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');

    $("#FormID").validate({
        rules: {
            'request_date': {
                required: true
            },
            'request_amount': {
                required: true
            },
            'is_amount_receive_id': {
                required: true
            },
            'received_date': {
                required: true,
				greaterThan: '#request-date'
            },
            'received_amount': {
                required: true
            }
        },

        messages: {
            'request_date': {
                required: "Select Request date"
            },
            'request_amount': {
                required: "Enter Request Amount"
            },
            'is_amount_receive_id': {
                required: "Select Amount Received as Yes or No"
            },
            'received_date': {
                required: "Select Received Date",
				greaterThan: "Received date should be greater than Requested Date"
            },
            'received_amount': {
                required: "Enter Received amount"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function calling(id) {      
        if (id == 1) {
            $(".yes").show();
        
        } else if (id == 2) {
            $('#received-date').val('');
            $('#received-amount').val('');  
            $(".yes").hide();			

        }
    }
</script>