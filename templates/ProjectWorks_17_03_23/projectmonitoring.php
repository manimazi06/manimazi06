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
        <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:3%;padding:15px;margin-left:5px;margin-bottom:3%">
            <legend class="bol" style="color: #0047AB; text-align: center;">Project Fund Request Details
            </legend>
            <div class="col-md-12">
                <div class="form-body row">
                    <?php if ($monitoringDetailscount == 0) { ?>
                        <div class="form-group">
                            <fieldset>

                                <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                    <thead>
                                        <tr align="center">
                                            <th style="width:1%"> S.No</th>
                                            <th style="width:20%">Monitoring Date</th>
                                            <th style="width:20%">Work Stage</th>

                                            <th style="width:20%">Percentage</th>
                                            <th style="width:25%">Photo Upload</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_doc">

                                        <tr class="present_row">
                                            <td class="trcount">1</td>
                                            <td><?php echo $this->Form->control('monitoring_date', ['id' => 'monitoring_date', 'class' => 'form-control datepicker', 'onblur' => 'calling(this.value)', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Monitoring date', 'required']) ?>
                                            </td>

                                            <td><?php echo $this->Form->control('work_stage_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work', 'required']) ?>
                                            </td>

                                            <td><?php echo $this->Form->control('work_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $percentage, 'empty' => 'Select Percentage', 'required']) ?>
                                            </td>

                                            <!-- <td><?php echo $this->Form->control('monitoring.0.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
                                            </td> -->
                                            <td align="center">
                                                <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
                                                    More</button>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </fieldset>

                        </div>
                    <?php   } elseif ($monitoringDetailscount > 0) {  ?>
                        <div class="form-group">
                            <fieldset>

                                <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                    <thead>
                                        <th style="width:1%"> S.No</th>
                                        <th style="width:20%">Monitoring Date</th>
                                        <th style="width:20%">Work Stage</th>

                                        <th style="width:20%">Percentage</th>
                                        <th style="width:25%">Photo Upload</th>
                                        <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_doc">

                                        <tr class="present_row">
                                            <td><?php echo $i + 1; ?></td>
                                            <td>
                                                <?php echo $this->Form->control('monitoring_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Monitoring Date', 'required', 'value' => date('d-m-Y', strtotime($monitoring->monitoring_date))]) ?>
                                                <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $monitoring->id]) ?>
                                            </td>
                                            <td><?php echo $this->Form->control('work_stage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work', 'required', 'value' => $monitoring->work_stage_id]) ?>
                                            </td>
                                            <td><?php echo $this->Form->control('work_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'options' => $percentage, 'error' => false, 'placeholder' => 'Enter Amount', 'required', 'value' => $monitoring->work_percentage_id]) ?>
                                            </td>

                                            <td>

                                                <?php
                                                $i = 0;
                                                foreach ($monitorings as $key => $monitoringDetail) : ?>
                                                    <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'value' => $monitoringDetail->photo_upload]); ?>
                                                    <?php echo $this->Form->control('monitoring.' . $key . '.photo_upload1', ['type' => 'hidden', 'label' => false, 'value' => $monitoringDetail->photo_upload]); ?>
                                                    <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/Projectmonitoring/' . $monitoringDetail['photo_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                            <ion-icon name="document-text-outline"></ion-icon>View

                                                        </span></a>
                                                    <?php
                                                    if (count($monitoringDetail['photo_upload']) > 0) {
                                                        echo '<p style="color:red;">(File Found)</p>';
                                                    } else {
                                                        echo 'no file found';
                                                    }
                                                    ?>

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


        </fieldset>

        </fieldset>
        <div class="form-group" style="padding-top: 10px">
            <div class="offset-md-5 col-md-6">
                <button type="submit" class="btn btn-info m-r-20">Submit</button>
                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Form->End(); ?>
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true"
    class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form add-unsent-form">

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
            'monitoring[0][monitoring_date]': {
                required: true
            },
            'monitoring[0][work_stage_id]': {
                required: true
            },
            'monitoring[0][photo_upload]': {
                <?php if ($monitoringDetailscount > 0) {  ?>
                    required: false
                <?php } else { ?>
                    required: true
                <?php  } ?>
            },
            'monitoring[0][work_percentage_id]': {
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
                required: "Select photo"
            },
            'monitoring[0][work_percentage_id]': {
                required: "Select Percentage"
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