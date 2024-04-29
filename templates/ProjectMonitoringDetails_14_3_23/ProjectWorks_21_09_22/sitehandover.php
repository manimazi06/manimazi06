
 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>

<?php echo $this->Form->create($projectTenderDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Site Handover Details for <?php  echo $projectWorkSubdetail['work_code'];  ?></header>
        </div>
         <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
      
				<?php  if($projectWorkSubdetail['site_handover_flag'] == 0){  ?>
		        <div class="card-body">
                    <div class="form-body row">                       
                           <legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend>
			               <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">  
						    <div class="col-md-12">
                            <div class="form-group row">
                              
                                <label class="control-label col-md-2">Site Handover Date<span class="required"> * </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('site_handover_date', ['class' => 'form-control datepicker1', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required']); ?>
                                </div>
								  <label class="control-label col-md-2">Site Handover Remarks<span class="required"> 
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('site_handover_remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows'=>3]); ?>
                                </div>
								
                            </div>                            
                           </div>		   
						   
						   </fieldset>
                      </div>                    
                </div>
				<?php  }elseif($projectWorkSubdetail['site_handover_flag'] == 1){  ?>
				
				     <div class="card-body">
                    <div class="form-body row">                       
                           <legend class="bol" style="color: #0047AB; text-align: center;">Site Handover Details</legend>
			               <fieldset  style="border:1px solid #00355F;border-radius:10px;padding:15px;">  
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
    </div>
    </div>
		<?php  if($projectWorkSubdetail['site_handover_flag'] == 0){  ?>
	            <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">Submit</button>
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
					</div>
				</div>
		<?php  }else{ ?>
		  <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-6 col-md-10">
						<button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
					</div>
				</div>
		<?php  } ?>
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
            }

        },

        messages: {
            'site_handover_date': {
                required: "Select Site Handover Date"
            }
        },
        submitHandler: function(form) {	
				
			 form.submit();
              $(".btn").prop('disabled', true);	
			
		
        }
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
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
    
</script>


