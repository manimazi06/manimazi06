 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
 
 <?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Project Technical Sanction</header>
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

            <div class="col-md-12">
                <div class="form-body row">
                    <?php if ($technicalcount == 0) { ?>
                        <div class="form-group">
                            <fieldset>
                                
                                <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                    <thead>
                                       <tr align = "center">
                                            <th style="width:5%"> S.No</th>
                                            <th style="width:20%">File Upload</th>
                                            <th style="width:20%">Description</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_doc">
                                        <tr class="present_row">
                                            <td class="trcount">1</td>

                                            <td><?php echo $this->Form->control('technical.0.detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
                                                <?php echo $this->Form->control('technical.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']) ?>
                                            </td>
                                            <td><?php echo $this->Form->control('technical.0.description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'required']) ?>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </fieldset>
                            <!-- <div class="form-group" style="padding-top: 10px">
                                    <div class="offset-md-5 col-md-6">
                                        <button type="submit" class="btn btn-info m-r-20">Submit</button>
                                        <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                                    </div>
                                </div> -->
                        </div>
                    <?php   } elseif ($technicalcount > 0) { ?>
                        <div class="form-group">
                            <fieldset>
                             
                                <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                    <thead>
                                        <tr align = "center">
                                        <th style="width:5%"> S.No</th>
                                            <th style="width:20%">File Upload</th>
                                            <th style="width:20%">Description</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_doc">
                                        <?php
                                        $i = 0;
                                        foreach ($technical as $tech) : ?>
                                            <tr class="present_row">
                                                <td class="trcount"><?php echo $i + 1; ?></td>
                                                <td>
                                                    <?php echo $this->Form->control('technical.' . $i . '.detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'value' => $tech->detailed_estimate_upload]); ?>
                                                    <?php echo $this->Form->control('technical.' . $i . '.detailed_estimate_upload1', ['type' => 'hidden', 'label' => false, 'value' => $tech->detailed_estimate_upload]); ?>
                                                    <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/technicalsanctions/' . $tech['detailed_estimate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                            <ion-icon name="document-text-outline"></ion-icon>View
                                                        </span></a>
                                                    <?php echo $this->Form->control('technical.' . $i . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $tech->id]) ?>
                                                </td>
                                                <td><?php echo $this->Form->control('technical.' . $i . '.description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'required', 'value' => $tech->description]) ?>
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
 <?php echo $this->Form->End(); ?>
<script>
    $("#FormID").validate({
        rules: {
            'technical.0.detailed_estimate_upload': {
                <?php if ($tech->detailed_estimate_upload != '') {   ?>
                    required: false
                <?php } else {   ?>
                    required: true
                <?php } ?>
            },
            'description': {
                required: true
            }
        },

        messages: {
            'technical.0.detailed_estimate_upload': {
                required: " Select File Upload"
            },
            'description': {
                required: "Enter Description"
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

    function getaddempdoc() {
        var j = ($('.present_row').length);
        // alert(j);
        var serial_id = ($('.present_row').length - 1);;
        var file = $("#technical-" + serial_id + "-detailed_estimate_upload").val();
        var file1 = $("#technical-" + serial_id + "-detailed_estimate_upload1").val();
        var cost = $("#technical-" + serial_id + "-description").val();
        if ((file != '' || file1 != '') && cost != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxtechnical/' +
                    j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    // alert(data);
                    $('.add_doc').append(data);
                    //  j++;
                    // $("#serialvalue").val(j);
                }
            });
        } else if (file == '' || file1 == '') {
            // Swal.fire("", "Select Document", "warning");
            alert("Select Document");
            $("#technical-" + serial_id + "-detailed_estimate_upload").focus();
        } else if (cost == '') {
            // Swal.fire("", "Enter Amount", "warning");
            alert("Enter Description");
            $("#technical-" + serial_id + "-description").focus();
        }

    }
</script>

<style>
   

    legend {
        background-color: #fff;
        color: white;
    }
</style>