 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>

 <?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header> Technical Sanction for Work ID - <?php echo $projectWorkSubdetail['work_code']   ?></header>
         </div>
		  <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;">     
           
     </div>
         <!--div class="card-body">
             <legend class="bol" style="color: #0047AB; text-align: center;">Project Details</legend>

             <fieldset
                 style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

                 <div class="col-md-12">
                     <div class="form-group row">
                         <label class="control-label col-md-2 bol">Project Code <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['project_code']; ?>
                         </div>
                         <label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['project_name']; ?>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label class="control-label col-md-2 bol bol">Departments <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['department']['name']; ?>
                         </div>


                         <label class="control-label col-md-2 bol">Financial Year <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['financial_year']['name']; ?>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['building_type']['name']; ?>
                         </div>


                         <label class="control-label col-md-2 bol">Project Status<span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['project_status']['name']; ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label class="control-label col-md-2 bol">Rough Cost (in Rs.)<span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>

                         </div>
                         <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['scheme_type']['name']; ?>
                         </div>
                         <label class="control-label col-md-2 bol">Project Description<span class="required">&nbsp;&nbsp;: </span></label>
                         <div class="col-md-4 lower">
                             <?php  echo $projectWork['project_description']; ?>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label class="control-label col-md-2 bol">Proposal Upload <span class="required"> &nbsp;&nbsp;:
                             </span></label>
                         <div class="col-md-4 lower">
                             <a style="color:blue;"
                                 href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>"
                                 target="_blank"><span>
                                     <ion-icon name="document-text-outline"></ion-icon>View
                                 </span></a>
                         </div>
                     </div>
                 </div>
         </fieldset>
         </div-->
   
	 <!--div class="card-body">
     <?php  if ($administrativesanctioncount > 0) { ?>
     <legend class="bol" style="color: #0047AB; text-align: center;">Administrative Sanction Details
     </legend>

     <fieldset
         style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;margin-bottom:2%">
         <div class="col-md-12" style="margin-top:">
             <div class="form-group row">
                 <label class="control-label col-md-2 bol">GO No. <span class="required">
                         &nbsp;&nbsp;: </span></label>
                 <div class="col-md-4 lower">
                     <?php  echo $administrativesanction['go_no']; ?>
                 </div>
                 <label class="control-label col-md-2 bol">GO Date <span class="required">
                         &nbsp;&nbsp;: </span></label>
                 <div class="col-md-4 lower">
                     <?php  echo date('d-m-Y',strtotime($administrativesanction['go_date'])); ?>
                 </div>
             </div>

             <div class="form-group row">
                 <label class="control-label col-md-2 bol">GO Upload <span class="required">
                         &nbsp;&nbsp;: </span></label>
                 <div class="col-md-4 lower">
                     <a style="color:blue;"
                         href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $administrativesanction['go_file_upload'], ['fullBase' => true]); ?>"
                         target="_blank"><span>
                             <ion-icon name="document-text-outline"></ion-icon>View
                         </span></a>
                 </div>
                 <label class="control-label col-md-2 bol">Sanctioned Amount (in Rs.)<span class="required">
                         &nbsp;&nbsp;: </span></label>
                 <div class="col-md-4 lower">
                     <?php  echo ($administrativesanction['sanctioned_amount'])?ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'],'INR'),'₹'):'0.00'; ?>
                 </div>
             </div>
         </div>
     </fieldset><br>
	  <?php   if ($financialSanctionscount > 0) {  ?>
     <?php   //if (count($financialsanctions) > 0) {  ?>
     <legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend>

     <fieldset
         style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">
         <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;"
             bgcolor="white">
             <thead>
                 <tr align="center">
                     <th style="width:5%"> S.No</th>
                     <th style="width:20%">GO No</th>
                     <th style="width:20%">GO Date</th>
                     <th style="width:20%">Sanction Amount (in Rs.)</th>
                     <th style="width:20%">GO Upload</th>
                 </tr>
             </thead>
             <tbody class="add_doc">
                 <?php
									$i = 0;
									foreach ($financialSanctions as $financialsanction) : ?>
                 <tr align="center">
                     <td class="trcount"><?php echo $i + 1; ?></td>
                     <td><?php echo $financialsanction['fs_ref_no']; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($financialsanction['sanctioned_date'])); ?></td>
                     <td><?php echo $financialsanction['sanctioned_amount']; ?></td>
                     <td>
                         <?php if($financialsanction['sanctioned_file_upload'] != ''){  ?>
                         <a style="color:blue;"
                             href="<?php echo $this->Url->build('/uploads/financialsanction/' .$financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>"
                             target="_blank"><span>
                                 <ion-icon name="document-text-outline"></ion-icon>View
                             </span></a>
                         <?php } ?>
                     </td>
                 </tr>
                 <?php $i++;
									endforeach; ?>
             </tbody>
         </table>
     </fieldset><br>
     <?php } //} ?>
	 	 <legend class="bol" style="color: #0047AB; text-align: center;"> Amount Sanctioned Details</legend>

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
								</tr>
							</thead>
							<tbody class="add_doc">
							   <?php
								$i = 0;
								//foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>
								<tr class="present_row">
									<td class="trcount"><?php echo $i + 1; ?></td>
									<td><?php echo $projectWorkSubdetail['work_code']; ?></td>
									<td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
									<td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
									<td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                  
								
								</tr>
								  <?php //$i++;
								//endforeach; ?>
							</tbody>
						
						</table>
					</fieldset>                     
				</div>
			</fieldset>
     <?php   } ?>    
	 </div-->
     <div class="card-body">
	  <h4 class = "sub-tile">Technical Sanction Details</h4> 
         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
             
             <div class="col-md-12">
                 <div class="form-body row">
                     <?php if ($technicalcount == 0) { ?>
                     <!--div class="form-group">
                         <fieldset>
                             <table id="answerTable" class="table  table-bordered  order-column"
                                 style="max-width: 98%;margin-left: 1%;">
                                 <thead>
                                     <tr align="center">
                                         <th style="width:1%"> S.No</th>
                                         <th style="width:10%">Sanction No</th>
                                         <th style="width:10%">Sanctioned Date</th>
                                         <th style="width:10%">Sanctioned Amount (in Rs.)</th>
                                         <th style="width:10%">Description</th>
                                         <th style="width:10%">File Upload</th>
                                     </tr>
                                 </thead>
                                 <tbody class="add_doc">
                                     <tr class="present_row">
                                         <td class="trcount">1</td>
										 <td>
										 <?php echo $this->Form->control('sanction_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction No','required']) ?>
                                         </td>
                                         <td>
										 <?php echo $this->Form->control('sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select date','required']) ?>
                                         </td>
                                         <td>
										 <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required']) ?>
                                         </td>
                                         <td>
										 <?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'required']) ?>
                                         </td>
                                         <td>
										 <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
                                             <?php //echo $this->Form->control('technical_id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']) ?>
                                         </td>
                                     </tr>

                                 </tbody>
                             </table>
                         </fieldset>
                     </div-->
					    <div class="col-md-12" style="margin-top:">						 
						    <div class="form-group row">
							  <label class="control-label col-md-2 bol">Sanction No <span class="required">* </span></label>
								<div class="col-md-4">
									 <?php echo $this->Form->control('sanction_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction No','required']) ?>
							  						
						     	</div>
								<label class="control-label col-md-2 bol">Sanction Date <span class="required">* </span></label>
								<div class="col-md-4">
									 <?php echo $this->Form->control('sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select date','required']) ?>
						     	</div>								
						    </div>                             
                            <div class="form-group row">
							   <label class="control-label col-md-2 bol">Sanctioned Amount <br>(in Rs.)<span class="required">*  </span></label>
								<div class="col-md-4">
										 <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','value'=>$projectWorkSubdetail['abstract_amount']]) ?>
									</div>
							    <label class="control-label col-md-2 bol">Description <span class="required">*  </span></label>
								<div class="col-md-4">
										 <?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'required']) ?>
								</div>								
							</div>							
                            <div class="form-group row">
							  <label class="control-label col-md-2 bol">File Upload. <span class="required">* </span></label>
								<div class="col-md-4">
									 <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
							   </div>								
							</div>							
                         </div> 
                     <?php   } elseif ($technicalcount > 0) {  ?>
                     <!--div class="form-group">
                         <fieldset>
                             <table id="answerTable" class="table  table-bordered  order-column"
                                 style="max-width: 98%;margin-left: 1%;">
                                 <thead>
                                     <tr align="center">
                                         <th style="width:1%"> S.No</th>
                                         <th style="width:10%">Sanction No.</th>
                                         <th style="width:10%">Sanctioned Date</th>
                                         <th style="width:10%">Sanctioned Amount (in Rs.)</th>
                                         <th style="width:10%">Description</th>
                                         <th style="width:10%">File Upload</th>
                                     </tr>
                                 </thead>
                                 <tbody class="add_doc">
                                     <?php
                                        $i = 0;
                                       ?>
                                     <tr class="present_row"  align="center">
                                         <td class="trcount"><?php echo $i + 1; ?></td>
									    <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $technical['id']]) ?>
                                         <td><?php echo $this->Form->control('sanctioned_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction No.','required','value' =>$technical['sanction_no']]) ?>
                                         </td>   
                                         <td><?php echo $this->Form->control('sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select date','required','value' =>date('d-m-Y',strtotime($technical['sanctioned_date']))]) ?>
                                         </td>   
                                         <td><?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','value' => $technical['amount']]) ?>
                                         </td>
                                         <td><?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'required', 'value' => $technical['description']]) ?>
                                         </td>
                                         <td>
										    <?php  if($projectWorkSubdetail['is_approved'] == 0){ ?>
                                             <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'value' => $technical['detailed_estimate_upload']]); ?>
                                            <?php } ?>
											<?php  if($technical['detailed_estimate_upload'] != ''){ ?>
											 
											 <?php echo $this->Form->control('detailed_estimate_upload1', ['type' => 'hidden', 'label' => false, 'value' => $technical['detailed_estimate_upload']]); ?>
                                             <a style="color:blue;"
                                                 href="<?php echo $this->Url->build('/uploads/technicalsanctions/' . $technical['detailed_estimate_upload'], ['fullBase' => true]); ?>"
                                                 target="_blank"><span>
                                                     <ion-icon name="document-text-outline"></ion-icon>View
                                                 </span></a>
											 <?php  } ?>
                                         </td>
                                     </tr>
                                     <?php $i++;
                                       ?>
                                 </tbody>
                             </table>
                         </fieldset>
                     </div-->
					 <div class="col-md-12" style="margin-top:">						 
						    <div class="form-group row">
							  <label class="control-label col-md-2 bol">Sanction No <span class="required">* </span></label>
								<div class="col-md-4">
										 <?php echo $this->Form->control('sanction_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction No','required','value' =>$technical['sanction_no']]) ?>
							  						
						     	</div>
								<label class="control-label col-md-2 bol">Sanction Date <span class="required">* </span></label>
								<div class="col-md-4">
										 <?php echo $this->Form->control('sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select date','required','value' =>date('d-m-Y',strtotime($technical['sanctioned_date']))]) ?>
							  						
						     	</div>
								
						    </div>
                             
                            <div class="form-group row">
							   <label class="control-label col-md-2 bol">Sanctioned Amount <br>(in Rs.)<span class="required">*  </span></label>
								<div class="col-md-4">
										 <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','value' => $technical['amount']]) ?>
									</div>
							    <label class="control-label col-md-2 bol">Description <span class="required">*  </span></label>
								<div class="col-md-4">
										 <?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'required', 'value' => $technical['description']]) ?>
								</div>								
							</div>
							
                            <div class="form-group row">
							  <label class="control-label col-md-2 bol">File Upload. <span class="required">* </span></label>
								<div class="col-md-4">
									  <?php  if($projectWorkSubdetail['is_approved'] == 0){ ?>
										 <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'value' => $technical['detailed_estimate_upload']]); ?>
										<?php } ?>
										<?php  if($technical['detailed_estimate_upload'] != ''){ ?>
										 
										 <?php echo $this->Form->control('detailed_estimate_upload1', ['type' => 'hidden', 'label' => false, 'value' => $technical['detailed_estimate_upload']]); ?>
										 <a style="color:blue;"
											 href="<?php echo $this->Url->build('/uploads/technicalsanctions/' . $technical['detailed_estimate_upload'], ['fullBase' => true]); ?>"
											 target="_blank"><span>
												 <ion-icon name="document-text-outline"></ion-icon>View
											 </span></a>
										 <?php  } ?>
										 </div>								
							</div>							
                         </div> 
                     <?php } ?>
                 </div>
             </div>
         </fieldset>		
     </div>
	  <?php  if($projectWorkSubdetail['is_approved'] == 0){ ?>
         <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-5 col-md-6">
                 <button type="submit" class="btn btn-info m-r-20">Submit</button>
                 <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
             </div>
         </div>
		 <?php  }else{ ?>
		  <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-6 col-md-6">
                 <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
             </div>
         </div>

		 <?php  }?>
 </div>
 </div>
 
 <?php echo $this->Form->End(); ?>
 <script>
  <?php  if($projectWorkSubdetail['is_approved'] == 1){ ?>
  $(".form-control").prop('disabled', true);
  
   <?php  } ?>
