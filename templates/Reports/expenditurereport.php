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
												<?php echo $this->Form->control('division_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => 'Division', 'error' => false, 'empty' => '-All-']); ?>
											</div>
											<div class="col-md-4">
											<?php  $work_types = [1=>'Construction Works',2=>'Special Repair Works'] ?>
												<?php echo $this->Form->control('work_type', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $work_types, 'label' => 'Work Type', 'error' => false, 'empty' => 'Select Work Type']); ?>
											</div>
											<div class="col-md-4">
												<?php echo $this->Form->control('fund_source_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $fund_sources, 'label' => 'Fund Source', 'error' => false, 'empty' => '-Select-']); ?>
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
									 <h4><strong>Expenditure Report&nbsp;&nbsp;as on <?php echo date('M Y');  ?></strong><br>
									 <?php if($fund_source_id == 1){  ?>PD Fund<?php }elseif($fund_source_id == 2){ ?>Direct Fund<?php  } ?></h4>
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
									 <thead>
										<tr class="text-center">
											<th style="width:1%"> Sno </th>
											<th style="width:10%"> Division </th>
											<th style="width:10%"> GO No</th>
											<th style="width:25%"> Work Name</th>
											<th style="width:10%"> Sanctioned<br>Amount (Rs.)</th>
											<th style="width:10%"> Expenditure<br>Incurred (Rs.)</th>
											<?php if($fund_source_id == 1){  ?>
											<th style="width:10%"> UC <br>Sanctioned (Rs.)</th>
											<th style="width:10%"> UC <br>Received (Rs.)</th>  
											<?php }elseif($fund_source_id == 2){ ?>
											<th style="width:10%"> Fund Received (Rs.)</th>
											<th style="width:10%"> Balance Amount (Rs.)</th>  
											<?php } ?>
										</tr>
									 </thead>
									 <tbody>
										<?php $sno = 1;
										foreach ($projects as $project) : ?>
											<tr class="odd gradeX">
												<td class="text-center"><?php echo $sno; ?></td>
												<td class="text-center"><?php echo $project['dname']; ?></td>
												<td class="text-center"><?php echo ($project['go_no'])?$project['go_no']: $project['ref_no']; ?></td>
												<td class="text-center"><?php echo $project['work_name']; ?></td>
												<td class="text-center"><?php echo ($project['san_amount'])?ltrim($fmt->formatCurrency((float)$project['san_amount'],'INR'),'₹'):'0.00' ;; ?></td>
												<td style="text-align:right;"><?php echo ($project['expenditure_incurred'])?ltrim($fmt->formatCurrency((float)$project['expenditure_incurred'],'INR'),'₹'):'0.00' ; ?></td>
												<?php if($fund_source_id == 1){  ?>
												<td style="text-align:right;"><?php echo ($project['uc_amount'])?ltrim($fmt->formatCurrency((float)$project['uc_amount'],'INR'),'₹'):'0.00' ; ?></td>
												<td style="text-align:right;"><?php echo ($project['uc_received'])?ltrim($fmt->formatCurrency((float)$project['uc_received'],'INR'),'₹'):'0.00' ; ?></td>
										     	<?php }elseif($fund_source_id == 2){ ?>
												<td style="text-align:right;"><?php echo ($direct_fund[$project['project_id']])?ltrim($fmt->formatCurrency((float)$direct_fund[$project['project_id']],'INR'),'₹'):'0.00' ; ?></td>
												<td style="text-align:right;"><?php 
												//if($direct_fund[$project['project_id']] > $project['san_amount'])
												 $direct_fund_val[$project['project_id']] = ($direct_fund[$project['project_id']])?$direct_fund[$project['project_id']]:0;
											     //echo $direct_fund."<br>"; 
												$balance = ($project['san_amount']-$direct_fund_val[$project['project_id']]);												
												echo ($balance)?ltrim($fmt->formatCurrency((float)($balance),'INR'),'₹'):'0.00' ; ?></td>  
										     
												
												<?php } ?>
											</tr>
									 	<?php
											$tot_san_amount           += $project['san_amount'];
											$expenditure_incurred     += $project['expenditure_incurred'];
											 if($fund_source_id == 1){
											$tot_uc_amount            += $project['uc_amount'];
											$tot_uc_received          += $project['uc_received'];
											 }elseif($fund_source_id == 2){
												 $direct_amount += $direct_fund[$project['project_id']];
												 $tot_bal += $balance;
											 }
											$sno++;
										    endforeach;
										?>
									</tbody>
									<tfoot>
										<tr>
											<th colspan="4" style="text-align:right;">Total&nbsp;&nbsp;</th>
											<th style="text-align:right;"><?php echo ($tot_san_amount)?ltrim($fmt->formatCurrency((float)$tot_san_amount,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
											<th style="text-align:right;"><?php echo ($expenditure_incurred)?ltrim($fmt->formatCurrency((float)$expenditure_incurred,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
											<?php if($fund_source_id == 1){  ?>
											<th style="text-align:right;"><?php echo ($tot_uc_amount)?ltrim($fmt->formatCurrency((float)$tot_uc_amount,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
											<th style="text-align:right;"><?php echo ($tot_uc_received)?ltrim($fmt->formatCurrency((float)$tot_uc_received,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
										    <?php }elseif($fund_source_id == 2){ ?>
											<th style="text-align:right;"><?php echo ($direct_amount)?ltrim($fmt->formatCurrency((float)$direct_amount,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
											<th style="text-align:right;"><?php echo ($tot_bal)?ltrim($fmt->formatCurrency((float)$tot_bal,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
											<?php } ?>
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
			   <tr class="text-center">
				  <th colspan="8">TamilNadu Police Housing Corporation (TNPHC)</th>
			   </tr>
			   <tr class="text-center">
				  <th colspan="8">Expenditure Report</th>
			   </tr>
			   <tr class="text-center">
					<th style="width:1%"> Sno </th>
					<th style="width:10%"> Division </th>
					<th style="width:10%"> GO No</th>
					<th style="width:25%"> Work Name</th>
					<th style="width:10%"> Sanctioned<br>Amount (Rs.)</th>
					<th style="width:10%"> Expenditure<br>Incurred (Rs.)</th>
					<?php if($fund_source_id == 1){  ?>
					<th style="width:10%"> UC <br>Sanctioned (Rs.)</th>
					<th style="width:10%"> UC <br>Received (Rs.)</th>  
					<?php }elseif($fund_source_id == 2){ ?>
					<th style="width:10%"> Fund Received (Rs.)</th>
					<th style="width:10%"> Balance Amount (Rs.)</th>  
					<?php } ?>  
				</tr>
			 <tbody>
				<?php $sno1 = 1;
				foreach ($projects as $project) : ?>
					<tr class="odd gradeX">
						<td style="text-align:center;"><?php echo $sno1; ?></td>
						<td style="text-align:center;"><?php echo $project['dname']; ?></td>
						<td style="text-align:center;"><?php echo $project['go_no']; ?></td>
						<td style="text-align:center;"><?php echo $project['work_name']; ?></td>
						<td style="text-align:center;"><?php echo $project['san_amount']; ?></td>
						<td style="text-align:right;"><?php echo ($project['expenditure_incurred'])?ltrim($fmt->formatCurrency((float)$project['expenditure_incurred'],'INR'),'₹'):'0.00' ; ?></td>
						<?php if($fund_source_id == 1){  ?>
						<td style="text-align:right;"><?php echo ($project['uc_amount'])?ltrim($fmt->formatCurrency((float)$project['uc_amount'],'INR'),'₹'):'0.00' ; ?></td>
						<td style="text-align:right;"><?php echo ($project['uc_received'])?ltrim($fmt->formatCurrency((float)$project['uc_received'],'INR'),'₹'):'0.00' ; ?></td>
						<?php }elseif($fund_source_id == 2){ ?>
						<td style="text-align:right;"><?php echo ($direct_fund[$project['project_id']])?ltrim($fmt->formatCurrency((float)$direct_fund[$project['project_id']],'INR'),'₹'):'0.00' ; ?></td>
						<td style="text-align:right;"><?php 
						//if($direct_fund[$project['project_id']] > $project['san_amount'])
						 $direct_fund_val1[$project['project_id']] = ($direct_fund[$project['project_id']])?$direct_fund[$project['project_id']]:0;
						 //echo $direct_fund."<br>"; 
						$balance1 = ($project['san_amount']-$direct_fund_val1[$project['project_id']]);												
						echo ($balance1)?ltrim($fmt->formatCurrency((float)($balance1),'INR'),'₹'):'0.00' ; ?></td>  			 
					<?php } ?>
					</tr>
				<?php
					$tot_san_amount1        += $project['san_amount'];
					$expenditure_incurred1   += $project['expenditure_incurred'];
					if($fund_source_id == 1){
						$tot_uc_amount1      += $project['uc_amount'];
						$tot_uc_received1    += $project['uc_received'];
					 }elseif($fund_source_id == 2){
						$direct_amount1 += $direct_fund[$project['project_id']];
						$tot_bal1 += $balance;
					 }
					$sno1++;
					endforeach;
				?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4" style="text-align:right;">Total&nbsp;&nbsp;</th>
					<th style="text-align:right;"><?php echo ($tot_san_amount1)?ltrim($fmt->formatCurrency((float)$tot_san_amount1,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
					<th style="text-align:right;"><?php echo ($expenditure_incurred1)?ltrim($fmt->formatCurrency((float)$expenditure_incurred1,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
					<?php if($fund_source_id == 1){  ?>
					<th style="text-align:right;"><?php echo ($tot_uc_amount1)?ltrim($fmt->formatCurrency((float)$tot_uc_amount1,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
					<th style="text-align:right;"><?php echo ($tot_uc_received1)?ltrim($fmt->formatCurrency((float)$tot_uc_received1,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
					<?php }elseif($fund_source_id == 2){ ?>
					<th style="text-align:right;"><?php echo ($direct_amount1)?ltrim($fmt->formatCurrency((float)$direct_amount1,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
					<th style="text-align:right;"><?php echo ($tot_bal1)?ltrim($fmt->formatCurrency((float)$tot_bal1,'INR'),'₹'):'0.00' ; ?>&nbsp;</th>
					<?php } ?>
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
            'fund_source_id': {
                required: true
            },
			'work_type': {
                required: true
            }
        },
        messages: {
            'fund_source_id': {
                required: "Select Fund Source"
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