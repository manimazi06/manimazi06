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
            <legend class="bol" style="color: #0047AB; text-align: center;">Project Monitoring Details
                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
            </legend>
            <div class="col-md-12">
                <div class="form-body row">                  
                    <div class="form-group">
                        <fieldset>

                            <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                <thead>
                                    <tr align="center">
                                        <th style="width:20%">Monitoring Date</th>
                                        <th style="width:20%">Work Stage</th>
                                        <th style="width:20%">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $this->Form->control('monitoring_date', ['id' => 'monitoring_date', 'class' => 'form-control datepicker', 'onblur' => 'calling(this.value)', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Monitoring date', 'required']) ?>
                                        </td>

                                        <td><?php echo $this->Form->control('work_stage_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work', 'required']) ?>
                                        </td>

                                        <td><?php echo $this->Form->control('work_percentage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $percentage, 'empty' => 'Select Percentage', 'required']) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <center>
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
                            </center>
                        </fieldset>
                    </div>     
                </div>
            </div>
            <div class="form-group" style="padding-top: 10px">
                <div class="offset-md-4 col-md-5">
                    <button type="submit" class="btn btn-info m-r-20">Submit</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                </div>
            </div>
          <?php if ($monitoringDetailscount > 0) { ?>
            <div class="card-body">
                <legend class="bol" style="color: #0047AB; text-align: center;">Project Monitoring Details List
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
                </legend>
                <?php if ($monitoring) { ?>
                    <div class="table-scrollable">
                        <table class="table table-bordered order-column" style="width: 100%" id="example4">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> Sno </th>
                                    <th style="width:20%">Monitoring Date</th>
                                    <th style="width:20%">Work Stage</th>
                                    <th style="width:20%">Percentage</th>
                                    <th style="width:20%">File Upload</th>
                                    <th>Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sno = 1;
                                foreach ($monitorings as $MonitoringDetail) : ?>
                                    <tr class="odd gradeX">
                                        <td class="text-center"><?php echo ($sno); ?></td>
                                        <td><?php echo (date('d-m-Y', strtotime($MonitoringDetail['monitoring_date']))); ?></td>

                                        <td><?php echo $MonitoringDetail['work_stage']['name']; ?></td>
                                        <td class="title"> <?php echo $MonitoringDetail['work_percentage']['name']; ?> </td>

                                        <td class="title">
                                            <a href="javascript:void(0);" onclick="getmonitoringphotos(<?php echo $MonitoringDetail['id'] ?>);">View</a>
                                        </td>
                                        <td class="text-center">
                                            <span style="overflow: visible; position: relative; width: 177px;">

                                                <div class="btn-icon tooltipster" title="Edit">
                                                    <?php echo $this->Html->link(__('<span class="svg-icon svg-icon-primary"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo3/dist/../src/media/svg/icons/Communication/Write.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                </g>
                                            </svg><!--end::Svg Icon--></span>'), ['action' => 'projectmonitoringedit', $id, $work_id, $MonitoringDetail['id']], ['escape' => false, 'target' => '_self']); ?>

                                                </div>
                                            </span>
                                        </td>
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
                        <?php if ($photo_upload > 0) {  ?>
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