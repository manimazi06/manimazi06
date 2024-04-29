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
<?php if ($projectdetails != "") {  ?>
    <?php if ($val == 2 || $val == 3 || $val == 4) { ?>
        <div class="table-scrollable">
     	<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
                <thead>
                    <tr class="text-center">
                        <th> Sno </th>
                        <th>Financial year </th>
                        <th>Work Code </th>
                        <th>Work Name </th>
                        <th>Division Name</th>
                        <th>Planning permission status</th>
                        <th>Planning permission send date</th>
                        <th>Planning approve date</th>
                        <th>Project Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = 1;
                    foreach ($projectdetails as $conn) : ?>
                        <tr class="odd gradeX" style="text-align:center ;">
                            <td><?php echo ($sno); ?></td>
                            <td><?php echo $conn['financial_yeartname']; ?></td>
                            <td><?php echo $conn['work_code']; ?></td>
                            <td><?php echo $conn['work_name']; ?></td>
                            <td><?php echo $conn['dname']; ?></td>
                            <td><?php if ($conn['pdate'] != '') {
                                    echo 'sent for planning permission';
                                } else {
                                    echo 'not sent';
                                } ?></td>
                            <td><?php if ($conn['pdate'] != '') {
                                    echo $conn['pdate'];
                                } else {
                                    echo '-';
                                } ?></td>
                            <td><?php
                                if ($conn['papprov'] != '') {
                                    echo $conn['papprov'];
                                } else {
                                    echo '-';
                                } ?></td>
                            <td><?php echo $conn['pws']; ?></td>
                        </tr>
                    <?php $sno++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php if ($val == 1 || $val == 5 || $val == 6) { ?>
        <div class="table-scrollable">
    	<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
                <thead>
                    <tr class="text-center">
                        <th> Sno </th>
                        <th>Financial year </th>
                        <th>Work Code </th>
                        <th>Work Name </th>
                        <th>Division Name</th>
                        <th>Project Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = 1;
                    foreach ($projectdetails as $conn) : ?>
                        <tr class="odd gradeX" style="text-align:center ;">
                            <td><?php echo ($sno); ?></td>
                            <td><?php echo $conn['financial_yeartname']; ?></td>
                            <td><?php echo $conn['work_code']; ?></td>
                            <td><?php echo $conn['work_name']; ?></td>
                            <td><?php echo $conn['dname']; ?></td>                 
                            <td><?php echo $conn['pws']; ?></td>
                        </tr>
                    <?php $sno++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
<?php } ?>