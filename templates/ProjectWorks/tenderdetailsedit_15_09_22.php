 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Edit Project Tender Details</header>
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
						<label class="control-label col-md-2 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>                  
					
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                        </div>						
                    </div>
					
                </div>
               </fieldset>		 
		</div> 
		<div class="card-body">
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
					</fieldset><br><br>
                        <legend class="bol" style="color: #0047AB; text-align: center;">Divisionwise Amount Sanction Details</legend>					
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">                               
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr align="center">
                                                <th style="width:5%"> S.No</th>
                                                <th style="width:20%">Division</th>
											    <th style="width:20%">Circle</th>
                                                <th style="width:20%">Amount</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
										   <?php
                                            $i = 0;
                                           // foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>										
											     <td class="trcount"><?php echo $i + 1; ?></td>
                                                <td><?php echo $projectWorkSubdetail['division']['name']; ?>
											   </td>
                                                <td>
												<?php echo $projectWorkSubdetail['circle']['name']; ?>
                                               </td>                                   
                                               <td align="right"><?php echo $projectWorkSubdetail['sanctioned_amount']; ?>
											   <?php echo $this->Form->control('sanctioned_amount', ['label' => false, 'error' => false, 'type' =>'hidden','class'=>'divided_amount','value'=>$projectWorkSubdetail['sanctioned_amount']]); ?>

                                               </td>                                                                                      
                                                <td align="center">
												  <?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 1){  ?>
												  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
												  
												  <?php } ?>
                                                </td>							
                                                
                                            </tr>
											  <?php
                                                 $tot_sanction += $projectWorkSubdetail['sanctioned_amount'];

 											  $i++;
                                           // endforeach; ?>
                                        </tbody>
										<tfoot>
										    <tr>
											   <td colspan="3" align="right"><b>Total</b></td>
											   <td align="right"><?php echo $tot_sanction;  ?></td>
										       <td></td>
											</tr>
										</tfoot>
                                    </table>
									</div>
                                </fieldset><br>  					
				<?php } //} ?>
				<?php   if ($financialSanctionscount > 0) {  ?> 					
					<?php   //if (count($financialsanctions) > 0) {  ?> 					
						 <legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend>

				         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">                                  
							<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;"  bgcolor="white">
								<thead>
									<tr align="center">
										<th  style="width:5%"> S.No</th>
										<th style="width:20%">Reference No</th>
										<th style="width:20%">Sanctioned Date</th>
										<th style="width:20%">Sanction amount</th>
										<th style="width:20%">File Upload</th>
									</tr>
								</thead>
								<tbody class="add_doc">
									<?php
									$i = 0;
									foreach ($financialSanctions as $financialsanction) : ?>
										<tr  align="center">
											<td class="trcount"><?php echo $i + 1; ?></td>
											<td><?php echo $financialsanction['fs_ref_no']; ?></td>
											<td><?php echo date('d-m-Y', strtotime($financialsanction['sanctioned_date'])); ?></td>
											<td><?php echo $financialsanction['sanctioned_amount']; ?></td>
											<td align="center">
											<?php if($financialsanction['sanctioned_file_upload'] != ''){  ?>
												<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' .$financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                <ion-icon name="document-text-outline"></ion-icon>View
                                                            </span></a>												
											<?php } ?>
											</td>											
										</tr>
									<?php $i++;
									endforeach; ?>
								</tbody>
							</table>
						</fieldset><br><br>					
                    <?php } //} ?>
					 <?php  if($technicalcount !=0){  ?>
					    <legend class="bol" style="color: #0047AB; text-align: center;">Technical Sanction Details</legend>

				         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;">                                  
						
                             <table id="answerTable" class="table  table-bordered  order-column"
                                 style="max-width: 98%;margin-left: 1%;">
                                 <thead>
                                     <tr align="center">
                                         <th style="width:5%"> S.No</th>
                                         <th style="width:20%">Sanctioned Date</th>
                                         <th style="width:20%">Sanctioned Amount</th>
                                         <th style="width:20%">Description</th>
                                         <th style="width:20%">File Upload</th>
                                     </tr>
                                 </thead>
                                 <tbody class="add_doc">
                                     <?php
                                        $i = 0;
                                       ?>
                                     <tr class="present_row"  align="center">
                                         <td class="trcount"><?php echo $i + 1; ?></td>
                                         <td><?php echo date('d-m-Y',strtotime($technical['sanctioned_date'])); ?>
                                         </td>   
                                         <td><?php echo $technical['amount']; ?>
                                         </td>
                                         <td><?php echo $technical['description']; ?>
                                         </td>
                                         <td>
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
                         </fieldset><br>
					 <?php } ?>
					</div>
					<div class="card-body">
					  <legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend>
					  <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">                   
						<div class="form-body row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label col-md-2">Tender no <span class="required"> * </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
									</div>
									<label class="control-label col-md-2">Tender Date<span class="required"> * </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('tender_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-2">Tender Copy <span class="required"> * </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
										
										<?php  if($projectTenderDetail['tender_copy'] != ''){  ?>
										<?php echo $this->Form->control('tender_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $projectTenderDetail['tender_copy']]); ?>
											<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
												<ion-icon name="document-text-outline"></ion-icon>View
											</span>
											</a>  
										<?php  } ?>
											
									</div>
									<label class="control-label col-md-2">Estimate Amount put to Tender<span class="required"> * </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
									</div>
								</div>             
							 </div>       
						</div>
						</fieldset>
					</div>
			    <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">update</button>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
					</div>
				</div>
      </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
    $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });

        $("#FormID").validate({
        rules: {
            'project_work_id': {
                required: true
            },
            'tender_no': {
                required: true
            },
            'tender_date': {
                required: true
            },
            'tender_copy': {
                required: false
            },
            'tender_amount': {
                required: true
            }

        },

        messages: {
            'project_work_id': {
                required: "Select Project Work"
            },
            'tender_no': {
                required: "Select Tender No"
            },
            'tender_date': {
                required: "Select Tender Date"
            },
            'tender_copy': {
                required: " Select Tender Copy"
            },
            'tender_amount': {
                required: "Enter Tender Amount"
            }
        },
        submitHandler: function(form) {
            
			var admin_sanction      = <?php echo $administrativesanction['sanctioned_amount'];  ?>;
			var tender_amount  = $('#tender-amount').val();			
			if(parseFloat(tender_amount) <= parseFloat(admin_sanction)){			
            form.submit();
            $(".btn").prop('disabled', true);			
			}else{
			 alert('Estimate Amount put to Tender should be less than or equal to  Technical Sanction');
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
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
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
                            ?>/firstproject/Students/ajaxtaluks/" + distID;
            // alert(path);
            if (financialID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc_staging/projectTenderDetails/ajaxproject/' + financialID,
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
</script>
