<style>
    .area {
        resize: none;
    }

    .control-label {
        font-size: 13px !important;
    }
</style>
<div class="col-md-12">
    <?php echo $this->Form->create($projectwiseTimeExtensionDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Time Extension Detail</header>
        </div>
        <div class="form-group" style="padding-top: 10px">
            <div class="offset-md-1 col-md-2">
                <button type="button" class='btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>
            </div>
        </div>
        <div id="project" style="display:none;">
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Extension of time recommended
                                    by the Asst.Exe.Engineer <span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('extension_date_of_ee', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date',  'required']); ?>
                                </div>
                                <label class="control-label col-md-3">Whether delay is on the part of
                                    the contractor,if so action taken for
                                    imposing fine as per penal clauses of agreement</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('delay_part_of_contractor', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">period of delay if any by the Department such as in supply
                                    of materials</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('delay_due_to_department', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                                <label class="control-label col-md-3">period of delay if any due to revision of plan
                                    and carrying out additional items of work by value of
                                    contractor (Details and value of additional items to be
                                    furnished)</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('delay_for_revision_plan', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">period of delay if any due to nature rain,flood etc</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('delay_due_to_rain', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                                <label class="control-label col-md-3">Due to shortage of sand</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('delay_due_to_shortage_sand', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Conduct of the contractor regarding quality of work
                                    and Responsiveness to Department
                                    Instructions</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('contractor_quality_of_work', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                                <label class="control-label col-md-3">Special remarks if any
                                    (to be filled by the Executive Engineer
                                    in his own Writing)</label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('remarks_of_ee', ['class' => 'form-control area', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">whether anyNotice has been issued to the
                                    contractor for delay in his part <span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('any_notice_issued_by_contractor', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $NoticeIssue, 'onchange' => 'notice(this.value)', 'label' => false, 'error' => false, 'empty' => '-Select-', 'required']); ?>
                                </div>
                                <label class="control-label col-md-3 projectlist" style="display:none;">File Upload <span class="required"> * </span></label>
                                <div class="col-md-3 projectlist" style="display:none;">
                                    <?php echo $this->Form->control('notice_file_upload', ['class' => 'form-control ', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)', 'id' => 'project']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">whether any fine was imposed for the delay <span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('any_fine_imposed_for_delay', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $NoticeIssue, 'label' => false, 'error' => false, 'empty' => '-Select-', 'required']); ?>
                                </div>
                            </div>
                        </div>

                        <center>
                            <table id="answerTable" class="table  table-bordered  order-column fileopen1" style="max-width: 40%;margin-left: 5%;margin-top:1%;">
                                <thead>
                                    <tr align="center">
                                        <th style="width:25%">File Upload</th>
                                        <th style="width:10%"> <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                                More</button></th>
                                    </tr>
                                </thead>
                                <tbody class="add_doc">

                                    <tr class="photo_upload">
                                        <td>
                                            <?php echo $this->Form->control('monitoring.0.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs1(this)']); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                    </fieldset>


						<div class="form-group text-center" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="col-md-12">
                            <?php if ($projectwiseTimeExtensionDetailcount == 0) { ?>
                                <button type="submit" class="btn btn-info m-r-20">Forward to SE</button>
                            <?php  } else if ($projectwiseTimeExtensionDetailcount == 1 && $last_Time_extention['is_approved'] == 1) { ?>
                                <button type="submit" class="btn btn-info m-r-20">Forward to CE</button>
                            <?php  } else if ($projectwiseTimeExtensionDetailcount >= 2 && $last_Time_extention['is_approved'] == 1) { ?>
                                <button type="submit" class="btn btn-info m-r-20">Forward to CMD</button>
                            <?php } ?>
                            <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->End(); ?>
</div><br>
<?php if ($projectwiseTimeExtensionDetailcount > 0) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="card-body">
                    <h4 class="sub-tile">Time Extension Detail list</h4>
                    <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details List</legend-->
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
                        <div class="table-scrollable">
                            <table class="table table-bordered order-column" style="width: 98%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="1%"> Sno </th>
                                        <th width="10%">Extention Date</th>
                                        <th width="10%">Status</th>
                                        <th width="5%">Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sno = 1;
                                    foreach ($projectwiseTimeExtensionDetailists as $projectwiseTimeExtensionDetailist) : ?>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo ($sno); ?></td>
                                            <td class="title"><?php echo date('d-m-Y', strtotime($projectwiseTimeExtensionDetailist['extension_date_of_ee'])); ?></td>
                                            <td class="title"><?php if ($projectwiseTimeExtensionDetailist['is_approved'] == 0) {
                                                                    echo "Forward to " . $curr_role[$projectwiseTimeExtensionDetailist['approval_role']];
                                                                } else {
                                                                    echo "Approved";
                                                                } ?></td>
                                            <td class="text-center">
                                                <span style="overflow: visible; position: relative; width: 177px;">
                                                    <?php if ($projectwiseTimeExtensionDetailist['is_approved'] == 0) {   ?>
                                                        <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $pid, $work_id, $projectwiseTimeExtensionDetailist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>&nbsp;&nbsp;&nbsp;
                                                    <?php  } ?>
                                                    <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['action' => 'view', $pid, $work_id, $projectwiseTimeExtensionDetailist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php $sno++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div id="modal-add-unsent1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-6">
    <div class="modal-dialog" style="max-width:25%;">
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
    $('.datepicker1').flatpickr({
        minDate: "today",
        dateFormat: "d-m-Y",
        allowInput: false
    });


    $("#FormID").validate({
        rules: {
            'extension_date_of_ee': {
                required: true
            },
            'any_notice_issued_by_contractor': {
                required: true
            },
            'any_fine_imposed_for_delay': {
                required: true
            },
            'notice_file_upload': {
                required: true
            }
        },

        messages: {
            'extension_date_of_ee': {
                required: "Select Date"
            },
            'any_notice_issued_by_contractor': {
                required: "Select"
            },
            'any_fine_imposed_for_delay': {
                required: "Select"
            },
            'notice_file_upload': {
                required: "Select Document"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function validdocs(oInput) {
        var _validFileExtensions = [".jpg", ".png", ".jpeg", ".pdf"];
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

    function notice(num_id) {
        // alert(num_id);
        var a = num_id;
        if (a == 1) {
            $('.projectlist').show();
        } else {
            $('.projectlist').hide();
            $('#notice-file-upload').val('');
        }

    }

    function toggledetail() {
        // alert('hii');
        $('#project').toggle();

    }


    $(document).ready(function() {

        var ProjectID = <?php echo $pid;  ?>;
        var ProjectSubID = <?php echo $work_id;  ?>;
        if (ProjectID != '' && ProjectSubID != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID + '/' + ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                    $('#project').html(data);
                }
            });
        }
    });


    function getaddempdoc() {
                var j = ($('.photo_upload').length);
                //alert(j);

                if (j != '') {
                    $.ajax({
                        async: true,
                        dataType: "html",
                        url: '<?php echo $this->Url->webroot ?>/ProjectwiseTimeExtensionDetails/ajaxtime/' + j,

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


    function validdocs1(oInput) {
        var _validFileExtensions = [".jpg", ".png", ".jpeg", ".pdf"];
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
</script>
