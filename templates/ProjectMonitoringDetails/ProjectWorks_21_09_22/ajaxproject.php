<?php $j = ($i +1);   ?>

<tr class="delete_docdetails_class_<?php echo $i ?> present_row">

    <td style="width:5%;"><?php echo $i + 1; ?></td>
   <td><?php echo $this->Form->control('project.' . $i . '.district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => true, 'empty' => 'Select District','onchange'=>'loadcircle(this.value,'.$i.')','data-rule-required'=>true,'data-msg-required'=>'Select District']) ?></td>
   <td><?php echo $this->Form->control('project.' . $i . '.division_id1', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => true, 'empty' => 'Select Division','disabled']) ?>
       <?php echo $this->Form->control('project.' . $i . '.division_id', ['type'=>'hidden', 'label' => false, 'error' => true]) ?>
	</td>
	<td>
	<?php echo $this->Form->control('project.' . $i . '.circle_id1', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => true, 'empty' => 'Select Circle','disabled']) ?>
	<?php echo $this->Form->control('project.' . $i . '.circle_id', ['type'=>'hidden', 'label' => false, 'error' => true]) ?>
	</td>                                   
	<td><?php echo $this->Form->control('project.' . $i . '.amount', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter Sanction Amount','onkeyup'=>'calculateTotal()','data-rule-required'=>true,'min'=>1,'data-msg-required'=>'Enter Sanctioned Amount']) ?>
	</td> 	
    <td style="text-align:center;">
    <a onclick='delete_docdetails(<?php echo $i; ?>);'>
            <button  type="button" class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
        </a>
    </td>
</tr>

<script>
   function delete_docdetails(i) {
        $('.delete_docdetails_class_' + i).remove();
         calculateTotal();
    } 

    jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });
</script>