<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>

<?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Project Monitoring Edit</header>
        </div>
         <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 


        <div class="card-body">
		 <h4 class = "sub-tile">Project Monitoring Details</h4>
                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
            </legend>
            <div class="col-md-12">
                <div class="form-body row">
                    <?php if ($monitoringDetailscount == 0) { ?>
                        <div class="form-group">
                            <fieldset>                              
								<div class="col-md-12" style="margin-top:">						 
									<div class="form-group row">
									  <label class="control-label col-md-2 bol">Monitoring Date <span class="required">* </span></label>
										<div class="col-md-4">
												<?php echo $this->Form->control('monitoring_date', ['id' => 'monitoring_date', 'class' => 'form-control datepicker', 'onblur' => 'calling(this.value)', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Monitoring date', 'required']) ?>
															
									   </div>
									   <!--label class="control-label col-md-2 bol">Work Stage <span class="required">* </span></label>
										<div class="col-md-4">
												<?php echo $this->Form->control('work_stage_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work', 'required']) ?>
															
									   </div-->								   
									   
									   <label class="control-label col-md-2 bol">Work Stage <span class="required">* </span></label>
										<div class="col-md-4">
									    	<?php echo $this->Form->control('description',  ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' =>'textarea','rows'=>3, 'placeholder' => 'Work Stage', 'required']) ?>
									   </div>						   
									   
									  </div>
									 
									<div class="form-group row">
									  <label class="control-label col-md-2 bol">Physical Percentage<span class="required">*  </span></label>
										<div class="col-md-4">
										<?php echo $this->Form->control('work_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $percentage, 'empty' => 'Select Percentage', 'required']) ?>

											</div>
									  <label class="control-label col-md-2 bol">Financial Percentage<span class="required">*  </span></label>
										<div class="col-md-4">
												<?php echo $this->Form->control('financial_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $financialpercentage, 'empty' => 'Select Percentage', 'required']) ?>


										</div>								
									</div>
									<div class="form-group row">
									  <label class="control-label col-md-2 bol">Photo Upload<span class="required">*  <br>(upload .jpg,.jpeg,.png) <br> (Maximum 5mb only)</span></label>
										<div class="col-md-4">
											<?php echo $this->Form->control('photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
										</div>															
									 </div>
																	
								 </div><br>
            
													
                                <!--center>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 40%;margin-left: 5%;">
                                        <thead>
                                            <tr align="center">
                                                <th style="width:5%;">S.No</th>
                                                <th style="width:25%">Photo Upload</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">

                                            <tr class="present_row">
                                                <td style="width:5%;">1.</td>
                                                <td><?php echo $this->Form->control('monitoring.0.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                                        More</button>

                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </center-->
                            </fieldset>

                        </div>
                    <?php   } elseif ($monitoringDetailscount > 0) {  ?>
                        <div class="form-group">
                            <fieldset>

                              
								<div class="col-md-12" style="margin-top:">						 
									<div class="form-group row">
									  <label class="control-label col-md-2 bol">Monitoring Date <span class="required">* </span></label>
										<div class="col-md-4">
												<?php echo $this->Form->control('monitoring_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Monitoring Date', 'required', 'value' => date('d-m-Y', strtotime($monitoring->monitoring_date))]) ?>
                                                <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $monitoring->id]) ?>
                                        															
									   </div>
									   <label class="control-label col-md-2 bol">Work Stage <span class="required">* </span></label>
										<div class="col-md-4">
											 <?php echo $this->Form->control('work_stage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work', 'required', 'value' => $monitoring->work_stage_id]) ?>
															
									   </div>
									   
									   
									  </div>
									 
									<div class="form-group row">
									  <label class="control-label col-md-2 bol">Physical Percentage<span class="required">*  </span></label>
										<div class="col-md-4">
											<?php echo $this->Form->control('work_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'options' => $percentage, 'error' => false, 'placeholder' => 'Enter Amount', 'required', 'value' => $monitoring->work_percentage_id]) ?>

											</div>
									  <label class="control-label col-md-2 bol">Financial Percentage<span class="required">*  </span></label>
										<div class="col-md-4">
											<?php echo $this->Form->control('financial_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'options' => $financialpercentage, 'error' => false, 'placeholder' => 'Enter Amount', 'required', 'value' => $monitoring->financial_percentage_id]) ?>
										</div>								
									</div>
														
								 </div><br>
                                <div align="right" style="margin-right:100px;"><button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                        More</button></div><br>
                                <center>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 40%;margin-left: 2%;">

                                        <thead>
                                            <tr align="center">
                                                <th style="width:25%">Photo Upload</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
                                            <?php $i = 0;
                                            foreach ($photo_uploads as $key => $photo_upload) : ?>
                                                <tr class="present_row">
                                                    <td>
                                                        <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)']); ?>
                                                        <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload1', ['type' => 'hidden', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => $photo_upload['file_upload']]); ?>
                                                        <?php echo $this->Form->control('monitoring.' . $key . '.id', ['type' => 'hidden', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => $photo_upload['id']]); ?>
                                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/Projectmonitoring/' . $photo_upload['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                <ion-icon name="document-text-outline"></ion-icon>View

                                                            </span></a>
                                                    </td>
                                                    <td align="center">

                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </center>
                            </fieldset>

                        </div>
                    <?php } ?>

                </div>
            </div>

            </fieldset>

            </fieldset>
            <div class="form-group" style="padding-top: 10px">
                <div class="offset-md-4 col-md-5">
                    <button type="submit" class="btn btn-info m-r-20">Submit</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
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
            var serial_id = ($('.present_row').length - 1);;
            var name = $("#monitoring-" + serial_id + "-monitoring-date").val();
            var stage = $("#monitoring-" + serial_id + "-work-stage-id").val();
            var file = $("#monitoring-" + serial_id + "-photo-upload").val();
            var file1 = $("#monitoring-" + serial_id + "-photo-upload1").val();
            var cost = $("#monitoring-" + serial_id + "-work_percentage_id").val();
            if (name != '' && stage != '' && (file != '' || file1 != '') && cost != '') {
                $.ajax({
                    async: true,
                    dataType: "html",
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxmonitor/' + j,

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
            } else if (stage == '') {
                alert("Select work stage");
                $("#monitoring-" + serial_id + "-work-stage-id").focus();
            } else if (file == '' || file1 == '') {
                alert("Select photo");
                $("#monitoring-" + serial_id + "-photo-upload").focus();
            } else if (cost == '') {
                // Swal.fire("", "Enter work_percentage_id", "warning");
                alert("Enter work_percentage_id");
                $("#monitoring-" + serial_id + "-work_percentage_id").focus();
            }

        }

        $("#FormID").validate({
            rules: {
                'monitoring_date': {
                    required: true
                },
                'work_stage_id': {
                    required: true
                },
                'monitoring[0][photo_upload]': {
                    <?php if ($photo_upload > 0) {  ?>
                        required: false
                    <?php } else { ?>
                        required: true
                    <?php  } ?>
                },
                'work_percentage_id': {
                    required: true
                }
            },

            messages: {
                'monitoring_date': {
                    required: "select Monitoring Date"
                },
                'work_stage_id': {
                    required: "select work stage"
                },
                'photo_upload': {
                    required: "Select photo"
                },
                'work_percentage_id': {
                    required: "Select Percentage"
                }
            },
            submitHandler: function(form) {

                $(".btn").prop('disabled', true);
                form.submit();
            }
        });
		
		
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
   