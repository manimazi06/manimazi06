<tr class="row_remove_tr<?php echo $i ?> present_row_in_post">
    <td style="width:1%;"><?php echo $i + 1; ?></td>
    <td><?php echo $this->Form->control('meeting.'. $i.'.minutes_points', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Question', 'rows'=>3,'required','data-rule-required'=>true,'data-msg-required'=>'Enter Question']); ?>
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
        i--;
    }

</script>