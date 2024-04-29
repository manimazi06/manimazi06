<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>

<?php echo $this->Form->create($projectwiseCompletionReport, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">

        <div id="addpage">
            <div class="card-body">
                <h4 class="sub-tile">Project Completion Details</h4>
				  <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;"> </div> 
		        <div class="card-body">
                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">				
                    <div class="col-md-12">
                        <div class="form-body row">
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="control-label col-md-2">Completed Date<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('completed_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                    </div>


                                    <label class="control-label col-md-2">Completion Copy <span class="required"> * <br>(upload .pdf,.jpg,.png) <br> (Maximum 5mb only)</span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('file_upload', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="control-label col-md-2">Financial Sanction amount</label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('fs_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'disabled', 'value' => $project_sub, 'required']); ?>
                                    </div>
                                    <label class="control-label col-md-2">Completion amount<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('completion_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'onchange' => 'amount(this.value)', 'type' => 'text', 'placeholder' => 'Enter Project Completion amount', 'required']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <label class="control-label col-md-2">Status<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('status', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'disabled', 'placeholder' => 'status', 'required']); ?>
                                    </div>

                                    <label class="control-label col-md-2">Remarks<span class="required"> * </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                    </div>
            </div>
        </div>

        <div class="form-group addpagess" style="padding-top: 10px;">
            <div class="offset-md-5 col-md-10">
                <button type="submit" class="btn btn-info m-r-20">Submit</button>
                <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
            </div>
        </div>
    </div>
    <?php // } 
    ?>



</div>
<?php echo $this->Form->End(); ?>
<script>
    $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });

    $("#FormID").validate({
        rules: {
            'completed_date': {
                required: true
            },
            'remarks': {
                required: true
            },
            'file_upload': {
                required: true
            },
            'completion_amount': {
                required: true
            }
        },

        messages: {
            'completed_date': {
                required: "Select Completed Date"
            },
            'remarks': {
                required: "Enter Remarks"
            },
            'file_upload': {
                required: "Upload Completion Copy"
            },
            'completion_amount': {
                required: "Enter Completion Amount"
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

    function amount(val) {
        //alert(val);
        var val;
        var amount = <?php echo ($project_sub)?$project_sub:0; ?>;

        //alert(val);
        // alert(amount);
        if (val < amount) {

            var savings = amount - val;
            var savings_add = Number(val) + Number(amount);
            //alert(savings);
            //alert(savings_add);
            var sav_perc = (savings / savings_add) * 100;
            var roun_off = Math.round(sav_perc);
            //alert(roun_off);
            $('#status').val('Savings-' + '  ' + 'Rs.' + savings + ' ' + 'In Perc-' + roun_off + '%');

        } else if (val > amount) {
            var excess = (val - amount).toFixed(2);
            //alert('excess');

            var excess_amount = Number(val) + Number(amount);
            //alert(savings);
            //alert(savings_add);
            var excess_perc = (excess / excess_amount) * 100;
            var roun_off = Math.round(excess_perc);
            //alert(roun_off);
            $('#status').val('Excess-' + '  ' + 'Rs.' + excess + ' ' + 'In Perc-' + roun_off + '%');

        } else if (val == amount) {
            $('#status').val('Both Amount are Equal');
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
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
</script>