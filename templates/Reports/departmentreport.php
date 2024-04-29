<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="card-head">
                <header>Department report</header>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
								<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;">
                                <div class="col-md-12">
                                    <div class="card-body">									
                                        <?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                                        <div class="col-md-12 row">
                                        <label class="control-label col-md-2">Financial year<span class="required"> * </span></label>
                                            <div class="col-md-3">
                                                <?php echo $this->Form->control('financial_year_id',  ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $finacial_year, 'empty' => '-All-']); ?>
                                            </div>
                                        </div>
                                        <div class="form-group m-t-20 text-center" style="padding-top: 10px;margin-bottom:-10px;">
                                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 btn-default btn-round" style=text-transform:capitalize;>
                                                <span class="fa fa-search"></span>&nbsp;Search
                                            </button>
                                        </div>
                                        <?php echo $this->Form->End(); ?>
                                    </div>
                                </div>
								</fieldset>
                            </div>
                        </div>
                      </div>
                    </div>
                 </div>
              </div>
							
							
		<?php if ($department_details != '') { ?>
        <div class="card-box">           
       <?php if (count($department_details) > 0) { ?>				
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">			
								<center><h4><b>Department Wise Project Count <?php if($financial_year != ''){   ?>  for financial Year - <?php echo $financial_year;  } ?></b></h4></center>
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
									   <div class="table-scrollable user-table">								   

                                        <table class="table  table-bordered table-checkable order-column mobile-table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2" style="width:2%;"> Sno </th>
                                                    <th rowspan="2" style="width:8%;"> Department Name </th>
                                                    <th colspan="3" style="width:30%;"> Sanctioned Projects </th>
                                                    <th colspan="3" style="width:30%;"> Work InProgress </th>
                                                    <th colspan="3" style="width:30%;"> Completed</th>
                                                </tr>
												<tr>
												   <th style="width:10%;">Construction<br>works</th>
												   <th style="width:10%;">Special Repair<br> works</th>
												   <th style="width:5%;">Total</th>
												   <th style="width:10%;">Construction<br> works</th>
												   <th style="width:10%;">Special Repair<br> works</th>
												   <th style="width:5%;">Total</th>
												   <th style="width:10%;">Construction<br> works</th>
												   <th style="width:10%;">Special Repair<br> works</th>
												   <th style="width:5%;">Total</th>
												</tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;
                                                    foreach ($department_details as $key => $department) : ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $sn; ?></td>
                                                        <td><?php echo   $department['department_name']; ?></td>
                                                        <td>
                                                            <?php $totolproject_con   = $department['total_count_con']; ?>
                                                            <?php if ($totolproject_con > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,3,1,<?php echo ($financial_year_id)?$financial_year_id:0; ?>)"><?php echo $totolproject_con; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
														 <td>
                                                            <?php $totolproject_rep   = $department['total_count_rep']; ?>
                                                            <?php if ($totolproject_rep > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,3,2,<?php echo ($financial_year_id)?$financial_year_id:0; ?>)"><?php echo $totolproject_rep; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
														<td><?php echo $totolproject= $totolproject_con+$totolproject_rep;   ?></td>
                                                        <td>
                                                            <?php $totalprogress_con  =  $department['inprogress_con']; ?>
                                                            <?php if ($totalprogress_con > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,5,1,<?php echo ($financial_year_id)?$financial_year_id:0; ?>)"><?php echo $totalprogress_con; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
														<td>
                                                            <?php $totalprogress_rep  =  $department['inprogress_rep']; ?>
                                                            <?php if ($totalprogress_rep > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,5,2,<?php echo ($financial_year_id)?$financial_year_id:0; ?>)"><?php echo $totalprogress_rep; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
														<td><?php echo $totalprogress = $totalprogress_con+$totalprogress_rep;   ?></td>
                                                        <td>
                                                            <?php $totalcompleted_con = $department['completed_con']; ?>
                                                            <?php if ($totalcompleted_con > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,6,1,<?php echo ($financial_year_id)?$financial_year_id:0; ?>)"><?php echo $totalcompleted_con; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
														<td>
                                                            <?php $totalcompleted_rep = $department['completed_rep']; ?>
                                                            <?php if ($totalcompleted_rep > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,6,2,<?php echo ($financial_year_id)?$financial_year_id:0; ?>)"><?php echo $totalcompleted_rep; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
														<td><?php echo $totalcompleted = $totalcompleted_con+$totalcompleted_rep;   ?></td>

                                                    </tr>
                                                <?php $sn++;
                                                    $totolprojectz_con += $totolproject_con;
                                                    $totolprojectz_rep += $totolproject_rep;
                                                    $totolprojectz += $totolproject;
                                                    $totalprogressz_con += $totalprogress_con;
                                                    $totalprogressz_rep += $totalprogress_rep;
                                                    $totalprogressz  += $totalprogress;
                                                    $totalcompletedz_con += $totalcompleted_con;
                                                    $totalcompletedz_rep += $totalcompleted_rep;
                                                    $totalcompletedz += $totalcompleted;
                                                endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="odd gradeX">
                                                    <td></td>
                                                    <td><?php echo "Total"; ?></td>
                                                    <td><?php echo $totolprojectz_con; ?></td>
                                                    <td><?php echo $totolprojectz_rep; ?></td>
                                                    <td><?php echo $totolprojectz; ?></td>
                                                    <td><?php echo $totalprogressz_con; ?></td>
                                                    <td><?php echo $totalprogressz_rep; ?></td>
                                                    <td><?php echo $totalprogressz; ?></td>
                                                    <td><?php echo $totalcompletedz_con; ?></td>
                                                    <td><?php echo $totalcompletedz_rep; ?></td>
                                                    <td><?php echo $totalcompletedz; ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
									</div>
                                    <?php } else {
                                        echo "<center><hr>No Data available!</center>";
                                    } ?>                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
		 <?php } ?>
    </div>
