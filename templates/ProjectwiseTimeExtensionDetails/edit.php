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
            <header>Edit Time Extension Detail</header>
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
                                    <?php echo $this->Form->control('extension_date_of_ee1', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date',  'required', 'value' => date('d-m-Y', strtotime($projectwiseTimeExtensionDetail->extension_date_of_ee))]); ?>
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
                                <label class="control-label col-md-3 projectfile" <?php if ($projectwiseTimeExtensionDetail['any_notice_issued_by_contractor'] == 0) { ?> style="display:none;" <?php } ?>>File Upload <span class="required"> * </span></label>
                                <div class="col-md-3 projectfile" <?php if ($projectwiseTimeExtensionDetail['any_notice_issued_by_contractor'] == 0) { ?> style="display:none;" <?php } ?>>
                                    <?php echo $this->Form->control('notice_file_upload', ['class' => 'form-control ', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)', 'id' => 'project']); ?>
                                    <?php if ($projectwiseTimeExtensionDetail['notice_file_upload'] != '') {  ?>
                                        <?php echo $this->Form->control('notice_file_upload1', ['type' => 'hidden', 'value' => $projectwiseTimeExtensionDetail['notice_file_upload']]); ?>
                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectwiseTimeExtension/' . $projectwiseTimeExtensionDetail['notice_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                <ion-icon name="document-text-outline"></ion-icon>View
                                            </span></a>
                                    <?php  } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">whether any fine was imposed for the delay <span class="required"> * </span></label>
                                <div class="col-md-3">
                                    <?php echo $this->Form->control('any_fine_imposed_for_delay', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $NoticeIssue, 'label' => false, 'error' => false, 'empty' => '-Select-', 'required']); ?>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <center>
                                <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 40%;margin-left:5%;margin-top:1%;">
                                    <thead>
                                        <tr align="center">
                                            <th style="width:25%">File Upload</th>
                                            <th style="width:10%"><button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                                    More</button></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_doc">
                                        <?php
                                        $i = 0;
                                        foreach ($projectwiseTimeExtensionFileUploads as $key =>  $projectwiseTimeExtensionFileUpload) { ?>

                                            <tr class="photo_upload <?php echo $key;  ?>">

                                                <td>
                                                    <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs1(this)']); ?>
                                                    <?php echo $this->Form->control('monitoring.' . $key . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $projectwiseTimeExtensionFileUpload['id']]) ?>
                                                    <?php if ($projectwiseTimeExtensionFileUpload['file_upload'] != '') {  ?>
                                                        <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload1', ['type' => 'hidden', 'value' => $projectwiseTimeExtensionFileUpload['file_upload']]); ?>
                                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/Projectimeetenstionfile/' . $projectwiseTimeExtensionFileUpload['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                <ion-icon name="document-text-outline"></ion-icon>View
                                                            </span></a>
                                                    <?php  } ?>
                                                </td>

                                                <td>
                                                </td>
                                            </tr>

                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group text-center" style="padding-top: 10px;margin-bottom: -20px;">
                     <div class="col-md-12">
                        <button type="submit" class="btn btn-info m-r-20">Submit</button>
                        <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php echo $this->Form->End(); ?>
</div>
<?php if ($projectwiseTimeExtensionDetailists > 0) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="card-body">
                    <h4 class="sub-tile">Projectwise Time Extension Detail List</h4>
                    <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details List</legend-->
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
                        <div class="table-scrollable">
                            <table class="table table-bordered order-column" style="width: 98%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="1%"> Sno </th>
                                        <th width="10%">Date</th>
                                        <th width="5%">Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sno = 1;
                                    foreach ($projectwiseTimeExtensionDetailists as $projectwiseTimeExtensionDetailist) : ?>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo ($sno); ?></td>
                                            <td class="title"><?php echo date('d-m-Y', strtotime($projectwiseTimeExtensionDetailist['extension_date_of_ee'])); ?></td>
                                            <td class="text-center">
                                                <span style="overflow: visible; position: relative; width: 177px;">
                                                    <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $pid, $work_id, $projectwiseTimeExtensionDetailist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
                                                    <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['action' => 'view', $pid, $work_id, $projectwiseTimeExtensionDetailist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
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
                required: false
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
        //  alert(num_id);
        var a = num_id;
        if (a == 1) {
            $('.projectfile').show();
        } else {
            $('.projectfile').hide();
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
        // alert('hii');
        var j = ($('.photo_upload').length);
        if (j != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/ProjectwiseTimeExtensionDetails/ajaxtime/' + j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },

                success: function(data, textStatus) {
                    //alert(textStatus);
                    $('.add_doc').append(data);

                }
            });
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
