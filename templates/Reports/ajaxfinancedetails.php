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
	<?php if($type == 1){ ?>
	<center><b><h3>&nbsp;&nbsp; UC Sanctioned</h3></b></center>
	<?php }else if($type == 2){  ?>
	<center><b><h3>&nbsp;&nbsp; UC Amount Received</h3></b></center>
	<?php }else if($type == 3){  ?>
	<center><b><h3>&nbsp;&nbsp; PD Balance Details</h3></b></center>
	<?php }   ?>
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
   <?php if($type == 3){ ?>
     <table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
        <thead>
            <tr class="text-center">
                <th>Sno</th>
                <th>Date</th>  
                <th>Transaction Amount (Rs.)</th>				
                <th>PD Balance (Rs.)</th>              
                <th>Payment Info</th>              
            </tr>
        </thead>
        <tbody>
            <?php $sno =1; foreach ($prjectdetails as $conn):
             
			?>
            <tr class="odd gradeX" style="background-color:<?php echo $color; ?>">
                <td><?php echo($sno); ?></td>           
                <td><?php echo ($conn['date'])?date('d-m-Y',strtotime($conn['date'])):''; ?></td> 
                <td style="text-align:right"><?php echo $conn['transaction_amount']; ?></td>
                <td style="text-align:right"><?php echo $conn['opening_balance']; ?></td>
                <td style="text-align:right"><b><?php echo ($conn['payment_info'] == 1)?'<span style="color:green">Credit</span>':'<span style="color:red">Debit</span>'; ?></b></td>
               
            </tr>
            <?php $sno++; endforeach; ?>
        </tbody>
    </table>
   <?php }else{ ?>
	<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
        <thead>
            <tr class="text-center">
                <th>Sno</th>
                <th>GO No.</th>
                <th>Work Name</th>
                <?php if($type == 1){ ?>
                <th>UC Date</th>
				<?php }else if($type == 2){  ?>
                <th>UC Sanctioned Date</th>
				<?php } ?>
				<?php if($type == 1){ ?>
                <th>UC Amount (Rs.)</th>
				<?php }else if($type == 2){  ?>
                <th>UC Amount Recieved (Rs.)</th>
				<?php } ?>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php $sno =1; foreach ($prjectdetails as $conn):
             if($type == 2){ 

              if((strtotime(date('d-m-Y',strtotime($conn['date']))) > strtotime('2023-03-31'))){
				 $color = 'Yellow'; 
			  }else{
				  $color = 'white';
			  }
			 }else{
				 $color = 'white'; 
			 }
			?>
            <tr class="odd gradeX" style="background-color:<?php echo $color; ?>">
                <td><?php echo($sno); ?></td>
               <?php if($conn['work_type'] == 1){ ?>
                <td><?php echo $conn['go_no']; ?></td>
				<?php }else{ ?>
                <td><?php echo $conn['ref_no']; ?></td>
			    <?php } ?>
                <td><?php echo $conn['work_name']; ?></td>
                <td><?php echo ($conn['date'])?date('d-m-Y',strtotime($conn['date'])):''; ?></td> 
                <td><?php echo $conn['amount']; ?></td>
                <td><?php echo $conn['remarks']; ?></td>
               
            </tr>
            <?php $sno++; endforeach; ?>
        </tbody>
    </table>
   <?php }  ?>
</div>
 <?php } ?>
 
 
 <div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
	        <tr>
                <td style='text-align:center' colspan="6">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
            <tr>			
                <td style='text-align:center' colspan="6">
				<?php if($type == 1){ ?>
				<center><b><h3>&nbsp;&nbsp; UC Sanctioned</h3></b></center>
				<?php }else if($type == 2){  ?>
				<center><b><h3>&nbsp;&nbsp; UC Amount Received</h3></b></center>
				<?php }else if($type == 3){  ?>
				<center><b><h3>&nbsp;&nbsp; PD Balance Details</h3></b></center>
				<?php }   ?>
                 </td>				
            </tr>
           <?php if($type == 3){ ?>
            <tr class="text-center">
                <th>Sno</th>
                <th>Date</th>  
                <th>UC Amount Added (Rs.)</th>				
                <th>PD Balance (Rs.)</th>              
                <th>Payment Info</th>              
            </tr>
        <tbody>
            <?php $sno1 =1; foreach ($prjectdetails as $conn):
             
			?>
            <tr class="odd gradeX" style="background-color:<?php echo $color; ?>">
                <td><?php echo($sno1); ?></td>           
                <td><?php echo ($conn['date'])?date('d-m-Y',strtotime($conn['date'])):''; ?></td> 
                <td style="text-align:right"><?php echo $conn['uc_received']; ?></td>
                <td style="text-align:right"><?php echo $conn['opening_balance']; ?></td>
                <td style="text-align:right"><b><?php echo ($conn['payment_info'] == 1)?'<span style="color:green">Credit</span>':'<span style="color:green">Debit</span>'; ?></b></td>
               
            </tr>
            <?php $sno1++; endforeach; ?>
        </tbody>
   <?php }else{ ?>
            <tr class="text-center">
                <th>Sno</th>
                <th>GO No.</th>
                <th>Work Name</th>
                <?php if($type == 1){ ?>
                <th>UC Date</th>
				<?php }else if($type == 2){  ?>
                <th>UC Sanctioned Date</th>
				<?php } ?>
				<?php if($type == 1){ ?>
                <th>UC Amount (Rs.)</th>
				<?php }else if($type == 2){  ?>
                <th>UC Amount Recieved (Rs.)</th>
				<?php } ?>
                <th>Remarks</th>
            </tr>
        <tbody>
            <?php $sno1 =1; foreach ($prjectdetails as $conn):
             
			?>
            <tr class="odd gradeX">
                <td><?php echo($sno1); ?></td>
               <?php if($conn['work_type'] == 1){ ?>
                <td><?php echo $conn['go_no']; ?></td>
				<?php }else{ ?>
                <td><?php echo $conn['ref_no']; ?></td>
			    <?php } ?>
                <td><?php echo $conn['work_name']; ?></td>
                <td><?php echo ($conn['date'])?date('d-m-Y',strtotime($conn['date'])):''; ?></td> 
                <td><?php echo $conn['amount']; ?></td>
                <td><?php echo $conn['remarks']; ?></td>
               
            </tr>
            <?php $sno1++; endforeach; ?>
        </tbody>
   <?php }  ?>
    </table>
    </div>
</div>
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
                        "report.xls"
                    ) // set file name (you want to put formatted date here)
                    .attr('href', uri) // data to download
                    .attr('target', '_blank') // open in new window (optional)
            });



        });
    });
	</script>