 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>

<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Project Tender Details</header>
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
                        <label class="control-label col-md-2 bol bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
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
                        <label class="control-label col-md-2 bol">Project Cost <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower"> 
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
 
                        </div>
                        <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>              
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                        </div>
						<label class="control-label col-md-2 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>
                    </div>                    
                </div>
               </fieldset>	 
		</div>    
		   <div class="card-body">
                <div class="col-md-12">
                     <div class="form-body row">
					  <div align="right">
			           <button type="button" name="add" id="add" class="btn btn-success btn_remove">Add More</button>

				     </div><br>
					

					     <?php if ($tendercount == 0) { ?>
                           <h4 class = "sub-tile">&nbsp;1.Tender Details:</h4>    
					    <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:25px;margin-left:5px;margin-bottom:1%">

                            <div class="col-md-12 tender">
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Tender no <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                    </div>
                                    <label class="control-label col-md-2">Tender Date<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.tender_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Tender Copy <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                    </div>


                                    <label class="control-label col-md-2">Tender Amount<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Contractor Name<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.contractor_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>

                                    </div>

                                    <label class="control-label col-md-2">Contractor Mobile no <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.contractor_mobile_no', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Agreement no <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                    </div>


                                    <label class="control-label col-md-2">Agreement Date<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.agreement_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Agreement Copy <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.0.agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                    </div>


                                </div>
                            </div>
                        </fieldset>
                        <?php } elseif ($tendercount > 0) {                            
                             foreach($tenders as $key => $tender){
                            ?>
                            <!-- edit -->
							<h4 class = "sub-tile">&nbsp;<?php echo $key+1;   ?>.&nbsp;Tender Details :</h4>
							<fieldset  style="border:1px solid #00355F;border-radius:10px;padding:25px;margin-left:5px;margin-bottom:1%">

                            <div class="col-md-12 tender">
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Tender no <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => $tender['tender_no']]); ?>
                                        <?php echo $this->Form->control('tender.'.$key.'.id', [ 'label' => false, 'error' => false, 'type' => 'hidden', 'value' => $tender['id']]); ?>
                                        
                                    </div>
                                    <label class="control-label col-md-2">Tender Date<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.tender_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => date('d-m-Y',strtotime($tender['tender_date']))]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Tender Copy <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)', 'value' => $tender['tender_copy']]); ?>
                                         
										<?php  if($tender['tender_copy'] != ''){   ?>
										<?php echo $this->Form->control('tender.'.$key.'.tender_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $tender['tender_copy']]); ?>
                                                                    
                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/'.$tender['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                <ion-icon name="document-text-outline"></ion-icon>View</span></a>
										<?php } ?>		
                                         
                                    </div>
                                        

                                    <label class="control-label col-md-2">Tender Amount<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'value' => $tender['tender_amount']]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Contractor Name<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.contractor_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => $tender['contractor_name']]); ?>

                                    </div>

                                    <label class="control-label col-md-2">Contractor Mobile no <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.contractor_mobile_no', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => $tender['contractor_mobile_no'], 'required']); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Agreement no <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => $tender['agreement_no']]); ?>
                                    </div>


                                    <label class="control-label col-md-2">Agreement Date<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.agreement_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'value' => date('d-m-Y',strtotime($tender['agreement_date']))]); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Agreement Copy <span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('tender.'.$key.'.agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)', 'value' => $tender['agreement_copy']]); ?>
                                        
										<?php  if($tender['agreement_copy'] != ''){   ?>
										<?php echo $this->Form->control('tender.'.$key.'.agreement_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $tender['agreement_copy']]); ?>
                                
                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/'.$tender['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                <ion-icon name="document-text-outline"></ion-icon>View
                                            </span></a>
										<?php  } ?>
                                    </div>
                                      <br><br>

                                </div>
                            </div>
							</fieldset>
						<?php  } } ?>	
     	   	          
                    </div>
                </div>        
           	   <div class ="form-body row addmore"></div>
			   <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">Submit</button>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
					</div>
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
            'tender[0][tender_no]': {
                required: true
            },
            'tender[0][tender_date]': {
                required: true
            },
            'tender[0][tender_amount]': {
                required: true
            },
            'tender[0][tender_copy]': {
			   <?php if (count($tenders) == 0) { ?>	
                required: true
			   <?php  }else{ ?>
                required: false
			   <?php  } ?>
            },
            'tender[0][contractor_name]': {
                required: true
            },
            'tender[0][contractor_mobile_no]': {
                required: true
            },
            'tender[0][agreement_no]': {
                required: true
            },
            'tender[0][agreement_date]': {
                required: true
            },
            'tender[0][agreement_copy]': {
                <?php if (count($tenders) == 0) { ?>	
                required: true
			   <?php  }else{ ?>
                required: false
			   <?php  } ?>
            }
        },

        messages: {
            'tender[0][tender_no]': {
                required: "Enter Tender No"
            },
            'tender[0][tender_date]': {
                required: "Select Date"
            },
            'tender[0][tender_amount]': {
                required: "Enter Tender Amount"
            },
            'tender[0][tender_copy]': {
                required: "Select Tender Copy"
            },
            'tender[0][contractor_name]': {
                required: "Enter Contractor Name"
            },
            'tender[0][contractor_mobile_no]': {
                required: "Enter Contractor Mobile No"
            },
            'tender[0][agreement_no]': {
                required: "Enter Agreement No."
            },
            'tender[0][agreement_date]': {
                required: "Enter Agreement Date"
            },
            'tender[0][agreement_copy]': {
                required: "Select Agreement Copy"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
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

 
</script>

<script>
    $(document).ready(function() {
      
        $('#add').click(function() {
            var j = $('.tender').length;
            var serial_id = ($('.tender').length - 1);
			
		  var tender_no  = $("#tender-" + serial_id + "-tender-no").val();
	     if(tender_no != ''){
 
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojecttender/' +j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) { //alert(data);  
                    $('.addmore').append(data);
                   
                }
            })
			
		 }else if(tender_no == ''){
			 alert('Enter Tender No');
			 $("#tender-" + serial_id + "-tender-no").focus();
			 
		 }
        })

    });
</script>

<style>


    legend {
        background-color: #fff;
        color: white;
        /* padding: 5px 10px; */
    }


</style>