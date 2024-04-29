<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>
<ul class="nav nav-tabs">
    <?php if($work_type == 1){  ?>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'basicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <?php }else{ ?>
	<li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'repairbasicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
	<?php } ?>
	<?php if($work_type == 1){  ?>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Administrative<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'administrativesanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
	<?php } ?>
    <li class="nav-item">
        <a class="nav-link active"  tabindex="-1" aria-disabled="true">Detailed<br>Estimate</a>
	</li>
	<?php if($work_type == 1){  ?>
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
	<?php if($work_type == 1){  ?>

	<li class="nav-item">
		<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planning<br>Clearance</a>
	</li>
	<?php } ?>
	<li class="nav-item">
		<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">SiteHand<br>Over</a>
	</li>
</ul>
<?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-body">
                <div class="form-body row">
                    <div class="col-md-12 addpage">
                        <h4 class="sub-tile">Detailed Estimate :</h4>
                        <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
                            <div class="col-md-12" style="margin-top:">
                                <div class="form-group row">
                                    <label class="control-label col-md-4 bol">Detailed Estimate Upload<span class="required">* <br>(xls,xlsx Format only)&nbsp;&nbsp;(Maximum 8MB Only) </span></label>
                                    <div class="col-md-5">
                                        <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'onchange' => 'validdocs(this)']); ?>

                                        <?php if ($projectWorkSubdetail['detailed_estimate_upload'] != '') {  ?>
                                            <?php echo $this->Form->control('detailed_estimate_upload1', ['type' => 'hidden', 'value' => $projectWorkSubdetail['detailed_estimate_upload']]); ?>
                                              <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/DetailedEstimates/'.$projectWorkSubdetail['detailed_estimate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                    <ion-icon name="document-text-outline"></ion-icon>View
                                                </span></a>
                                        <?php  } ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 bol">Total Estimate Amount (in Rs.)<span class="required">*</span></label>
                                    <div class="col-md-5">
                                        <?php echo $this->Form->control('detailed_estimate_amount', ['class' => 'form-control amount', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'required', 'type' => 'text', 'min' => 1, 'maxlength' => 15, 'value' => ($projectWorkSubdetail['detailed_estimate_amount'])?$projectWorkSubdetail['detailed_estimate_amount']:'']); ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="form-group" style="padding-top: 10px;">
                <div class="offset-md-5 col-md-10">
                    <button type="submit" class="btn btn-success">Save & Continue</button>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
    $("#FormID").validate({
        rules: {
            'detailed_estimate_upload': {
                <?php if ($projectWorkSubdetail['detailed_estimate_upload'] != '') { ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php } ?>
            },
            'detailed_estimate_amount': {
                required: true
            }
        },

        messages: {
            'detailed_estimate_upload': {
                required: "Upload Detailed Estimate"
            },
            'detailed_estimate_amount': {
                required: "Enter Total Estimate Amount"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
    

    function validdocs(oInput) {
        var _validFileExtensions = [".xls", ".xlsx"];
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
            if (file_size >= 8388608) {
                alert("File Maximum size is 8MB");
                oInput.value = "";
                return false;
            }

        }
        return true;
    }
</script>
