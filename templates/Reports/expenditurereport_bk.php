<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
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
                <header>Expenditure Report</header>
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
												<?php echo $this->Form->control('division_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => 'Division', 'error' => false, 'empty' => 'Select Division']); ?>
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
							<div class="card-body">			
								<center>
									 <h4><strong>Expenditure Report&nbsp;&nbsp;as on <?php echo date('M Y');  ?></strong></h4>
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
								   <table class="table  table-bordered table-checkable order-column" style="width:80%">
									 <thead>
										<tr class="text-center">
											<th> Sno </th>
											<th> GO No</th>
											<th> Sanctioned Amount </th>
											<th> Actual Expenditure</th>    
										</tr>
									 </thead>
									 <tbody>
										<?php $sno = 1;
										foreach ($projects as $project) : ?>
											<tr class="odd gradeX">
												<td class="text-center"><?php echo $sno; ?></td>
												<td class="text-center"><?php //echo $project['fsgo_no']; ?>
												<?php if ($project['fsgo_no'] != '') { ?>
														<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdetails(<?php echo  $project['project_id']; ?>,1);"><?php echo $project['fsgo_no']; ?></a>
												<?php }  ?>										
												</td>
												<td style="text-align:right;"><?php echo ($project['amount'])?ltrim($fmt->formatCurrency((float)$project['amount'],'INR'),'₹'):'0.00' ; ?></td>
												<td style="text-align:right;"><?php echo ($project['expenditure_incurred'])?ltrim($fmt->formatCurrency((float)$project['expenditure_incurred'],'INR'),'₹'):'0.00' ; ?></td>
											</tr>
									 	<?php
											$tot_fs                += $project['amount'];
											$expenditure_incurred  += $project['expenditure_incurred'];
											$sno++;
										    endforeach;
										?>
									</tbody>
									<tfoot>
										<tr>
											<th colspan="2" style="text-align:right;">Total&nbsp;&nbsp;</th>
											<th style="text-align:right;"><?php echo ($tot_fs)?ltrim($fmt->formatCurrency((float)$tot_fs,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
											<th style="text-align:right;"><?php echo ($expenditure_incurred)?ltrim($fmt->formatCurrency((float)$expenditure_incurred,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
										</tr>
									</tfoot>
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
			<thead>		 
			   <tr class="text-center">
				  <th colspan="4">TamilNadu Police Housing Corporation (TNPHC)</th>
			   </tr>
			   <tr class="text-center">
					<th> Sno </th>
					<th> GO No</th>
					<th> Sanctioned Amount </th>
					<th> Actual Expenditure</th>      
				</tr>
			 </thead>
			<tbody>
				<?php $sno = 1;
				foreach ($projects as $project) : ?>
					<tr class="odd gradeX">
						<td class="text-center"><?php echo $sno; ?></td>
						<td class="text-center"><?php echo $project['fsgo_no']; ?></td>
						<td style="text-align:right;"><?php echo number_format((float)$project['amount'], 2, '.', '') ; ?></td>
						<td style="text-align:right;"><?php echo number_format((float)$project['expenditure_incurred'], 2, '.', '') ; ?></td>
					</tr>
				<?php
					$tot_fs                += $project['amount'];
					$expenditure_incurred  += $project['expenditure_incurred'];
					$sno++;
					endforeach;
				?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="2" style="text-align:right;">Total&nbsp;&nbsp;</th>
					<th style="text-align:right;"><?php echo number_format((float)$tot_fs, 2, '.', '') ;  ?>&nbsp;</th>
					<th style="text-align:right;"><?php echo number_format((float)$expenditure_incurred, 2, '.', '') ;  ?>&nbsp;</th>
				</tr>
			</tfoot>
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
                required: true
            }
        },
        messages: {
            'division_id': {
                required: "Select Division"
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
                        "Expenditure_report.xls"
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