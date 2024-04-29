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
	
	
	.table-scrollable{
		height:700px;
       width:100%;
       overflow:scroll;
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
                                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;">
                                    <div class="card-body">
                                        <?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                                        <div class="col-md-12 row">
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('division', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $division_table, 'label' => 'Division', 'error' => false, 'empty' => 'Select Division']); ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $this->Form->control('financial', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financial, 'label' => 'Financial Year', 'error' => false, 'empty' => '-All-']); ?>
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
                                        <h4><strong>Progress Report for Division - &nbsp;<?php echo $division_wise ?>&nbsp;&nbsp;<?php if($finance_wise != ''){ ?>for Financial Year -&nbsp;<?php echo $finance_wise; } ?></strong></h4>
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
                                            <thead  class="fixed" style="position:sticky;top:0px;z-index: 1;background-color:#244f96;color:white;">  
                                                <tr class="text-center">
                                                    <th rowspan="2" style="width:1%;top:0px;left:0px;position:sticky;z-index: 1;background-color:#244f96;color:white;"> Sno </th>
                                                    <th rowspan="2" style="width:18%;top:0px;left:0px;position:sticky;z-index: 1;background-color:#244f96;color:white;"> Work Name </th>
                                                    <th rowspan="2" style="width:5%;"> Districts </th>
                                                    <th rowspan="2" style="width:5%;">IG /<br> SP/<br> DC/CMT </th>
                                                    <th rowspan="2" style="width:5%;"> DSP/<br> AC/<br> A.CMT </th>
                                                    <th rowspan="2" style="width:5%;"> INSPECTOR </th>
                                                    <th rowspan="2" style="width:5%;"> SUB-<br>INSPECTOR </th>
                                                    <th rowspan="2" style="width:5%;"> HC/PC </th>
                                                    <th rowspan="2" style="width:5%;"> F.S.Value<br>(Rs.In lakhs)</th>
                                                    <th rowspan="2" style="width:5%;"> Exp.during <br>last month <br>(Rs.in lakhs)</th>
                                                    <th rowspan="2" style="width:5%;"> Exp.upto <br>this month<br>(Rs.in Lakhs)</th>
                                                    <th rowspan="2" style="width:5%;"> Total <br> Expenditure</th>
                                                    <th rowspan="2" style="width:5%;"> Date of handing<br>over of site</th>
                                                    <th rowspan="2" style="width:5%;"> Actual<br> Target<br> Date</th>
                                                    <th rowspan="2" style="width:5%;">Revised<br> Target<br> Date</th>
                                                    <th colspan="3" style="width:9%;">% of achievement </th>
                                                    <th rowspan="2" style="width:5%;"> Present Stage</th> 
                                                </tr>
                                                <tr class="text-center">
                                                    <th>Physical</th>
                                                    <th>Financial</th>
                                                    <th>Photo</th>
                                                </tr>
                                            </thead>
                                            <tbody  style = "background-color:#d0dae7">
                                                <?php $sno = 1;
                                                foreach ($projects as $project) : ?>  
                                                    <tr class="odd gradeX" style="text-align:center ;">
                                                        <td class="text-center" style="left:0px;position:sticky;z-index: 1;background-color:#d0dae7;"><?php echo $sno; ?></td>
                                                        <td class="text-center" style="left:0px;position:sticky;z-index: 1;background-color:#d0dae7;"><?php echo "Work code -".$project['wcode']."<br> ".$project['name']; ?></td>
                                                        <td class="text-center"><?php echo $project['dname']; ?> </td>
                                                        <td class="text-center"><?php
                                                                                if ($quarter_details[$project['sub_id']][0]['ig'] != '') {
                                                                                    echo $quarter_details[$project['sub_id']][0]['ig'];
                                                                                } else {
                                                                                    echo '0';
                                                                                } ?></td>
                                                        <td class="text-center"><?php
                                                                                if ($quarter_details[$project['sub_id']][0]['dsp'] != '') {
                                                                                    echo $quarter_details[$project['sub_id']][0]['dsp'];
                                                                                } else {
                                                                                    echo '0';
                                                                                } ?></td>
                                                        <td class="text-center"><?php
                                                                                if ($quarter_details[$project['sub_id']][0]['insp'] != '') {
                                                                                    echo $quarter_details[$project['sub_id']][0]['insp'];
                                                                                } else {
                                                                                    echo '0';
                                                                                } ?></td>
                                                        <td class="text-center"><?php
                                                                                if ($quarter_details[$project['sub_id']][0]['sub_insp'] != '') {
                                                                                    echo $quarter_details[$project['sub_id']][0]['sub_insp'];
                                                                                } else {
                                                                                    echo '0';
                                                                                } ?></a></td>
                                                        <td class="text-center"><?php
                                                                                if ($quarter_details[$project['sub_id']][0]['constable'] != '') {
                                                                                    echo $quarter_details[$project['sub_id']][0]['constable'];
                                                                                } else {
                                                                                    echo '0';
                                                                                } ?></a></td>
                                                        <!-- <td class="text-center">
                                                            <?php if ($project['amount'] != 0) { ?>
                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1)"><?php echo $sanction = $project['amount']; ?></a>
                                                            <?php } else { ?>
                                                                <span><?php echo "0"; ?></span>
                                                            <?php  } ?>
                                                        </td> -->
                                                        <td class="text-center">
                                                            <?php echo $sanction = $project['amount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($expenditure_details[$project['sub_id']]['last_month'] != '') {
                                                                echo $expenditure_details[$project['sub_id']]['last_month'];
                                                            } else
                                                                echo '0';
                                                            ?></td>
                                                        <td><?php if ($expenditure_details[$project['sub_id']]['this_month'] != '') {
                                                                echo $expenditure_details[$project['sub_id']]['this_month'];
                                                            } else
                                                                echo '0';
                                                            ?></td>
                                                        <td><?php echo $total = $expenditure_details[$project['sub_id']]['last_month'] + $expenditure_details[$project['sub_id']]['this_month']; ?></td>
                                                        <td class="text-center"><?php echo ($project['sdate'])?date('d-m-Y',strtotime($project['sdate'])):''; ?></td>
                                                        <td class="text-center"><?php echo ($project['adate'])?date('d-m-Y',strtotime($project['adate'])):''; ?></td>
                                                        <td><?php echo ($eot_time[$project['sub_id']]['eot'])?date('d-m-Y',strtotime($eot_time[$project['sub_id']]['eot'])):'';  ?></td>
                                                        <td class="text-center"><?php echo  $monitoring_details[$project['sub_id']]['work_percentage']['name'] ?></td>
                                                        <td class="text-center"><?php echo  $monitoring_details[$project['sub_id']]['financial_percentage']['name'] ?></td>
                                                        <td class="text-center">
														    <?php if($monitoring_details[$project['sub_id']]['work_percentage']['name'] != ''){  ?>
                                                            <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none;color:red;" onclick="photoview(<?php echo $project['sub_id'] ?>)">View</a>
															<?php } ?>
													   </td>
                                                        <td> <?php echo $project['sname']; ?></td>
                                                    </tr>
                                                <?php $sno++;
                                                    $total_ig += $quarter_details[$project['sub_id']][0]['ig'];
                                                    $total_dsp += $quarter_details[$project['sub_id']][0]['dsp'];
                                                    $total_insp +=  $quarter_details[$project['sub_id']][0]['insp'];
                                                    $total_subinsp += $quarter_details[$project['sub_id']][0]['sub_insp'];
                                                    $total_constable +=  $quarter_details[$project['sub_id']][0]['constable'];
                                                    $total_sanction  += $sanction;
                                                    $last_month += $expenditure_details[$project['sub_id']]['last_month'];
                                                    $this_month += $expenditure_details[$project['sub_id']]['this_month'];
                                                    $total_exp += $total;
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
                                                    <td class="text-center" style="font-weight:bold; color:black;"><?php echo $last_month; ?></td>
                                                    <td class="text-center" style="font-weight:bold; color:black;"><?php echo $this_month; ?></td>
                                                    <td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_exp; ?></td>
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
    <div class="modal-dialog" style="max-width:95%;">
        <div class="modal-content">
            <div class="modal-header">
			    <div style="margin-left:90%;"><a onClick="print_receipt('div_vc_1')">
                                                    <i class="fa fa-print"></i> Print</a></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="margin-left:25px;">
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
                <td style='text-align:center' colspan="19">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="19">Progress report for Division-<?php echo $division_wise ?>in the year-<?php echo $finance_wise ?>
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
				<th rowspan="2"> Exp.during last month(Rs.in lakhs)</th>
				<th rowspan="2"> Exp.upto this month(Rs.in Lakhs)</th>
				<th rowspan="2"> Total Expenditure</th>
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
		</thead>
		<tbody>
			<?php $sno = 1;
			foreach ($projects as $project) : ?>
				<tr class="odd gradeX" style="text-align:center ;">
					<td class="text-center"><?php echo $sno; ?></td>
					<td class="text-center"><?php echo $project['name']; ?></td>
					<td class="text-center"><?php echo $project['wcode']; ?></td>
					<td class="text-center"><?php echo $project['dname']; ?> </td>
					<td class="text-center"><?php
											if ($quarter_details[$project['sub_id']][0]['ig'] != '') {
												echo $quarter_details[$project['sub_id']][0]['ig'];
											} else {
												echo '0';
											} ?></td>
					<td class="text-center"><?php
											if ($quarter_details[$project['sub_id']][0]['dsp'] != '') {
												echo $quarter_details[$project['sub_id']][0]['dsp'];
											} else {
												echo '0';
											} ?></td>
					<td class="text-center"><?php
											if ($quarter_details[$project['sub_id']][0]['insp'] != '') {
												echo $quarter_details[$project['sub_id']][0]['insp'];
											} else {
												echo '0';
											} ?></td>
					<td class="text-center"><?php
											if ($quarter_details[$project['sub_id']][0]['sub_insp'] != '') {
												echo $quarter_details[$project['sub_id']][0]['sub_insp'];
											} else {
												echo '0';
											} ?></a></td>
					<td class="text-center"><?php
											if ($quarter_details[$project['sub_id']][0]['constable'] != '') {
												echo $quarter_details[$project['sub_id']][0]['constable'];
											} else {
												echo '0';
											} ?></a></td>
					<!-- <td class="text-center">
						<?php if ($project['amount'] != 0) { ?>
							<a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1)"><?php echo $sanction = $project['amount']; ?></a>
						<?php } else { ?>
							<span><?php echo "0"; ?></span>
						<?php  } ?>
					</td> -->
					<td class="text-center">
						<?php echo $sanction = $project['amount']; ?>
					</td>
					<td>
						<?php
						if ($expenditure_details[$project['sub_id']]['last_month'] != '') {
							echo $expenditure_details[$project['sub_id']]['last_month'];
						} else
							echo '0';
						?></td>
					<td><?php if ($expenditure_details[$project['sub_id']]['this_month'] != '') {
							echo $expenditure_details[$project['sub_id']]['this_month'];
						} else
							echo '0';
						?></td>
					<td><?php echo $total = $expenditure_details[$project['sub_id']]['last_month'] + $expenditure_details[$project['sub_id']]['this_month']; ?></td>
					<td class="text-center"><?php echo date('d-m-Y',strtotime($project['sdate'])); ?></td>
					<td class="text-center"><?php echo date('d-m-Y',strtotime($project['adate'])); ?></td>
					<td><?php echo ($eot_time[$project['sub_id']]['eot'])?date('d-m-Y',strtotime($eot_time[$project['sub_id']]['eot'])):'';  ?></td>
					<td class="text-center"><?php echo  $monitoring_details[$project['sub_id']]['work_percentage']['name'] ?></td>
					<td class="text-center"><?php echo  $monitoring_details[$project['sub_id']]['financial_percentage']['name'] ?></td>
					<td> <?php echo $project['sname']; ?></td>
				</tr>
			<?php $sno++;
				$total_ig1 += $quarter_details[$project['sub_id']][0]['ig'];
				$total_dsp1 += $quarter_details[$project['sub_id']][0]['dsp'];
				$total_insp1 +=  $quarter_details[$project['sub_id']][0]['insp'];
				$total_subinsp1 += $quarter_details[$project['sub_id']][0]['sub_insp'];
				$total_constable1 +=  $quarter_details[$project['sub_id']][0]['constable'];
				$total_sanction1  += $sanction;
				$last_month1 += $expenditure_details[$project['sub_id']]['last_month'];
				$this_month1 += $expenditure_details[$project['sub_id']]['this_month'];
				$total_exp1 += $total;
			endforeach; ?>
		</tbody>
		<tfoot>
			<tr  style="text-align:center;">
				<td colspan="4" style="text-align:right;"><b><?php echo "Total"; ?></b></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_ig1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_dsp1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_insp1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_subinsp1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_constable1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_sanction1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $last_month1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $this_month1; ?></td>
				<td class="text-center" style="font-weight:bold; color:black;"><?php echo $total_exp1; ?></td>
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
                required: false
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
                        "progress_report.xls"
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
            url: '<?php echo $this->Url->webroot ?>/Reports/ajaxprogress/' + val + '/' + div + '/' + finance,
            success: function(data, textStatus) {
                //alert(data);
                $(".add-unsent-form").html(data);
            }
        });
    }

    function photoview(sub_id) {
        // var val;

        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/Reports/ajaxphoto/' + sub_id,
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