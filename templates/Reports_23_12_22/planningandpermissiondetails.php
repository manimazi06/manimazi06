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
                <header>Planning Permission Status</header>
            </div>
            <div class="card-body ">
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
                                                                        <a onClick="print_receipt('div_vc')">
                                                                            <i class="fa fa-print"></i> Print </a>
                                                                    </li>
                                                                    <li>
                                                                        <a id="export_excel_button">
                                                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-scrollable">
                                                        <table class="table  table-bordered table-checkable order-column" style="width: 100%">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Sno</th>
                                                                    <th>Division</th>
                                                                    <th>Total Projects</th>
                                                                    <th>Planning Permission obtained</th>
                                                                    <th>Planning Permission not obtained</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $sno = 1;
                                                                foreach ($projects as $project) : ?>
                                                                    <tr class="odd gradeX">
                                                                        <td class="text-center"><?php echo $sno; ?></td>
                                                                        <td class="text-center">
                                                                            <?php echo $project['dname']; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php if ($project['total'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1)"><?php echo $project['total']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php if ($project['planned'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(2)"><?php echo $project['planned']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php if ($project['not_planned'] != '') { ?>
                                                                                <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(3)"><?php echo $project['not_planned']; ?></a>
                                                                            <?php } else { ?>
                                                                                <span><?php echo "0"; ?></span>
                                                                            <?php  } ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php $sno++;
                                                                // $total_div  +=  $project['total'];
                                                                // $planned_div   +=  $project['planned'];
                                                                // $notplanned_div    +=  $project['not_planned'];
                                                                // echo "<pre>";
                                                                // print_r($totalcompleted_opening);
                                                                // exit();
                                                                endforeach; ?>
                                                            </tbody>
                                                            <!-- <tfoot>
                                                                <tr class="odd gradeX">

                                                                    <td colspan="2"><?php echo "Total"; ?></td>
                                                                    <td class="text-center" style="font-weight:bold; color:red;"><?php echo
                                                                                                                                    $total; ?>
                                                                    </td>
                                                                    <td class="text-center" style="font-weight:bold; color:red;"><?php echo $planned; ?>
                                                                    </td>
                                                                    <td class="text-center" style="font-weight:bold; color:red;"><?php echo $notplanned; ?>
                                                                    </td>
                                                                </tr>
                                                            </tfoot> -->
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
                <th> Sno </th>
                <th> Division </th>
                <th> Total Projects </th>
                <th> Planning permission obtained </th>
                <th>Planning permission not obtained</th>
            </tr>
            <?php $sno = 1;
            foreach ($projects as $project) : ?>
                <tr class="odd gradeX" style="text-align:center ;">
                    <td class="text-center"><?php echo $sno; ?></td>
                    <td class="text-center">
                        <?php echo $project['dname']; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($project['total'] != '') { ?>
                            <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1)"><?php echo $project['total']; ?></a>
                        <?php } else { ?>
                            <span><?php echo "0"; ?></span>
                        <?php  } ?>
                    </td>
                    <td class="text-center">
                        <?php if ($project['planned'] != '') { ?>
                            <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(2)"><?php echo $project['planned']; ?></a>
                        <?php } else { ?>
                            <span><?php echo "0"; ?></span>
                        <?php  } ?>
                    </td>
                    <td class="text-center">
                        <?php if ($project['not_planned'] != '') { ?>
                            <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(3)"><?php echo $project['not_planned']; ?></a>
                        <?php } else { ?>
                            <span><?php echo "0"; ?></span>
                        <?php  } ?>
                    </td>
                </tr>
            <?php $sno++;
            // $total_div  +=  $project['total'];
            // $planned_div   +=  $project['planned'];
            // $notplanned_div    +=  $project['not_planned'];
            // echo "<pre>";
            // print_r($totalcompleted_opening);
            // exit();
            endforeach; ?>
            <!-- <tfoot>
                <tr class="odd gradeX" style="text-align:center ;">

                    <td colspan="2"><?php echo "Total"; ?></td>
                    <td class="text-center" style="font-weight:bold; color:red;"><?php echo
                                                                                    $total_div; ?>
                    </td>
                    <td class="text-center" style="font-weight:bold; color:red;"><?php echo $planned_div; ?>
                    </td>
                    <td class="text-center" style="font-weight:bold; color:red;"><?php echo $notplanned_div; ?>
                    </td>
                </tr>
            </tfoot> -->
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

    function getempdesgn(val, divid) {
        var val;
        var division_wise = <?php echo ($division_wise) ? "'" . $division_wise . "'" : '0'; ?>;
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxplanningandpermissiondetails/' + val + '/' + division_wise,
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
            'division_wise': {
                required: true
            }

        },
        messages: {
            'division_wise': {
                required: "Select Division"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
</script>