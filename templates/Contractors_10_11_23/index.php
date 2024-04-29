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
                <header>Contractors</header>
                <div class="tools">
                    <?php echo $this->Html->link(__('Add Contractors<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 btn btn-info']); ?>
                </div>
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
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
                                <div class="table-scrollable">
                                    <table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
                                        <thead>
                                            <tr class="text-center">
                                                <th style="width:1%"> Sno </th>
                                                <th style="width:25%"> Contractor/Company Name </th>
                                                <th style="width:10%"> Mobile No</th>
                                                <th style="width:10%"> GST No</th>
                                                <th style="width:10%"> Register Date</th>
                                                <th style="width:10%"> License Validity upto </th>
                                                <th style="width:20%"> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sno = 1;
                                            foreach ($contractors as $contractor) : ?>
                                                <tr class="odd gradeX">
                                                    <td class="text-center"><?php echo $sno; ?></td>
                                                    <td class="text-center"><?php echo $contractor['name'] ?></td>
                                                    <td class="text-center"><?php echo $contractor['mobile_no'] ?></td>
                                                    <td class="text-center"><?php echo $contractor['gst_no'] ?></td>
                                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($contractor['register_date'])) ?></td>
                                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($contractor['validity_upto'])) ?></td>
													<td class="text-center" style="width:20%">
												      <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$contractor['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>&nbsp;&nbsp;
												      <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete',$contractor['id']], ['confirm' => __('Are you sure you want to delete Contractor - {0}?',  $contractor['name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?><br><br>
										      	      <?php  if($role_id == 1){ ?>
													  <?php echo $this->Html->link('<i class="fa fa-recycle"></i>Renewal', ['action' => 'licenserenewal', $contractor['id']], ['escape' => false, 'class' => 'btn btn-outline-info btn-sm','target'=>'_blank']); ?>
												      <?php  } ?>
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
    </div>
</div>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
		   <tr style="text-align:center;">
			  <th colspan="7">TamilNadu Police Housing Corporation (TNPHC)</th>
		   </tr>
		   <tr style="text-align:center;">
			  <th colspan="7">Contractor Details</th>
		   </tr>
			<tr style="text-align:center;">
				<th style="width:1%"> Sno </th>
				<th style="width:20%"> Contractor/Company Name </th>
				<th style="width:10%"> Mobile No</th>
				<th style="width:10%"> GST No</th>
				<th style="width:10%"> Register Date</th>
				<th style="width:10%"> License Validity upto </th>
				<th style="width:20%"> Address </th>
			</tr>
		<tbody>
			<?php $sno1 = 1;
			foreach ($contractors as $contractor) : ?>
				<tr class="odd gradeX">
					<td style="text-align:center;"><?php echo $sno1; ?></td>
					<td style="text-align:center;"><?php echo $contractor['name'] ?></td>
					<td style="text-align:center;"><?php echo $contractor['mobile_no'] ?></td>
					<td style="text-align:center;"><?php echo $contractor['gst_no'] ?></td>
					<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($contractor['register_date'])) ?></td>
					<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($contractor['validity_upto'])) ?></td>
					<td style="text-align:left;"><?php echo $contractor['address'] ?></td>
				</tr>
			<?php $sno1++;
			endforeach; ?>
		</tbody>
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
                        "Contractor_details.xls"
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