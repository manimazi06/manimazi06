<?php echo $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min'); ?>
    <?php echo $this->Html->css('/plugins/datatables/export/buttons.dataTables.min'); ?>	
	<?php echo $this->Html->script('/plugins/datatables/jquery.dataTables.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/dataTables.buttons.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/buttons.flash.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/jszip.min'); ?>
    <?php // echo $this->Html->script('/plugins/datatables/export/pdfmake.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/vfs_fonts'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/buttons.html5.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/buttons.print.min'); ?>
    <?php echo $this->Html->script('/js/pages/table/table_data'); ?>
	
	<?php if($prjectdetails != ""){  ?>
	
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

<center><h3><?php echo $prjectdetails[0]['dname'];    ?></h3></center>
	<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
        <thead>
            <tr class="text-center">
                <th> Sno </th>
                <th>Financial year </th>
				<?php if($prjectdetails[0]['work_type'] == 1){ ?>
                <th>GO No.</th>
				<?php }else{ ?>
                <th>Ref No.</th>
				<?php } ?>
                <th>Work Name </th>
                <th>Division Name</th>
                <th>AS Sanctioned (in Rs.)</th>
                <th>Target Date</th>
                <th>Project Status</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
            <?php $sno =1; foreach ( $prjectdetails as $conn): ?>
            <tr class="odd gradeX">
                <td><?php echo($sno); ?></td>
                <td><?php echo $conn['financial_yeartname']; ?></td>
				<?php if($conn['work_type'] == 1){ ?>
                <td><?php echo $conn['go_no']; ?></td>
				<?php }else{ ?>
                <td><?php echo $conn['ref_no']; ?></td>
			    <?php } ?>
                <td><?php echo$conn['work_name']; ?></td>
                <td><?php echo$conn['division_name']; ?></td>
                <td><?php echo $conn['sanctioned_amount']; ?></td>
				<td><?php echo ($conn['tentative_completion_date'])?date('d-m-Y',strtotime($conn['tentative_completion_date'])):''; ?></td>  
                <td><?php echo $conn['pws']; 
				if($monitoringcount[$conn['sub_detail_id']] > 0){
					echo "<span style='color:blue;font-size:11px;'><b><br>work<br>completed:".$physicallly_completed[$conn['sub_detail_id']]."</b></span>";
					
				}
				
				?></td>
                <td>
	              <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectWorks','action' => 'workview',$conn['project_id'],$conn['work_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?><br><br>

				</td>
            </tr>
            <?php $sno++; endforeach; ?>
        </tbody>
    </table>
</div>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
	        <tr>
                <td style='text-align:center' colspan="8">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>
                <td style='text-align:center' colspan="8">Department wise report -<?php echo $prjectdetails[0]['dname'];    ?>
 
                </td>
            </tr>
            <tr class="text-center">
                <th> Sno </th>
                <th>Financial year </th>
				<?php if($prjectdetails[0]['work_type'] == 1){ ?>
                <th>GO No.</th>
				<?php }else{ ?>
                <th>Ref No.</th>
				<?php } ?>
                <th>Work Name </th>
                <th>Division Name</th>
                <th>AS Sanctioned (in Rs.)</th>
                <th>Target Date</th>
                <th>Project Status</th>
            </tr>
        <tbody>
            <?php $sno1 =1; foreach ($prjectdetails as $conn): ?>
            <tr >
                <td><?php echo($sno1); ?></td>
                <td><?php echo $conn['financial_yeartname']; ?></td>
				<?php if($conn['work_type'] == 1){ ?>
                <td><?php echo $conn['go_no']; ?></td>
				<?php }else{ ?>
                <td><?php echo $conn['ref_no']; ?></td>
			    <?php } ?>
                <td><?php echo$conn['work_name']; ?></td>
                <td><?php echo$conn['division_name']; ?></td>
                <td><?php echo $conn['sanctioned_amount']; ?></td>
				<td><?php echo ($conn['tentative_completion_date'])?date('d-m-Y',strtotime($conn['tentative_completion_date'])):''; ?></td>  
                <td><?php echo $conn['pws']; 
				if($monitoringcount[$conn['sub_detail_id']] > 0){
					echo "<span style='color:blue;font-size:11px;'><b><br>work<br>completed:".$physicallly_completed[$conn['sub_detail_id']]."</b></span>";
					
				}				
				?></td>                
            </tr>
            <?php $sno1++; endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
    <?php } ?>
	<script>
	  function print_receipt() {
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
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
                        "departmentwise_report.xls"
                    ) // set file name (you want to put formatted date here)
                    .attr('href', uri) // data to download
                    .attr('target', '_blank') // open in new window (optional)
            });



        });
    });
	</script>