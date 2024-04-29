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
                <header>Add Financial Sanctions</header>
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
         <div class="card-body">
                <div class="form-body row">

                    <div class="col-md-12">
					 <?php  if ($administrativesanctioncount > 0) { ?>
					<legend class="bol" style="color: #0047AB; text-align: center;">Administrative Sanction Details</legend>
                   
				      <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;margin-bottom:2%">
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
								<label class="control-label col-md-2 bol">Sanctioned Amount (in Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
								 <?php  echo ($administrativesanction['sanctioned_amount'])?ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'],'INR'),'₹'):'0.00'; ?>               
								</div>
							</div>                                  
                         </div>
					</fieldset><br>	
					  <legend class="bol" style="color: #0047AB; text-align: center;"> Project Work Details</legend>					
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">                               
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"> S.No</th>
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
											     <td class="trcount"><?php echo $i + 1; ?></td>
                                                <td><?php echo $projectWorkSubdetail['division']['name']; ?>
											   </td>
                                                <td>
												<?php echo $projectWorkSubdetail['circle']['name']; ?>
                                               </td>                                   
                                               <td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?>
											   <?php echo $this->Form->control('sanctioned_amount', ['label' => false, 'error' => false, 'type' =>'hidden','class'=>'divided_amount','value'=>$projectWorkSubdetail['sanctioned_amount']]); ?>

                                               </td>                                                                                      
                                                <td>
												  <?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 1){  ?>
												  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
												  
												  <?php } ?>
                                                </td>							
                                                
                                            </tr>
											  <?php $i++;
                                            endforeach; ?>
                                        </tbody>
										<tfoot>
										    <tr>
											   <td colspan="3" align="right"><b>Total (in Rs.)</b></td>
											   <td><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Total Amount','readonly']) ?></td>
										       <td></td>
											</tr>
										</tfoot>
                                    </table>
                                </fieldset><br>   
                    <?php   } ?>								
					  <!--div align="right">
			      <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                    More</button>
				</div><br-->
				      <legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend>					

					  <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;margin-left:5px;margin-bottom:1%">

                        <?php if ($financialSanctionscount == 0) { ?>
                            <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"> S.No</th>
                                                <th style="width:20%">GO No</th>
											    <th style="width:20%">GO Date</th>
                                                <th style="width:20%">Sanction Amount (in Rs.)</th>
                                                <th style="width:20%">File Upload</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
                                            <tr class="present_row">
                                                <td class="trcount">1</td>
                                                <td><?php echo $this->Form->control('financial.0.fs_ref_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter GO No.', 'required']) ?>
                                                   <?php echo $this->Form->control('financial.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']) ?>
											   </td>
											    <td><?php echo $this->Form->control('financial.0.sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Select GO Date']) ?>
                                               </td>                                   
                                               <td><?php echo $this->Form->control('financial.0.sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter Sanction Amount']) ?>
                                               </td>
                                                <td><?php echo $this->Form->control('financial.0.sanctioned_file_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)']); ?>
                                                </td>                                       
                                                <td>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>                     
                            </div>
                        <?php } elseif ($financialSanctionscount > 0) { ?>
                            <div class="form-group">
                                <fieldset>                                  
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
                                        <thead>
                                            <tr>
                                            <th style="width:5%"> S.No</th>
                                                <th style="width:20%">GO No</th>
									            <th style="width:20%">GO Date</th>
                                                <th style="width:20%">Sanction Amount (in Rs.)</th>
                                                <th style="width:20%">GO Upload</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
                                            <?php
                                            $i = 0;
                                            foreach ($financialSanctions as $financialSanction) : ?>
                                                <tr class="present_row">
                                                    <td class="trcount"><?php echo $i + 1; ?></td>
                                                
                                                    <td><?php echo $this->Form->control('financial.' . $i . '.fs_ref_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Financial Sanction ReferenceNo', 'required' ,'value' => $financialSanction->fs_ref_no]) ?>
                                                    </td>

                                                        <?php echo $this->Form->control('financial.' . $i . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $financialSanction->id]) ?>
                                                    </td>
													 <td><?php echo $this->Form->control('financial.' . $i . '.sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Sanction Date', 'required' ,'value' => date('d-m-Y', strtotime($financialSanction->sanctioned_date))]) ?>
                                                    </td>

                                                    <td><?php echo $this->Form->control('financial.' . $i . '.sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction Amount', 'required' ,'value' => $financialSanction->sanctioned_amount]) ?>
                                                    </td>

                                                    <td><?php echo $this->Form->control('financial.' . $i . '.sanctioned_file_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','value' => $financialSanction->sanctioned_file_upload]); ?>
                                                    <?php echo $this->Form->control('financial.' . $i . '.sanctioned_file_upload1', ['type' => 'hidden','label' => false, 'value' => $financialSanction->sanctioned_file_upload]); ?>

                                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' .$financialSanction['sanctioned_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                <ion-icon name="document-text-outline"></ion-icon>View
                                                            </span></a>
                                                    </td>                                          
                                                     <td>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        <?php } ?>
						</fieldset>
                        <div class="form-group" style="padding-top: 10px">
                            <div class="offset-md-5 col-md-6">
                                <button type="submit" class="btn btn-info m-r-20">Submit</button>
                                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
 <?php  if ($administrativesanctioncount > 0) { ?>
           var amount = 0;
		   $(".divided_amount").each(function() {
			   
			   if(parseFloat(this.value) != 'NAN'){
				 amount += parseFloat(this.value);
			   }
				 
			});
			
			$('#total-amount').val(amount);
			
 <?php   } ?>
    function validdocs(oInput) {
        var _validFileExtensions = ['.pdf','.jpg','.jpeg','.png'];
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

    function getaddempdoc() {
        var j = ($('.present_row').length);
        // alert(j);
        var serial_id =  ($('.present_row').length - 1);;
        var name  = $("#financial-" + serial_id + "-fs-ref-no").val();
        var stage = $("#financial-" + serial_id + "-sanctioned-amount").val();
        var file  = $("#financial-" + serial_id + "-sanctioned-file-upload").val();
		 <?php if (count($financialSanctions) == 0) { ?>
        var file1 = "";
		 <?php }else{ ?>
        var file1 = $("#financial-" + serial_id + "-sanctioned-file-upload1").val();
		 <?php } ?>
        var date  = $("#financial-" + serial_id + "-sanctioned-date").val();  
		
		//alert(file);
		//alert(file1);
        if (name != '' &&  stage != '' && (file != '' || file1 != '') && date != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxfinancial/' +j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {//alert(data);
                    $('.add_doc').append(data);
                 
                }
            });
        } else if (name == '') {
            alert("Select Financial Reference No");
            
            $("#financial-" + serial_id + "-fs-ref-no").focus();
        }else if (stage == '') {
            alert("Select Sanction Amount");
            $("#financial-" + serial_id + "-sanctioned-amount").focus();
        }else if (file == '' || file1 == '') {
            alert("Select Document");
            $("#financial-" + serial_id + "-sanctioned-file-upload").focus();
        }else if (date == '') {
            alert("Enter sanctioned date");
            $("#financial-" + serial_id + "-sanctioned-date").focus();
        }

    }

    $("#FormID").validate({
        rules: {
            'financial[0][fs_ref_no]': {
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
            'financial[0][fs_ref_no]': {
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
			
			var admin_sanction      = <?php echo $administrativesanction['sanctioned_amount'];  ?>;
			var financial_sanction  = $('.amount').val();
			
			// alert(admin_sanction);
			// alert(financial_sanction);
			
			if(parseFloat(financial_sanction) <= parseFloat(admin_sanction)){	
			
            form.submit();
            $(".btn").prop('disabled', true);
			
			}else{
			 alert('Financial Sanction should be less than or equal to  Administrative Sanction');
			 return false;
				
			}
        }
    });
</script>
