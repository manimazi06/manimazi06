<?php $j = ($i + 1);   ?>
<tr class="delete_docdetails_class_<?php echo $i ?> photo_upload">
    <td><?php echo $this->Form->control('monitoring.' . $i . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
    </td>
    <td style="text-align:center;">
        <a onclick='delete_docdetails(<?php echo $i; ?>);'>
            <button class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
        </a>
    </td>
</tr>
<script>
    function delete_docdetails(i) {
        $('.delete_docdetails_class_'+ i).remove();

    }  
</script>