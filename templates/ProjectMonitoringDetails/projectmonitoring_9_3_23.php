<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>

<?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>


<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Project Monitoring</header>
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
            <div class="col-md-12">
                <div class="form-body row">                  
                    <div class="form-group">                     
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
							 <!--div class="form-group row">
							  <label class="control-label col-md-2 bol">Photo Upload<span class="required">*  <br>(upload .jpg,.jpeg,.png) <br> (Maximum 5mb only)</span></label>
								<div class="col-md-4">
									<?php echo $this->Form->control('photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
								</div>
							 						
							 </div-->
							
                         </div><br>
                            <center>
                                <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 40%;margin-left: 5%;margin-top:1%;">
                                    <thead>
                                        <tr align="center">
                                            <th style="width:25%">Photo Upload</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_doc">

                                        <tr class="photo_upload">
                                            <td>
											<?php echo $this->Form->control('monitoring.0.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
                                            </td>
                                            <td align="center">
                                                <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                                    More</button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </center>
                    </div>     
                </div>
            </div>
                   </fieldset>
            <div class="form-group" style="padding-top: 10px">
                <div class="offset-md-5 col-md-5">
                    <button type="submit" class="btn btn-info m-r-20">Submit</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                </div>
            </div>
          <?php if ($monitoringDetailscount > 0) { ?>
            <div class="card-body">
			<h4 class = "sub-tile">Project Monitoring Details List</h4>
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
                <?php if ($monitorings) { ?>
                    <div class="table-scrollable">
                        <table class="table table-bordered order-column" style="width: 100%" id="example4">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> Sno </th>
                                    <th style="width:10%">Monitoring Date</th>
                                    <th style="width:20%">Work Stage</th>
                                    <th style="width:20%">Physical Percentage</th>     
                                    <th style="width:20%">Financial Percentage</th>
                                    <th style="width:20%">Photos</th>
                                    <!--th>Actions </th-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sno = 1;
                                foreach ($monitorings as $MonitoringDetail) : ?>
                                    <tr class="odd gradeX">
                                        <td class="text-center"><?php echo ($sno); ?></td>
                                        <td><?php echo (date('d-m-Y', strtotime($MonitoringDetail['monitoring_date']))); ?></td>
                                        <!--td><?php echo $MonitoringDetail['work_stage']['name']; ?></td-->
                                        <td><?php echo $MonitoringDetail['description']; ?></td>
                                        <td class="title"> <?php echo $MonitoringDetail['work_percentage']['name']; ?> </td>
                                        <td class="title"> <?php echo $MonitoringDetail['financial_percentage']['name']; ?> </td>
                                		<td class="title">
										    <?php $sno = 1;    foreach ($photo_uploads as $key => $photo_upload){ ?>
                                                <!--a href="javascript:void(0);" onclick="getmonitoringphotos(<?php echo $MonitoringDetail['id'] ?>);">View</a-->
											       <a href="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photo_upload['file_upload'], ['fullBase' => true]); ?>" data-fancybox="gallery" data-caption="photo_<?php echo ($key+1); ?>" >
												   <span <?php if($key != 0){ ?>style="display:none" <?php } ?>>View</span>
												  </a>
												
											<?php  } ?>
                                        </td>  
                                        <!--td class="text-center">
											 <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['controller'=>'ProjectMonitoringDetails','action' => 'projectmonitoringedit', $id, $work_id, $MonitoringDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
                                        </td-->
                                    </tr>
                                <?php $sno++;

                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php  } ?>
                </fieldset>   

            </div>
			  <?php  } ?>
        </div>
        <?php echo $this->Form->End(); ?>
        <div id="modal-add-unsent1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-6">
            <div class="modal-dialog" style="max-width:40%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form add-unsent-form1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    if (file_size >= 5242880) {
                        alert("File Maximum size is 5MB");
                        oInput.value = "";
                        return false;
                    }

                }
                return true;
            }

            function getaddempdoc() {
                var j = ($('.photo_upload').length);
				//alert(j);
           
                if (j != '') {
                    $.ajax({
                        async: true,
                        dataType: "html",
                        url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectMonitoringDetails/ajaxmonitor/'+j,

                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                        },
                        //cache: false,
                        success: function(data, textStatus) { //alert(textStatus);
                            $('.add_doc').append(data);

                        }
                    });
                } else if (j == '') {
                    alert("Select Monitoring Date");
                    $("#monitoring-" + serial_id + "-monitoring-date").focus();
                }

            }

            $("#FormID").validate({
                rules: {
                    'monitoring_date': {
                        required: true
                    },
                    'work_stage_id': {
                        required: false
                    },
                    'work_percentage_id': {
                        required: true
                    },
                    'financial_percentage_id': {
                        required: true
                    },
                    'description': {
                        required: true
                    },
                    'photo_upload': {
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
                    'work_percentage_id': {
                        required: "Select Physical Percentage"
                    },
                    'financial_percentage_id': {
                        required: "Select Financial Percentage"
                    },
                    'description': {
                        required: "Enter Work Stage"
                    },
                    'photo_upload': {
                        required: "Select Photo Upload"
                    }
                },
                submitHandler: function(form) {

                    $(".btn").prop('disabled', true);
                    form.submit();
                }
            });

            function getmonitoringphotos(id) {
                // alert(val);
                $(".add-unsent-form1").html("<span class='text-center'>Fetching data!!!</span>");
                $("#modal-add-unsent1").modal('show');
                $.ajax({
                    async: true,
                    dataType: "html",
                    type: "post",
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectMonitoringDetails/ajaxphotoupload/' + id,
                    success: function(data, textStatus) {
                         //alert(data);
                        $(".add-unsent-form1").html(data);
                    }
                });
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

 