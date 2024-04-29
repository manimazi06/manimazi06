<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
		<div class="card-body">
				 <h4 class = "sub-tile"><?php echo $projectwork['project_name']; ?></h4>
		
        </div>
        </div>
    </div>
</div><br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'basicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
        </li>
        <li class="nav-item">
            <a class="nav-link active">Administrative <br>Sanction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Detailed<br>Estimate</a>
        </li>
        <?php  if($oldProjectWorkDetail['skip_fs_flag'] == 0){ ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Financial<br>Sanction</a>
        </li>
		<?php } ?>
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
    <div id="tabs">
        
        <div id="tabs-2">
            <?php echo $this->Form->create($projectAdministrative_Sanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-body row">
                                <h4 class="sub-tile">Administrative Sanction Details</h4>
                                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:3%">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">GO No <span class="required">* </span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('go_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea','rows'=>2, 'value' => ($projectAdministrativeSanction['go_no'])?$projectAdministrativeSanction['go_no']:$oldProjectWorkDetail['go_no']]); ?>

                                            </div>
                                            <label class="control-label col-md-2">GO Date<span class="required">* </span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('go_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'value' => ($projectAdministrativeSanction['go_date'] != '')?date('d-m-Y', strtotime($projectAdministrativeSanction['go_date'])):(($oldProjectWorkDetail['go_date'])?date('d-m-Y', strtotime($oldProjectWorkDetail['go_date'])):'')]); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">Supervision Charges<span class="required">*
                                                </span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('supervision_charge_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $supervision_charges, 'label' => false, 'error' => true, 'empty' => 'Select', 'value' => $projectAdministrativeSanction['supervision_charge_id']]) ?>
                                            </div>
                                            <label class="control-label col-md-2">Fund Source <span class="required">* </span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('fund_source_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $fund_sources, 'label' => false, 'error' => true, 'empty' => 'Select', 'value' => $projectAdministrativeSanction['fund_source_id']]) ?>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">Sanctioned Amount<span class="required">*
                                                </span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false,'min'=>1,'maxlength'=>15, 'error' => false, 'type' => 'text', 'required', 'value' => ($projectAdministrativeSanction['sanctioned_amount'] != '')?$projectAdministrativeSanction['sanctioned_amount']:$oldProjectWorkDetail['fs_value']]); ?>
                                            </div>
                                            <label class="control-label col-md-2">GO Upload <span class="required">* <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)</span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('go_file_upload', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                                <?php if ($projectAdministrativeSanction['go_file_upload'] != '') {  ?>
                                                    <?php echo $this->Form->control('go_file_upload1', ['type' => 'hidden', 'value' => $projectAdministrativeSanction['go_file_upload']]); ?>

                                                    <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $projectAdministrativeSanction['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                            <ion-icon name="document-text-outline"></ion-icon>View
                                                        </span></a>
                                                <?php  } ?>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">Total Units<span class="required">*
                                                </span></label>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('total_units', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'value' => ($totalunit)?$totalunit:'1']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group" style="padding-top: 10px;">
                                <div class="offset-md-5 col-md-10">
                                    <button type="submit" class="btn btn-info m-r-20">Save & Continue</button>
                                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->End(); ?>
            </div>
        </div>
    </div>
<script>
    $("#FormID").validate({
        rules: {
            'go_no': {
                required: true
            },
            'go_date': {
                required: true
            },
            'supervision_charge_id': {
                required: true
            },
            'fund_source_id': {
                required: true
            },
            'sanctioned_amount': {
                required: true
            },
            'go_file_upload': {
                <?php if ($projectAdministrativeSanction['go_file_upload'] != '') { ?>
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
            'supervision_charge_id': {
                required: "Select Supervision Charge"
            },
            'fund_source_id': {
                required: "Select Fund Source"
            },            
            'sanctioned_amount': {
                required: "Select Sanctioned Amount"
            },
            'go_file_upload': {
                required: "Select File upload"
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
