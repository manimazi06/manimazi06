
 <ul class="nav nav-tabs">
    <?php if($work_type == 1){  ?>
    <li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'basicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
    <?php }else{ ?>
	<li class="nav-item">
        <?php echo $this->Html->link(__('Basic<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'repairbasicdetail', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
    </li>
	<?php } ?>
	<?php if($work_type == 1){  ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Administrative<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'administrativesanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	<?php } ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Detailed<br>Estimate'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php if($work_type == 1){  ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Financial<br>Sanctions'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php  } ?>
     <li class="nav-item">
         <a class="nav-link active">Technical<br> Sanction</a>
     </li>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tender<br>Details</a>
     </li>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Contractor<br>Details</a>
     </li>
	 <?php if($work_type == 1){  ?>
	 <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planning<br>Clearance</a>
     </li>
	 <?php } ?>
     <li class="nav-item">
         <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">SiteHand<br>Over</a>
     </li>
 </ul>
 <?php echo $this->Form->create($technicalSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
        
         <div class="card-body">
             <h4 class="sub-tile">Technical Sanction Details</h4>
             <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
			 
			     <div class="card-body addpage">
                <div class="col-md-12">
                    <div class="form-body row"> 
                         <div class="form-group">
                            <fieldset>                             
                                <table class="table  table-bordered  order-column" style="max-width:100%;margin-right:1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:10%">Item code</th>
                                            <th style="width:30%">Item Description</th>
											<th style="width:8%">Quantity</th>
											<th style="width:8%">Unit</th>
                                            <th style="width:8%">Rate</th>
                                            <th style="width:10%">Amount <br>(in Rs.)</th>
                                            <th style="width:5%"> 
												<!--button type="button" class="btn btn-success btn-xs" onclick="pageadding(1);"><i class="fa fa-plus-circle"></i>Add Code</button><br><br>
												<button type="button" class="btn btn-danger btn-xs" onclick="pageadding(2);"><i class="fa fa-plus-circle"></i>Add Description</button-->
											</th>
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
                                        <tr class="present_row_in_post">
                                            <td class="trcount">1</td>
                                            <td class="nodescription">
                                                <?php echo $this->Form->control('workdetail.0.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,0)','data-rule-required'=>true,'data-msg-required'=>'Select Item Code']); ?>
                                                <?php echo $this->Form->control('workdetail.0.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_code_0']); ?>
                                            </td>
                                            <td  class="nodescription"><?php echo $this->Form->control('workdetail.0.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 4,'id'=>'description_0', 'readonly']); ?>
                                            </td>
											
											<td class ="description" style="display:none;">
											   <?php //echo $this->Form->control('workdetail.0.building_item_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','value'=>0]); ?>
											   <?php //echo $this->Form->control('workdetail.0.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','value'=>0]); ?>

                                             </td>
                                            <td class ="description" style="display:none;"><?php echo $this->Form->control('workdetail.0.item_description1', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 4,'id'=>'description_0','data-rule-required'=>true,'data-msg-required'=>'Enter Description']); ?>
                                            </td>
											
											<td><?php echo $this->Form->control('workdetail.0.quantity', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','id'=>'q_0','onkeyup'=>"product(0)",'data-rule-required'=>false,'data-msg-required'=>'Enter Quantity']); ?>
                                            </td>
											<td>
											   <?php echo $this->Form->control('workdetail.0.unit_id', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Unit','data-rule-required'=>false,'data-msg-required'=>'Select Unit','options'=>$units,'empty'=>'-Select-']); ?>
                                            </td>
                                            <td>
											  <?php echo $this->Form->control('workdetail.0.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate','id'=>'r_0','onkeyup'=>"product(0)",'data-rule-required'=>false,'data-msg-required'=>'Enter Rate']); ?>
                                            </td>                                            
                                            <td>
											<?php echo $this->Form->control('workdetail.0.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'cal_total_0', 'readonly','value'=>0]); ?>
                                            <?php //echo $this->Form->control('workdetail.0.amount_test', ['class' => 'divided_amounts','type'=>'hid','value'=>0]); ?> 
											</td>
                                            <td>
											  <button type="button" class="btn btn-primary btn-xs" onclick="showdescription(0);"><i class="fa fa-pencil"></i>Description</button>
											  <!--button type="button" class="btn btn-primary btn-xs" onclick="showdescription(0);"><i class="fa fa-pencil"></i>Type Description</button-->
											   <?php echo $this->Form->control('type', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','value'=>0]); ?>

											</td>  
                                        </tr>
                                    </tbody>
									<tfoot >
										<tr>
										   <td colspan="6" align="right"><b>Total (in Rs.)</b></td>
										   <td>
										   <?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly']) ?>
										   </td>
										   <td>
										   	<button type="button" class="btn btn-success btn-xs" onclick="pageadding(1);"><i class="fa fa-plus-circle"></i>Add Code</button><br><br>
											<button type="button" class="btn btn-danger btn-xs" onclick="pageadding(2);"><i class="fa fa-plus-circle"></i>Add Description</button>
										
										   
										   </td>
										</tr>
									</tfoot>
                                </table>
                            </fieldset>
                        </div>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20" onclick="hidetechnical();">Submit</button>
                                <button type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default"
                                    onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
				 <?php echo $this->Form->control('abstract_amount', ['type' => 'hidden',  'label' => false, 'error' => false,'value'=>($tot_amount)?$tot_amount:'0.00']) ?>


                 <div class="col-md-12">
				 
				   
                     <div class="form-body row">
                         <div class="col-md-12">

                             <div class="col-md-12">
                                 <div class="form-group row">
                                     <label class="control-label col-md-2 bol">Sanction No <span class="required">* </span></label>
                                     <div class="col-md-4">
                                         <?php echo $this->Form->control('sanction_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction No', 'required', 'value' => ($technical['sanction_no'])?$technical['sanction_no']:'']) ?>
                                     </div>
                                     <label class="control-label col-md-2 bol">Sanction Date <span class="required">* </span></label>
                                     <div class="col-md-4">
                                         <?php echo $this->Form->control('sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select date', 'required', 'value' => ($technical['sanctioned_date'])?date('d-m-Y', strtotime($technical['sanctioned_date'])):'']) ?>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="control-label col-md-2 bol">Sanctioned Amount <br>(in Rs.)<span class="required">* </span></label>
                                     <div class="col-md-4">
                                         <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount', 'required', 'value' => $technical['amount']]) ?>
                                     </div>
                                     <label class="control-label col-md-2 bol">Description <span class="required"> </span></label>
                                     <div class="col-md-4">
                                         <?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'value' => $technical['description']]) ?>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="control-label col-md-2 bol">File Upload. <span class="required">* </span></label>
                                     <div class="col-md-4">
                                          <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'value' => $technical['detailed_estimate_upload']]); ?>
                                         <?php if ($technical['detailed_estimate_upload'] != '') { ?>

                                             <?php echo $this->Form->control('detailed_estimate_upload1', ['type' => 'hidden', 'label' => false, 'value' => $technical['detailed_estimate_upload']]); ?>
                                             <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/technicalsanctions/' . $technical['detailed_estimate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                     <ion-icon name="document-text-outline"></ion-icon>View
                                                 </span></a>
                                         <?php  } ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
             </fieldset>
         </div>
             <div class="form-group" style="padding-top: 10px">
                 <div class="offset-md-5 col-md-6">
                     <button type="submit" class="btn btn-info m-r-20">Save & Continue</button>
                     <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                 </div>
             </div>      
     </div>
 </div>

 <?php echo $this->Form->End(); ?>
 <script>
   
     $("#FormID").validate({
         rules: {            
             'sanction_no': {
                 required: true
             },
             'sanctioned_date': {
                 required: true
             },
             'amount': {
                 required: true
             },             
             'detailed_estimate_upload': {
				  <?php if ($technical['detailed_estimate_upload'] != '') { ?>
                 required: false
				  <?php }else{ ?>
                 required: true
			      <?php } ?>
             }             
         },
         messages: {            
             'sanction_no': {
                 required: "Enter Sanction No."
             },
             'sanctioned_date': {
                 required: "Select Sanctioned Date"
             },
             'amount': {
                 required: "Enter Amount"
             },             
             'detailed_estimate_upload': {
                 required: "upload Document"
             }             
         },
         submitHandler: function(form) {
             var sanctioned_amount = <?php echo  $projectWorkSubdetail['sanctioned_amount']   ?>;
             var amount = $('#amount').val();

             if (parseFloat(amount) <= parseFloat(sanctioned_amount)) {
                 form.submit();
                 $(".btn").prop('disabled', true);

             } else {
                 alert('Technical Sanction Amount should be less than or equal to Sanction Amount to that project work');
                 $('#amount').val('');
                 $('#amount').focus();
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

     
 </script>
