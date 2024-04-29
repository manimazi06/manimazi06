 <!--style>
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

a.ex1:hover {background-color: yellow;}

</style-->
 <?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
           <div class="card-head">
            <header>Approved Project List</header>  
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
					<label class="control-label col-md-2">Project Code<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('project_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
					</div>
					<?php if($role_id == 1 || $role_id == 2 || $role_id == 8){  ?>
                    <label class="control-label col-md-2">Division<span class="required"> * </span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('division_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => false, 'empty' => 'Select Division']); ?>
					</div>
					<?php } ?>					
				</div> 
                 <div class="form-group row">
					<label class="control-label col-md-2">Status<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php  echo $this->Form->control('status_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $work_statuses, 'label' => false, 'error' => false, 'empty' => 'Select Status']); ?>
					</div>                  				
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
    <div class="col-md-12">     
		<div class="card">
			 <div class="card-body ">		
			   <?php if ($projectWorks != '') {  ?>									
				 <div class="row" >                  
					<div class="table-scrollable user-table">
						<div class="btn-group pull-right">
								<button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Tools
									<i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right">
									<li>
										<a onClick="print_receipt('div_vc')">
											<i class="fa fa-print"></i> Print </a>
									</li>
									<li>
										<a id="export_excel_button">
											<i class="fa fa-file-excel-o"></i> Export to Excel </a>
									</li>
								</ul>
							</div><br>
						<table class="table table-bordered table-advanced display" id="example4">
							<thead class="info">
								<tr  align="center">
									<th style="width:2%"> S.No</th>
									<th style="width:10%">Work ID</th>
									<th style="width:22%">Work Name</th>
									<th style="width:7%">Financial Year</th>
									<th style="width:7%">Department</th>
									<th style="width:10%">District</th>
									<th style="width:7%">Division</th>
									<th style="width:10%">Sanctioned Amount <br>(in Rs.)</th>
									<th style="width:10%">Work Status</th>
									<?php if($role_id == 1){ ?>
									<th style="width:5%">Action</th>
									<?php  } ?>
								</tr>
							</thead>
							<tbody class="add_doc">
							   <?php
								$sno = 1;
								foreach ($projectWorks as $projectWorkSubdetail) : ?>
								<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
									<td><a class="ex1" style="color:blue;" href="<?php echo $this->Url->build('/project-works/workview/'.$projectWorkSubdetail['project_id'].'/'. $projectWorkSubdetail['id'], ['fullBase' => true]); ?>"
														  target="_blank"><?php echo ($projectWorkSubdetail['work_code'])?$projectWorkSubdetail['work_code']:$projectWorkSubdetail['project_work']['project_code']; ?></a></td>
									<td><?php echo $projectWorkSubdetail['work_name']; ?></td>  
									<td><?php echo $projectWorkSubdetail['financial_year']; ?></td>  
									<td><?php echo $projectWorkSubdetail['department_name']; ?></td>  
									<td><?php echo $projectWorkSubdetail['district_name']; ?></td>
									<td><?php echo $projectWorkSubdetail['division_name']; ?></td>
									<td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                   
									<!--td><?php echo ($projectWorkSubdetail['is_approved'] == 1)?"<span class='badge badge-pill badge-success'>Approved</span>":"<span class='badge badge-pill badge-Danger'>Not Approved</span>"; ?></td-->                                                                                   
									<td><?php echo $work_statuses[$projectWorkSubdetail['project_work_status_id']]; ?></td>
									<?php if($role_id == 1){ ?>
									<td>
									<?php echo $this->Html->link(__('<i class="fa fa-trash"></i>'), ['action' => 'deletework',$projectWorkSubdetail['id']], ['confirm' => __('Are you sure you want to delete Project - {0}?',  $projectWorkSubdetail['work_name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?><br><br>
									</td>
									<?php  } ?>									
								</tr>
								  <?php $sno++;
								endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php } ?>
			</div>			
		</div>                
    </div>
</div>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
            <tr>
                <td style='text-align:center' colspan="9">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="9"><b> Approved list as on
                        <?php echo date('d-m-Y'); ?>
                    </b></td>
            </tr>
            <tr>
				<th style="width:2%"> S.No</th>
				<th style="width:10%">Work ID</th>
				<th style="width:22%">Work Name</th>
				<th style="width:7%">Financial Year</th>
				<th style="width:7%">Department</th>
				<th style="width:10%">District</th>
				<th style="width:7%">Division</th>
				<th style="width:10%">Sanctioned Amount <br>(in Rs.)</th>
				<th style="width:10%">Work Status</th>					
			</tr>
			<tbody >
			   <?php
				$sno1 = 1;
				foreach ($projectWorks as $projectWorkSubdetail) : ?>
				<tr >
					<td class="text-center"><?php echo ($sno1); ?></td>
					<td><?php echo $projectWorkSubdetail['work_code']; ?></td>  
					<td><?php echo $projectWorkSubdetail['work_name']; ?></td>  
					<td><?php echo $projectWorkSubdetail['financial_year']; ?></td>  
					<td><?php echo $projectWorkSubdetail['department_name']; ?></td>  
					<td><?php echo $projectWorkSubdetail['district_name']; ?></td>
					<td><?php echo $projectWorkSubdetail['division_name']; ?></td>
					<td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                   
					<td><?php echo $work_statuses[$projectWorkSubdetail['project_work_status_id']]; ?></td>												
				</tr>
				  <?php $sno1++;
				endforeach; ?>
			</tbody>
		</table>
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
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxgetworkdetails/'+project,
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
			var district_id = $('#district-id').val();
			var status_id = $('#status-id').val();
			
			if(fin_id != '' || dep_id != '' || project_code != '' || district_id != '' || status_id != ''){           
               form.submit();
			 }else{
				alert('Select any one input!');
				return false;				
			}
        }
    });


$(document).ready(function() {

        $(function() {
            $("#export_excel_button").click(function() {
                $("#export_excel_button").removeClass("model-head");
                var filename = $(this).attr("title");
                var uri = $("#report").btechco_excelexport({
                    containerid: "report",
                    datatype: $datatype.Table,
                    returnUri: true
                });

                $(this).attr('download',
                        "approvedlist.xls"
                    ) // set file name (you want to put formatted date here)
                    .attr('href', uri) // data to download
                    .attr('target', '_blank') // open in new window (optional)
            });
        });
    });

    function print_receipt() {
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
    }		
</script>