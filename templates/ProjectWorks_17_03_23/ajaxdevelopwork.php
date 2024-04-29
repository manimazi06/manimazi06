<tr class="row_remove_tr<?php echo $i ?> present_row_in_post">
    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <td>
        <?php echo $this->Form->control('workdetail.'.$i.'.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,'.$i.')','data-rule-required'=>true,'data-msg-required'=>'Select Item Code']); ?>
        <?php echo $this->Form->control('workdetail.'.$i.'.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'required', 'type' => 'hidden', 'id' => 'item_code_'.$i.'']); ?>
    </td>
    <td>
        <?php echo $this->Form->control('workdetail.'.$i.'.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 3,'id'=>'description_'.$i.'', 'readonly']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.number_1', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Number1', 'id' => 'n1_'.$i.'', 'onkeyup' => "Sum(".$i.")",'data-rule-required'=>true,'data-msg-required'=>'Enter Number1']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.number_2', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Number2', 'id' => 'n2_'.$i.'', 'onkeyup' => "Sum(".$i.")",'data-rule-required'=>true,'data-msg-required'=>'Enter Number2']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.length', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Length', 'id' => 'length_'.$i.'', 'onkeyup' => "Sum(".$i.")",'data-rule-required'=>true,'data-msg-required'=>'Enter Length']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.breath', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Breath', 'id' => 'breath_'.$i.'', 'onkeyup' => "Sum(".$i.")",'data-rule-required'=>true,'data-msg-required'=>'Enter Breath']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.depth', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Depth', 'id' => 'depth_'.$i.'', 'onkeyup' => "Sum(".$i.")",'data-rule-required'=>true,'data-msg-required'=>'Enter Depth']); ?>
    </td>
    <td><?php echo $this->Form->control('workdetail.'.$i.'.quantity', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity', 'id' => 'cal_total_'.$i.'']); ?>
    </td>
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
    }   
</script>
    <?php echo $this->Html->script('/plugins/select2/js/select2'); ?>
    <?php echo $this->Html->script('/js/pages/select2/select2-init'); ?>