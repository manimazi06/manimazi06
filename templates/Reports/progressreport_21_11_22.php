<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
	
    .table-scrollable>.table>thead>tr>th {
        border: 1px solid white;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Progress Report</header>
            </div>
            <div class="card-body ">               
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
							         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;">
                                        <div class="card-body">
											<?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
											<div class="col-md-12 row">
												<div class="col-md-4">
													<?php echo $this->Form->control('division', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $division_table, 'label' => 'Division', 'error' => false, 'empty' => 'Select Division']); ?>
												</div>
												<div class="col-md-4">
													<?php echo $this->Form->control('financial', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financial, 'label' => 'Financial Year', 'error' => false, 'empty' => 'Select Financial year']); ?>
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
									<h4><strong>Progress Report for Division - &nbsp;<?php echo $division_wise ?>&nbsp;&nbsp;for Financial Year -&nbsp;<?php echo $finance_wise ?></strong></h4>
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
									<table class="table table-bordered" id="border">
										<thead>
											<tr class="text-center">
												<th rowspan="3"> Sno </th>
												<th rowspan="3"> Work Name </th>
												<th rowspan="3"> Work Code </th>
												<th rowspan="3"> Districts </th>
												<th rowspan="3">IG / SP/ DC/CMT </th>
												<th rowspan="3"> DSP/ AC/ A.CMT </th>
												<th rowspan="3"> INSPECTOR </th>
												<th rowspan="3"> SUB-INSPECTOR </th>
												<th rowspan="3"> HC/PC </th>
												<th rowspan="3"> F.S.Value(Rs.In lakhs)</th>
												<th rowspan="3"> Exp.during this month(Rs.in lakhs)</th>
												<th rowspan="3"> Exp.upto this month(Rs.in Lakhs)</th>
												<th rowspan="3"> Date of handing over of site</th>
												<th rowspan="3"> Actual Target Date</th>
												<th rowspan="3">Revised Target Date</th>
												<th colspan="2">% of achievement </th>
												<th rowspan="3"> Present Stage</th>
											</tr>
											<tr class="text-center">
												<th>Physical</th>
												<th>Financial</th>
											</tr>
										</thead>
										<tbody>
											<?php $sno = 1;
											foreach ($projects as $project) : ?>
												<tr class="odd gradeX">
													<td class="text-center"><?php echo $sno; ?></td>
													<td class="text-center"><?php echo $project['name']; ?></td>
													<td class="text-center"><?php echo $project['wcode']; ?></td>
													<td class="text-center"><?php echo $project['dname']; ?> </td>
													<td class="text-center"><?php echo $value1 = $project['ig']; ?></td>
													<td class="text-center"><?php echo $value2 = $project['dsp']; ?></td>
													<td class="text-center"><?php echo $value3 = $project['insp']; ?></td>
													<td class="text-center"><?php echo $value4 = $project['sub_insp']; ?></a></td>
													<td class="text-center"><?php echo $value5 = $project['constable']; ?></a></td>
													<td class="text-center">
														<?php if ($project['amount'] != 0) { ?>
															<a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1)"><?php echo $sanction = $project['amount']; ?></a>
														<?php } else { ?>
															<span><?php echo "0"; ?></span>
														<?php  } ?>
													</td>
													<td></td>
													<td></td>
													<td class="text-center"><?php echo  $project['sdate']; ?></td>
													<td class="text-center"><?php echo $project['adate']; ?></td>
													<td></td>
													<td class="text-center"><?php echo  $project['wname'] ?></td>
													<td class="text-center"><?php echo $project['fname'] ?></td>
													<td> <?php echo $project['sname']; ?></td>                                                               
												</tr>
											<?php $sno++;
												$total_ig += $value1;
												$total_dsp += $value2;
												$total_insp += $value3;
												$total_subinsp += $value4;
												$total_constable += $value5;
												$total_sanction  += $sanction;                                        
											endforeach; ?>
										</tbody>
										<tfoot>
											<tr class="odd gradeX">
												<td colspan="4" style="text-align:right;"><b><?php echo "Total"; ?></b></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_ig; ?></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_dsp; ?></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_insp; ?></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_subinsp; ?></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_constable; ?></td>
												<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_sanction; ?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>																
											</tr>
										</tfoot>
									</table>
								</div>

							<?php } else {
								echo "<center><hr>No Data available!</center>";
							}  ?>
						<?php } ?>

						</div>
					</div>
				</div>
			</div>               
        </div>
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
            <tr>
                <td style='text-align:center' colspan="18">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="18">Progress report for Division-<?php echo $division_wise ?>in the year-<?php echo $finance_wise ?>
                </td>
            </tr>
            <tr class="text-center">
                <th rowspan="2"> Sno </th>
                <th rowspan="2"> Work Name </th>
                <th rowspan="2"> Work Code </th>
                <th rowspan="2"> Districts </th>
                <th rowspan="2">IG / SP/ DC/CMT </th>
                <th rowspan="2"> DSP/ AC/ A.CMT </th>
                <th rowspan="2"> INSPECTOR </th>
                <th rowspan="2"> SUB-INSPECTOR </th>
                <th rowspan="2"> HC/PC </th>
                <th rowspan="2"> F.S.Value(Rs.In lakhs)</th>
                <th rowspan="2"> Exp.during this month(Rs.in lakhs)</th>
                <th rowspan="2"> Exp.upto this month(Rs.in Lakhs)</th>
                <th rowspan="2"> Date of handing over of site</th>
                <th rowspan="2"> Actual Target Date</th>
                <th rowspan="2">Revised Target Date</th>
                <th colspan="2">% of achievement </th>
                <th rowspan="2"> Present Stage</th>
            </tr>
            <tr class="text-center">
                <th>Physical</th>
                <th>Financial</th>
            </tr>
            <?php $sno = 1;
            foreach ($projects as $project) : ?>
                <tr class="odd gradeX">
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $project['name']; ?></td>
                    <td><?php echo $project['wcode']; ?></td>
                    <td><?php echo $project['dname']; ?> </td>
                    <td style="text-align:center;"><?php echo $val1 = $project['ig']; ?></td>
                    <td style="text-align:center;"><?php echo $val2 = $project['dsp']; ?></td>
                    <td style="text-align:center;"><?php echo $val3 = $project['insp']; ?></td>
                    <td style="text-align:center;"><?php echo $val4 = $project['sub_insp']; ?></a></td>
                    <td style="text-align:center;"><?php echo $val5 = $project['constable']; ?></a></td>
                    <td style="text-align:center;">
                        <?php if ($project['amount'] != 0) { ?>
                            <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1)"><?php echo $sanc = $project['amount']; ?></a>
                        <?php } else { ?>
                            <span><?php echo "0"; ?></span>
                        <?php  } ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td><?php echo  $project['sdate']; ?></td>
                    <td><?php echo $project['adate']; ?></td>
                    <td></td>
                    <td style="text-align:center;"><?php echo  $project['wname'] ?></td>
                    <td style="text-align:center;"><?php echo $project['fname'] ?></td>
                    <td> <?php echo $project['sname']; ?></td>               
                </tr>
            <?php $sno++;

                $tot_ig += $val1;
                $tot_dsp += $val2;
                $tot_insp += $val3;
                $tot_subinsp += $val4;
                $tot_constable += $val5;
                $tot_sanction  += $sanc;
            endforeach; ?>
            <tfoot>
                <tr style="text-align:center;">
                    <td colspan="4"><?php echo "Total"; ?></td>
                    <td style="font-weight:bold; color:black;"><?php echo $tot_ig; ?>
                    <td style="font-weight:bold; color:black;"><?php echo
                                                                $tot_dsp; ?>
                    <td style="font-weight:bold; color:black;"><?php echo
                                                                $tot_insp; ?>
                    <td style="font-weight:bold; color:black;"><?php echo
                                                                $tot_subinsp; ?>
                    <td style="font-weight:bold; color:black;"><?php echo
                                                                $tot_constable; ?>
                    <td style="font-weight:bold; color:black;"><?php echo
                                                                $tot_sanction; ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
            'division': {
                required: true
            },
            'financial': {
                required: true
            }
        },

        messages: {
            'division': {
                required: "Select Division"
            },
            'financial': {
                required: "Select Financial Year"
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
                        "OpeningBalanceLogs_Report.xls"
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


    function getempdesgn(val) {
        var val;
        var div = <?php echo ($div) ? "'" . $div . "'" : '0'; ?>;
        var finance = <?php echo ($finance) ? "'" . $finance . "'" : '0'; ?>;
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxprogress/'+val+'/'+ div+'/'+finance,
            success: function(data, textStatus) {
                //alert(data);
                $(".add-unsent-form").html(data);
            }
        });
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