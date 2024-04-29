   <?php //echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min'); ?>
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
	
    <?php if($fundrequeststages != ""){  ?>
	  <legend class="bol" style="color: #0047AB; text-align: center;">Project Fund Request Stages
					 </legend>
	 <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;" bgcolor="white">
		 <thead>
			 <tr align="center">
				 <th style="width:5%"> S.No</th>
				 <th style="width:20%">Forward Date</th>
				 <th style="width:20%">Status</th>
				 <th style="width:20%">Remarks</th>
			 </tr>
		 </thead>
		 <tbody class="add_doc">											 
			 <?php  $i = 0;  foreach ($fundrequeststages as $fundrequeststage): ?>								 
			  <tr align="center">
				 <td class="trcount"><?php echo $i + 1; ?></td>
				 <td><?php echo date('d-m-Y',strtotime($fundrequeststage['forward_date'])) ?>
				 </td>
				 <td><?php echo $fundrequeststage['fund_status']['name']; ?>
				 </td>
				 <td><?php echo $fundrequeststage['remarks']; ?>
				 </td>                                 
			 </tr>
			 <?php $i++;   endforeach; ?>
		 </tbody>
	 </table>
    <?php } ?>


