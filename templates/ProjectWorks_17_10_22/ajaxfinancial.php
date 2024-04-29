<?php $j = ($i +1);   ?>

<tr class="delete_docdetails_class_<?php echo $i ?> present_row">

    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <td><?php echo $this->Form->control('financial.' . $i . '.fs_ref_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Ref No.','required']) ?>
    </td>
	<td><?php echo $this->Form->control('financial.' . $i . '.sanctioned_date', ['class' => 'form-control datepicker'.$j.'', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date','required']) ?>
    </td>
    <td><?php echo $this->Form->control('financial.' . $i . '.sanctioned_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanctioned Amount','required']) ?>
    </td>
    <td><?php echo $this->Form->control('financial.' . $i . '.sanctioned_file_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','required']); ?>
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
        // i--;
        // $("#serialvalue").val(i);
    }    

    var i = <?php echo $j; ?>;	
    $('.datepicker'+i).flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });

    jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });
</script>