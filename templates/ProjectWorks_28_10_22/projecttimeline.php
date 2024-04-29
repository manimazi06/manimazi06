<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
<?php echo $this->Form->create($projectTimelineDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add ProjectTimelineDetail</header>
        </div>
        <div class="card-body">
            <!--h4 class = "sub-tile">Project Details:</h4-->
          <div class="card-body">       
				   <!--h4 class = "sub-tile">Project Details:</h4-->				  
				    <legend class="bol" style="color: #0047AB; text-align: center;">Project Details</legend>
                   
				 	 	<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
				 <div class="col-md-12">
				    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Project Code <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['project_code']; ?>              
                        </div>
                        <label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo $projectWork['project_name']; ?>   
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['department']['name']; ?>                       
					   </div>
                        <label class="control-label col-md-2 bol">Financial Year <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['financial_year']['name']; ?>              
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['building_type']['name']; ?>              
                        </div>
                        <label class="control-label col-md-2 bol">Project Status<span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						    <?php  echo $projectWork['project_status']['name']; ?>              
                        </div>
                    </div>                 
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Rough Cost (Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower"> 
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
                         </div>
                        <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>              
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['scheme_type']['name']; ?>              
                        </div>
						<label class="control-label col-md-2 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>                  
					
                    </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                        </div>						
                    </div>
					
                </div>
               </fieldset>		 
		</div> 
		<div class="card-body">
		<?php   if ($administrativesanctioncount > 0) {   ?>
			    <?php   //if (count($administrativesanction) > 0) {   ?>
					  <legend class="bol" style="color: #0047AB; text-align: center;">Administrative Sanction Details</legend>

				      <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                         <div class="col-md-12" style="margin-top:">
						   <div class="form-group row">
							  <label class="control-label col-md-2 bol">GO No. <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
									<?php  echo $administrativesanction['go_no']; ?>                       
							   </div>
								<label class="control-label col-md-2 bol">GO Date <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
								  <?php  echo date('d-m-Y',strtotime($administrativesanction['go_date'])); ?>              
								</div>
							</div>
							
							<div class="form-group row">
							  <label class="control-label col-md-2 bol">GO Upload <span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
									<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $administrativesanction['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a>                    
							   </div>
								<label class="control-label col-md-2 bol">Sanctioned Amount<span class="required"> &nbsp;&nbsp;: </span></label>
								<div class="col-md-4 lower">
								 <?php  echo ($administrativesanction['sanctioned_amount'])?ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'],'INR'),'₹'):'0.00'; ?>               
								</div>
							</div>                                  
                         </div>
					</fieldset><br><br>
                        <legend class="bol" style="color: #0047AB; text-align: center;">Divisionwise Amount Sanction Details</legend>					
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">                               
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;" bgcolor="white">
                                        <thead>
                                            <tr align="center">
                                                <th style="width:5%"> S.No</th>
                                                <th style="width:20%">Division</th>
											    <th style="width:20%">Circle</th>
                                                <th style="width:20%">Amount</th>
                                                <th style="width:10%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										   <?php
                                            $i = 0;
                                            //foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>										
											     <td class="trcount"><?php echo $i + 1; ?></td>
                                                <td><?php echo $projectWorkSubdetail['division']['name']; ?>
											   </td>
                                                <td>
												<?php echo $projectWorkSubdetail['circle']['name']; ?>
                                               </td>                                   
                                               <td align="right"><?php echo $projectWorkSubdetail['sanctioned_amount']; ?>
											   <?php //echo $this->Form->control('sanctioned_amount', ['label' => false, 'error' => false, 'type' =>'hidden','class'=>'divided_amount','value'=>$projectWorkSubdetail['sanctioned_amount']]); ?>

                                               </td>                                                                                      
                                                <td align="center">
												  <?php  if($projectWorkSubdetail['detailed_estimate_flag'] == 1){  ?>
												  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Detailed Estimate'), ['action' => 'projectdetailedestimateadd',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
												  
												  <?php } ?>
                                                </td>							
                                                
                                            </tr>
											  <?php
                                                 $tot_sanction += $projectWorkSubdetail['sanctioned_amount'];

 											  $i++;
                                           // endforeach; ?>
                                        </tbody>
										<tfoot>
										    <tr>
											   <td colspan="3" align="right"><b>Total</b></td>
											   <td align="right"><?php echo $tot_sanction;  ?></td>
										       <td></td>
											</tr>
										</tfoot>
                                    </table>
									</div>
                                </fieldset><br>  					
				<?php } //} ?>
				<?php   if ($financialSanctionscount > 0) {  ?> 					
					<?php   //if (count($financialsanctions) > 0) {  ?> 					
						 <legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend>

				         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">                                  
							<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;"  bgcolor="white">
								<thead>
									<tr align="center">
										<th  style="width:5%"> S.No</th>
										<th style="width:20%">Reference No</th>
										<th style="width:20%">Sanctioned Date</th>
										<th style="width:20%">Sanction amount</th>
										<th style="width:20%">File Upload</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									foreach ($financialSanctions as $financialsanction) : ?>
										<tr  align="center">
											<td class="trcount"><?php echo $i + 1; ?></td>
											<td><?php echo $financialsanction['fs_ref_no']; ?></td>
											<td><?php echo date('d-m-Y', strtotime($financialsanction['sanctioned_date'])); ?></td>
											<td><?php echo $financialsanction['sanctioned_amount']; ?></td>
											<td align="center">
											<?php if($financialsanction['sanctioned_file_upload'] != ''){  ?>
												<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' .$financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                                <ion-icon name="document-text-outline"></ion-icon>View
                                                            </span></a>												
											<?php } ?>
											</td>											
										</tr>
									<?php $i++;
									endforeach; ?>
								</tbody>
							</table>
						</fieldset><br><br>					
                    <?php } //} ?>
					<?php  if($technicalcount !=0){  ?>
					    <legend class="bol" style="color: #0047AB; text-align: center;">Technical Sanction Details</legend>

				         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">                                  
						
                             <table id="answerTable" class="table  table-bordered  order-column"
                                 style="max-width: 98%;margin-left: 1%;" bgcolor="white">
                                 <thead>
                                     <tr align="center">
                                         <th style="width:5%"> S.No</th>
                                         <th style="width:20%">Sanctioned Date</th>
                                         <th style="width:20%">Sanctioned Amount</th>
                                         <th style="width:20%">Description</th>
                                         <th style="width:20%">File Upload</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $i = 0;
                                       ?>
                                     <tr  align="center">
                                         <td class="trcount"><?php echo $i + 1; ?></td>
                                         <td><?php echo date('d-m-Y',strtotime($technical['sanctioned_date'])); ?>
                                         </td>   
                                         <td><?php echo $technical['amount']; ?>
                                         </td>
                                         <td><?php echo $technical['description']; ?>
                                         </td>
                                         <td>
										   <?php  if($technical['detailed_estimate_upload'] != ''){ ?>										 
                                             <a style="color:blue;"
                                                 href="<?php echo $this->Url->build('/uploads/technicalsanctions/' . $technical['detailed_estimate_upload'], ['fullBase' => true]); ?>"
                                                 target="_blank"><span>
                                                     <ion-icon name="document-text-outline"></ion-icon>View
                                                 </span></a>
											 <?php  } ?>
                                         </td>
                                     </tr>
                                     <?php $i++;
                                       ?>
                                 </tbody>
                             </table>
                         </fieldset><br>
					 <?php } ?>
					</div>	

				<?php  if ($tenders){ ?>
				 <div class="card-body">
				   <div class="form-body row">      
				<div class="table-scrollable">
				  <legend class="bol" style="color: #0047AB; text-align: center;">Tender Details</legend>		
				   <fieldset  style="border:1px solid #00355F;border-radius:10px; padding:15px;background-color:ghostwhite;">                                  
						 
				<table class="table table-bordered order-column" style="width: 100%" bgcolor="white">
					<thead>
						<tr class="text-center">
							<th width="5%"> Sno </th>
							<th>Work ID</th>
							<th>Tender No</th>
							<th>Tender Date </th>
							<th>Tender Amount </th>
							<th>Tender Copy</th> 
						  <?php  if($projectWorkSubdetail['tender_detail_flag'] == 0){ ?>				
							<th>Actions </th>
						  <?php  } ?>
						</tr>
					</thead>
					<tbody>
						<?php $sno = 1;
						foreach ($tenders as $projectTenderDetail) : ?>
							<tr class="odd gradeX">
								<td class="text-center"><?php echo ($sno); ?></td>
								<td><?php echo $projectTenderDetail['project_work_subdetail']['work_code']; ?></td>
								<td><?php echo $projectTenderDetail['tender_no']; ?></td>
								<td class="title"><?php echo date('d-m-Y',strtotime($projectTenderDetail['tender_date'])); ?></td>
								<td class="title"><?php echo $projectTenderDetail['tender_amount']; ?> </td>
								<td class="title"><a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank">
										<ion-icon name="document-text-outline"></ion-icon>View
										</span>
									</a>
								</td>
								<?php  if($projectWorkSubdetail['tender_detail_flag'] == 0){ ?>  	
								<td class="text-center">
									<span style="overflow: visible; position: relative; width: 177px;">							
										<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'tenderdetailsedit',$id,$work_id,$projectTenderDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
										<?php echo $this->Html->link(__('<i class="fa fa-plus"></i> Contractor'), ['action' => 'addcontractor',$id,$work_id,$projectTenderDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?>
										
									</span>
								</td>                    
								<?php  } ?>				
							</tr>
						<?php $sno++;
						endforeach; ?>
					</tbody>
				</table>
				</fieldset>
			</div>
			</div>
			</div>
			<?php  } ?>
             <div class="card-body">
                    <div class="form-body row">                       
                              <legend class="bol" style="color: #0047AB; text-align: center;">Contract Agreement Details</legend>
			               <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;background-color:ghostwhite;">                              

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
                                                <?php echo date('d-m-Y',strtotime($contractor_details['agreement_date'])); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Agreement Period From <span class="required"> &nbsp;&nbsp;:</span></label>
                                            <div class="col-md-3 lower">
                                                <?php echo date('d-m-Y',strtotime($contractor_details['agreement_fromdate'])); ?>
                                            </div>
                                            <label class="control-label col-md-3">Agreement Period To<span class="required"> &nbsp;&nbsp;: </span></label>
                                            <div class="col-md-3 lower">
                                                <?php echo date('d-m-Y',strtotime($contractor_details['agreement_todate'])); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Agreement Copy <span class="required"> &nbsp;&nbsp;: </span></label>
                                            <div class="col-md-3 lower">
                                                <?php   if ($contractor_details['agreement_copy'] != '') {  ?>
                                                    <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/'.$contractor_details['agreement_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
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
					<?php if($projectWorkSubdetail['site_handover_flag'] == 1){  ?>
				
				     <div class="card-body">
                    <div class="form-body row">                       
                           <legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend>
			               <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;background-color:ghostwhite;">  
						    <div class="col-md-12">
                            <div class="form-group row">
                              
                                <label class="control-label col-md-2">Site Handover Date<span class="required">  &nbsp;&nbsp;:  </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y',strtotime($projectWorkSubdetail['site_handover_date'])); ?>
                                </div>
								  <label class="control-label col-md-2">Remarks<span class="required">  &nbsp;&nbsp;: 
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $projectWorkSubdetail['site_handover_remarks']; ?>
                                </div>
								
                            </div>                            
                           </div>		   
						   
						   </fieldset>
                      </div>                    
                </div>
				<?php  } ?>
            <div class="form-group">
			 <legend class="bol" style="color: #0047AB; text-align: center;">Project Time line Details</legend>
                <fieldset
                    style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:2px;margin-bottom:1%">
                   
                    <?php if ($ProjectTimelinecount == 0) { ?>
                        <div align="right">
                                <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i
                                        class="fa fa-plus-circle"></i> Add
                                    More</button>
                            </div><br>
                    <div class="form-group">
                        <fieldset>
                            <table id="answerTable" class="table  table-bordered  order-column"
                                style="max-width: 98%;margin-left: 2%;">
                                <thead>
                                    <tr>
                                        <th style="width:5%"> S.No</th>
                                        <th style="width:20%">Work Stage</th>
                                        <th style="width:20%">Tentative Completion Date</th>
                                        <th style="width:10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="add_doc">
                                    <tr class="present_row">
                                        <td class="trcount">1</td>
                                        <td><?php echo $this->Form->control('timeline.0.work_stage_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'empty'=>'Select work stage','options'=>$workStages, 'required']) ?>
                                            <?php echo $this->Form->control('timeline.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']) ?>
                                        </td>
                                        <td><?php echo $this->Form->control('timeline.0.tentative_completion_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Select Date']) ?>
                                        </td>
                                        <td>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <?php } elseif ($ProjectTimelinecount > 0) { ?>
                    <div class="form-group">
                        <fieldset>
                            <div align="right">
                                <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i
                                        class="fa fa-plus-circle"></i> Add
                                    More</button>
                            </div><br>
                            <table id="answerTable" class="table  table-bordered  order-column"
                                style="max-width: 98%;margin-left: 1%;">
                                <thead>
                                    <tr>
                                        <th style="width:5%"> S.No</th>
                                        <th style="width:20%">Work Stage</th>
                                        <th style="width:20%">Tentative Completion Date</th>
                                        <th style="width:10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="add_doc">
                                    <?php
                                        $i = 0;
                                        foreach ($ProjectTimeline as $ProjectTime) : ?>
										<tr class="present_row">
											<td class="trcount"><?php echo $i + 1; ?></td>

											<td><?php echo $this->Form->control('timeline.' . $i . '.work_stage_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty'=>'Select work stage','options'=>$workStages, 'required' ,'value' => $ProjectTime->work_stage_id]) ?>
											</td>

											<?php echo $this->Form->control('timeline.' . $i . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $ProjectTime->id]) ?>
											</td>
											<td><?php echo $this->Form->control('timeline.' . $i . '.tentative_completion_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Sanction Date', 'required' ,'value' => date('d-m-Y', strtotime($ProjectTime->tentative_completion_date))]) ?>
											</td>
											<td>
											</td>
										</tr>
                                    <?php $i++;  endforeach; ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <?php } ?>
                    <div class="form-group" style="padding-top: 10px">
                        <div class="offset-md-5 col-md-6">
                            <button type="submit" class="btn btn-info m-r-20">Submit</button>
                            <button type="button" class="btn btn-default"
                                onclick="javascript:history.back()">Cancel</button>
                        </div>
                    </div>
            </div>
            </fieldset>

        </div>
    </div>


    <?php echo $this->Form->End(); ?>

    <script>
	   $('.datepicker1').flatpickr({
                dateFormat: "d-m-Y",
                allowInput: false
            });
    function getaddempdoc() {
        var j = ($('.present_row').length);
        // alert(j);
        var serial_id = ($('.present_row').length - 1);
        var name = $("#timeline-" + serial_id + "-work_stage_id").val();
        var date = $("#timeline-" + serial_id + "-tentative_completion_date").val();

        //alert(file);
        //alert(file1);
        if (name != '' && date != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxtimeline/' + j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) { //alert(data);
                    $('.add_doc').append(data);

                }
            });
        } else if (name == '') {
            alert("Select work stage");
            $("#timeline-" + serial_id + "-work_stage_id").focus();
        } else if (date == '') {
            alert("select tentative completion date");
            $("#timeline-" + serial_id + "-tentative_completion_date").focus();
        }

    }
    </script>