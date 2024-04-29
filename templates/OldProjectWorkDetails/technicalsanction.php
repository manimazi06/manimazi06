 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
		<div class="card-body">
				 <h4 class = "sub-tile"><?php echo $projectwork['project_name']; ?></h4>
		
        </div>
        </div>
    </div>
</div><br>
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
	<?php //if($work_type == 1){  ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Administrative<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'administrativesanction', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	<?php //} ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Detailed<br>Estimate'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php if($work_type == 1 && $oldProjectWorkDetail['skip_fs_flag'] == 0){  ?>  
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
                 <?php echo $this->Form->create($projectDevelopmentWorkDetail, ['id' =>'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Project Abstract / Technical Sanction Details	
				
				
				</header>
				<div class= "tools">
				  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>&nbsp;View Items Codes with Description'), ['controller'=>'NewBuildingItems','action' => 'index'], ['escape' => false, 'class' => ' btn btn-info','target'=>'_blank']); ?>

				</div>
            </div>			
			
			<?php  if($detailed_approval_stages_count > 0){  ?> 
			 <div class="card-body"> 
                   <h4 class = "sub-tile">Abstract Approval Stages</h4>			 
					<!--legend class="bol" style="color: #0047AB; text-align: center;"></legend-->  
			         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width:98%" bgcolor="white">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No</th>
									<th style="width:10%">Date</th>
									<th style="width:10%">Status</th>
									<th style="width:10%">Process</th>
									<th style="width:10%">Remarks</th>
								</tr>
							</thead>
							<tbody>							
				
								<?php $sno = 1;
								foreach ($detailed_approval_stages as $detailed_approval) : ?>
									<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo date('d-m-Y',strtotime($detailed_approval['submit_date'])); ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['approval_status']['name']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['current_status']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_approval['remarks']; ?></td>
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>							
						</table>
                    </fieldset>						
             </div>
			 <?php } ?>
            <div class="card-body addpage">
                <div class="col-md-12">
                    <div class="form-body row"> 
			          <h5 style="color:red;"><b>* If Item code/ Description not present please contact Admin of Head office</b></h5>
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
											  <!--button type="button" class="btn btn-primary btn-xs" onclick="showdescription(0);"><i class="fa fa-pencil"></i>Description</button-->
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
										   	<button type="button" class="btn btn-success btn-xs" onclick="pageadding(1);"><i class="fa fa-plus-circle"></i>Add Code</button><br>
											<!--button type="button" class="btn btn-danger btn-xs" onclick="pageadding(2);"><i class="fa fa-plus-circle"></i>Add Description</button-->
										
										   
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

        </div>
    </div>
</div>
<style>
.mdl-tabs__tab.tabs_three:hover {
    color: #6610f2 !important;
}

a.mdl-tabs__tab.tabs_three {
    max-width: 20%;
}
</style>
<?php if($abstractcount > 0 && $subabstractcount > 0){  ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Abstract Details</header>
				<div class="btn-group pull-right">
					<button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Download
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right">
						<li>
							<a onClick="print_receipt('div_vc')">
								<i class="fa fa-print"></i> Print </a>
						</li>
						<li>
							<a id="export_excel_button">
								<i class="fa fa-file-excel-o"></i> Export to Excel </a>
						</li>
					</ul>
				</div><br>
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">				
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">                              
                                    <div class="table-scrollable">
                                        <table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width:1%">S.no</th>
													<th style="width:5%">Item code</th>
													<th style="width:5%">New Item code</th>
													<th style="width:45%">Item Description</th>
													<th style="width:7%">Quantity</th>
													<th style="width:7%">Unit</th>
													<th style="width:7%">Rate</th>
													<th style="width:10%">Amount <br>(in Rs.)</th>
                                                    <th style="width:3%">Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                    foreach ($abstract_subdetails  as $abstract_subdetail) : ?>
													<tr class="odd gradeX">
														<td class="text-center"><?php echo $sno; ?></td>
														<td class="title"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
														<td class="title"><?php echo ($abstract_subdetail['new_item_code'])?$abstract_subdetail['new_item_code']:'' ?></td>
														<td class="title"><?php echo ($abstract_subdetail['new_item_description'])?$abstract_subdetail['new_item_description']:$abstract_subdetail['item_description'] ?></td>
														<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['quantity'] ?></td>
														<td class="title" style="text-align:center;"><?php echo $abstract_subdetail['unit']['name'] ?></td>
														<td class="title" style="text-align:right;"><?php echo $abstract_subdetail['rate'] ?></td>
														<td class="title" style="text-align:right;"><?php echo ($abstract_subdetail['amount'] != 0)?$abstract_subdetail['amount']:''; ?></td>
														<td class="text-center">
															<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'projectabstractedit',$id,$pid,$work_id,$abstract_subdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?><br><br>
															<?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'projectabstractdelete',$id,$pid,$work_id,$abstract_subdetail['id']], ['confirm' => __('Are you sure you want to delete item code - {0}? after deletion click on save and continue to reflect on technical sanction',  $abstract_subdetail['new_item_code']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?>
														</td>
													</tr>
                                                <?php $sno++;
                                                    endforeach; ?>
                                            </tbody>
											<tfoot>  
												<tr>
												   <td colspan="7" style="text-align:right"><b>SUB TOTAL I (in Rs.)</b>&nbsp;&nbsp;</td>
												   <td style="text-align:right"><?php echo ($tot_amount)?ltrim($fmt->formatCurrency((float)($tot_amount)?$tot_amount:0,'INR'),'₹'):'0.00'; ?>&nbsp;
												   	<?php echo $this->Form->control('sub_total_1', ['label' => false, 'error' => false, 'type' => 'hidden','id'=>'sub_total_1','value'=>($tot_amount)?$tot_amount:0,'readonly']); ?>
												   </td>
												   <td></td>
												</tr>
											</tfoot>
                                        </table>
										<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
										  <tr>
										     <th style="width:80%;">GST at 18% (SGST at 9%+ CGST at 9%)</th>
										     <td style="width:20%;">
											     <?php echo $this->Form->control('gst_at_18', ['class' => 'form-control amount ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'gst_18','onkeyup'=>'addsubtotal_2()','value'=>($abstract_detail['gst_at_18'])?$abstract_detail['gst_at_18']:$technical['gst']]); ?>
											 </td>
										  </tr>
										  <tr>
										   <th style="text-align:right;width:80%;"><b>SUB TOTAL II (in Rs.)</b>&nbsp;&nbsp;</th>
										   <td style="text-align:right;width:20%;">
										   		 <?php echo $this->Form->control('sub_total_2', ['class' => 'form-control ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'sub_total_2','readonly','value'=>($abstract_detail['sub_total_2'])?$abstract_detail['sub_total_2']:$tot_amount]); ?>
										   </td>
										  </tr>
										</table><br>
										<center><button type="button" class="btn btn-danger btn-xs" onclick="addnorms();"><i class="fa fa-plus-circle"></i>Add Description / Amount</button></center><br>
										<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
										  <tbody class="adding_norms">
										  <?php if($additional_count > 0){  
										   foreach($additional_details as $key1 =>$additional){										  
										   ?>										  
										    <tr class="row_remove_norms<?php echo $key1 ?> present_row_in_norms">
												<td style="width:6%;text-align:center;">
													<a onclick='deleterow(<?php echo $key1 ?>,<?php echo $additional['id']; ?>);' title="delete">
														<button class="btn btn-danger btn-xs" style="margin-left:2px;width:52px;">Delete</button>
													</a>
												</td>
												<td style="width:4%;"><?php echo $key1 + 1; ?></td>
												<td style="width:70%;">
													<?php echo $this->Form->control('norms.'.$key1.'.description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'empty' => '-Select-','data-rule-required'=>true,'data-msg-required'=>'Enter Description','value'=>$additional['description']]); ?>
													<?php echo $this->Form->control('norms.'.$key1.'.additional_id', [ 'label' => false, 'error' => false, 'type'=>'hidden','value'=>$additional['id']]); ?>
												</td>	
												<td style="width:20%;">
													<?php echo $this->Form->control('norms.'.$key1.'.amount', ['class' => 'form-control amount normamount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','onkeyup'=>'addsubtotal_3()','id'=>'amount_'.$i.'','value'=>$additional['amount']]); ?>
												</td>   
											</tr>										        
										   <?php  } } ?>
										  </tbody>
										  <tr>
										   <th style="text-align:right;width:80%;" colspan="3"><b>SUB TOTAL III (in Rs.)</b>&nbsp;&nbsp;</th>
										   <td style="text-align:right;width:20%;">
										   		 <?php echo $this->Form->control('sub_total_3', ['class' => 'form-control ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'sub_total_3','readonly','value'=>($abstract_detail['sub_total_3'])?$abstract_detail['sub_total_3']:$tot_amount]); ?>
										   </td>
										  </tr>
										</table>
										<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
										  <tr>
										     <th style="width:60%;">Labour Welfare fund at 1%</th>
											 <td style="width:20%;">As Per PWD Norms</td>
										     <td style="width:20%;">
											    <?php echo $this->Form->control('labour_welfare', ['class' => 'form-control amount ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'labour_welfare_fund','onkeyup'=>'addtotal()','value'=>($abstract_detail['labour_welfare'])?$abstract_detail['labour_welfare']:0]); ?>
											 </td>
										  </tr>
										  <tr>
										     <th style="width:60%;">Provision for Contigency Petty Supervision Charge at 2.5%</th>
											 <td style="width:20%;">As Per PWD Norms</td>
										     <td style="width:20%;">
											    <?php echo $this->Form->control('contigency_petty_supervision_1', ['class' => 'form-control amount ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'supervision_charges_1','onkeyup'=>'addtotal()','value'=>($abstract_detail['contigency_petty_supervision_1'])?$abstract_detail['contigency_petty_supervision_1']:0]); ?>
											 </td>
										  </tr>
										  <tr>
										     <th style="width:60%;">Supervision Charge at 7.5%</th>
											 <td style="width:20%;">As Per PWD Norms</td>
										     <td style="width:20%;">
											    <?php echo $this->Form->control('supervision_2', ['class' => 'form-control amount ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'supervision_charges_2','onkeyup'=>'addtotal()','value'=>($abstract_detail['supervision_2'])?$abstract_detail['supervision_2']:0]); ?>
											 </td>
										  </tr>
										  <tr>
										     <th style="width:60%;">GST at 18% for Supervision Charges 7.5%</th>
											 <td style="width:20%;"></td>
										     <td style="width:20%;">
											      <?php echo $this->Form->control('gst_supervision_2', ['class' => 'form-control amount ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'gst_supervision_charges_2','onkeyup'=>'addtotal()','value'=>($abstract_detail['gst_supervision_2'])?$abstract_detail['gst_supervision_2']:0]); ?>
											 </td>
										  </tr>
										  <tr>
										   <th colspan="2" style="text-align:right;width:80%;"><b>TOTAL (in Rs.)</b>&nbsp;&nbsp;</th>
										   <td style="text-align:right;width:20%;">
										   		 <?php echo $this->Form->control('total', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'total','readonly','value'=>($abstract_detail['total'])?$abstract_detail['total']:$tot_amount]); ?>
										   </td>
										  </tr>
										</table>
										<table class="table  table-bordered table-checkable order-column" style="width: 100%" >
										  <tr>
										     <th style="width:80%;">Advertisement Charges</th>
										     <td style="width:20%;">
											     <?php echo $this->Form->control('advertisement', ['class' => 'form-control ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'advertisement','onkeyup'=>'addgrandtotal()','value'=>($abstract_detail['advertisement'])?$abstract_detail['advertisement']:0]); ?>
											 </td>
										  </tr>
										  <tr>
										   <th style="text-align:right;width:80%;"><b>Grand TOTAL (in Rs.)</b>&nbsp;&nbsp;</th>
										   <td style="text-align:right;width:20%;">
										   		 <?php echo $this->Form->control('grand_total', ['class' => 'form-control ', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'grand_total','readonly','value'=>($abstract_detail['grand_total'])?$abstract_detail['grand_total']:$tot_amount]); ?>
										   </td>
										  </tr>
										</table>
                                    </div>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br><br>
				<center><button type="button" class = 'btn btn-primary btn-sm' onclick="loadtechnicalsanction();"><i class="fa fa-pencil"></i>Click for Technical Sanction</button></center><br>
				<!--a onclick="loadtechnicalsanction();">Technical Sanction</a-->
				<div id ="technical" <?php if($technical['sanction_no'] == ''){  ?> style= "display:none;" <?php } ?>>
				 <h4 class = "sub-tile">Technical Sanction :</h4> 
                 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
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
								<?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','value'=>($technical['amount'])?$technical['amount']:$tot_amount,'id'=>'technical_sanction','readonly']) ?>
							 </div>
							 <!--label class="control-label col-md-2 bol">GST Amount <br>(in Rs.)<span class="required"></span></label>
							 <div class="col-md-4">
								<?php //echo $this->Form->control('gst', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter gst','required','value'=>($technical['gst'])?$technical['gst']:0.00]) ?>
							 </div-->
							 
						 </div>
						 <div class="form-group row">
							 <label class="control-label col-md-2 bol">Description <span class="required"> </span></label>
							 <div class="col-md-4">
								 <?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'value' => $technical['description']]) ?>
							 </div>
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
			  </fieldset>
              </div>
            </div>
        </div>
		    <div class="form-group" style="padding-top: 10px;">
				<div class="offset-md-5 col-md-10">
					<?php echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>					
					<button type="submit" class="btn btn-success" onclick="setvalue()">Save and Continue</button>
				</div>
			</div>
    </div>
</div>
<?php } ?>
 <?php echo $this->Form->End(); ?>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
            <tr>
                <td style='text-align:center' colspan="7">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
			<tr class="text-center">
				<th style="width:1%">S.no</th>
				<th style="width:7%">Item code</th>
				<th style="width:50%">Item Description</th>
				<th style="width:10%">Quantity</th>
				<th style="width:10%">Unit</th>
				<th style="width:10%">Rate</th>
				<th style="width:10%">Amount</th>
			</tr>
		<tbody>
			<?php $sno = 1;
				foreach ($abstract_subdetails  as $abstract_subdetail) : ?>
				<tr class="odd gradeX">
					<td class="text-center"><?php echo $sno; ?></td>
					<td class="title"><?php echo ($abstract_subdetail['new_item_code'])?$abstract_subdetail['new_item_code']:'' ?></td>
					<td class="title"><?php echo ($abstract_subdetail['new_item_description'])?$abstract_subdetail['new_item_description']:'' ?></td>
					<td class="title"><?php echo $abstract_subdetail['quantity'] ?></td>
					<td class="title"><?php echo $abstract_subdetail['unit']['name'] ?></td>
					<td class="title"><?php echo $abstract_subdetail['rate'] ?></td>
					<td class="title" style="text-align:right"><?php echo ($abstract_subdetail['amount'] != 0)?$abstract_subdetail['amount']:''; ?></td>					
				</tr>
			<?php $sno++;
				endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
			   <td colspan="6" style="text-align:right"><b>Total (in Rs.)</b>&nbsp;&nbsp;</td>
			   <td style="text-align:right"><b><?php echo ($tot_amount)?$tot_amount:'0.00'; ?></b>&nbsp;</td>
			</tr>
		</tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
$(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>
<script>
$(document).ready(function() {
	 addsubtotal_2();
  });


function addsubtotal_2(){
	var sub_total_1 = $('#sub_total_1').val()? $('#sub_total_1').val() : 0;
	var gst         = $('#gst_18').val()? $('#gst_18').val() : 0;
	//alert(sub_total_1);
	//alert(gst);
    var tot_2       = parseFloat(sub_total_1)+parseFloat(gst);
	//alert(tot_2);
	$('#sub_total_2').val(tot_2.toFixed(2));
	//$('#total').val(tot_2.toFixed(2));
	//$('#sub_total_3').val(tot_2.toFixed(2));
	addsubtotal_3();
}


function addsubtotal_3(){
	
		 var amount = 0;
	   $(".normamount").each(function() {
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }
			 
		});
		
		var  sub_total_2 = $('#sub_total_2').val();
		//var  total = $('#total').val()?$('#total').val():0;
		
		var tot = parseFloat(sub_total_2)+parseFloat(amount);
		
		//alert(amount);
		 if(!isNaN(amount)){
		
		$('#sub_total_3').val(tot.toFixed(2));
		//$('#total').val(tot.toFixed(2));
		
		}else{
			
		$('#sub_total_3').val(sub_total_2.toFixed(2));

		}
	  addtotal();
	
	
}


function addtotal(){
	
	var  sub_total_3 = $('#sub_total_3').val();
	  
	var labour_welfare_fund    = $('#labour_welfare_fund').val()? $('#labour_welfare_fund').val() : 0;
	var supervision_charges_1  = $('#supervision_charges_1').val()? $('#supervision_charges_1').val() : 0;
	var supervision_charges_2  = $('#supervision_charges_2').val()? $('#supervision_charges_2').val() : 0;
	var gst_supervision_charges_2  = $('#gst_supervision_charges_2').val()? $('#gst_supervision_charges_2').val() : 0;
	
	var total =  parseFloat(sub_total_3)+parseFloat(labour_welfare_fund)+ parseFloat(supervision_charges_1)+parseFloat(supervision_charges_2)+ parseFloat(gst_supervision_charges_2);
	
	$('#total').val(total.toFixed(2));
	addgrandtotal();
}

function addgrandtotal(){	
	var  total = $('#total').val();
	//alert(total);	  
	var advertisement    = $('#advertisement').val()? $('#advertisement').val() : 0;	
	var grand_total =  parseFloat(total)+parseFloat(advertisement);	
	 if(!isNaN(grand_total)){	
	  $('#grand_total').val(grand_total.toFixed(2));
	  $('#technical_sanction').val(grand_total.toFixed(2));
	 }
}


function hidetechnical(){
	 $('#technical').hide(); 
}
function loadtechnicalsanction(){
	 $('#technical').toggle();
	
}
function setvalue(){ 
    $('#technical').show(); 

		if(confirm('Are you sure for final submit')){		
			$('.addpage').hide();
			$('#completed-flag').val(1);
			$("#FormID").validate({
			rules: {
				'detailed_estimate_upload': {
					<?php if ($technical['detailed_estimate_upload'] != '') {   ?>
					required: false
					<?php } else {   ?>
					required: true
					<?php } ?>
				},
				'description': {
					required: true
				},
				'amount': {
					required: true
				},
				'sanctioned_date': {
					required: true
				},
				'description': {
					required: true
				},
				'sanction_no': {
					required: true
				}
			},

			messages: {
				'detailed_estimate_upload': {
					required: " Select File Upload"
				},
				'description': {
					required: "Enter Description"
				},
				'amount': {
					required: "Enter Amount"
				},
				'sanctioned_date': {
					required: "select sanctions date"
				},
				'description': {
					required: "Enter Description"
				},
				'sanction_no': {
					required: "Enter Sanction No."
				}
			},
			submitHandler: function(form) {
				  form.submit();
                  $(".btn").prop('disabled', true);				  
			}
		});            	  
	}else{
		$('#technical').hide(); 
	  return false;	
	}	

}

$("#FormID").validate({
    rules: {
        'development_work_id': {
            required: true
        }
    },
    messages: {
        'development_work_id': {
            required: "Select Development Work"
        }
    },
    submitHandler: function(form) {
        form.submit();
        $(".btn").prop('disabled', true);
    }
});

function pageadding(type) {
	var type;
    var j = ($('.present_row_in_post').length);
    var row_no = j - 1;
    var code = $("#workdetail-"+row_no+"-item-description").val();
	//alert(code);
    if (code != '') {
        if (document != '' || document1 != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectdevelopmentwork/' +
                    j+'/'+type,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    $('.adding').append(data);
                }
            });
        }
    }else if (code == '') {
        alert("Select Item Code");
        $("#workdetail-"+row_no+"-building-item-id").focus();
    }
}  



function addnorms() {
    var j = ($('.present_row_in_norms').length);
	//alert(j);
    //var row_no = j - 1;
	//alert(code);
		$.ajax({
			async: true,
			dataType: "html",
			url: '<?php echo $this->Url->webroot ?>/OldProjectWorkDetails/ajaxaddnorm/' +
				j+'/'+type,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
			},
			success: function(data, textStatus) {
				$('.adding_norms').append(data);
			}
		});
  
}  

function descriptionid(id,count) {
    var id;
    if (id != '') {
        $.ajax({
            async: true,
            dataType: "html",
            url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxitemcode/' + id,

            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data, textStatus) {
                var detail = JSON.parse(data);
                $('#description_'+count).val(detail.item_description);
                $('#item_code_'+count).val(detail.item_code);
            }
        });
    }
}



function product(count) {
	var count;
    var num1 = parseFloat(document.getElementById("q_"+count).value);
    var num2 = parseFloat(document.getElementById("r_"+count).value);
	
	
	if(isNaN(num1) && isNaN(num2)){
		var n1 = 0;
		var n2 = 0;
		//alert('hi');
	}else{	
	   	//alert('hi da');
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

 $(document).ready(function() {
	

        $(function() {
            $("#export_excel_button").click(function() {
                $("#export_excel_button").removeClass("model-head");
                var filename = $(this).attr("title");
                var uri = $("#report").btechco_excelexport({
                    containerid: "report",
                    datatype: $datatype.Table,
                    returnUri: true
                });

                $(this).attr('download',
                        "Abstract.xls"
                    ) // set file name (you want to put formatted date here)
                    .attr('href', uri) // data to download
                    .attr('target', '_blank') // open in new window (optional)
            });



        });
    });
	
	   function print_receipt() {
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
    }
	
	function showdescription(){
		var type = $('#type').val();
		if(type == 0){
			$('.description').show();
			$('.nodescription').hide();
			$('#type').val(1);
		}else{
			$('.description').hide();
			$('.nodescription').show();
			$('#type').val(0);
			
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
		
		}else{
			
		$('#total-amount').val('');

		}		
	}
	
	function validdocs(oInput) {
    var _validFileExtensions = [".pdf", ".jpg",".jpeg",".png"];
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
        if (file_size >= 8388608) {
            alert("File Maximum size is 8MB");
            oInput.value = "";
            return false;
        }

    }
    return true;
}


function deleterow(i,id){
  if (confirm('Are you Sure You want to delete?')) {
  var id;
  var i;	 
  //var machinery_id =  $('#raw-'+i+'-utility-id').val();
   $.ajax({
		async: true,
		dataType: "html",
		url: '<?php echo $this->Url->webroot ?>/OldProjectWorkDetails/deletenorm/'+ id,
		beforeSend: function(xhr) {
			xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
		},
		success: function(data, textStatus) { //alert(data);
		   if(data == 1){			
			  $('.row_remove_norms'+i).remove();
			  addsubtotal_3();
			  alert('Please click on save and continue to Reflect on Technical Sanction Amount');
			  $('#sub_total_3').focus();
			// location.reload(true);
		   }else{
				alert('Unable to Delete');
			}
		}
	});
  }		  
}
</script>