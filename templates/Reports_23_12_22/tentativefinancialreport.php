<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>
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
                <header><b>Tentative Financial Programme Report</b></header>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <?php echo $this->Form->create($tentativeFinancialProgrammeDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                                        <div class="col-md-12 row">
                                            <label class="control-label col-md-2">Financial year<span class="required"> * </span></label>
                                            <div class="col-md-3">
                                                <?php echo $this->Form->control('financial_year_id',  ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $finacial_year, 'empty' => 'select financial year']); ?>
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
                            </div>
                            <?php if ($division_details != '') { ?>
                                <?php if (count($division_details) > 0) { ?>
                                    <center>
                                        <h4><b>Tentative Financial Programme Report - <?php echo $financial_year_name; ?>&nbsp;&nbsp;(Rs in lakhs)</b></h4>
                                    </center>
                                    <div class="btn-group pull-right">
                                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a onClick="print_receipt('div_vc')"><i class="fa fa-print"></i> Print </a>
                                            </li>
                                            <li>
                                                <a id="export_excel_button"><i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                            </li>
                                        </ul>
                                    </div><br>
                                    <div class="table-scrollable user-table">
                                        <table class="table  table-bordered table-checkable order-column mobile-table" style="width: 100px;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2"> Sno </th>
                                                    <th rowspan="2"> Division Name </th>
                                                    <th>April</th>
                                                    <th>May</th>
                                                    <th>June</th>
                                                    <th>July</th>
                                                    <th>August</th>
                                                    <th>September</th>
                                                    <th>October</th>
                                                    <th>November</th>
                                                    <th>December</th>
                                                    <th>January</th>
                                                    <th>February</th>
                                                    <th>March</th>
                                                    <th rowspan="2">Total Amount</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="9"> <?php echo substr($financial_year_name, 0, 4); ?></th>
                                                    <th class="text-center" colspan="3"> <?php echo substr($financial_year_name, -4); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;
                                                foreach ($division_details as $key => $division) : ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $sn; ?></td>
                                                        <td> <?php echo $division['division_name']; ?></td>
                                                        <td align="right"><?php $apriltotal = $division['Apr']; ?>
                                                            <?php echo $division['Apr'];  ?></td>
                                                        <td align="right">
                                                            <?php $maytotal = $division['May']; ?>
                                                            <?php echo $division['May']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $junetotal = $division['June']; ?>
                                                            <?php echo $division['June']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $julytotal = $division['July']; ?>
                                                            <?php echo $division['July']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $augtotal = $division['Aug']; ?>
                                                            <?php echo $division['Aug']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $septotal = $division['Sep']; ?>
                                                            <?php echo $division['Sep']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $octtotal = $division['Oct']; ?>
                                                            <?php echo $division['Oct']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $novtotal = $division['Nov']; ?>
                                                            <?php echo $division['Nov']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $decetotal = $division['Dece']; ?>
                                                            <?php echo $division['Dece']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $jantotal = $division['Jan']; ?>
                                                            <?php echo $division['Jan']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $febtotal = $division['Feb']; ?>
                                                            <?php echo $division['Feb']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $martotal = $division['Mar']; ?>
                                                            <?php echo $division['Mar']; ?>
                                                        </td>
                                                        <td align="right">
                                                            <?php $totalmonth = $division['totalamount']; ?>
                                                            <b><?php echo $division['totalamount']; ?></b>
                                                        </td>
                                                    </tr>
                                                <?php $sn++;
                                                    $apriltotolz += $apriltotal;
                                                    $maytotolz   += $maytotal;
                                                    $junetotalz  += $junetotal;
                                                    $julytotalz  += $julytotal;
                                                    $augtotalz   += $augtotal;
                                                    $septotalz   += $septotal;
                                                    $octtotalz   += $octtotal;
                                                    $novtotalz   += $novtotal;
                                                    $decetotalz  += $decetotal;
                                                    $jantotalz   += $jantotal;
                                                    $febtotalz   += $febtotal;
                                                    $martotalz   += $martotal;
                                                    $totalmonthz += $totalmonth;
                                                endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="odd gradeX">
                                                    <td></td>
                                                    <td style= "text-align:right;"><b><?php echo "Total"; ?></b></td>
                                                    <td align="right"><b><?php echo $apriltotolz; ?></b></td>
                                                    <td align="right"><b><?php echo $maytotolz; ?></b></td>
                                                    <td align="right"><b><?php echo $junetotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $julytotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $augtotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $septotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $octtotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $novtotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $decetotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $jantotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $febtotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $martotalz; ?></b></td>
                                                    <td align="right"><b><?php echo $totalmonthz; ?></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                <?php } else {
                                    echo "<center><hr>No Data available!</center>";
                                } ?>
                            <?php } ?>
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
            <tr>
                <td style='text-align:center' colspan="15">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br/></strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="15"><b>Tentative Financial Programme Report as on <?php echo $financial_year_name; ?></b></td>
            </tr>
            <tr>
            <tr class="text-center">
                <th rowspan="2"> Sno </th>
                <th rowspan="2"> Division Name </th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th rowspan="2">Total Amount</th>
            </tr>
            <tr>
                <th colspan="9"> <?php echo substr($financial_year_name, 0, 4); ?></th>
                <th class="text-center" colspan="3"> <?php echo substr($financial_year_name, -4); ?></th>
            </tr>
            </tr>
            <?php $sn = 1;
            foreach ($division_details as $key => $division) : ?>
                <tr class="odd gradeX">
                    <td><?php echo $sn; ?></td>
                    <td> <?php echo $division['division_name']; ?></td>
                    <td align="right"><?php $apriltotal = $division['Apr']; ?>
                        <?php echo $division['Apr'];  ?></td>
                    <td align="right">
                        <?php $maytotal = $division['May']; ?>
                        <?php echo $division['May']; ?>
                    </td>
                    <td align="right">
                        <?php $junetotal = $division['June']; ?>
                        <?php echo $division['June']; ?>
                    </td>
                    <td align="right">
                        <?php $julytotal = $division['July']; ?>
                        <?php echo $division['July']; ?>
                    </td>
                    <td align="right">
                        <?php $augtotal = $division['Aug']; ?>
                        <?php echo $division['Aug']; ?>
                    </td>
                    <td align="right">
                        <?php $septotal = $division['Sep']; ?>
                        <?php echo $division['Sep']; ?>
                    </td>
                    <td align="right">
                        <?php $octtotal = $division['Oct']; ?>
                        <?php echo $division['Oct']; ?>
                    </td>
                    <td align="right">
                        <?php $novtotal = $division['Nov']; ?>
                        <?php echo $division['Nov']; ?>
                    </td>
                    <td align="right">
                        <?php $decetotal = $division['Dece']; ?>
                        <?php echo $division['Dece']; ?>
                    </td>
                    <td align="right">
                        <?php $jantotal = $division['Jan']; ?>
                        <?php echo $division['Jan']; ?>
                    </td>
                    <td align="right">
                        <?php $febtotal = $division['Feb']; ?>
                        <?php echo $division['Feb']; ?>
                    </td>
                    <td align="right">
                        <?php $martotal = $division['Mar']; ?>
                        <?php echo $division['Mar']; ?>
                    </td>
                    <td align="right">
                        <?php $totalmonth = $division['totalamount']; ?>
                        <b><?php echo $division['totalamount']; ?></b>
                    </td>
                </tr>
            <?php $sn++;
                $apriltotolz1 += $apriltotal;
                $maytotolz1   += $maytotal;
                $junetotalz1  += $junetotal;
                $julytotalz1  += $julytotal;
                $augtotalz1   += $augtotal;
                $septotalz1   += $septotal;
                $octtotalz1   += $octtotal;
                $novtotalz1   += $novtotal;
                $decetotalz1  += $decetotal;
                $jantotalz1   += $jantotal;
                $febtotalz1   += $febtotal;
                $martotalz1   += $martotal;
                $totalmonthz1 += $totalmonth;
            endforeach; ?>
            <tfoot>
                <tr class="odd gradeX">
                    <td></td>
                    <td><?php echo "Total"; ?></td>
                    <td align="right"><b><?php echo $apriltotolz1; ?></b></td>
                    <td align="right"><b><?php echo $maytotolz1; ?></b></td>
                    <td align="right"><b><?php echo $junetotalz1; ?></b></td>
                    <td align="right"><b><?php echo $julytotalz1; ?></b></td>
                    <td align="right"><b><?php echo $augtotalz1; ?></b></td>
                    <td align="right"><b><?php echo $septotalz1; ?></b></td>
                    <td align="right"><b><?php echo $octtotalz1; ?></b></td>
                    <td align="right"><b><?php echo $novtotalz1; ?></b></td>
                    <td align="right"><b><?php echo $decetotalz1; ?></b></td>
                    <td align="right"><b><?php echo $jantotalz1; ?></b></td>
                    <td align="right"><b><?php echo $febtotalz1; ?></b></td>
                    <td align="right"><b><?php echo $martotalz1; ?></b></td>
                    <td align="right"><b><?php echo $totalmonthz1; ?></b></td>
                </tr>
            </tfoot>
        </table>
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
                        "tentative_financial_programme.xls"
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