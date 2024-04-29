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
                                                <?php echo $this->Form->control('financial_year_id',  ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $finacial_year, 'empty' => 'Select Financial year']); ?>
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
								<center><h4><b>Department Wise Project Count for financial Year - <?php echo $financial_year ?></b></h4></center>
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
                                                    <th> Sno </th>
                                                    <th> Department Name </th>
                                                    <th> Total Project </th>
                                                    <th> Progress </th>
                                                    <th> Completed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;
                                                foreach ($department_details as $key => $department) : ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $sn; ?></td>
                                                        <td><?php echo   $department['department_name']; ?></td>
                                                        <td>
                                                            <?php $totolproject   = $department['total_count']; ?>
                                                            <?php if ($totolproject > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,1)"><?php echo $totolproject; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php $totalprogress  =  $department['inprogress']; ?>
                                                            <?php if ($totalprogress > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,2)"><?php echo $totalprogress; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php $totalcompleted = $department['completed']; ?>
                                                            <?php if ($totalcompleted > 0) { ?>
                                                                <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,3)"><?php echo $totalcompleted; ?></a>
                                                            <?php } else {
                                                                echo "0";
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                <?php $sn++;
                                                    $totolprojectz += $totolproject;
                                                    $totalprogressz += $totalprogress;
                                                    $totalcompletedz += $totalcompleted;
                                                endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="odd gradeX">
                                                    <td></td>
                                                    <td><?php echo "Total"; ?></td>
                                                    <td><?php echo $totolprojectz; ?></td>
                                                    <td><?php echo $totalprogressz; ?></td>
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
                <td style='text-align:center' colspan="5">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="5"><b> Department wise Report as on
                        <?php echo date('d-m-Y'); ?>
                    </b></td>
            </tr>
            <tr>
                <th> Sno </th>
                <th> Department Name </th>
                <th> Total Project </th>
                <th> Progress </th>
                <th> Completed</th>
            </tr>
            <?php $sno = 1;
            foreach ($department_details as $key => $department) : ?>
                <tr>
                    <td><?php echo ($sno); ?></td>
                    <td><?php echo  $department['department_name']; ?></td>
                    <td><?php echo $department['total_count']; ?></td>
                    <td class="title"><?php echo $department['inprogress']; ?></td>
                    <td class="title"><?php echo $department['completed']; ?> </td>
                </tr>

            <?php $sno++;
                $totolprojectz += $totolproject;
                $totalprogressz += $totalprogress;
                $totalcompletedz += $totalcompleted;
            endforeach;  ?>
            <tfoot>
                <tr class="odd gradeX">
                    <td></td>
                    <td><?php echo "Total"; ?></td>
                    <td><?php echo $totolprojectz; ?></td>
                    <td><?php echo $totalprogressz; ?></td>
                    <td><?php echo $totalcompletedz; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:80%;">
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
    function getdepart(key, type) {
        // alert("hii");
        // alert(key);
        // alert(type);
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxdepartment/' + key + "/" + type,
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
                required: true
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
            var from_date = $('#form-date').val();
            var to_date = $('#to-date').val();

            if (fin_id != '') {

                form.submit();

            } else {
                alert('Select any one input!');
                return false;

            }
            // form.submit();
            // $(".btn").prop('disabled', true);
        }
    });
</script>