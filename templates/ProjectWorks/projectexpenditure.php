<?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header> Project Expenditure </header>
            </div>
			     <div class="form-group" style="padding-top: 10px">
					 <div class="offset-md-1 col-md-2">
					 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
					 </div>
				  </div>
				 <div id ="project" style="display:none;">     
				   
				 </div>            	 
				<?php // if($projectWorkSubdetail['detailed_estimate_flag'] == 0){  ?>  			
				  <div class="card-body">
					<div class="form-body row">
						<div class="col-md-12 addpage">
						 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
					 <div class="col-md-12" style="margin-top:">						 
					<div class="form-group row">
					  <center><h4 class = "sub-tile"><?php echo $projectWorkSubdetail['work_name']." - ".$projectWorkSubdetail['place_name']  ?></h4></center>							
					</div>
                    	   				
				  </div>
				  </fieldset><br> 
						 <h4 class = "sub-tile">Project Expenditure  :</h4> 
					 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
					 <div class="col-md-12" style="margin-top:">						 
					<div class="form-group row">
					  <label class="control-label col-md-4 bol">Enter Expenditure Incurred So far<span class="required">* </span></label>
						<div class="col-md-5">
							 <?php echo $this->Form->control('expenditure_incurred', ['class' => 'form-control amount', 'type' => 'text', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'required','value'=>$projectWorkSubdetail['expenditure_incurred']]); ?>
					       
					  </div>								
					</div>
                    	   				
				  </div> 
				  </fieldset>
						</div>                    
					</div>
				 </div>		
				<?php  //} ?>	       	
			   <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-5 col-md-10">
					    <?php //echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>
						<button type="submit" class="btn btn-success"> Submit</button>
					</div>
				</div>
		
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
    $("#FormID").validate({
        rules: {
            'expenditure_incurred': {
                required: true
            }
        },
        messages: {
            'expenditure_incurred': {
                required: "Enter Expenditure"
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
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
</script>
