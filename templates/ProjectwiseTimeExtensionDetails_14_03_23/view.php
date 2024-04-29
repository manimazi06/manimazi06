<style>
    .form-group {
        margin-bottom: 5px !important;
    }
	
	.control-label{
		font-size:14px !important;
	}
</style>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>View Time Extension Detail</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-8">
                                    Extension Of Time Recommended By The Asst.Exe.Engineer</label>
                                <div class="col-md-4">
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo date('d-m-Y',strtotime($projectwiseTimeExtensionDetail->extension_date_of_ee)); ?>
                                </div>
                                
                            </div>
							<div class="form-group row">                               
                                <label class="control-label col-md-8">Whether Delay Is On The Part Of The Contractor,If
                                    So Action Taken For Imposing Fine As Per Penal Clauses Of Agreement</label>
                                <div class="col-md-4" >
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->delay_part_of_contractor; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-8">
                                    Period Of Delay If Any By The Department Such As In Supply Of Materials</label>
                                <div class="col-md-4">
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->delay_due_to_department; ?>
                                </div>                               
                            </div>							
							 <div class="form-group row">                               
                                <label class="control-label col-md-8">
                                    Period Of Delay If Any Due To Revision Of Plan And Carrying Out Additional Items
                                    Of Work By Value Of Contractor (Details And Value Of Additional Items To Be
                                    Furnished)
                                    </label>
                                <div class="col-md-4">
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->delay_for_revision_plan; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-8">
                                    Period Of Delay If Any Due To Nature Rain,Flood Etc</label>
                                <div class="col-md-4" >
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->delay_due_to_rain; ?>
                                </div>
                                
                            </div>
							<div class="form-group row">                               
                                <label class="control-label col-md-8">
                                    Due To Shortage Of Sand
                                    </label>
                                <div class="col-md-4" >
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->delay_due_to_shortage_sand; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-8">
                                    Conduct Of The Contractor Regarding Quality Of Work And Responsiveness To Department Instructions</label>
                                <div class="col-md-4" >
                                   <span class="required">:&nbsp;&nbsp;</span> <?php echo $projectwiseTimeExtensionDetail->contractor_quality_of_work; ?>
                                </div>
                                
                            </div>
							<div class="form-group row">                                
                                <label class="control-label col-md-8">
                                    Special Remarks If Any (To Be Filled By The Executive Engineer In His Own Writing)
                                    </label>
                                <div class="col-md-4" >
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->remarks_of_ee; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-8">
                                    Whether AnyNotice Has Been Issued To The Contractor For Delay In His Part</label>
                                <div class="col-md-4" >
                                    <span class="required">:&nbsp;&nbsp;</span><?php  if($projectwiseTimeExtensionDetail->any_notice_issued_by_contractor == 1 ){ echo"Yes";}else{ echo"No";} ?>
                                </div>
                                
                            </div>
							<div class="form-group row">                                
                                <label class="control-label col-md-8" <?php if($projectwiseTimeExtensionDetail->any_notice_issued_by_contractor == 0){ ?> style="display:none;" <?php } ?>>
                                    File Upload
                                   </label>
                                <div class="col-md-4"  >
                                    <?php if ($projectwiseTimeExtensionDetail->notice_file_upload != '') {  ?>
                                        <?php echo $this->Form->control('notice_file_upload1', ['type' => 'hidden', 'value' => $projectwiseTimeExtensionDetail->notice_file_upload]); ?>
                                        <span class="required">:&nbsp;&nbsp;</span><a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectwiseTimeExtension/' . $projectwiseTimeExtensionDetail->notice_file_upload, ['fullBase' => true]); ?>" target="_blank"><span>
                                                View
                                            </span></a>
                                    <?php  } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-8">
                                Whether Any Fine Was Imposed For The Delay</label>
                                <div class="col-md-4" >
                                    <span class="required">:&nbsp;&nbsp;</span><?php if($projectwiseTimeExtensionDetail->any_fine_imposed_for_delay == 1){ echo "yes" ;}else{ echo "No";}  ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
					 <?php if($projectwiseTimeExtensionDetail->is_approved == 1){ ?>
					 <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                        <div class="col-md-12">
						   <div class="form-group row">
                            <label class="control-label col-md-8">
                                   Approved Date</label>
                                <div class="col-md-4">
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo date('d-m-Y',strtotime($projectwiseTimeExtensionDetail->approved_date)); ?>
                                </div>
                           </div>
						   <div class="form-group row">
                            <label class="control-label col-md-8">Remarks</label>
                                <div class="col-md-4">
                                    <span class="required">:&nbsp;&nbsp;</span><?php echo $projectwiseTimeExtensionDetail->approval_remarks; ?>
                                </div>
                           </div>
						</div>
					 </fieldset>
					 <?php } ?>
                </div>
                <div class="form-group" style="padding-top: 10px;">
                    <div class="offset-md-5 col-md-11">
                        <button type="button" class="btn btn-info" onclick="javascript:history.back()">back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>