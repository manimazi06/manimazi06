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
                <header>Utilisation Certificate Report</header>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:20px;">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <?php echo $this->Form->create($projectWorks, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                                            <div class="col-md-12 row">
                                                <label class="control-label col-md-2">Financial year<span class="required"> * </span></label>
                                                <div class="col-md-3">
                                                    <?php echo $this->Form->control('financial_year_id',  ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $finacial_year, 'empty' => 'Select Financial year']); ?>
                                                </div>
                                                <label class="control-label col-md-2">Department<span class="required"> * </span></label>
                                                <div class="col-md-3">
                                                    <?php echo $this->Form->control('department_id',  ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $department, 'empty' => 'Select department']); ?>
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
            <?php if ($utilisationcertificatedetails != '') { ?>
                <?php if (count($utilisationcertificatedetails) > 0) { ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <center>
                                        <h4><b>Utilisation Certificate</b></h4>
                                    </center>
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
                                                    <th style="width: 5px;"> Sno </th>
                                                    <th style="width: 5px;"> G.O.No</th>
                                                    <th style="width: 5px;"> G.O.Date</th>
                                                    <th style="width: 5px;"> Name of work </th>
                                                    <th style="width: 5px;"> FS Amount(Rs. In Lakhs)</th>
                                                    <th style="width: 5px;"> Expenditure incurred so far </th>
                                                    <th style="width: 5px;"> UC Amount</th>
                                                    <th style="width: 5px;"> Fund Recevied</th>
                                                    <th style="width: 5px;"> Fund to be received</th>
                                                    <th style="width: 5px;"> Stage of Work</th>
                                                </tr>
                                            </thead>
                                            <?php $sno = 1;
                                            foreach ($utilisationcertificatedetails as $key => $utilisationcertificatedetail) {
                                                // echo"<pre>";print_r([$utilisationcertificatedetail['pwid']]);
                                            ?>
                                                <tbody>
                                                    <td class="title"><?php echo $sno; ?></td>
                                                    <td class="title"><?php $utilisationcertificatedetail['go_no']; ?>
                                                    <?php if ($utilisationcertificatedetail['pfsid'] > 0) {?> 
                                                        <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="pfsid(<?php echo $utilisationcertificatedetail['pfsid'];?>)"><?php echo $utilisationcertificatedetail['go_no'];?></a>
                                                        <?php }else{
                                                            echo"0";
                                                        } ?>
                                                   </td>
                                                    <td class="title"><?php echo date('d-m-y', strtotime($utilisationcertificatedetail['go_date'])); ?></td>
                                                    <td class="title"><?php echo $utilisationcertificatedetail['work_name']; ?></td>
                                                    <td class="title"><?php echo $utilisationcertificatedetail['fs_amount']; ?></td>
                                                    <td class="title"><?php echo $utilisationcertificatedetail['expenditure_incurred']; ?></td>
                                                    <td class="title"><?php //($uc_amount_detail[$utilisationcertificatedetail['pwid']])?$uc_amount_detail[$utilisationcertificatedetail['pwid']]:0 ?>
                                                        <?php if ($uc_amount_detail[$utilisationcertificatedetail['pwid']] !='') { ?>
                                                            <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getuid(<?php echo $utilisationcertificatedetail['pwid']; ?>,<?php echo $utilisationcertificatedetail['pid'];?>)"><?php echo ($uc_amount_detail[$utilisationcertificatedetail['pwid']])?$uc_amount_detail[$utilisationcertificatedetail['pwid']]:0; ?></a>
                                                        <?php } else {
                                                            echo "0";
                                                        } ?>
                                                    </td>
                                                    <td class="title"><?php echo $utilisationcertificatedetail['request_amount']; ?></td>
                                                    <td class="title"><?php echo $utilisationcertificatedetail['fs_amount']- $utilisationcertificatedetail['expenditure_incurred']-$uc_amount_detail[$utilisationcertificatedetail['pwid']]; ?></td>
                                                    <td class="title"><?php echo ($monitoring[$utilisationcertificatedetail['pwid']])?$monitoring[$utilisationcertificatedetail['pwid']]:'-'; ?></td>

                                                </tbody>
                                            <?php $sno++;
                                            } ?>

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
                <td style='text-align:center' colspan="10">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="10"><b>Utilisation Certificate - <?php echo  date("d-m-Y"); ?>
                    </b></td>
            </tr>
            <tr>
                <th> Sno </th>
                <th> G.O.No</th>
                <th> G.O.Date</th>
                <th> Name of work </th>
                <th> FS Amount(Rs. In Lakhs)</th>
                <th> Expenditure incurred so far </th>
                <th> UC Amount</th>
                <th> Fund Recevied</th>
                <th> Fund to be received</th>
                <th> Stage of Work</th>
            </tr>
            <?php $sno = 1;
            foreach ($utilisationcertificatedetails as $utilisationcertificatedetail) : ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $utilisationcertificatedetail['go_no']; ?></td>
                    <td><?php echo date('d-m-y', strtotime($utilisationcertificatedetail['go_date'])); ?></td>
                    <td><?php echo  $utilisationcertificatedetail['work_name']; ?></td>
                    <td><?php echo $utilisationcertificatedetail['sanctioned_amount1']; ?></td>
                    <td><?php echo $utilisationcertificatedetail['expenditure_incurred']; ?></td>
                    <td><?php echo ($uc_amount_detail[$utilisationcertificatedetail['pwid']])?$uc_amount_detail[$utilisationcertificatedetail['pwid']]:0; ?></td>
                    <td><?php echo $utilisationcertificatedetail['request_amount']; ?></td>
                    <td><?php echo $utilisationcertificatedetail['sanctioned_amount1']-$uc_amount_detail[$utilisationcertificatedetail['pwid']]; ?></td>
                    <td><?php echo ($monitoring[$utilisationcertificatedetail['pwid']])?$monitoring[$utilisationcertificatedetail['pwid']]:'-'; ?></td>
                    
                </tr>

            <?php
                $sno++;
            endforeach;  ?>
            <tfoot>
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
<div id="modal-add-unsent1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form add-unsent-form1">

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function pfsid(pid){
        // alert("hii");
        // alert(pid);
        $(".add-unsent-form1").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent1").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxfinancialsanctions/' + pid,
            success: function(data, textStatus) {
                // alert(data);
                $(".add-unsent-form1").html(data);
            }
        });

    }

    function getuid(pw_id,p_id) {
        // alert("hii");
        // alert(id);
        // alert(pid);
       
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxutilisationreport/' + pw_id + "/"+ p_id,
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
                        "utilisationcertificate.xls"
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
            },
            'department_id': {
                required: true
            }
        },
        messages: {
            'financial_year_id': {
                required: "select Financial Year"
            },
            'department_id': {
                required: "select Department"
            }
        },
        // submitHandler: function(form) {
        //     var fin_id = $('#financial-year-id').val();
        //     // var dep_id = $('#department-id').val();
        //     var from_date = $('#form-date').val();
        //     var to_date = $('#to-date').val();

        //     if (fin_id != '') {

        //         form.submit();

        //     } else {
        //         alert('Select any one input!');
        //         return false;

        //     }
        //     // form.submit();
        //     // $(".btn").prop('disabled', true);
        // }
    });
</script>