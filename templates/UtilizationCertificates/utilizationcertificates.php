<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Utilization Certificate</header>
            </div>           
            <?php echo $this->Form->create($utilizationCertificate, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
            <div class="col-md-12">
				<div class="form-group" style="padding-top: 10px">
				  <div class="offset-md-1 col-md-2">
				    <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
				  </div>
			    </div>
			   <div id ="project" style="display:none;"> </div>
			      <div class="card-body">
                    <div class="form-body row">
					   <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Cerificate Date<span class=" required">*
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('certificated_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select date', 'required']); ?>
                                </div>
								  <label class="control-label col-md-2">Amount<span class=" required">*
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount', 'required','maxlength'=>13,'min'=>1]); ?>
                                </div>                                
                            </div>
                            <div class="form-group row">
							    <label class="control-label col-md-2">File Upload<span class=" required"> <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('certificate_upload', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'file','label' => false, 'error' => false, 'accept' => '.pdf,.jpg,.png,.jpeg', 'placeholder' => 'Select File upload', 'required','onchange'=>'validdocs(this)']); ?>
                                </div>
                                <label class="control-label col-md-2">Remarks<span class=" required"> 
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'type' => 'textarea', 'rows' => 3, 'label' => false, 'error' => false, 'placeholder' => 'Remarks', 'required']); ?>
                                </div>
                            </div>
                        </div>
						</fieldset>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  if($utilizationCertificatecount > 0){ ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
		  <div class="card-body">
			<h4 class = "sub-tile">Utilization Certificate List</h4> 
			<!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details List</legend-->
			<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
				<div class="table-scrollable">
					<table class="table table-bordered order-column" style="width: 98%">
						<thead>
							<tr class="text-center">
								<th width="1%"> Sno </th>
								<th width="10%">Date</th>
								<th width="10%">Amount</th>
								<th width="10%">File Upload</th>
								<th width="25%">Remarks </th>
								<th width="5%">Actions </th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1;
							    foreach ($utilizationCertificatelists as $utilizationCertificatelist) : ?>
								<tr class="text-center">
									<td class="text-center"><?php echo ($sno); ?></td>
									<td class="title"><?php echo date('d-m-Y', strtotime($utilizationCertificatelist['certificated_date'])); ?></td>
									<td><?php echo $utilizationCertificatelist['amount']; ?></td>
									<td class="title">
									  <?php if ($utilizationCertificatelist['certificate_upload'] != '') {  ?>
											 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/utilizationCertificates/' . $utilizationCertificatelist['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
													 <ion-icon name="document-text-outline"></ion-icon>View
												 </span>
											 </a>
										 <?php  } ?>
									</td>
									<td><?php echo $utilizationCertificatelist['remarks']; ?> </td>
										<td class="text-center">
											<span style="overflow: visible; position: relative; width: 177px;">
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'utilizationcertificatesedit',$pw_id, $work_id, $utilizationCertificatelist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
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
<script>
    $("#FormID").validate({
        rules: {
            'certificated_date': {
                required: true
            },
            'amount': {
                required: true
            },
            'certificate_upload': {
                required: false
            },
            'remarks': {
                required: false
            }
        },

        messages: {
            'certificated_date': {
                required: "Select Cerificate Date"
            },
            'amount': {
                required: "Enter Amount"
            },
            'certificate_upload': {
                required: "Select Document"
            },
            'remarks': {
                required: "Enter Remark",
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
	 
  function toggledetail(){
    $('#project').toggle();

    }

  $(document).ready(function() {
        var ProjectID    = <?php echo $pw_id;  ?>;
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