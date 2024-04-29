 <ul class="nav nav-tabs">
     <li class="nav-item">
         <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'basicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Administrative<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'administrativesanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Detailed<br>Estimate'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
         <a class="nav-link active" href="#" tabindex="-1" aria-disabled="true">Financial<br>Sanction</a>
     </li>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Technical<br>Sanction</a>
     </li>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tender<br>Details</a>
     </li>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Contractor<br>Details</a>
     </li>
	 <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planning<br>Clearance</a>
     </li>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">SiteHand<br>Over</a>
     </li>
 </ul>
 <?php echo $this->Form->create($projectFinancial_Sanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="row">
     <div class="col-md-12">
         <div class="card card-topline-aqua">
             <div class="card-head">
                 <header>Add Financial Sanctions</header>
             </div>
             <div class="card-body">
                 <div class="form-body row">
                     <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;margin-left:5px;margin-bottom:0%">
                         <div class="form-group">						 
							 <div class="form-group">                               
								<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
									<thead>
										<tr align="center">
											<th style="width:5%">Work Code</th>
											<th style="width:25%">Work Name</th>
											<th style="width:5%">Division</th>
											<th style="width:8%">Administrative Sanction <br>(in Rs.)</th>   
											<th style="width:3%">Supervision <br>(%)</th>   
											<th style="width:12%">Financial Sanction excluding  SC<br>(in Rs.)</th>   
											<th style="width:12%">Supervision Charge <br>(in Rs.)</th>   
											<th style="width:12%">Financial Sanction <br>(in Rs.)</th>   
										</tr>
									</thead>
									<tbody class="add_doc">.
									<?php $i= 0;   ?>
									<tr class="delete_docdetails_class_<?php echo $id ?> present_row">
									   <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
									   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
									   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
									   <td align="right"><?php echo  number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', ''); ?></td>
									   <td><?php echo $as_detail['supervision_charge']['name']; ?></td>     
									   <td>
										 <?php echo $this->Form->control('project.'.$i.'.fs_excluding_sc', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal('.$i.')','data-rule-required'=>true,'data-msg-required'=>'Enter Amount','value'=>($projectWorkSubdetail['fs_excluding_sc'])?$projectWorkSubdetail['fs_excluding_sc']:'']) ?>
									   </td> 
										<td>
										 <?php echo $this->Form->control('project.'.$i.'.supervision_charge', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Supervision','min'=>0,'maxlength'=>13,'onkeyup'=>'calculateTotal('.$i.')','data-rule-required'=>true,'data-msg-required'=>'Enter Supervision Charge','value'=>($projectWorkSubdetail['supervision_charge'])?$projectWorkSubdetail['supervision_charge']:'0']) ?>
									   </td>   
										<td>
										<?php echo $this->Form->control('project.'.$i.'.fs_amount', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Amount','min'=>1,'maxlength'=>13,'readonly','value'=>($projectWorkSubdetail['fs_amount'])?$projectWorkSubdetail['fs_amount']:'']) ?>
										<?php echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['id']]) ?>
										<?php echo $this->Form->control('project.'.$i.'.project_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['project_work_id']]) ?>
										<?php echo $this->Form->control('project.'.$i.'.sanctioned_amount', ['class'=>'sanctioned_amount','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['sanctioned_amount']]) ?>
										<?php echo $this->Form->control('project.'.$i.'.division_id', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['division_id']]) ?>
										<?php echo $this->Form->control('project.'.$i.'.supervision_percentage', ['class'=>'supervision_charge','label' => false, 'error' => false, 'type' =>'hidden','value'=> rtrim($as_detail['supervision_charge']['name'], "%")]) ?>
										</td>  
									</tr>									   
									</tbody>
									<tfoot>
										<tr>
										   <td colspan="7" align="right"><b>Total (in Rs.)</b></td>										  
								 	       <td ><?php echo $this->Form->control('total_fs', ['id'=>'total_fs','class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly','value'=>($projectWorkSubdetail['fs_amount'])?$projectWorkSubdetail['fs_amount']:'']) ?></td>
                                     	</tr>
									</tfoot>
								</table>
						    </div>			
                             <fieldset>
                                 <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
                                     <thead>
                                         <tr>
                                             <th style="width:20%">GO No</th>
                                             <th style="width:20%">GO Date</th>
                                             <th style="width:20%">Sanction Amount (in Rs.)</th>
                                             <th style="width:20%">GO Upload</th>
                                         </tr>
                                     </thead>
                                     <tbody class="add_doc">
                                         <tr class="present_row">
                                             <td><?php echo $this->Form->control('go_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'type'=>'textarea','rows'=>3, 'placeholder' => 'Enter Financial Sanction ReferenceNo', 'required', 'value' => ($projectFinancialSanction['go_no'])?$projectFinancialSanction['go_no']:$oldProjectWorkDetail['go_no']]) ?>
                                             </td>
                                             </td>
                                             <td><?php echo $this->Form->control('go_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Sanction Date', 'required', 'value' => ($projectFinancialSanction['go_date'] != '')?date('d-m-Y',strtotime($projectFinancialSanction['go_date'])):(($oldProjectWorkDetail['go_date'] != '')?date('d-m-Y',strtotime($oldProjectWorkDetail['go_date'])):'')]) ?>
                                             </td>
                                             <td><?php echo $this->Form->control('sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction Amount', 'required','min'=>1,'maxlength'=>15, 'value' => ($projectFinancialSanction['sanctioned_amount'])?$projectFinancialSanction['sanctioned_amount']:$oldProjectWorkDetail['fs_value'],'readonly']) ?>
                                             </td>
                                             <td><?php echo $this->Form->control('sanctioned_file_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'value' => $financialSanction['sanctioned_file_upload']]); ?>
                                                 <?php if ($projectFinancialSanction['sanctioned_file_upload'] != '') {  ?>
                                                     <?php echo $this->Form->control('sanctioned_file_upload1', ['type' => 'hidden', 'value' => $projectFinancialSanction['sanctioned_file_upload']]); ?>
                                                     <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' . $projectFinancialSanction['sanctioned_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                             <ion-icon name="document-text-outline"></ion-icon>View
                                                         </span></a>
                                                 <?php  } ?>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </fieldset>
                         </div>
                     </fieldset>
                     <div class="form-group" style="padding-top: 10px">
                         <div class="offset-md-5 col-md-6">
                             <button type="submit" class="btn btn-info m-r-20">Save & Continue</button>
                             <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <?php echo $this->Form->End(); ?>
 <script>
 
     $("#FormID").validate({
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
                <?php if ($projectFinancialSanction['sanctioned_file_upload'] != '') { ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php } ?>
            }
        },

        messages: {
            'go_no': {
                required: "Enter GO No"
            },
            'go_date': {
                required: "Select GO Date"
            },                   
            'sanctioned_amount': {
                required: "Select Sanctioned Amount"
            },
            'sanctioned_file_upload': {
                required: "Select File upload"
            }
        },
		submitHandler: function(form) {	
            var tot_fs  = $('#total_fs').val();
		    var sanc_fs = $('#sanctioned-amount').val();
			if(parseFloat(tot_fs) == parseFloat(sanc_fs)){            
			  form.submit();
              $(".btn").prop('disabled', true);
			}else{
			  alert('Total FS should be equal to sanctioned FS Amount');
			}		 
		
        }

    });   

     function validdocs(oInput) {
         var _validFileExtensions = ['.pdf', '.jpg', '.jpeg', '.png'];
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
             if (file_size >= 2097152) {
                 alert("File Maximum size is 2MB");
                 oInput.value = "";
                 return false;
             }

         }
         return true;
     }
	 
	 function calculateTotal(count){		
       var count;	  

       var fs_amount_sc = $('#project-'+count+'-fs-excluding-sc').val();	 
	   var sc  = $('#project-'+count+'-supervision-charge').val();	 
       // alert(fs_amount_sc);
       // alert(sc);
	   
	   var tot          = parseFloat(fs_amount_sc)+parseFloat(sc);
	    if(!isNaN(tot)){
	      $('#project-'+count+'-fs-amount').val(tot.toFixed(2));
		}else{
	    	$('#project-'+count+'-fs-amount').val(0);	
		}
	   
	   var amount = 0;
   
	   $(".divided_amount").each(function() {		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }else{
			   amount = 0;
		   }			   
		});		
		 if(!isNaN(amount)){		
		$('#total_fs').val(amount.toFixed(2));
		//$('#sanctioned-amount').val(amount.toFixed(2));
		
		}else{			
		$('#total_fs').val('');
		}
		
	}
 </script>