</div>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
            <tr>
                <td style='text-align:center' colspan="11">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="11"><b> Department wise Report as on
                        <?php echo date('d-m-Y'); ?>
                    </b></td>
            </tr>
             <tr class="text-center">
				<th rowspan="2" style="width:2%;"> Sno </th>
				<th rowspan="2" style="width:8%;"> Department Name </th>
				<th colspan="3" style="width:30%;"> Total Project </th>
				<th colspan="3" style="width:30%;"> Progress </th>
				<th colspan="3" style="width:30%;"> Completed</th>
			</tr>
			<tr>
			   <th style="width:10%;">Construction<br>works</th>
			   <th style="width:10%;">Special Repair<br> works</th>
			   <th style="width:5%;">Total</th>
			   <th style="width:10%;">Construction<br> works</th>
			   <th style="width:10%;">Special Repair<br> works</th>
			   <th style="width:5%;">Total</th>
			   <th style="width:10%;">Construction<br> works</th>
			   <th style="width:10%;">Special Repair<br> works</th>
			   <th style="width:5%;">Total</th>
			</tr>
            <?php $sno = 1;
            foreach ($department_details as $key => $department) : ?>
               <tr class="odd gradeX">
				<td><?php echo $sno; ?></td>
				<td><?php echo   $department['department_name']; ?></td>
				<td>
					<?php $totolproject_con1   = $department['total_count_con']; ?>
					<?php if ($totolproject_con1 > 0) { ?>
						<?php echo $totolproject_con1; ?>
					<?php } else {
						echo "0";
					} ?>
				</td>
				 <td>
					<?php $totolproject_rep1   = $department['total_count_rep']; ?>
					<?php if ($totolproject_rep1 > 0) { ?>
					<?php echo $totolproject_rep1; ?>
					<?php } else {
						echo "0";
					} ?>
				</td>
				<td><?php echo $totolproject1= $totolproject_con1+$totolproject_rep1;   ?></td>
				<td>
					<?php $totalprogress_con1  =  $department['inprogress_con']; ?>
					<?php if ($totalprogress_con1 > 0) { ?>
					 <?php echo $totalprogress_con1; ?>
					<?php } else {
						echo "0";
					} ?>
				</td>
				<td>
					<?php $totalprogress_rep1  =  $department['inprogress_rep']; ?>
					<?php if ($totalprogress_rep1 > 0) { ?>
				   <?php echo $totalprogress_rep1; ?>
					<?php } else {
						echo "0";
					} ?>
				</td>
				<td><?php echo $totalprogress1 = $totalprogress_con1+$totalprogress_rep1;   ?></td>
				<td>
					<?php $totalcompleted_con1 = $department['completed_con']; ?>
					<?php if ($totalcompleted_con1 > 0) { ?>
					<?php echo $totalcompleted_con1; ?>
					<?php } else {
						echo "0";
					} ?>
				</td>
				<td>
					<?php $totalcompleted_rep1 = $department['completed_rep']; ?>
					<?php if ($totalcompleted_rep1 > 0) { ?>
				   <?php echo $totalcompleted_rep1; ?>
					<?php } else {
						echo "0";
					} ?>
				</td>
				<td><?php echo $totalcompleted1 = $totalcompleted_con1+$totalcompleted_rep1;   ?></td>

			</tr>
		<?php $sno++;
					$totolprojectz_con1 += $totolproject_con1;
					$totolprojectz_rep1 += $totolproject_rep1;
					$totolprojectz1 += $totolproject1;
					$totalprogressz_con1 += $totalprogress_con1;
					$totalprogressz_rep1 += $totalprogress_rep1;
					$totalprogressz1  += $totalprogress1;
					$totalcompletedz_con1 += $totalcompleted_con1;
					$totalcompletedz_rep1 += $totalcompleted_rep1;
					$totalcompletedz1 += $totalcompleted1;
				endforeach; ?>
			</tbody>
			<tfoot>
				<tr class="odd gradeX">
					<td></td>
					<td><?php echo "Total"; ?></td>
					<td><?php echo $totolprojectz_con1; ?></td>
					<td><?php echo $totolprojectz_rep1; ?></td>
					<td><?php echo $totolprojectz1; ?></td>
					<td><?php echo $totalprogressz_con1; ?></td>
					<td><?php echo $totalprogressz_rep1; ?></td>
					<td><?php echo $totalprogressz1; ?></td>
					<td><?php echo $totalcompletedz_con1; ?></td>
					<td><?php echo $totalcompletedz_rep1; ?></td>
					<td><?php echo $totalcompletedz1; ?></td>
				</tr>
			</tfoot>
        </table>
    </div>
</div>

<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:95%;">
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
<script>
    function getdepart(key, type, work_type,fin_year) {
        // alert("hii");
        // alert(key);
        // alert(type);
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/Reports/ajaxdepartment/' + key + "/" + type + "/" + work_type+ "/" + fin_year,
            success: function(data, textStatus) {
                // alert(data);
                $(".add-unsent-form").html(data);
            }
        });
    }

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
                        "departmentwise.xls"
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

    $("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: false
            }
        },
        messages: {
            'financial_year_id': {
                required: "select Financial Year"
            }
        },
        submitHandler: function(form) {
            var fin_id = $('#financial-year-id').val();
            // var dep_id = $('#department-id').val();
            // var from_date = $('#form-date').val();
            // var to_date = $('#to-date').val();
			form.submit();

            // if (fin_id != '') {

                // form.submit();

            // } else {
                // alert('Select any one input!');
                // return false;

            // }
            // form.submit();
            // $(".btn").prop('disabled', true);
        }
    });
</script>