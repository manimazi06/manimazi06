 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>


 <?php echo $this->Form->create($projectMonitoringDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Add Project Monitoring</header>
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
			
			  <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:3%;padding:15px;margin-left:5px;margin-bottom:3%">

                <div class="form-body row">
               
                    <div class="col-md-12">
                        <?php if ($monitoringDetailscount == 0) { ?>
                            <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
                                        <thead>
                                            <tr align="center">
                                                <th style="width:5%"> S.No</th>
                                                <th style="width:20%">Monitoring Date</th>
                                                <th style="width:20%">Work Stage</th>
                                                <th style="width:20%">File Upload</th>
                                                <th style="width:20%">Amount</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
                                            <tr class="present_row">
                                                <td class="trcount">1</td>
                                                <td>
                                                    <?php echo $this->Form->control('monitoring.0.monitoring_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Monitoring Date','required']) ?>
                                                    <?php echo $this->Form->control('monitoring.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']) ?>

                                                </td>
                                                <td><?php echo $this->Form->control('monitoring.0.work_stage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work','required']) ?>
                                                </td>
                                                <td><?php echo $this->Form->control('monitoring.0.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','required']); ?>
                                                </td>
                                                <td><?php echo $this->Form->control('monitoring.0.amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required']) ?>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>                             
                            </div>
                        <?php } elseif ($monitoringDetailscount > 0) { ?>
                            <div class="form-group">
                                <fieldset>                                    
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
                                        <thead>
                                            <tr align="center">
                                                <th  style="width:1%"> S.No</th>
                                                <th style="width:20%">Monitoring Date</th>
                                                <th style="width:20%">Work Stage</th>
                                                <th style="width:25%">File Upload</th>
                                                <th style="width:20%">Amount</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
                                            <?php
                                            $i = 0;
                                            foreach ($monitoringDetails as $key => $monitoringDetail) : ?>
                                                <tr class="present_row">
                                                    <td><?php echo $i + 1; ?></td>
                                                    <td>
                                                        <?php echo $this->Form->control('monitoring.' . $key . '.monitoring_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Monitoring Date','required' ,'value' => date('d-m-Y', strtotime($monitoringDetail->monitoring_date))]) ?>
                                                        <?php echo $this->Form->control('monitoring.' . $key . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $monitoringDetail->id]) ?>
                                                    </td>
                                                    <td><?php echo $this->Form->control('monitoring.' . $key . '.work_stage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work','required' , 'value' => $monitoringDetail->work_stage_id]) ?>
                                                    </td>
                                                    <td><?php echo $this->Form->control('monitoring.' . $key . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','value' => $monitoringDetail->photo_upload]); ?>
                                                    <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload1', ['type' => 'hidden','label' => false, 'value' => $monitoringDetail->photo_upload]); ?>
                                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/Projectmonitoring/' .$monitoringDetail['photo_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                <ion-icon name="document-text-outline"></ion-icon>View
                                                            </span></a>
                                                    </td>
                                                    <td><?php echo $this->Form->control('monitoring.' . $key . '.amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount', 'required' ,'value' => $monitoringDetail->amount]) ?>
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
                       
                    </div>

                   
                </div>
				 <div align="right">
				   <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
							More</button>
				 </div>
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
 <?php echo $this->Form->End(); ?>
<script>
    function validdocs(oInput) {
        var _validFileExtensions = [".jpg", ".png", ".jpeg"];
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
        var serial_id =  ($('.present_row').length - 1);;
        var name  = $("#monitoring-" + serial_id + "-monitoring-date").val();
        var stage = $("#monitoring-" + serial_id + "-work-stage-id").val();
        var file  = $("#monitoring-" + serial_id + "-photo-upload").val();
        var file1 = $("#monitoring-" + serial_id + "-photo-upload1").val();
        var cost  = $("#monitoring-" + serial_id + "-amount").val();  
        if (name != '' &&  stage != '' && (file != '' || file1 != '') && cost != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxmonitor/' +j,

                 beforeSend: function(xhr) {
                   xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                 },
				//cache: false,
                success: function(data, textStatus) { //alert(textStatus);
                    $('.add_doc').append(data);
                  
                }
            });
        } else if (name == '') {
            alert("Select Monitoring Date");            
            $("#monitoring-" + serial_id + "-monitoring-date").focus();
        }else if (stage == '') {
            alert("Select work stage");
            $("#monitoring-" + serial_id + "-work-stage-id").focus();
        }else if (file == '' || file1 == '') {
            alert("Select Document");
            $("#monitoring-" + serial_id + "-photo-upload").focus();
        }else if (cost == '') {
           // Swal.fire("", "Enter Amount", "warning");
            alert("Enter Amount");
            $("#monitoring-" + serial_id + "-amount").focus();
        }

    }

    $("#FormID").validate({
        rules: {
            'monitoring[0][monitoring_date]': {
                required: true
            },
            'monitoring[0][work_stage_id]': {
                required: true
            },
            'monitoring[0][photo_upload]': {
			  <?php if($monitoringDetails[0]->photo_upload != '' ){ ?>
                required: false   
			  <?php }else{ ?>	
                required: true 
              <?php  } ?>				
            },
            'monitoring[0][amount]': {
                required: true
            }
        },

        messages: {
            'monitoring[0][monitoring_date]': {
                required: "select Monitoring Date"
            },
            'monitoring[0][work_stage_id]': {
                required: "select work stage"
            },
            'monitoring[0][photo_upload]': {
                required: "Select Document"
            },
            'monitoring[0][amount]': {
                required: "Enter Amount"
            }
        },
        submitHandler: function(form) {
           
            $(".btn").prop('disabled', true);
			 form.submit();
        }
    });
</script>
<style>
    legend {
        background-color: #fff;
        color: white;
    }
</style>