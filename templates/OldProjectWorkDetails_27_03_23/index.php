<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
</style>
<?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        	<div class="card-head">
				<header>Work In Progress Details</header>							
			</div>
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Financial Year<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year']); ?>
					</div>
					<label class="control-label col-md-2">Department<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department']); ?>
					</div>
				</div>
                <div class="form-group row">
					<label class="control-label col-md-2">GO NO<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('go_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
					</div>
					<?php if($role_id == 9 || $role_id == 6){ ?>
                    <label class="control-label col-md-2">Division<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select District']); ?>
					</div>	
					<?php } ?>					
				</div>  				
		    </div> 
		      <div class="form-group" style="margin-top:10px;">
				<div class="offset-md-6 col-md-10">
					<button type="submit" class="btn btn-info ">Get Details</button>  
				</div>
			 </div>
		  </div>		  
	 </div>  
 </div><br>
  <?php echo $this->Form->End(); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">           
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">                       
                        <div class="table-scrollable user-table">
                            <table class="table  table-bordered table-checkable order-column mobile-table" id="example4">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width:2%;"> Sno </th>
                                        <th style="width:10%;"> Financial Year</th>
                                        <th style="width:10%;">Department</th>
                                        <th style="width:10%;"> GO No</th>
                                        <th style="width:20%;"> Project Name </th>
                                        <th style="width:5%;"> Place </th>
                                        <th style="width:8%;"> Division </th>
                                        <th style="width:10%;"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sno = 1;
                                    foreach ($oldProjectWorkDetails as $oldProjectWorkDetail) : ?>
                                        <tr class="odd gradeX">
                                            <td class="text-center"><?php echo $sno; ?></td>
                                            <td class="title"><?php echo $oldProjectWorkDetail['fy_name'] ?></td>
                                            <td class="title"><?php echo $oldProjectWorkDetail['deptname'] ?></td>
                                            <td class="title"><?php echo $oldProjectWorkDetail['go_no'] ?></td>
                                            <td class="title"><?php echo $oldProjectWorkDetail['projectname'] ?></td>
                                            <td class="title"><?php echo $oldProjectWorkDetail['place_name'] ?></td>
                                            <td class="title"><?php echo $oldProjectWorkDetail['diname'] ?></td>
                                            </td>
                                            <td class="text-center">  
											    <?php if($project_count[$oldProjectWorkDetail['id']] == 0){  ?>
												<?php if($role_id == 9 || $role_id == 14){ ?>
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'basicdetail',$oldProjectWorkDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?>&nbsp;&nbsp;&nbsp;
												
												<?php }  }else{ 
												 if($role_id == 9 || $role_id == 14){ ?>
												 
												<?php  echo $this->Html->link(__('<i class="fa fa-pencil"></i> Update'), ['action' => 'basicdetail',$oldProjectWorkDetail['id'],$project[$oldProjectWorkDetail['id']]['project_work_id'],$project[$oldProjectWorkDetail['id']]['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
												      <?php  echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['controller'=>'ProjectWorks','action' => 'workview',$project[$oldProjectWorkDetail['id']]['project_work_id'],$project[$oldProjectWorkDetail['id']]['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>

												<?php  }else{ ?>
    											   <?php  echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['controller'=>'ProjectWorks','action' => 'workview',$project[$oldProjectWorkDetail['id']]['project_work_id'],$project[$oldProjectWorkDetail['id']]['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>

												<?php }  }  ?>
											</td>
                                        </tr>
                                    <?php $sno++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
	
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
			var go_no = $('#go-no').val();
			var division_id = $('#division-id').val();
			
			if(fin_id != '' || dep_id != '' || go_no != '' || division_id != ''){
           
               form.submit();
			 
			}else{
				alert('Select any one input!');
				return false;
				
			}
        }
    });   
</script>
