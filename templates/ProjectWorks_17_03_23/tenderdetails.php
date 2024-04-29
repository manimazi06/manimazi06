<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>

<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Project Tender Details</header>
        </div>
		 <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div>   
		 
		  <?php if ($project_tender_statusescount  > 0) { ?>
		   <div class="card-body">
					<h4 class="sub-tile">Tender Status Details:</h4>
					<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
					  <div class="table-scrollable">
						<table class="table  table-bordered table-checkable order-column" style="width: 98%">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.no</th>
									<th style="width:10%">Date</th>
									<th style="width:10%">Tender Status</th>
									<th style="width:10%">Remarks</th>
								</tr>
							</thead>
							<tbody>
								<?php $a = 1;
							    	foreach ($project_tender_statuses  as $tender_statuses) : ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $a; ?></td>
										<td class="title"><?php echo date('d-m-Y', strtotime($tender_statuses['submit_date'])); ?></td>
										<td class="title"><?php echo  $tender_statuses['tender_status']['name']; ?></td>
										<td class="title"><?php echo $tender_statuses['remarks']; ?></td>
									</tr>
								<?php
									$a++;
								   endforeach; ?>
							</tbody>
						</table>
					</div>
				</fieldset>
				</div>
			   <?php } ?> 
		  <?php  if($tender_count == 0){ ?>
          <div id="tenderstatus">
			 <div class="card-body">
			    <h4 class = "sub-tile">Tender Status</h4> 
                <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend-->
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
						<div class="form-body row addpagess">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label col-md-2">Tender Status <span class="required"> * </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('tender_status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false,  'error' => false, 'empty' => 'Select Tender Status',  'options' => $tenderStatus, 'required', 'onchange' => 'load_tender(this.value)']); ?>
									</div>
									<label class="control-label col-md-2">Remarks<span class="required"> * </span></label>
									<div class="col-md-4">
										<?php echo $this->Form->control('tender_status_remarks', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea','rows'=>3, 'required']); ?>
									</div>									
								</div>						
							</div>
						</div>
                </fieldset>
            </div>
            <div class="form-group addpagess finalstatus" style="padding-top: 10px;">
                <div class="offset-md-5 col-md-10">
                    <button type="submit" class="btn btn-info m-r-20">submit</button>
                    <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
                </div>
            </div>    
          </div>	
		  <?php  } ?>		  
        <?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) { ?>
            <div id="addpage"  <?php  if($tender_count == 0){ ?> style="display:none;" <?php } ?> >
			 <div class="card-body">
			    <h4 class = "sub-tile">Tender Details</h4> 
                <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend-->
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
						<div class="form-body row addpagess">
							<div class="col-md-12 tender">
								<div class="form-group row">
									<label class="control-label col-md-3">Tender type <span class="required"> * </span></label>
									<div class="col-md-3">
										<?php echo $this->Form->control('tender_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false,  'error' => false, 'empty' => 'Select Tender Type',  'options' => $tender_type, 'required', 'onchange' => 'load_details(this.value)']); ?>
									</div>
									<label class="control-label col-md-3 etender" style="display:none;">E-tender ID<span class="required"> * </span></label>
									<div class="col-md-3 etender" style="display:none;">
										<?php echo $this->Form->control('etenderID', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'placeholder' => 'Enter E-Tender ID', 'label' => false,   'error' => false, 'type' => 'text']); ?>
									</div>
									<label class="control-label col-md-3 boxtender" style="display:none;">tender No<span class="required"> * </span></label>
									<div class="col-md-3 boxtender" style="display:none;">
										<?php echo $this->Form->control('tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'placeholder' => 'Enter tender No', 'error' => false, 'type' => 'text']); ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Tender Date<span class="required"> * </span></label>
									<div class="col-md-3">
										<?php echo $this->Form->control('tender_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
									</div>
									<label class="control-label col-md-3">Tender Copy <span class="required"> * </span></label>
									<div class="col-md-3">
										<?php echo $this->Form->control('tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Estimate Amount put to Tender <br>(in Rs.)<span class="required"> * </span></label>
									<div class="col-md-3">
										<?php echo $this->Form->control('tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>$sanctioned_amount]); ?>
									</div>
								</div>
							</div>
						</div>
                </fieldset>
            </div>
            <div class="form-group addpagess" style="padding-top: 10px;">
                <div class="offset-md-5 col-md-10">
                    <button type="submit" class="btn btn-info m-r-20">ADD Tender</button>
                    <!--button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button-->
                </div>
            </div>    
            </div>
     <?php } ?>
    <?php if ($tenders) { ?>
    <div class="card-body">
        <h4 class = "sub-tile">Tender Details List</h4> 
        <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details List</legend-->
        <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">

            <div class="table-scrollable">
            <table class="table table-bordered order-column" style="width: 98%">
                <thead>
                    <tr class="text-center">
                        <th width="5%"> Sno </th>
                        <th>Work ID</th>
                        <th>Tender Type</th>
                        <th>Tender No/<br>Etender ID</th>
                        <th>Tender Date </th>
                        <th>Tender Amount </th>
                        <th>Tender Copy</th>
                        <?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) { ?>
                            <th>Actions </th>
                        <?php  } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = 1;
                    foreach ($tenders as $projectTenderDetail) : ?>
                        <tr class="text-center">
                            <td class="text-center"><?php echo ($sno); ?></td>
                            <td><?php echo ($projectTenderDetail['project_work_subdetail']['work_code'])?$projectTenderDetail['project_work_subdetail']['work_code']:$projectTenderDetail['project_work']['project_code']; ?></td>
                            <td><?php echo $projectTenderDetail['tender_type']['name']; ?></td>
							<?php  if($projectTenderDetail['tender_type_id'] == 1){  ?>
                            <td><?php echo $projectTenderDetail['etenderID']; ?></td>
							<?php  }else if($projectTenderDetail['tender_type_id'] == 2){ ?>
                            <td><?php echo $projectTenderDetail['tender_no']; ?></td>
							<?php } ?>
                            <td class="title"><?php echo date('d-m-Y', strtotime($projectTenderDetail['tender_date'])); ?></td>
                            <td class="title"><?php echo $projectTenderDetail['tender_amount']; ?> </td>
                            <td class="title"><a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank">
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                    </span>
                                </a>
                            </td>
                            <?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) { ?>
                                <td class="text-center">
                                    <span style="overflow: visible; position: relative; width: 177px;">
                                        <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'tenderdetailsedit', $id, $work_id, $projectTenderDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
									    <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Contractor Details'), ['action' => 'addcontractor', $id, $work_id, $projectTenderDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?>
                                    </span>
                                </td>
                            <?php  } ?>
                        </tr>
                    <?php $sno++;
                    endforeach; ?>
                </tbody>
            </table>
			</div>
        </fieldset>
    </div>
   <?php  } ?>
  <?php if ($projectWorkSubdetail['tender_detail_flag'] == 1) {  ?>
    <div class="card-body">
        <div class="form-body row">
            <legend class="bol" style="color: #0047AB; text-align: center;">Contract Agreement Details</legend>
            <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">

                <div class="form-body row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Contractor / Company Name<span class="required"> &nbsp;&nbsp;:</span></label>
                            <div class="col-md-3 lower">
                                <?php echo $contractor_details['contractor_name']; ?>
                            </div>
                            <label class="control-label col-md-3">Contact Mobile No <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php echo $contractor_details['contractor_mobile_no']; ?>
							</div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Agreement no <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php echo $contractor_details['agreement_no']; ?>
                            </div>
                            <label class="control-label col-md-3">Agreement Date<span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php echo date('d-m-Y', strtotime($contractor_details['agreement_date'])); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Agreement Period From <span class="required"> &nbsp;&nbsp;:</span></label>
                            <div class="col-md-3 lower">
                                <?php echo date('d-m-Y', strtotime($contractor_details['agreement_fromdate'])); ?>
                            </div>
                            <label class="control-label col-md-3">Agreement Period To<span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php echo date('d-m-Y', strtotime($contractor_details['agreement_todate'])); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Agreement Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php if ($contractor_details['agreement_copy'] != '') {  ?>
                                    <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $contractor_details['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a>
                                <?php   }  ?>
                            </div>
                            <label class="control-label col-md-3">Agreement amount <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php echo $contractor_details['agreement_amount']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Reduction in Percentage(%) <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-3 lower">
                                <?php echo $contractor_details['perc_deduction']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
<?php  } ?>
<?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) {  ?>
    <?php if ($contractor_detail_count != 0) {  ?>
        <div class="form-group" style="padding-top: 10px;">
            <div class="offset-md-5 col-md-10">
                <?php echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>
                <button type="submit" class="btn btn-success" onclick="setvalue()">Final Submit</button>
            </div>
        </div>
    <?php  }
} else {  ?>

    <div class="form-group" style="padding-top: 10px;">
        <div class="offset-md-5 col-md-10">
            <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
        </div>
    </div>
<?php } ?>

</div>
</div>
<?php echo $this->Form->End(); ?>
<script>
    function setvalue() {
        if (confirm('Are you sure for final submit')) {
            $("#addpage").hide();
            //alert('hi');
            $('#completed-flag').val(1);
            //alert();
            $("#FormID").validate({
                rules: {
                    'material_id1': {
                        required: true
                    }
                },
                messages: {
                    'material_id1': {
                        required: "Enter Reference No"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                    $(".btn").prop('disabled', true);
                }
            });
        } else {
            return false;
        }
    }

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
                required: true
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

            var completed_flag = $('#completed-flag').val();

            if (completed_flag == 0) {

                var admin_sanction = <?php echo ($administrativesanction['sanctioned_amount'])?$administrativesanction['sanctioned_amount']:0;  ?>;
                var tender_amount = $('#tender-amount').val();
                if (parseFloat(tender_amount) <= parseFloat(admin_sanction)) {
                    form.submit();
                    $(".btn").prop('disabled', true);
                } else {
                    alert('Estimate Amount put to Tender should be less than or equal to  Technical Sanction');
                    return false;

                }
            } else {

                form.submit();
                $(".btn").prop('disabled', true);

            }

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

    /*$(document).ready(function() {
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
                    url: '<?php echo $this->Url->webroot ?>_staging/projectTenderDetails/ajaxproject/' + financialID,
                    success: function(data, textStatus) {
                        //alert(data)
                        $('#project').html(data);
                    }
                });
            } else {
                $('#project').html('<option value="">Select Project</option>');

            }
        });


    });*/

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

<script>
    $(document).ready(function() {


        $('#add').click(function() {
            var j = $('.tender').length;
            //alert(j);


            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>_staging/ProjectTenderDetails/ajaxprojecttender/' +
                    j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) { //alert(data);  
                    $('.addmore').append(data);
                    //  j++;
                    // $("#serialvalue").val(j);
                }
            })
        })

    });
	
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
	
	function load_tender(id){
		var id;
		if(id == 4){
		   $('#addpage').show();			
		   $('.finalstatus').hide();			
		}else{	
           $('#tender-type-id').val('');		
           $('#etenderid').val('');		
           $('#tender-no').val('');		
           $('#tender-date').val('');		
           $('#tender-copy').val('');		
		   $('#addpage').hide();	
		   $('.finalstatus').show();	
		}		
	}
</script>