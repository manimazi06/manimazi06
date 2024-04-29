<tr class="row_remove_tr<?php echo $i ?> present_row_in_post">
    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <?php if($type == 1){  ?>
	<td>
        <?php echo $this->Form->control('workdetail.'.$i.'.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,'.$i.')','data-rule-required'=>true,'data-msg-required'=>'Select Item Code']); ?>
        <?php echo $this->Form->control('workdetail.'.$i.'.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required', 'type' => 'hidden', 'id' => 'item_code_'.$i.'']); ?>
    </td>
	
    <td>
        <?php echo $this->Form->control('workdetail.'.$i.'.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 4,'id'=>'description_'.$i.'', 'readonly']); ?>
    </td>
	<?php }else if($type == 2){ ?>
	<td>
    </td>	
    <td>
        <?php echo $this->Form->control('workdetail.'.$i.'.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 3,'id'=>'description_'.$i.'']); ?>
    </td>
	
	<?php } ?>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.quantity', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity', 'id' => 'q_'.$i.'', 'onkeyup' => "product(".$i.")",'data-rule-required'=>false,'data-msg-required'=>'Enter Rate']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.rate', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Rate', 'id' => 'r_'.$i.'', 'onkeyup' => "product(".$i.")",'data-rule-required'=>false,'data-msg-required'=>'Enter Number2']); ?>
    </td>
    <td>
        <?php echo $this->Form->control('workdetail.'.$i.'.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'cal_total_'.$i.'', 'readonly']); ?>
	</td>
    <td style="text-align:center;">
        <a onclick='row_remove(<?php echo $i; ?>);'>
            <button class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
        </a>
    </td>
</tr>
<script>
    function row_remove(i) {
        $('.row_remove_tr' + i).remove();
		calculateTotal();
    }   
</script>
    <?php echo $this->Html->script('/plugins/select2/js/select2'); ?>
    <?php echo $this->Html->script('/js/pages/select2/select2-init'); ?>