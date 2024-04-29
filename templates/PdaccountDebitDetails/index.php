
<style>
.mdl-tabs__tab.tabs_three:hover {
    color: #6610f2 !important;
}

a.mdl-tabs__tab.tabs_three {
    max-width: 20%;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>PD Account Debit details</header>
				<div class="tools">
				  
					<?php echo $this->Html->link(__('Add PD Account Debit<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false,'class'=>' btn btn-info']); ?>
				</div>
            </div>
            <div class="card-body ">
                <div class="row">
					<div class="col-md-12">
						<div class="card-body">
						        <div class="btn-group pull-right">
									<button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Download
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
						   
							<div class="table-scrollable user-table">
								<table class="table  table-bordered table-checkable order-column mobile-table" id="example4">
									<thead>
										<tr class="text-center">
											<th> Sno </th>
											<th> Fund Debit date </th>
											<th>Amount</th>
											<th>Remarks</th>
											<!--th> Actions </th-->
										</tr>
									</thead>
									<tbody>
										<?php $sno =1; foreach ($pdaccountDebitDetails as $pdaccountDebitDetail): ?>
										<tr class="odd gradeX">
											<td class="text-center"><?php echo $sno; ?></td>
											<td class="text-center"><?php echo date('d-F-Y',strtotime($pdaccountDebitDetail['fund_debit_date'])) ?></td>
											<td class="text-center"><?php echo $pdaccountDebitDetail['fund_debit_amount'] ?>  </td>
											<td class="text-center"><?php echo $pdaccountDebitDetail['remarks'] ?>  </td>
										
										</tr>
										<?php $sno++; endforeach; ?>
									</tbody>
								</table>
							</div>                                    
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
		   <tr class="text-center">
			  <th colspan="4">TamilNadu Police Housing Corporation (TNPHC)</th>
		   </tr>
		   <tr class="text-center">
			  <th colspan="4">PD Account Debit details</th>
		   </tr>
			<tr class="text-center">
				<th>Sno</th>
				<th>Fund Debit date</th>
				<th>Amount</th>
				<th>Remarks</th>
			</tr>
		  <tbody>
			<?php $sno1 =1; foreach ($pdaccountDebitDetails as $pdaccountDebitDetail): ?>
			<tr class="odd gradeX">
				<td style="text-align:center;"><?php echo $sno1; ?></td>
				<td style="text-align:center;"><?php echo date('d/m/Y',strtotime($pdaccountDebitDetail['fund_debit_date'])); ?></td>
				<td style="text-align:right;"><?php echo $pdaccountDebitDetail['fund_debit_amount']; ?></td>
				<td style="text-align:left;"><?php echo $pdaccountDebitDetail['remarks']; ?></td>				
			</tr>
			<?php
			$total += $pdaccountDebitDetail['fund_debit_amount'];
			$sno1++; 
			endforeach; ?>
		 </tbody>
		 <tfoot>
		   <tr>
			   <td colspan="2">Total</td>
			   <td><?php echo $total; ?></td>
			   <td></td>
		   </tr>
		 </tfoot>
		</table>	
    </div>
</div>
<script type="text/javascript">
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
                        "pd_account_debit_details_report.xls"
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