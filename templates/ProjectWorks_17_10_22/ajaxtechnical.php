<tr class="delete_docdetails_class<?php echo $i ?> present_row">
    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <td><?php echo $this->Form->control('technical.' . $i . '.detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)','required']); ?>
    </td>
    <td><?php echo $this->Form->control('technical.' . $i . '.description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'type'=>'textarea','rows'=>3,'placeholder' => 'Enter Description','required']) ?>
    </td>
    <td style="text-align:center;">
        <a onclick='delete_docdetails(<?php echo $i; ?>);'>
            <button class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
        </a>
    </td>
</tr>
<script>
     function delete_docdetails(i) {
        $('.delete_docdetails_class' + i).remove();
        i--;
        $("#serialvalue").val(i);
    }
</script>