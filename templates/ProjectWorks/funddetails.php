<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>

<?php echo $this->Form->create($projectFundDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Project Fund Details</header>
        </div>
         <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
       
        <div class="card-body">
		  					 <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button><br><br>

            <div class="form-body row">

                <div class="col-md-12">
                    <?php if ($projectfundcount == 0) { ?>
                        <div class="form-group">
                            <fieldset>
                               
                                <table class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:10%">Request Date</th>
                                            <th style="width:10%">Request amount</th>
                                            <th style="width:10%">Is Amount received</th>
                                            <th style="width:10%">Received date</th>
                                            <th style="width:10%">Received amount</th>
                                            <th style="width:8%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="add">

                                        <tr class="present_row_in_post">
                                            <td class="trcount">1</td>
                                            <td><?php echo $this->Form->control('fund.0.request_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Fund request date', 'required']); ?>
                                                <?php echo $this->Form->control('fund.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('fund.0.request_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Request amount', 'required']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('fund.0.is_amount_receive_id', ['class' => 'form-select', 'options' => $amount_received, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select status', 'onchange' => 'calling(this.value,0)', 'required']); ?>
                                            </td>
                                            <td><span class="yes_0" style="display: none;"><?php echo $this->Form->control('fund.0.received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select received Date', 'required']); ?></span>
                                            </td>
                                            <td><span class="yes_0" style="display: none;"><?php echo $this->Form->control('fund.0.received_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Received amount', 'required']); ?></span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>

                    <?php
                    } elseif ($projectfunds > 0) { ?>
                        <div class="form-group">
                            <fieldset>
                                <table class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:10%">Request Date</th>
                                            <th style="width:10%">Request amount</th>
                                            <th style="width:10%">Is Amount received</th>
                                            <th style="width:10%">Received date</th>
                                            <th style="width:10%">Received amount</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="add">  
                                    <?php $i = 0;
                                    foreach ($projectfunds as $projectfund) : ?>
                                        <tr class="present_row_in_post">
                                            <td class="trcount"><?php echo $i + 1; ?></td>
                                            <td><?php echo $this->Form->control('fund.' . $i . '.request_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Fund request date', 'required', 'value' => date('d-m-Y', strtotime($projectfund->request_date))]); ?>
                                                <?php echo $this->Form->control('fund.' . $i . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $projectfund->id]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('fund.' . $i . '.request_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Request amount', 'required', 'value' => $projectfund->request_amount]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('fund.' . $i . '.is_amount_receive_id', ['class' => 'form-select', 'options' => $amount_received, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select status', 'onchange' => 'calling(this.value,' . $i . ')', 'required', 'value' => $projectfund->is_amount_received]); ?>

                                            </td>

                                            <td><span class="yes_<?php echo  $i;  ?>" <?php if ($projectfund->is_amount_received == 2) { ?> style="display: none;" <?php } ?>><?php echo $this->Form->control('fund.' . $i . '.received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select received Date', 'required', 'value' =>($projectfund->received_date != '')? date('d-m-Y', strtotime($projectfund->received_date)):'']); ?></span>
                                            </td>
                                            <td> <span class="yes_<?php echo  $i;  ?>" <?php if ($projectfund->is_amount_received == 2) { ?> style="display: none;" <?php } ?>><?php echo $this->Form->control('fund.' . $i . '.received_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Received amount', 'required', 'value' => $projectfund->received_amount]); ?></span>
                                            </td>
                                            <td></td>
                                        </tr>

                                    <?php $i++;
                                    endforeach; ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    <?php } ?>
                    <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                        <div class="offset-md-5 col-md-10">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                        </div>
                    </div>
                </div>
                <?php //echo $this->Form->End(); ?>
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

        function pageadding() {
            var j = ($('.present_row_in_post').length);
           // alert(j);
            var row_no = j - 1;
            var request_date = $("#fund-" + row_no + "-request-date").val();
            var request_amount = $("#fund-" + row_no + "-request-amount").val();
              if (request_amount != '' && request_date != '') {

                $.ajax({
                    async: true,
                    dataType: "html",
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxfunddetails/' + j,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    },
                    success: function(data, textStatus) {
                       // alert(data);
                        $('#add').append(data);
                        //  j++;
                        // $("#serialvalue").val(j);
                    }
                });

            } else if (request_date == '') {
                alert("Enter Request date");
                $("#fund-" + row_no + "-request-date").focus();
            } else if (request_amount == '') {
                alert("Enter Request amount");
                $("#fund-" + row_no + "-request-amount").focus();
            } 
        }

        $("#FormID").validate({
            rules: {
                'fund[0][request_date]': {
                    required: true
                },
                'fund[0][request_amount]': {
                    required: true
                },
                'fund[0][is_amount_receive_id]': {
                    required: true
                },
                'fund[0][received_amount]': {
                    required: true
                },
                'fund[0][received_date]': {
                    required: true
                }

            },

            messages: {
                'fund[0][request_date]': {
                    required: "Select fund request date"
                },
                'fund[0][request_amount]': {
                    required: "Enter Request amount"
                },
                'fund[0][is_amount_receive_id]': {
                    required: "Select Is amount received"
                },
                'fund[0][received_amount]': {
                    required: "Enter Received amount"
                },
                'fund[0][received_date]': {
                    required: "Select Received date"
                }
            },
            submitHandler: function(form) {
                form.submit();
                $(".btn").prop('disabled', true);
            }
        });

        function validdocs(oInput) {
            var _validFileExtensions = ['.pdf'];
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
        $(document).ready(function() {
            $('#financialyear').on('change', function() {
                // alert(distID);
                var financialID = $(this).val();
                //  alert(distID);
                //var path = "<?php //echo $this->Url->webroot 
                                ?>/firstproject/Students/ajaxtaluks/" + distID;
                // alert(path);
                if (financialID) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $this->Url->webroot ?>/tnphc/projectTenderDetails/ajaxproject/' + financialID,
                        success: function(data, textStatus) {
                            //alert(data)
                            $('#project').html(data);
                        }
                    });
                } else {
                    $('#project').html('<option value="">Select Project</option>');

                }
            });

        });

        function calling(id, count) {
            var count;
            if (id == 1) {
                $(".yes_" + count).show();

            } else if (id == 2) {
                $('#fund-' + count + '-received-date').val('');
                $('#fund-' + count + '-received-amount').val('');
                $(".yes_" + count).hide();

            }


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