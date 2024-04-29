 <?php
    $fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
    $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
    ?>

 <?php echo $this->Form->create($projectTenderDetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

 <div class="col-md-12">
     <div class="card card-topline-aqua">
         <div class="card-head">
             <header>Add Project Tender Details</header>
         </div>
          <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-3">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
        
         <div class="card-body">
             <div class="form-body row">
                 <div class="col-md-12">
				  <h4 class = "sub-tile">Tender Details</h4> 
                      <!--legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend-->
                     <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;">
                         <div class="form-body row">
                             <div class="col-md-12">

                                 <div class="form-group row">

                                     <label class="control-label col-md-3">Tender Type <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo $projectTenderDetail['tender_type']['name'] ?>
                                     </div>
									<?php if($projectTenderDetail['tender_type_id'] == 1){ ?> 
									 <label class="control-label col-md-3">E Tender ID <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo $projectTenderDetail['etenderID']; ?>
                                     </div>
									<?php }elseif($projectTenderDetail['tender_type_id'] == 1){ ?> 
									 <label class="control-label col-md-3">Tender No <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo $projectTenderDetail['tender_no']; ?>
                                     </div>
									<?php } ?>
                                 </div>
                                 <div class="form-group row">
                                     <label class="control-label col-md-3">Tender Date<span class="required"> &nbsp;&nbsp;:</span></label>
                                     <div class="col-md-3 lower">
                                         <?php echo date('d-m-Y', strtotime($projectTenderDetail['tender_date'])); ?>
                                     </div>
                                     <label class="control-label col-md-3">Amount put to Tender (in Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower" id="tender_amount">
                                         <?php echo $projectTenderDetail['tender_amount'] ?>
                                     </div>
                                    
                                 </div>
								 <div class="form-group row">
                                    
                                     <label class="control-label col-md-3">Tender Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                     <div class="col-md-3 lower" style="margin-top:8px;">
                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                             </span></a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </fieldset>
                 </div>
                 <div class="card-body">
				  <h4 class = "sub-tile">Contractor Agreement List</h4> 				
					 <div class="table-scrollable">
						 <table class="table  table-bordered table-checkable order-column" style="width: 100%">
								<thead>
									<tr class="text-center">
										<th style="width:1%">S.no</th>
										<th style="width:4%">Item code</th>
										<th style="width:35%">Item Description</th>
										<th style="width:8%">Quantity</th>
										<th style="width:5%">Unit</th>
										<!--th style="width:10%">Rate</th>
										<th style="width:10%">Amount</th-->
										<th style="width:12%">Contractor Rate <br>(in Rs)</th>
										<th style="width:12%">Final Amount <br>(in Rs)</th>
									</tr>
								</thead>
								<tbody>
									<?php $sno = 1;
										foreach ($abstract_subdetails  as $key => $abstract_subdetail) : ?>
										<tr class="odd gradeX">
											<td class="text-center"><?php echo $sno; ?></td>
											<td class="title" style="text-align:center;"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
											<td class="title"><?php echo $abstract_subdetail['item_description'] ?></td>
											<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['quantity'] ?></td>
											<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['unit']['name'] ?></td>
											<!--td class="title" style="text-align:right;"><?php //echo $abstract_subdetail['rate'] ?></td>
											<td class="title" style="text-align:right;"><?php //echo ($abstract_subdetail['amount'])?$abstract_subdetail['amount']:''; ?></td-->
											<td>
											  <?php if($abstract_subdetail['quantity'] != ''){ ?>
											  <?php echo $this->Form->control('workdetail.'.$key.'.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate','id'=>'r_'.$key.'','onkeyup'=>"product(".$key.")",'data-rule-required'=>true,'data-msg-required'=>'Enter Rate','value'=>($abstract_subdetail['contractor_rate'])?$abstract_subdetail['contractor_rate']:'']); ?>
                                             <?php echo $this->Form->control('workdetail.'.$key.'.quantity', ['type'=>'hidden','label' => false, 'error' => false,'id'=>'q_'.$key.'','value'=>$abstract_subdetail['quantity']]); ?>
                                             <?php echo $this->Form->control('workdetail.'.$key.'.id', ['type'=>'hidden','label' => false, 'error' => false,'id'=>'q_'.$key.'','value'=>$abstract_subdetail['id']]); ?>

											<?php } ?>
											</td>                                            
                                            <td>
											  <?php if($abstract_subdetail['quantity'] != ''){ ?>
											<?php echo $this->Form->control('workdetail.'.$key.'.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'cal_total_'.$key.'', 'readonly','value'=>($abstract_subdetail['final_amount'])?$abstract_subdetail['final_amount']:'0']); ?>
											  <?php } ?>
											</td>
										</tr>
									<?php 
									if($abstract_subdetail['amount'] != ''){
									 $tot_amount += $abstract_subdetail['amount'];   
									}
									
									if($abstract_subdetail['final_amount'] != ''){
									 $final_tot_amount += $abstract_subdetail['final_amount'];   
									}
									  $sno++;
										endforeach; ?>
								</tbody>
								<tfoot>
								   <tr>
									  <th colspan="3" style="text-align:right;"></th>
									  <th ><?php //echo ($tot_amount)?ltrim($fmt->formatCurrency((float)$tot_amount,'INR'),'₹'):'0.00';  ?></th>						
									  <th></th>
									  <th style="text-align:right;">Total  (in Rs) &nbsp;</th>
									  <th>
									   <?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly','value'=>($final_tot_amount)?$final_tot_amount:'']) ?>

									  </th>
								  </tr>
							   </tfoot>
							</table>
					 </div> 
                     <div class="form-body row">
					    <h4 class = "sub-tile">Contract Agreement Details</h4> 
                         <!--legend class="bol" style="color: #0047AB; text-align: center;">Contract Agreement Details</legend-->
                         <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;">

                             <div class="form-body row">
                                 <div class="col-md-12">
                                     <?php if ($contractor_detail_count == 0) { ?>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Contractor /Company<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_id', ['empty' => 'Select Contractor/Company', 'class' => 'form-select select2', 'options' => $contractor_type, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required','onchange'=>'get_details(this.value)']); ?>

                                             </div>                                            
                                         </div>
										 <div class="form-group row contractor" style="display:none;">
										    <label class="control-label col-md-3">Contractor Mobile No<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_mobile_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','disabled']); ?>
                                             </div>
                                              <label class="control-label col-md-3">Contractor Email<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('contractor_email', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','disabled']); ?>
                                             </div>                                          
                                         </div>
										 <div class="form-group row contractor" style="display:none;">  
										    <label class="control-label col-md-3">GST No<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('gst_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','disabled']); ?>
                                             </div>
                                              <label class="control-label col-md-3">Contractor Address<span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('address', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea','rows'=>3,'disabled']); ?>  
                                             </div>                                          
                                         </div>
										 
										  <div class="form-group row">
										    <label class="control-label col-md-3">Work Order Reference No<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('work_order_refno', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                             </div>
                                             <label class="control-label col-md-3">Work Order Copy <span class="required"> *  <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only) </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('work_order_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                             </div>                                            
                                         </div>
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement No. <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'agreement_no', 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                             </div>
                                             <label class="control-label col-md-3">Agreement Date<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                             </div>
                                         </div>
										   <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Period. <span class="required"> * </span></label>
                                             <div class="col-md-9">
                                                 <?php echo $this->Form->control('agreement_period', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
                                             </div>
                                             <!--label class="control-label col-md-3">Agreement Date<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                             </div-->
                                         </div>
                                         <!--div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Period From <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_fromdate', ['class' => 'form-control datepicker1', 'label' => false, 'error' => true, 'onchange' => 'validdocs(this)']); ?>
                                             </div>
                                             <label class="control-label col-md-3">Agreement Period To<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_todate', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                             </div>
                                         </div-->
                                         <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Copy <span class="required"> *  <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only) </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>
                                             </div>

                                             <label class="control-label col-md-3">Agreement Amount (in Rs.) <span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'id' => 'agreement_amount', 'value' => $contractor_details['agreement_amount'], 'type' => 'text', 'onblur' => 'calculation(this.value)']); ?>
                                             </div>
                                         </div>                                     
                                         <div class="form-group row" id="calc_perc">
                                             <label class="control-label col-md-3">Percentage(%) <span class="required"></span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('perc_deduction', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'perc_deduction', 'label' => false, 'error' => false, 'type' => 'text', 'readonly']); ?>
                                             </div>
                                         </div>
                                         <?php } elseif ($contractor_detail_count > 0) {
                                            if ($projectWorkSubdetail['tender_detail_flag'] == 0) {  ?>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Contractor / Company Name<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('contractor_id', ['class' => 'form-select', 'options' => $contractor_type, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required']); ?>
                                                     <?php echo $this->Form->control('id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $contractor_details['id']]) ?>
                                                 </div>
                                             </div>
											   <div class="form-group row">
											    <label class="control-label col-md-3">Work Order Reference No <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $this->Form->control('work_order_refno', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $contractor_details['work_order_refno'], 'type' => 'text']); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Work Order Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $this->Form->control('work_order_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                                     <?php if ($contractor_details['work_order_copy'] != '') {  ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/WorkOrders/' . $contractor_details['work_order_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement No.<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'agreement_no', 'label' => false, 'error' => false, 'value' => $contractor_details['agreement_no'], 'type' => 'text']); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Date<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'value' => date('d-m-Y', strtotime($contractor_details['agreement_date'])), 'required']); ?>
                                                 </div>
                                             </div>
                                             <!--div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement Period From <span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_fromdate', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => date('d-m-Y', strtotime($contractor_details['agreement_fromdate'])), 'required']); ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Period To<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_todate', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => date('d-m-Y', strtotime($contractor_details['agreement_todate'])), 'required']); ?>
                                                 </div>
                                             </div-->
											    <div class="form-group row">
                                             <label class="control-label col-md-3">Agreement Period. <span class="required"> * </span></label>
                                             <div class="col-md-9">
                                                 <?php echo $this->Form->control('agreement_period', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','value'=>$contractor_details['agreement_period']]); ?>
                                             </div>
                                             <!--label class="control-label col-md-3">Agreement Date<span class="required"> * </span></label>
                                             <div class="col-md-3">
                                                 <?php echo $this->Form->control('agreement_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                             </div-->
                                         </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement Copy <span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                                                     <?php if ($contractor_details['agreement_copy'] != '') {  ?>
                                                         <?php echo $this->Form->control('agreement_copy1', ['label' => false, 'error' => true, 'type' => 'hidden', 'value' => $contractor_details['agreement_copy']]); ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $contractor_details['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Agreement Amount (in Rs.)<span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('agreement_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'agreement_amount', 'label' => false, 'onblur' => 'calculation(this.value)', 'error' => false, 'value' => $contractor_details['agreement_amount'], 'type' => 'text']); ?>
                                                 </div>
                                             </div>
                                           
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3"> Percentage(%) <span class="required"> * </span></label>
                                                 <div class="col-md-3">
                                                     <?php echo $this->Form->control('perc_deduction', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'id' => 'perc_deduction', 'label' => false, 'error' => false, 'placeholder' => 'Percentage Calculation', 'readonly', 'required', 'type' => 'text', 'value' => $contractor_details['perc_deduction']]); ?>
                                                 </div>
                                             </div>
                                        <?php } else { ?>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Contractor / Company Name<span class="required"> &nbsp;&nbsp;:</span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['contractor_name']; ?>

                                                 </div>
                                                 <!--label class="control-label col-md-3">Contact Mobile No <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['contractor_mobile_no']; ?>
                                                 </div-->
                                             </div>
											  <div class="form-group row">
											    <label class="control-label col-md-3">Work Order Reference No <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['work_order_refno']; ?>
                                                 </div>
                                                 <label class="control-label col-md-3">Work Order Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php if ($contractor_details['work_order_copy'] != '') {  ?>
                                                         <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/WorkOrders/' . $contractor_details['work_order_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                 <ion-icon name="document-text-outline"></ion-icon>View
                                                             </span></a>
                                                     <?php   }  ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Agreement No. <span class="required"> &nbsp;&nbsp;: </span></label>
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
                                                 <label class="control-label col-md-3">Agreement Amount <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['agreement_amount']; ?>
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label class="control-label col-md-3">Percentage(%) <span class="required"> &nbsp;&nbsp;: </span></label>
                                                 <div class="col-md-3 lower">
                                                     <?php echo $contractor_details['perc_deduction']; ?>
                                                 </div>
                                             </div>
                                     <?php }
                                        } ?>
                                 </div>

                             </div>
                         </fieldset>
                     </div>
                 </div>
                 <?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) {  ?>
                     <div class="form-group" style="padding-top: 5px;">
                         <div class="offset-md-5 col-md-10">
                             <button type="submit" class="btn btn-info m-r-20">Submit</button>
                             <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                         </div>
                     </div>
                 <?php  } else { ?>
                     <div class="form-group" style="padding-top: 5px;">
                         <div class="offset-md-5 col-md-10">
                             <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
                         </div>
                     </div>
                 <?php } ?>
             </div>
         </div>
   </div>
 </div>
     <?php echo $this->Form->End(); ?>

     <script>
         function calculation(val) {
             var tender = <?php echo ($projectTenderDetail['tender_amount']) ? $projectTenderDetail['tender_amount'] : 0 ?>;
             var agreement = $("#agreement_amount").val();
              // alert(tender);
              // alert(agreement);

             if (agreement > tender) {
                 var calc = Math.round((parseFloat(agreement - tender) / tender) * 100);
                 $("#perc_deduction").val('+' + calc);
             } else if (agreement < tender) {
                 var calc = Math.round((parseFloat(tender - agreement) / tender) * 100);
                 $("#perc_deduction").val('-' + calc);
             } else if (agreement == tender) {
                 //var calc = Math.round((parseFloat(tender - agreement) / tender) * 100);
                 $("#perc_deduction").val(0);
             }
         }


         $('.datepicker1').flatpickr({
             dateFormat: "d-m-Y",
             allowInput: false
         });
		 
		 jQuery.validator.addMethod("greaterThan", 
			function(value, element, params) {

				if (!/Invalid|NaN/.test(new Date(value))) {
					return new Date(value) > new Date($(params).val());
				}

				return isNaN(value) && isNaN($(params).val()) 
					|| (Number(value) > Number($(params).val())); 
			},'Must be greater than {0}.');

         $("#FormID").validate({
             rules: {
                 'contractor_id': {
                     required: true
                 },
                 'contractor_mobile_no': {
                     required: true
                 },
                 'agreement_no': {
                     required: true
                 },
                 'agreement_date': {
                     required: true
                 },
                 'agreement_copy': {
                     <?php if ($contractor_detail_count == 0) { ?>
                         required: true
                     <?php } else { ?>
                         required: false
                     <?php } ?>
                 },
                 'agreement_fromdate': {
                     required: true,
					 //greaterThan: "#agreement-date"
                 },
                 'agreement_todate': {
                     required: true,
					 greaterThan: "#agreement-fromdate"
                 },
                 'agreement_period': {
                     required: true
                 },
                 'agreement_amount': {
                     required: true
                 },
                 'work_order_refno': {
                     required: true
                 },
                 'work_order_copy': {
                    <?php if ($contractor_detail_count == 0) { ?>
                         required: true
                     <?php } else { ?>
                         required: false
                     <?php } ?>
                 }
             },
             messages: {
                 'contractor_id': {
                     required: "Select Contractor /Company"
                 },
                 'contractor_mobile_no': {
                     required: "Enter Contractor Mobile No"
                 },
                 'agreement_no': {
                     required: "Enter Agreement No"
                 },
                 'agreement_date': {
                     required: "Select Agreement Date"
                 },
                 'agreement_copy': {
                     required: "Select Agreement Copy"
                 },
                 'agreement_fromdate': {
                     required: "Select Agreement fromdate",
					 greaterThan: "should be greater than Agreement Date"
                 },
                 'agreement_todate': {
                     required: "Select Agreement todate",
					  greaterThan: "should be greater than Agreement fromdate"
                 },
                 'agreement_period': {
                     required: "Enter Agreement Period"
                 },
                 'agreement_amount': {
                     required: "Enter Agreement amount"
                 },
                 'work_order_refno': {
                     required: "Enter Work Order Reference No."
                 },
                 'work_order_copy': {
                     required: "Select Work Order Copy"
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
                         url: '<?php echo $this->Url->webroot ?>/projectTenderDetails/ajaxproject/' + financialID,
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
	
	
	function product(count) {
	var count;
    var num1 = parseFloat(document.getElementById("q_"+count).value);
    var num2 = parseFloat(document.getElementById("r_"+count).value);

	
	if(isNaN(num1) && isNaN(num2)){
		var n1 = 0;
		var n2 = 0;
	}else{	
		if (!isNaN(num1)) {
		   var n1 = parseFloat(document.getElementById("q_"+count).value);
		}else{
			var n1 = 1;
		}

		if (!isNaN(num2)) {
			var n2 = parseFloat(document.getElementById("r_"+count).value);
		}else{
			var n2 = 1;
		}	
	}	
	
    var tot = (n1*n2);
    //alert(tot);  
    if (tot >= 0) {
		if(tot > 0){
        document.getElementById("cal_total_"+count).value = tot.toFixed(2);
		}else{
		document.getElementById("cal_total_"+count).value = tot;	
		}
		calculateTotal();
    }
}

function calculateTotal(){	
	 var amount = 0;
	   $(".divided_amount").each(function() {       
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }			 
		});
		

		 if (!isNaN(amount)) {
		
		$('#total-amount').val(amount.toFixed(2));
		$('#agreement_amount').val(amount.toFixed(2));
		 calculation();
		
		}else{
			
		$('#total-amount').val('');

		}		
	}
	
	
	function get_details(id){		
	
	   if (id !='') {
	    $('.contractor').show();	
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxcontractordetails/'+id,
                success: function(data, textStatus) { //alert(data);
                     //$('#project').html(data);
					 
					 var detail = JSON.parse(data);
					$('#contractor-mobile-no').val(detail.mobile_no);
					$('#contractor-email').val(detail.email);
					$('#gst-no').val(detail.gst_no);
					$('#address').val(detail.address);
                }
            });
        }else{
			 $('.contractor').hide();	
			 
			        $('#contractor-mobile-no').val('');
					$('#contractor-email').val('');
					$('#gst-no').val('');
					$('#address').val('');


		}			
	}
     </script>