<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
	
		.table-scrollable{
		height:700px;
       width:100%;
       overflow:scroll;
	}
</style>
 <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Timeline Report</header>
            </div>
            <div class="card-body">                
				<div class="row">
					<div class="col-md-12">
						<div class="card-body">
							<div class="row">
							   <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;">
								<div class="card-body">
									<?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off"]); ?>
										<div class="col-md-12 row">										
											<div class="col-md-4">
												<?php echo $this->Form->control('division_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => 'Division', 'error' => false, 'empty' => '-All-']); ?>
											</div>
											<div class="col-md-4">
											<?php  $work_types = [1=>'Construction Works',2=>'Special Repair Works'] ?>
												<?php echo $this->Form->control('work_type', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $work_types, 'label' => 'Work Type', 'error' => false, 'empty' => 'Select Work Type']); ?>
											</div>											
										</div>
										<div class="form-group m-t-20 text-center" style="padding-top: 10px;margin-bottom: -10px;">
											<button type="details" class="btn btn-primary">
												Get Details</button>  
										</div>
									<?php echo $this->Form->End(); ?>
									</div>
								</fieldset>	
							</div>
						</div>
				   </div>
			   </div>
           </div>
      </div>   
	   <?php if ($projects != '') {  ?>										
			<div class="card-box">           
               <?php if (count($projects) > 0) { ?>	   						
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="">			
								<center>
									 <h4><strong>Timeline Report&nbsp;&nbsp;as on <?php echo date('M Y');  ?></strong></h4>
								</center>
								 <div class="btn-group pull-right">
									<button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Tools
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a onClick="print_receipt('div_vc')">
											<i class="fa fa-print"></i> Print</a>
										</li>
										<li>
											<a id="export_excel_button">
											<i class="fa fa-file-excel-o"></i> Export to Excel</a>
										</li>
									</ul>
								</div>
								<center>
								 <div class="table-scrollable">
								   <table class="table  table-bordered table-checkable order-column" style="width:100%">
                                      <thead  class="fixed" style="position:sticky;top:0px;z-index: 1;background-color:#244f96;color:white;">  
										<tr class="text-center">
											<th style="width:1%">Sno </th>
											<th style="width:5%">Division </th>
											<th style="width:10%">Work Name</th>
											<th style="width:7%">AS Date</th>
											<th style="width:7%">FS Date</th>
											<th style="width:7%">Technical<br>Sanction<br>Date</th>
											<th style="width:7%">Tender<br>Date</th>
											<th style="width:7%">Planning<br>Permission<br>Date</th>
											<th style="width:7%">Planning<br>Approved<br>Date</th>
											<th style="width:7%">Site H/O to<br>Contractor</th>
											<th style="width:7%">Target<br>Date</th>    
											<th style="width:7%">Completion<br>Date</th>    
											<th style="width:7%">Site H/O<br>to User<br>Department</th>    
											<th style="width:7%">CR<br>Submitted</th>    
										</tr>
									 </thead>
									 <tbody>
										<?php $sno = 1;
										foreach ($projects as $project) : ?>
											<tr class="odd gradeX">
												<td class="text-center"><?php echo $sno; ?></td>
												<td class="text-center"><?php echo $project['dname']; ?></td>
												<td class="text-center"><?php echo $project['work_name']; ?></td>
												<td class="text-center"><?php echo ($project['as_date'] != '')?date('d/m/Y',strtotime($project['as_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['fs_date'] != '')?date('d/m/Y',strtotime($project['fs_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['technical_date'] != '')?date('d/m/Y',strtotime($project['technical_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['tender_date'] != '')?date('d/m/Y',strtotime($project['tender_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['pp_send_date'] != '')?date('d/m/Y',strtotime($project['pp_send_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['pp_approved_date'] != '')?date('d/m/Y',strtotime($project['pp_approved_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['site_handover_date'] != '')?date('d/m/Y',strtotime($project['site_handover_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['target_date'] != '')?date('d/m/Y',strtotime($project['target_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['completed_date'] != '')?date('d/m/Y',strtotime($project['completed_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['handover_date'] != '')?date('d/m/Y',strtotime($project['handover_date'])): ''; ?></td>
												<td class="text-center"><?php echo ($project['br_submitted_date'] != '')?date('d/m/Y',strtotime($project['br_submitted_date'])): ''; ?></td>
											</tr>
									 	<?php
											
											$sno++;
										    endforeach;
										?>
									</tbody>									
								</table>
							   </div>
							 </center>
						 <?php }else{	echo "<center><hr><b>No Data available!</b></center>";  }  ?>			
						</div>
					</div>
				</div>                  
              </div>
          </div>
		<?php } ?>
    </div>
</div>
<!-- REPORT -->
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form add-unsent-form">

                </div>
            </div>
        </div>
    </div>
</div>   
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
			   <tr class="text-center">
				  <th colspan="14">TamilNadu Police Housing Corporation (TNPHC)</th>
			   </tr>
			   <tr class="text-center">
				  <th colspan="14">Timeline Report</th>
			   </tr>
			   <tr class="text-center">
					<th style="width:1%">Sno </th>
					<th style="width:5%">Division </th>
					<th style="width:10%">Work Name</th>
					<th style="width:7%">AS Date</th>
					<th style="width:7%">FS Date</th>
					<th style="width:7%">Technical<br>Sanction<br>Date</th>
					<th style="width:7%">Tender<br>Date</th>
					<th style="width:7%">Planning<br>Permission<br>Date</th>
					<th style="width:7%">Planning<br>Approved<br>Date</th>
					<th style="width:7%">Site H/O to<br>Contractor</th>
					<th style="width:7%">Target<br>Date</th>    
					<th style="width:7%">Completion<br>Date</th>    
					<th style="width:7%">Site H/O<br>to User<br>Department</th>    
					<th style="width:7%">CR<br>Submitted</th>    
				</tr>
			 <tbody>
				<?php $sno1 = 1;
				foreach ($projects as $project) : ?>
					<tr class="odd gradeX">
						<td class="text-center"><?php echo $sno1; ?></td>
						<td class="text-center"><?php echo $project['dname']; ?></td>
						<td class="text-center"><?php echo $project['work_name']; ?></td>
						<td class="text-center"><?php echo ($project['as_date'] != '')?date('d/m/Y',strtotime($project['as_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['fs_date'] != '')?date('d/m/Y',strtotime($project['fs_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['technical_date'] != '')?date('d/m/Y',strtotime($project['technical_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['tender_date'] != '')?date('d/m/Y',strtotime($project['tender_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['pp_send_date'] != '')?date('d/m/Y',strtotime($project['pp_send_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['pp_approved_date'] != '')?date('d/m/Y',strtotime($project['pp_approved_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['site_handover_date'] != '')?date('d/m/Y',strtotime($project['site_handover_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['target_date'] != '')?date('d/m/Y',strtotime($project['target_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['completed_date'] != '')?date('d/m/Y',strtotime($project['completed_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['handover_date'] != '')?date('d/m/Y',strtotime($project['handover_date'])): ''; ?></td>
						<td class="text-center"><?php echo ($project['br_submitted_date'] != '')?date('d/m/Y',strtotime($project['br_submitted_date'])): ''; ?></td>
					</tr>
				<?php
					
					$sno1++;
					endforeach;
				?>
			</tbody>									
		</table>	
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>
<script>
    var division_id = <?php echo ($division_id)?$division_id:0; ?>;  
	function getdetails(id, type) {	   
		$(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
		$("#modal-add-unsent").modal('show');
		$.ajax({
			async: true,
			dataType: "html",
			type: "post",
			url: '<?php echo $this->Url->webroot ?>/Reports/ajaxexpenditurereport/'+id+'/'+ type+'/'+division_id,  
			success: function(data, textStatus) {
				$(".add-unsent-form").html(data);
			}
		});
	}

    $("#FormID").validate({
        rules: {
            'division_id': {
                required: false
            },
			'work_type': {
                required: true
            }
        },
        messages: {
            'division_id': {
                required: "Select Division"
            },
			 'work_type': {
                required: "Select Work Type"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
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
                        "Timeline_report.xls"
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

    $(document).ready(function() {
        $('.monthpicker').flatpickr({
            maxDate: "today",
            allowInput: false,
            plugins: [
                new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "Y-m",
                    altFormat: "F Y"
                })
            ]
        });
    });
</script>