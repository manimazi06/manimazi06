 <style>
.table.table-advanced thead tr th{border-width: 1px !important;text-align:center;}
#district_full > thead.info tr th{background: #0a819c none repeat scroll 0 0;color: #FFF;}
#division_full > thead.info tr th{background: #607D8B none repeat scroll 0 0 !important}
#scheme_full > thead.info tr th{background: #8DAD5A none repeat scroll 0 0;}
#asset_full > thead.info tr th{background: #68B7B3 none repeat scroll 0 0;}
tr.shown td.details-control {
    background: rgba(0, 0, 0, 0) url("<?php echo $this->Url->build('/img/minus.png', ['fullBase' => true]); ?>") no-repeat scroll center 10px;
	 cursor: pointer;
	padding:15px !important;
	background-size: 13px;
}
td.details-control {
    background: rgba(0, 0, 0, 0) url("<?php echo $this->Url->build('/img/plus.png', ['fullBase' => true]); ?>") no-repeat scroll center 10px;  
    cursor: pointer;
	padding:15px !important;
	background-size: 13px;
}

</style>
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Approved Project List</header>  
          </div>
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Financial Year<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year']); ?>
					</div>
					<label class="control-label col-md-2">Department<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department']); ?>
					</div>
				</div>
                <div class="form-group row">
					<label class="control-label col-md-2">Project Code<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('project_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
					</div>					
				</div>				
		    </div> 
		       <div class="form-group" style="padding-top: 10px;">
					<div class="offset-md-6 col-md-10">
						<button type="submit" class="btn btn-info m-r-20">Get Details</button>  
					</div>
				</div>
		  </div>		  
	 </div>
 </div><br>
  <?php echo $this->Form->End(); ?>
<div class="row">
    <div class="col-md-12">     
		<div class="card">
		
			 <div class="card-body ">
			
			   <?php if ($projectWorks != '') {  ?>									
				 <div class="row" style="margin-top:10px;">                  
					<div class="table-scrollable">
						<table class="table table-bordered table-advanced  display" style="width: 100%" id="example4">
							<thead>
								<tr class="text-center">
									<th > Sno </th>
									<th></th>
									<th  align="center"> Project Code</th>
									<th  align="center"> Departments</th>
									<th align="center"> Financial Year </th>
									<th style="width:20%">Project Name </th>
									<th align="center"> Actions </th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($projectWorks)) { ?>
								<?php if (count($projectWorks) > 0) { ?>
				
								<?php $sno = 1;
								foreach ($projectWorks as $projectWork) : ?>
									<tr>
										<td class="text-center"><?php echo ($sno); ?></td>
										<td style="background-color:#FFFFFF;" class="details-control load_project_work" rel="<?php echo $projectWork['id'];?>" > </td>
										<td align="center" class="alignment"><?php echo $projectWork['project_code']; ?></td>
										<td align="center" class="alignment"><?php echo $projectWork['department_name']; ?></td>
										<td align="center" class="alignment"><?php echo $projectWork['financial_year']; ?></td>
										<td align="left"   class="alignment"><?php echo $projectWork['project_name']; ?></td>
										<td class="text-center" style="margin-top:10px;">
											<span style="margin-top:10px;">
												<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?>
											    <?php if($role_id == 6){  ?>
											    <?php if($projectWork['AS_flag'] == 1 && $projectWork['work_flag'] == 0){  ?>
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Works'), ['action' => 'projectworksadd',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-info btn-sm']); ?><br><br>

												<?php  } ?>
										        <?php  } ?>											
												 <?php  if($projectWork['work_flag'] == 1){ ?>
												 
										 	 	<?php  echo $this->Html->link(__('<i class="fa fa-pencil"></i> Project Works'), ['action' => 'projectworkdetail',$projectWork['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
												
												<?php } ?>  
											</span>
										</td>                                               
									</tr>
								<?php $sno++;
								endforeach; ?>
								<?php } else {
									//echo "<center><hr>No Data available!</center>";
									 } ?>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php } ?>
			</div>
			
		</div>
                
    </div>
</div>
<script>
$('#example4 tbody').on('click','td.load_project_work',function(){         
    var tr = $(this).closest('tr');  
    var project = $(this).attr('rel');	
	var row = tr;	
    if(row.hasClass('shown')) {
        row.next().remove();
        tr.removeClass('shown');
    }else{  
        if(project != ''){ 
		//alert(project);
            $.ajax({
                async 		: true,
                dataType	: "html",               
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectFundDetails/ajaxgetworkdetails/'+project,
               	success : function (data, textStatus) {
                    row.after('<tr><td  align="right"  colspan="'+tr.find("td").length+'">'+data+'</td></tr>');
                    tr.addClass('shown');
                }
            });             
        } 
    }
});		

    $("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: false
            },
            'department_id': {
                required: false
            }          
        },

        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            },
            'department_id': {
                required: "Select Department"
            }
        },
        submitHandler: function(form) {
			
			var fin_id = $('#financial-year-id').val();
			var dep_id = $('#department-id').val();
			var project_code = $('#project-code').val();
			
			if(fin_id != '' || dep_id != '' || project_code != ''){
           
               form.submit();
			 
			}else{
				alert('Select any one input!');
				return false;
				
			}
        }
    });   
		
</script>