
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Project Fund Type Report</header>
            </div>
            <div class="">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                                                <div class="col-md-4">
                                                    <?php echo $this->Form->control('division_wise', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => 'Select division', 'error' => false, 'empty' => 'Select Division']); ?>
                                                </div>
												<!--div class="col-md-4">
												<?php  $work_types = [1=>'Construction Works',2=>'Special Repair Works'] ?>
													<?php echo $this->Form->control('work_type', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $work_types, 'label' => 'Work Type', 'error' => false, 'empty' => 'Select Work Type']); ?>
												</div-->
                                                  <div class="form-group m-t-20 text-center" style="padding-top: 10px;margin-bottom: -10px;">
                                                    <button type="details" class="btn btn-primary">
                                                        Get Details</button>
                                                </div>
                                                <?php echo $this->Form->End(); ?>
                                            </div>
                                        </div>
                                        <?php if ($projects != '') {  ?>
                                            <?php if (isset($projects)) { ?>
                                                <?php if (count($projects) > 0) { ?>
                                                    <div class="row" >
                                                        <div class="col-md-12 col-sm-6 col-6">
                                                            <div class="btn-group pull-right">
                                                                <button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Tools
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li>
                                                                        <a onClick="print_receipt('div_vc')"> <i class="fa fa-print"></i>Print</a>
                                                                    </li>
                                                                    <li>
                                                                        <a id="export_excel_button">
                                                                            <i class="fa fa-file-excel-o"></i>Export to Excel</a>
																	</li>
																</ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="table-scrollable user-table">							   
                                                       <table class="table table-bordered">
                                                            <thead style="text-align:center;">
                                                                <tr >
                                                                    <th rowspan="2" style="width:2%;border:1px solid #fff;">Sno</th>
                                                                    <th rowspan="2" style="width:8%;border:1px solid #fff;">Division</th>
                                                                    <th colspan="3" style="width:30%;border:1px solid #fff;">Construction<br>Works</th>
                                                                    <th colspan="3" style="width:30%;border:1px solid #fff;">Special<br>Repair Works</th>
                                                                </tr>
																<tr>
																   <th style="width:10%;">Total<br>Works</th>
																   <th style="width:10%;">PD Fund</th>
																   <th style="width:10%;">Direct Fund</th>
																   <th style="width:10%;">Total<br>Works</th>
																   <th style="width:10%;">PD Fund</th>
																   <th style="width:10%;">Direct Fund</th>
																</tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $sno = 1;
                                                                foreach ($projects as $key => $project) : ?>
                                                                    <tr class="odd gradeX">
                                                                        <td class="text-center"><?php echo $sno; ?></td>
                                                                        <td class="text-center">
                                                                            <?php echo $project['dname']; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php if ($project['tot_con'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:blue;" onclick="getempdesgn(1,<?php echo $key  ?>,0)"><?php echo $project['tot_con']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
																		<td class="text-center">
                                                                            <?php if ($project['con_pd'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:red;" onclick="getempdesgn(1,<?php echo $key  ?>,1)"><?php echo $project['con_pd']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
																		<td class="text-center">
                                                                            <?php if ($project['con_direct'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:blue;" onclick="getempdesgn(1,<?php echo $key  ?>,2)"><?php echo $project['con_direct']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
																		<td class="text-center">
                                                                            <?php if ($project['tot_rep'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:red;" onclick="getempdesgn(2,<?php echo $key  ?>,0)"><?php echo $project['tot_rep']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
																		<td class="text-center">
                                                                            <?php if ($project['rep_pd'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:blue;" onclick="getempdesgn(2,<?php echo $key  ?>,1)"><?php echo $project['rep_pd']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
																		<td class="text-center">
                                                                            <?php if ($project['rep_direct'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:red;" onclick="getempdesgn(2,<?php echo $key  ?>,2)"><?php echo $project['rep_direct']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>                                                                        															
                                                                    </tr>
                                                                <?php $sno++;
                                                                 $tot_con     +=  $project['tot_con'];
                                                                 $con_pd      +=  $project['con_pd'];
                                                                 $con_direct  +=  $project['con_direct'];
                                                                 $tot_rep     +=  $project['tot_rep'];
                                                                 $rep_pd      +=  $project['rep_pd'];                                                                
                                                                 $rep_direct  +=  $project['rep_direct'];                                                                
                                                            
                                                                endforeach; ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="odd gradeX">
                                                                    <td colspan="2" style="text-align:right;"><?php echo "Total"; ?></td>
                                                                    <td class="text-center" style="font-weight:bold;"><?php echo $tot_con; ?>
                                                                    </td>
																	<td class="text-center" style="font-weight:bold;"><?php echo $con_pd; ?>
                                                                    </td>
                                                                    <td class="text-center" style="font-weight:bold;"><?php echo $con_direct; ?>
                                                                    </td>
																	<td class="text-center" style="font-weight:bold;"><?php echo $tot_rep; ?>
                                                                    </td>
																	<td class="text-center" style="font-weight:bold;"><?php echo $rep_pd; ?>
                                                                    </td>
																	<td class="text-center" style="font-weight:bold;"><?php echo $rep_direct; ?>
                                                                    </td>																	
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                <?php } else {
                                                    echo "<center><hr>No Data available!</center>";
                                                }  ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- REPORT -->
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:98%;">
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
				<th rowspan="2" style="width:2%;">Sno</th>
				<th rowspan="2" style="width:8%;">Division</th>
				<th colspan="2" style="width:20%;">Total<br>Projects</th>
				<th colspan="2" style="width:20%;">AS Received</th>
				<th colspan="2" style="width:20%;">AS NOT<br>Received</th>
				<th style="width:10%;">FS Received</th>
				<!--th style="width:10%;">FS NOT<br>Received</th-->
				<th style="width:10%;">AS Received and<br>FS NOT Received</th>
			</tr>
			<tr>
			   <th style="width:10%;">Construction<br>Works</th>
			   <th style="width:10%;">Special<br>Repair Works</th>
			   <th style="width:10%;">Construction<br>Works</th>
			   <th style="width:10%;">Special<br>Repair Works</th>
			   <th style="width:10%;">Construction<br>Works</th>
			   <th style="width:10%;">Special<br>Repair Works</th>
			   <th style="width:10%;">Construction<br>Works</th>
			   <!--th style="width:10%;">Construction<br> Works</th-->
			   <th style="width:10%;">Construction<br>Works</th>
			</tr>
		</thead>
		<tbody>
			<?php $sno1 = 1;
			foreach ($projects as $key => $project) : ?>
				<tr class="odd gradeX">
					<td class="text-center"><?php echo $sno1; ?></td>
					<td class="text-center">
						<?php echo $project['dname']; ?>
					</td>
					<td class="text-center">
						<?php if ($project['total_con'] != '') { ?>
							<?php echo $project['total_con']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					<td class="text-center">
						<?php if ($project['total_rep'] != '') { ?>
							<?php echo $project['total_rep']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					<td class="text-center">
						<?php if ($project['AS_san_con'] != '') { ?>
							<?php echo $project['AS_san_con']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					<td class="text-center">
						<?php if ($project['AS_san_rep'] != '') { ?>
						<?php echo $project['AS_san_rep']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					<td class="text-center">
						<?php if ($project['AS_not_San_con'] != '') { ?>
							<?php echo $project['AS_not_San_con']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					<td class="text-center">
						<?php if ($project['AS_not_San_rep'] != '') { ?>
							<?php echo $project['AS_not_San_rep']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					<td class="text-center">
						<?php if ($project['FS_san'] != '') { ?>
							<?php echo $project['FS_san']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>
					 <!--td class="text-center">
						<?php if ($project['FS_not_san'] != '') { ?>
							<?php echo $project['FS_not_san']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td-->
					<td class="text-center">
						<?php if ($project['AS_san_FS_not'] != '') { ?>
							<?php echo $project['AS_san_FS_not']; ?>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td>																		
				</tr>
			<?php $sno1++;
			 $total_div_con1      +=  $project['total_con'];
			 $total_div_rep1      +=  $project['total_rep'];
			 $AS_san_div_con1     +=  $project['AS_san_con'];
			 $AS_san_div_rep1     +=  $project['AS_san_rep'];
			 $tot_AS_not_San_con1 +=  $project['AS_not_San_con'];
			 $tot_AS_not_San_rep1 +=  $project['AS_not_San_rep'];
			 $tot_FS_san1     +=  $project['FS_san'];
			 $FS_not_san1     +=  $project['FS_not_san'];
			 $AS_san_FS_not1  +=  $project['AS_san_FS_not'];
			 /*echo "<pre>";
			 print_r($totalcompleted_opening);
			exit();*/
			endforeach; ?>
		</tbody>
		<tfoot>
			<tr class="odd gradeX">
				<td colspan="2" style="text-align:right;"><?php echo "Total"; ?></td>
				<td class="text-center" style="font-weight:bold;"><?php echo $total_div_con1; ?>
				</td>
				<td class="text-center" style="font-weight:bold;"><?php echo $total_div_rep1; ?>
				</td>
				<td class="text-center" style="font-weight:bold;"><?php echo $AS_san_div_con1; ?>
				</td>
				<td class="text-center" style="font-weight:bold;"><?php echo $AS_san_div_rep1; ?>
				</td>
				<td class="text-center" style="font-weight:bold;"><?php echo $tot_AS_not_San_con1; ?>
				</td>
				<td class="text-center" style="font-weight:bold;"><?php echo $tot_AS_not_San_rep1; ?>
				</td>
				<td class="text-center" style="font-weight:bold;"><?php echo $tot_FS_san1; ?>
				</td>
				<!--td class="text-center" style="font-weight:bold;"><?php echo $FS_not_san1; ?>
				</td-->
				<td class="text-center" style="font-weight:bold;"><?php echo $AS_san_FS_not1; ?>
				</td>
			</tr>
		</tfoot>
	</table>
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>
<script>
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
                        "AS_FS_report.xls"
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

    function getempdesgn(work_type, division_id,typeid) {
        var work_type;
        var typeid;
		
		if(division_id != ''){			
		   var divid = division_id;
		}else{
		   var divid = <?php echo ($division_id) ? "'" . $division_id. "'" : '0'; ?>;
	    }
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/reports/ajaxdivisionfundtypereport/'+work_type+'/'+divid+'/'+typeid,
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


    $("#FormID").validate({
        rules: {
            'work_type': {
                required: true
            }

        },
        messages: {
            'work_type': {
                required: "Select Work Type"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
</script>