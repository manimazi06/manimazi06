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
                <header>Statistics Report</header>
            </div>
            <div class="card-body">                
				<div class="row">
					<div class="col-md-12">
						<div class="card-body">
							<div class="row">
							   <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;">
								<div class="card-body">
									<?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
										<div class="col-md-12 row">
											<div class="col-md-4">
												<?php echo $this->Form->control('month_date', ['class' => 'form-control monthpicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => 'Month', 'error' => false, 'placeholder' => 'Select Month']); ?>
											</div>
											<div class="col-md-4">
												<?php echo $this->Form->control('development_work', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $development_work, 'label' => 'Development Work Type', 'error' => false, 'empty' => 'Select Type']); ?>
											</div>
											<div class="col-md-4">
												<?php echo $this->Form->control('status', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $status, 'label' => 'Status', 'error' => false, 'empty' => 'Select Status']); ?>
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
									   <h4><strong><?php echo $development_work_type ?>&nbsp;&nbsp;<?php echo $title; ?>&nbsp;&nbsp;as on <?php echo $month_year;  ?></strong></h4>
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
								<div class="table-scrollable">
									<table class="table  table-bordered table-checkable order-column" style="width: 100%">
										<thead>
											<tr class="text-center">
												<th> Sno </th>
												<th> Work Name </th>
												<th> Districts </th>
												<th> Sanctioned Amount </th>
											</tr>
										</thead>
										<tbody>
											<?php $sno = 1;
											foreach ($projects as $project) : ?>
												<tr class="odd gradeX">
													<td class="text-center"><?php echo $sno; ?></td>
													<td class="text-center"><?php echo $project['name']; ?></td>
													<td class="text-center"><?php echo $project['dname']; ?></td>
													<td class="text-center"><?php echo $sanction = $project['amount']; ?></td>
												</tr>
											<?php $sno++;
												$total_sanction  += $sanction;
											endforeach; ?>

										</tbody>
										<tfoot>
											<tr class="odd gradeX">
												<td colspan="3"><?php echo "Total"; ?></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_sanction; ?></td>
											</tr>
										</tfoot>
									</table>
								</div>

							<?php } else {
								echo "<center><hr><b>No Data available!</b></center>";
							}  ?>			
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
                    <th> Work Name </th>
                    <th> Districts </th>
                    <th> Sanctioned Amount </th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 1;
                foreach ($projects as $project) : ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?php echo $sno; ?></td>
                        <td class="text-center"><?php echo $project['name']; ?></td>
                        <td class="text-center"><?php echo $project['dname']; ?></td>
                        <td class="text-center"><?php echo $sanction = $project['amount']; ?></td>
                    </tr>
                <?php $sno++;
                    $total_sanction_amount  += $sanction;
                endforeach; ?>

            </tbody>
            <tfoot>
                <tr class="odd gradeX">
                    <td colspan="3"><?php echo "Total"; ?></td>
                    <td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_sanction_amount; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>

<script>
    $("#FormID").validate({
        rules: {
            'month_date': {
                required: true
            },
            'development_work': {
                required: true
            },
            'status': {
                required: true
            }
        },

        messages: {
            'month_date': {
                required: "Select Month"
            },
            'development_work': {
                required: "Select Development work"
            },
            'status': {
                required: "Select Status"
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
                        "Statistics_report.xls"
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

    // $(".comp").attr("data-placeholder", "Select Company");
    // $(".client").attr("data-placeholder", "Select Client");

    // function getempdesgn(val, divid) {
        // var val;
        // var divid;
        // var month_date = <?php echo ($month_date) ? "'" . $month_date . "'" : '0'; ?>;
        // var office_wise = <?php echo ($office_wise) ? "'" . $office_wise . "'" : '0'; ?>;

        // //alert(office_wise);
        // // alert(divid);

        // // alert(month_date);


        // $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        // $("#modal-add-unsent").modal('show');
        // $.ajax({
            // async: true,
            // dataType: "html",
            // type: "post",
            // url: '<?php echo $this->Url->webroot ?>/tnphc/OpeningBalanceLogs/ajaxdivisionwise/' + val + '/' + month_date + '/' + divid + '/' + office_wise,
            // success: function(data, textStatus) {

                // //alert(data);
                // $(".add-unsent-form").html(data);

            // }
        // });
    // }

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