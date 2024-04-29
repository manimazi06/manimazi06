  <?php echo $this->Form->create($planningPermissionDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
  <div class="row">
      <div class="col-sm-12">
          <div class="card card-topline-aqua">

              <div class="card-box">
                  <div class="card-head">
                      <header>Add Planning Permission Detail</header>
                  </div>
                  <div class="form-group" style="padding-top: 10px">
                      <div class="offset-md-1 col-md-2">
                          <button type="button" class='btn btn-outline-primary btn-sm' onclick='toggledetail()'><i
                                  class="fa fa-eye"></i>View Project Details</button>
                      </div>
                  </div>
                  <div id="project" style="display:none;"> </div>
                  <div class="card-body">
                      <!--legend class="bol" style="color: #0047AB; text-align: center;">Planning Permission Details
                      </legend-->
					  <h4 class="sub-tile">Planning Permission Details</h4>
                      <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">
                          <?php if ($Planningcount == 0) { ?>
                          <div class="form-body row">
                              <div class="col-md-12">
                                  <div class="form-group row">
                                      <label class="control-label col-md-2">Send Date<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4">
                                          <?php echo $this->Form->control('send_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required']); ?>
                                      </div>
                                      <label class="control-label col-md-2">Project Approved <span class="required"> *
                                          </span></label>
                                      <div class="col-md-4">
                                          <?php echo $this->Form->control('is_permission_apporved', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'],'empty' => 'select status', 'options' => $apporved, 'label' => false, 'error' => false, 'required', 'onchange' => 'apporvedtype(this.value)']); ?>
                                      </div>
                                  </div>
                                  <div class="form-group row approved"  style="display:none;">
                                      <label class="control-label col-md-2">Approved
                                          Date<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4" >
                                          <?php echo $this->Form->control('approved_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required','id'=>'approveddate']); ?>
                                      </div>
                                      <label class="control-label col-md-2" >File
                                          Upload<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4" >
                                          <?php echo $this->Form->control('permission_apporved_copy', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','id'=>'approvedfile']); ?>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="control-label col-md-2 remarks" style="display:none;">Remarks<span
                                              class=" required"> *
                                          </span></label>
                                      <div class="col-md-4 remarks" style="display:none;">
                                          <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks', 'type' => 'textarea', 'required', 'rows' => '3','id'=>'remarks']); ?>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <?php }elseif($Planningcount > 0) {?>
                          <div class="form-body row">
                              <div class="col-md-12">
                                  <div class="form-group row">
                                      <label class="control-label col-md-2">Send Date<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4">
                                          <?php echo $this->Form->control('send_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required', 'value' => $planingdetail['send_date']?date('d-m-Y', strtotime($planingdetail['send_date'])):'']); ?>
                                          <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $planingdetail->id]); ?>
                                      </div>
                                      <label class="control-label col-md-2">Project Approved <span class="required"> *
                                          </span></label>
                                      <div class="col-md-4">
                                          <?php echo $this->Form->control('is_permission_apporved', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'],'empty' => 'select status', 'options' => $apporved, 'label' => false, 'error' => false, 'required', 'onchange' => 'apporvedtype(this.value)','value'=>$planingdetail['is_permission_approved']]); ?>
                                      </div>

                                  </div>
								  <div class="form-group row approved" <?php if($planingdetail['is_permission_approved']!=1){ ?> style="display:none;" <?php } ?>>
                                      <label class="control-label col-md-2">Approved
                                          Date<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4" >
                                          <?php echo $this->Form->control('approved_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required','id'=>'approveddate' ,'value' => ($planingdetail['approved_date'])?date('d-m-Y', strtotime($planingdetail['approved_date'])):'']); ?>
                                      </div>
                                      <label class="control-label col-md-2" >File
                                          Upload<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4" >
										<?php echo $this->Form->control('permission_apporved_copy', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','id'=>'approvedfile']); ?>
                                          <?php if ($planingdetail['permission_apporved_copy'] != '') { ?>
                                          <?php echo $this->Form->control('permission_apporved_copy1', ['type' => 'hidden', 'label' => false, 'value' => $planingdetail['permission_apporved_copy']]); ?>
                                          <a style="color:blue;"
                                              href="<?php echo $this->Url->build('/uploads/PlanningPermissions/' . $planingdetail['permission_apporved_copy'], ['fullBase' => true]); ?>"
                                              target="_blank"><span>
                                                  <ion-icon name="document-text-outline"></ion-icon>View
                                              </span></a>
                                          <?php  } ?>                                      </div>
                                  </div>                          
                                  <div class="form-group row">
                                      <label class="control-label col-md-2 remarks" <?php if($planingdetail['is_permission_approved']!=2){ ?> style="display: none;" <?php } ?>>Remarks<span class=" required"> *
                                          </span></label>
                                      <div class="col-md-4 remarks"<?php if($planingdetail['is_permission_approved']!=2){ ?> style="display: none;" <?php } ?>>
                                          <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Remarks', 'type' => 'textarea', 'required', 'rows' => '3','id'=>'remarks', 'value' => $planingdetail['remarks']]); ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <?php }?>
                      </fieldset>

                  </div>
                  <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                      <div class="offset-md-6 col-md-6">
                          <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                          <button type="button"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default"
                              onclick="javascript:history.back()">Cancel</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php echo $this->Form->End(); ?>
  <script>
function apporvedtype(id) {
    // alert(id)
    if (id == 1) {
        $('.approved').show();       
        $('.remarks').hide();
        $('#remarks').val('');
    } else if (id = 2) {
        $('.remarks').show();
        $('.approved').hide();       
        $('#approveddate').val('');
        $('#approvedfile').val('');
    }


}

$('.datepicker1').flatpickr({
    dateFormat: "d-m-Y",
    allowInput: false
});

		 jQuery.validator.addMethod("greaterThan", 
			function(value, element, params) {

				if (!/Invalid|NaN/.test(new Date(value))) {
					return new Date(value) >= new Date($(params).val());
				}

				return isNaN(value) && isNaN($(params).val()) 
					|| (Number(value) >= Number($(params).val())); 
			},'Must be greater than {0}.');

$("#FormID").validate({
    rules: {
        'send_date': {
            required: true
        },
        'approved_date': {
            required: true,
			 greaterThan: "#send-date"
        },
        'permission_apporved_copy': {
            <?php if ($planingdetail->permission_apporved_copy != '') {   ?>
            required: false
            <?php } else {   ?>
            required: true
            <?php } ?>
        },
        'remarks': {
            required: true
        }

    },

    messages: {
        'send_date': {
            required: "Select Date"
        },
        'approved_date': {
            required: "Select Date",
			greaterThan: "should be greater than Send Date"
        },
        'permission_apporved_copy': {
            required: "Select Document"
        },
        'remarks': {
            required: "Enter Remarks"
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

function toggledetail() {
    $('#project').toggle();

}

$(document).ready(function() {
    var ProjectID = <?php echo $id;  ?>;
    var ProjectSubID = <?php echo $work_id;  ?>;
    if (ProjectID != '' && ProjectSubID != '') {
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectfulldetails/' +
                ProjectID + '/' + ProjectSubID,
            success: function(data, textStatus) { //alert(data);
                $('#project').html(data);
            }
        });
    }
});
  </script>