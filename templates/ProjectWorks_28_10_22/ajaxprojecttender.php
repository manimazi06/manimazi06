<?php $j = ($i +1);   ?>
<div class="col-md-12 tender delete_docdetails_class_<?php echo $i; ?>">
   <h4 class = "sub-tile">&nbsp;<?php echo $i+1; ?>.Tender Details:</h4>

 <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:25px;margin-bottom:1%">
	  <div class="col-md-12">
			<div class="form-group row">
				<label class="control-label col-md-2">Tender no <span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.tender_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Enter Tender No']); ?>
				</div>
				<label class="control-label col-md-2">Tender Date<span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.tender_date', ['class' => 'form-control datepicker'.$j.'', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Select Tender Date']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Tender Copy <span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.tender_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)','data-rule-required'=>true,'data-msg-required'=>'Select Document']); ?>
					
					<?php if($tender_copy !=''){?>
					<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectTender/' . $projectTenderDetail['tender_copy'], ['fullBase' => true]); ?>" target="_blank"><span>
							<ion-icon name="document-text-outline"></ion-icon>View
						</span></a>
						<?php }	 ?>
				</div>
				<label class="control-label col-md-2">Tender Amount<span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.tender_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Enter Tender Amount']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label col-md-2">Contractor Name<span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.contractor_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Enter Contractor Name']); ?>

				</div>

				<label class="control-label col-md-2">Contractor Mobile no <span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.contractor_mobile_no', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Enter Contractor Mobile No']); ?>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-md-2">Agreement no <span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.agreement_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Enter Agreement No.']); ?>
				</div>


				<label class="control-label col-md-2">Agreement Date<span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.agreement_date', ['class' => 'form-control datepicker'.$j.'', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text','data-rule-required'=>true,'data-msg-required'=>'Enter Agreement Date']); ?>
				</div>
			</div>

			<div class="form-group row">
				<label class="control-label col-md-2">Agreement Copy <span class="required"> * </span></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('tender.'.$i.'.agreement_copy', ['class' => 'form-control', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)','data-rule-required'=>true,'data-msg-required'=>'Select Agreement Copy']); ?>

				
				</div>

			</div>
			<!-- add closing -->
		</div>

		<!-- button closing -->

       <div align="right">    
		<a onclick='delete_docdetails(<?php echo $i; ?>);'>
            <button  type="button" class="btn btn-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
			
         </a>
		 </div>
</fieldset>
				
</div>
<script>
    function delete_docdetails(i) { //alert(i);
        $('.delete_docdetails_class_' + i).remove();  
    }
	
    var i = <?php echo $j; ?>;	
    $('.datepicker'+i).flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });
    
    </script>