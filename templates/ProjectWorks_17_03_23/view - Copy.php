<?php echo $this->Form->create($projectWork,['id'=>'FormID','class'=>'form-horizontal', "autocomplete"=>"off",'enctype'=>'multipart/form-data']); ?>
<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  								

 ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>View Project Work</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
				<h4 class = "sub-tile">Project Work Details:</h4>
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
					 
                  <div class="col-md-12">	
				  <div class="row">
                   <div class="col-sm-6">					  
					<div class="form-group row">
						
						<label class="control-label col-md-4 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['department']['name']; ?>
						</div>
					</div>
							
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Financial Year<span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['financial_year']['name']; ?>
						</div>
					</div>					
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Name <span class="required"> &nbsp;&nbsp;:</span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['project_name']; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['project_description']; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Cost (Rs.)<span class="required"> &nbsp;&nbsp;:</span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['building_type']['name']; ?>
						</div>
					</div>
					<?php if($projectWork['file_upload'] !=''){ ?>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">File upload <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/'.$projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank" ><span><ion-icon name="document-text-outline"></ion-icon>View</span></a>

						</div>
					</div>
					<?php } ?>
								
			      </div>
				  <div class="col-sm-6">					  
					<div class="form-group row department" >
						<label class="control-label col-md-4 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['department']['name']; ?>
						</div>
					</div>						
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Financial Year<span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['financial_year']['name']; ?>
						</div>
					</div>					
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Name <span class="required"> &nbsp;&nbsp;:</span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['project_name']; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['project_description']; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Cost (₹)<span class="required"> &nbsp;&nbsp;:</span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['building_type']['name']; ?>
						</div>
					</div>
					<?php if($projectWork['file_upload'] !=''){ ?>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">File upload <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/'.$projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank" ><span><ion-icon name="document-text-outline"></ion-icon>View</span></a>

						</div>
					</div>
					<?php } ?>								
			    </div>
			    </div>
			    </div>
				</fieldset>
				<hr>
				<h4 class = "sub-tile">Project Work Details:</h4>
				<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;">
					 
                  <div class="col-md-12">
                      <div class="col-md-6">					  
					
					<div class="form-group row department" >
						<label class="control-label col-md-4 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['department']['name']; ?>
						</div>
					</div>					
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Financial Year<span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['financial_year']['name']; ?>
						</div>
					</div>					
					<div class="form-group row">
						<label class="control-label col-md-4 ">Project Name <span class="required"> &nbsp;&nbsp;:</span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['project_name']; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['project_description']; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Project Cost <span class="required"> &nbsp;&nbsp;:</span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<?php  echo $projectWork['building_type']['name']; ?>
						</div>
					</div>
					<?php if($projectWork['file_upload'] !=''){ ?>
					<div class="form-group row">
						<label class="control-label col-md-4 bol">File upload <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-8" style="margin-top:10px;">
							<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/'.$projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank" ><span><ion-icon name="document-text-outline"></ion-icon>View</span></a>

						</div>
					</div>
					<?php } ?>
								
			    </div>
			    </div>
				</fieldset>						
            </div>
			<div class="form-body row">
				     <div class="form-group" style="padding-top: 10px;">
						<div class="offset-md-6 col-md-10">
							<button type="button" class="btn btn-primary" onclick="javascript:history.back()">Back</button>
						</div>
					</div>		
				</div>
		</div>
    </div>
</div>
</div>
<?php echo $this->Form->End();?>
