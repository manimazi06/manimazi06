<?php $j = ($i +1);   ?>
<tr class="delete_docdetails_class<?php echo $i ?> present_row">
    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <td>
	
      <?php echo $this->Form->control('monitoring.' . $i . '.monitoring_date', ['class' => 'form-control datepicker'.$j.'', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Monitoring Date','required']) ?>
    </td>
    <td><?php echo $this->Form->control('monitoring.' . $i . '.work_stage_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $workStages, 'empty' => 'Select Project Work','required']) ?>
    </td>
    <td><?php echo $this->Form->control('monitoring.' . $i . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','required']); ?>
    </td>
    <td><?php echo $this->Form->control('monitoring.' . $i . '.amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required']) ?>
    </td>
    <td style="text-align:center;">
        <a onclick='delete_docdetails(<?php echo $i; ?>);'>
            <button class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
        </a>
    </td>
</tr>
<script> 

    var i = <?php echo $j; ?>;	
    $('.datepicker'+i).flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });
	
	function delete_docdetails(i) {
        $('.delete_docdetails_class' + i).remove();
    
    }
	
	 jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });
   
</script> 