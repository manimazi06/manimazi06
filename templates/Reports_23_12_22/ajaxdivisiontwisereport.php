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
	<center><b><h3><?php echo $prjectdetails[0]['division_name'];  ?>&nbsp;&nbsp; Division</h3></b></center>
<div class="table-scrollable">
	<table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
        <thead>
            <tr class="text-center">
                <th>Sno</th>
                <th>Department Name</th>
                <th>Financial Year</th>
                <th>Work Code</th>
                <th>Work Name</th>
                <th>AS Sanctioned <br>(in Rs.)</th>
                <th>Project Status</th>
				<th></th>
            </tr>
        </thead>
        <tbody>
            <?php $sno =1; foreach ($prjectdetails as $conn): ?>
            <tr class="odd gradeX">
                <td><?php echo($sno); ?></td>
                <td><?php echo $conn['dname']; ?></td>
                <td><?php echo $conn['financial_yeartname']; ?></td>
                <td><?php echo $conn['work_code']; ?></td>
                <td><?php echo $conn['work_name']; ?></td>
                <td><?php echo $conn['sanctioned_amount']; ?></td>  
                <td><?php echo $conn['pws']; ?></td>
                <td>
	              <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['controller'=>'ProjectWorks','action' => 'workview',$conn['project_id'],$conn['work_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?><br><br>

				</td>
            </tr>
            <?php $sno++; endforeach; ?>
        </tbody>
    </table>
</div>
    <?php } ?>