<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
		<div class="card-body">
				 <h4 class = "sub-tile"><?php echo $projectwiseDevelopmentWork['work_name'] ?></h4>
		
        </div>
        </div>
    </div>
</div><br>
 <ul class="nav nav-tabs">     
     <li class="nav-item">
         <?php echo $this->Html->link(__('Detailed<br>Estimate'), [ 'action' => 'projectdetailedestimate', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>	
     <li class="nav-item">
         <?php echo $this->Html->link(__('Technical<br>Sanction'), [ 'action' => 'projectfinancialsanctions', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
         <?php echo $this->Html->link(__('Tender<br>Details'), [ 'action' => 'tenderdetails', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
     <li class="nav-item">
     <?php echo $this->Html->link(__('Contractor<br>Details'), [ 'action' => 'contractors', $id, $pid, $work_id], ['escape' => false, 'class' => 'nav-link']); ?>
     </li>
	
     <li class="nav-item">
         <a class="nav-link active">SiteHand<br>Over</a>
     </li>
 </ul>
 <?php echo $this->Form->create($ProjectWorkSubdetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
 <div class="col-md-12">
     <div class="card card-topline-aqua">       
         <div class="card-body">
		   <h4 class="sub-tile">Site Handover Details</h4>

             <!--legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend-->
             <fieldset style="border:1px solid #00355F;border-radius:10px;padding:15px;">
                 <div class="col-md-12">
                     <div class="form-group row">
                         <label class="control-label col-md-2">Site Handover Date<span class="required"> * </span></label>
                         <div class="col-md-4">
                             <?php echo $this->Form->control('site_handover_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>($projectwiseDevelopmentWork['site_handover_date'])?date('d-m-Y',strtotime($projectwiseDevelopmentWork['site_handover_date'])):'']); ?>
                         </div>
                         <label class="control-label col-md-2">Completion Date<span class="required"> * </span></label>
                         <div class="col-md-4">
                             <?php echo $this->Form->control('tentative_completion_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','value'=>($projectwiseDevelopmentWork['tentative_completion_date'])?date('d-m-Y',strtotime($projectwiseDevelopmentWork['tentative_completion_date'])):'']); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label class="control-label col-md-2">Site Handover Remarks<span class="required">
                             </span></label>
                         <div class="col-md-4">
                             <?php echo $this->Form->control('site_handover_remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3,'value'=>($projectwiseDevelopmentWork['site_handover_remarks'])?$projectwiseDevelopmentWork['site_handover_remarks']:'']); ?>
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
 </script>
