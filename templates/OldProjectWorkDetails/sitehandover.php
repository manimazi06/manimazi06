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
	 <?php } ?>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Technical<br>Sanction'), ['controller' => 'OldProjectWorkDetails', 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Tender<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'tenderdetails', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
     <?php echo $this->Html->link(__('Contractor<br>Details'), ['controller' => 'OldProjectWorkDetails', 'action' => 'contractors', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php if($work_type == 1){  ?>
	 <li class="nav-item">
     <?php echo $this->Html->link(__('Planning<br>Clearance'), ['controller' => 'OldProjectWorkDetails', 'action' => 'planningclearance', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	 <?php } ?>
     <li class="nav-item">
         <a class="nav-link active">SiteHand<br>Over</a>
     </li>
 </ul>
 <?php echo $this->Form->create($ProjectWorkSubdetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
 <div class="col-md-12">
     <div class="card card-topline-aqua">
       
         <div class="card-body">
		  <?php if($work_type == 1){  ?>			 
			 <div class="col-md-12 addpage">
					<h4 class = "sub-tile">Project Final Drawing  :</h4> 
					 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
					 <div class="col-md-12" style="margin-top:">						 
					<div class="form-group row">
					  <label class="control-label col-md-4 bol">Project Final Drawing Upload<span class="required">* <br>(.jpeg,.jpg,.png,.pdf Format only)&nbsp;&nbsp;(Maximum 8MB Only) </span></label>
						<div class="col-md-5">
							 <?php echo $this->Form->control('architect_drawing_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
					        <?php  if($projectWorkSubdetail['architect_drawing_flag'] == 1){  ?>  
								 <?php echo $this->Form->control('architect_drawing_upload1', ['type' => 'hidden', 'label' => false,'value'=>$projectWorkSubdetail['architect_drawing_upload']]); ?>
                                 <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ArchitectDrawings/'.$projectWorkSubdetail['architect_drawing_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
										<i class="fa fa-file-image-o" aria-hidden="true">&nbsp;</i>View</span></a>
							  
					        <?php }  ?>
					  </div>								
					</div>
                    	   				
				  </div> 
				  </fieldset>
		    </div> 
		  <?php } ?>
		   <h4 class="sub-tile">Site Handover Details</h4>

             <!--legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend-->
             <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
                 <div class="col-md-12">
                     <div class="form-group row">
                         <label class="control-label col-md-2">Site Handover Date<span class="required"> * </span></label>
                         <div class="col-md-4">
                             <?php echo $this->Form->control('site_handover_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>($projectWorkSubdetail['site_handover_date'])?date('d-m-Y',strtotime($projectWorkSubdetail['site_handover_date'])):'']); ?>
                         </div>
                         <label class="control-label col-md-2">Completion Date<span class="required"> * </span></label>
                         <div class="col-md-4">
                             <?php echo $this->Form->control('tentative_completion_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>($projectWorkSubdetail['tentative_completion_date'])?date('d-m-Y',strtotime($projectWorkSubdetail['tentative_completion_date'])):'']); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label class="control-label col-md-2">Site Handover Remarks<span class="required">
                             </span></label>
                         <div class="col-md-4">
                             <?php echo $this->Form->control('site_handover_remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3,'value'=>($projectWorkSubdetail['site_handover_remarks'])?$projectWorkSubdetail['site_handover_remarks']:'']); ?>
                         </div>
                     </div>
                 </div>
             </fieldset>
         </div>
         <div class="form-group" style="padding-top: 10px;">
             <div class="offset-md-5 col-md-10">
                 <button type="submit" class="btn btn-info m-r-20">Submit</button>
                 <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
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

     $("#FormID").validate({
         rules: {
             'site_handover_date': {
                 required: true
             },
             'tentative_completion_date': {
                 required: true
             }

         },

         messages: {
             'site_handover_date': {
                 required: "Select Site Handover Date"
             },
             'tentative_completion_date': {
                 required: "Select Completion Date"
             }
         },
         submitHandler: function(form) {

             form.submit();
             $(".btn").prop('disabled', true);


         }
     });

     // function toggledetail() {
         // $('#project').toggle();

     // }

     // $(document).ready(function() {
         // var ProjectID = <?php echo $id;  ?>;
         // var ProjectSubID = <?php echo $work_id;  ?>;
         // if (ProjectID != '' && ProjectSubID != '') {
             // $.ajax({
                 // type: 'POST',
                 // url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID + '/' + ProjectSubID,
                 // success: function(data, textStatus) { //alert(data);
                     // $('#project').html(data);
                 // }
             // });
         // }
     // });
 </script>
