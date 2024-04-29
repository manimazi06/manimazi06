
    <?php if($material_Detail_count > 0){  ?>
	  <legend class="bol" style="color: #0047AB; text-align: center;">Material Sub Types
					 </legend>
	 <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;" bgcolor="white">
		 <thead>
			 <tr align="center">
				 <th style="width:5%"> S.No</th>
				 <th style="width:10%">Sub Type </th>
				 <th style="width:10%">Quantity</th>
				 <th style="width:10%">Rate</th>
				 <th style="width:10%">PER</th>
				 <th style="width:10%">Amount</th>
			 </tr>
		 </thead>
		 <tbody class="add_doc">											 
			 <?php  $i = 0;  foreach ($material_Details as $key => $material_Detail): ?>								 
			  <tr align="center">
				 <td class="trcount"><?php echo $i + 1; ?></td>
				 <td><?php echo $material_Detail['building_submaterial']['name']; ?></td>
				 <td><?php echo $material_Detail['quantity']; ?></td>                                 
				 <td><?php echo $this->Form->control('material.'.$key .'.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Rate','data-rule-required'=>true,'data-msg-required'=>'Enter Rate','onkeyup'=>'calculateAmount(this.value,'.$key.')']); ?></td>                                 
				     <?php echo $this->Form->control('material.'.$key .'.building_material_detail_id', ['type'=>'hidden','label' => false, 'error' => false, 'value'=>$material_Detail['id']]); ?>                               
				     <?php echo $this->Form->control('material.'.$key .'.quantity', ['type'=>'hidden','label' => false, 'error' => false, 'value'=>$material_Detail['quantity']]); ?>                               
				<td><?php echo $material_Detail['unit']['name_code']; ?></td>       
				<td><?php echo $this->Form->control('material.'.$key.'.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount', 'readonly','value'=>0]); ?></td>                                 
			 </tr>
			 <?php $i++;   endforeach; ?>
		 </tbody>
		 
		 <tfoot>
		      <tr>
				 <th colspan="5" style="text-align:right">Total</th>
				 <th style="width:10%"><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Total', 'readonly']); ?>                             
                 </th>
			 </tr>
		 
		 </tfoot>
		 
		 </table>
    <?php }else{ ?>
	<center><span><b>No Details Found</b></span></center>
    <?php } ?>