$("#FormID").validate({
    rules: {
        'detailed_estimate_upload': {
            <?php if ($technical['detailed_estimate_upload'] != '') {   ?>
            required: false
            <?php } else {   ?>
            required: true
            <?php } ?>
        },
        'description': {
            required: true
        },
        'amount': {
            required: true
        },
        'sanctioned_date': {
            required: true
        },
        'description': {
            required: true
        },
        'sanction_no': {
            required: true
        }
    },

    messages: {
        'detailed_estimate_upload': {
            required: " Select File Upload"
        },
        'description': {
            required: "Enter Description"
        },
        'amount': {
            required: "Enter Amount"
        },
        'sanctioned_date': {
            required: "select sanctions date"
        },
        'description': {
            required: "Enter Description"
        },
        'sanction_no': {
            required: "Enter Sanction No."
        }
    },
    submitHandler: function(form) {
		var sanctioned_amount =  <?php echo  $projectWorkSubdetail['sanctioned_amount']   ?>;
		var amount            = $('#amount').val();
		
		if(parseFloat(amount) <= parseFloat(sanctioned_amount)){
		   form.submit();
           $(".btn").prop('disabled', true);
		
		}else{
			alert('Technical Sanction Amount should be less than or equal to Sanction Amount to that project work');
			$('#amount').val('');
            $('#amount').focus(); 			
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

