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
        <?php echo $this->Html->link(__('Detailed<br>Estimate'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
	<?php if($work_type == 1){  ?>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Financial<br>Sanctions'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
	<?php } ?>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Technical<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'technicalsanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
        <a class="nav-link active">Tender<br>Details</a>
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
<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Project Tender Details</header>
        </div>

        <div id="addpage">
            <div class="card-body">
                <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend-->
                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
                    <div class="form-body row addpagess">
                        <div class="col-md-12 tender">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Tender type <span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('tender_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false,  'error' => false, 'empty' => 'Select Tender Type',  'options' => $tender_type, 'required', 'onchange' => 'load_details(this.value)']); ?>
                                </div>
                                <label class="control-label col-md-3 etender" <?php  if($projectTenderDetail['tender_type_id'] != 1){  ?>style="display:none;" <?php } ?>>E-tender ID<span class="required"> * </span></label>
                                <div class="col-md-3 etender" <?php  if($projectTenderDetail['tender_type_id'] != 1){  ?> style="display:none;" <?php } ?>>
                                    <?php echo $this->Form->control('etenderID', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'placeholder' => 'Enter E-Tender ID', 'label' => false,   'error' => false, 'type' => 'text']); ?>
                                </div>
                                <label class="control-label col-md-3 boxtender" <?php  if($projectTenderDetail['tender_type_id'] != 2){  ?> style="display:none;" <?php } ?>>tender No<span class="required"> * </span></label>
                                <div class="col-md-3 boxtender"<?php  if($projectTenderDetail['tender_type_id'] != 2){  ?> style="display:none;" <?php } ?>>
                                    <?php echo $this->Form->control('tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'Enter tender No', 'error' => false, 'type' => 'text']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Tender Date<span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('tender_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>($projectTenderDetail['tender_date'])?date('d-m-Y',strtotime($projectTenderDetail['tender_date'])):'']); ?>
                                </div>
                                <label class="control-label col-md-3">Tender Copy <span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                  <?php if ($projectTenderDetail['tender_copy'] != '') { ?>

									 <?php echo $this->Form->control('tender_copy1', ['type' => 'hidden', 'label' => false, 'value' => $projectTenderDetail['tender_copy']]); ?>
									 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/'.$projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
											 <ion-icon name="document-text-outline"></ion-icon>View
										 </span></a>
									  <?php  } ?>
							   </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Estimate Amount put to Tender <br>(in Rs.)<span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required', 'value' => $technical['amount'],'readonly']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="form-group" style="padding-top: 20px;">
            <div class="offset-md-5 col-md-10">
                <button type="submit" class="btn btn-info m-r-20">Save & Continue</button>
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
            'tender_type_id': {
                required: true
            },
            'tender_no': {
                required: true
            },
            'tender_date': {
                required: true
            },
            'tender_copy': {
                <?php if ($projectTenderDetail['tender_copy'] != '') {   ?>
                     required: false
                 <?php } else {   ?>
                     required: true
                 <?php } ?>
            },
            'tender_amount': {
                required: true
            },
            'etenderID': {
                required: true
            }
        },

        messages: {
            'tender_type_id': {
                required: "Select Tender Type"
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
            },
            'etenderID': {
                required: "Enter E-Tender ID"
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
    

    function load_details(id) {
        if (id == 1) {

            $(".etender").show();
            $(".boxtender").hide();
        } else if (id == 2) {
            $(".boxtender").show();
            $(".etender").hide();
        }


    }
</script>