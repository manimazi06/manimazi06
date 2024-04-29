<style>
    textarea {
        resize: none;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>View Contractor</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($contractor, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <div class="col-md-12">
						<div style="margin-left:90%;"><a onClick="print_receipt('div_vc')"><i class="fa fa-print"></i> Print</a></div>
                        <div  id="div_vc1">
                           <div class="form-body row">
							 <table  style="max-width:98%;margin-left:1%;">						  
								   <tr>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Contractor/Company Name</td>
									  <td style="padding:13px;width:30%;border:1px solid black"><?php echo $contractor_details['name']; ?></td>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Contractor Class.</td>
									  <td style="padding:13px;width:30%;border:1px solid black"><?php  echo $contractor_details['contractor_class']['name']; ?> </td>
								   </tr>
								   <tr>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Mobile No</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['mobile_no']; ?></td>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Mobile No 2</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['mobile_no2']; ?></td>
								   </tr>
								   <tr>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Email</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['email']; ?></td>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">GST No</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['gst_no']; ?></td>
								   </tr>
								   <tr>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">File no</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['file_no']; ?></td>

									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Register Date</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo date('d-m-Y', strtotime($contractor_details['register_date'])); ?></td>
								   </tr>
									<tr>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Validity upto</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo date('d-m-Y', strtotime($contractor_details['validity_upto'])); ?></td>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Certificate Upload</td>
									   <td style="padding:13px;width:30%;border:1px solid black;"> <?php if ($contractor_details['certificate_upload'] != '') {  ?>
												 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ContractorCertificate/'.$contractor_details['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
														 <ion-icon name="document-text-outline"></ion-icon>View
													 </span></a>
											 <?php   }  ?></td>
								   </tr>
									<tr>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Address</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['address']; ?></td>	
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Class Level</td>
									  <td style="padding:13px;width:30%;border:1px solid black"><?php echo $contractor_details['contractor_class_level']['name']; ?></td>									  
								   </tr>
									<tr>
									 
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Contractor Type</td>
									  <td style="padding:13px;width:30%;border:1px solid black"><?php  echo $contractor_details['contractor_type']['name']; ?> </td>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Registered Department</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['contractor_registered_department']['name']; ?></td>
								   </tr>
								   <tr>									  
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Renewal Date</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo ($contractor_details['renewal_date'])?date('d-m-Y', strtotime($contractor_details['renewal_date'])):''; ?></td>
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Registration No</td>
									  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['registration_no']; ?></td>
								   </tr>
								   <?php if($contractor_details['remarks'] != ''){ ?>
								   <tr>									 
									  <td style="padding:13px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Remarks</td>
									  <td colspan="3" style="padding:13px;width:80%;border:1px solid black;"> <?php echo $contractor_details['remarks']; ?></td>
								   </tr>
								   <?php } ?>
								</table> 
							</div>		
							</div>		
                        </div>
                       
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 pdfreport" style="display:none;">      
	<div  id="div_vc">
		<div class="card-body">	
		   <table  style="max-width:98%;margin-left:1%;">						  
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Contractor/Company Name</td>
				  <td style="padding:13px;width:30%;border:1px solid black"><?php echo $contractor_details['name']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Contractor Class.</td>
				  <td style="padding:13px;width:30%;border:1px solid black"><?php  echo $contractor_details['contractor_class']['name']; ?> </td>
			   </tr>
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Mobile No</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['mobile_no']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Mobile No 2</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['mobile_no2']; ?></td>
			   </tr>
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Email</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['email']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">GST No</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['gst_no']; ?></td>
			   </tr>
			   <tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">File no</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['file_no']; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Register Date</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo date('d-m-Y', strtotime($contractor_details['register_date'])); ?></td>
			   </tr>
				<tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Validity upto</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo date('d-m-Y', strtotime($contractor_details['validity_upto'])); ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Certificate Upload</td>
				   <td style="padding:13px;width:30%;border:1px solid black;"> </td>
			   </tr>
				<tr>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Address</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php echo $contractor_details['address']; ?></td>	
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Class Level</td>
				  <td style="padding:13px;width:30%;border:1px solid black"><?php echo $contractor_details['contractor_class_level']['name']; ?></td>									  
			   </tr>
				<tr>				 
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Contractor Type</td>
				  <td style="padding:13px;width:30%;border:1px solid black"><?php  echo $contractor_details['contractor_type']['name']; ?> </td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Registered Department</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['contractor_registered_department']['name']; ?></td>
			   </tr>
			   <tr>									  
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Renewal Date</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"><?php //echo ($contractor_details['renewal_date'] != '')?date('d-m-Y', strtotime($contractor_details['renewal_date'])):''; ?></td>
				  <td style="padding:13px;width:20%;border:1px solid black;font-weight:600;">Registration No</td>
				  <td style="padding:13px;width:30%;border:1px solid black;"> <?php echo $contractor_details['registration_no']; ?></td>
			   </tr>
			   <?php if($contractor_details['remarks'] != ''){ ?>
			   <tr>									 
				  <td style="padding:13px;width:20%;border: 1px solid black;font-weight:600;">Remarks</td>
				  <td colspan="3" style="padding:13px;width:80%;border:1px solid black;"> <?php echo $contractor_details['remarks']; ?></td>
			   </tr>
			   <?php } ?>
			</table> 
		</div>
	</div>
</div>
<script>
   function print_receipt() {
	   $('.pdfreport').show();
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
		 $('.pdfreport').hide();
    }
</script>
