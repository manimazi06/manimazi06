<?php echo $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min'); ?>
<?php echo $this->Html->css('/plugins/datatables/export/buttons.dataTables.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/jquery.dataTables.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/export/dataTables.buttons.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/export/buttons.flash.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/export/jszip.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/export/vfs_fonts'); ?>
<?php echo $this->Html->script('/plugins/datatables/export/buttons.html5.min'); ?>
<?php echo $this->Html->script('/plugins/datatables/export/buttons.print.min'); ?>
<?php echo $this->Html->script('/js/pages/table/table_data'); ?>
<?php if ($utilisationcertificate != "") {  ?>
    <center><b>
            <h3>&nbsp;&nbsp;Utilisation Certificate</h3>
        </b></center>
    <div class="btn-group pull-right">
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Tools
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a id="export_excel_button1">
                    <i class="fa fa-file-excel-o"></i> Export to Excel </a>
            </li>
        </ul>
    </div>
    <div class="table-scrollable">
        <table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%">
            <thead>
                <tr class="text-center">
                    <th style="width: 5px;">Sno</th>
                    <th style="width: 15px;">Certificated Date</th>
                    <th style="width: 15px;">Amount</th>
                    <th style="width: 15px;">file</th>
                    <th style="width: 40px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 1;
                foreach ($utilisationcertificate as $conn) : ?>
                    <tr class="odd gradeX">
                        <td><?php echo ($sno); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($conn['certificated_date'])); ?></td>
                        <td><?php echo $conn['amount']; ?></td>
                        <td>
                        <?php if($conn['certificate_upload']!=''){?>
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/utilizationcertificates/' . $conn['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                         <?php }else{
                            echo"No File";
                         } ?>
                        </td>
                        <td><?php echo $conn['remarks'] ?></td>
                    </tr>
                <?php $sno++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<div id="report2" style="display:none;">
    <div class="table-responsive" id="div_vc2">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
            <tr>
                <td style='text-align:center' colspan="4">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="4"><b>Utilisation Certificate - <?php echo  date("d-m-Y"); ?>
                    </b></td>
            </tr>
            <tr>
                   <th>Sno</th>
                    <th>Certificated Date</th>
                    <th>Amount</th>
                    <th>Remarks</th>
            </tr>
            <?php $sno = 1;
            foreach ($utilisationcertificate as $conn) : ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($conn['certificated_date'])); ?></td>
                    <td><?php echo $conn['amount']; ?></td>
                    <td><?php echo $conn['remarks'] ?></td>
                 
                </tr>

            <?php
                $sno++;
            endforeach;  ?>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(function() {
            $("#export_excel_button1").click(function() {
                $("#export_excel_button1").removeClass("model-head");
                var filename = $(this).attr("title");
                var uri = $("#report2").btechco_excelexport({
                    containerid: "report2",
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
</script>