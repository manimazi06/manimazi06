<?php $j = ($i + 1);   ?>

<tr class="row_remove_tr<?php echo $i ?> present_row_in_post">
    <td style="width:1%;"><?php echo $i + 1; ?></td>
    <td><?php echo $this->Form->control('fund.' . $i . '.request_date', ['class' => 'form-control datepicker' . $j . '', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Fund request date', 'required']); ?>
    </td>
    <td><?php echo $this->Form->control('fund.' . $i . '.request_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Request amount', 'required']); ?>
    </td>
    <td><?php echo $this->Form->control('fund.' . $i . '.is_amount_receive_id', ['class' => 'form-select', 'options' => $amount_received, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select status', 'onchange' => 'calling(this.value,'.$i.')', 'required']); ?>
    </td>
    <td><span class="yes_<?php echo  $i;  ?>" style="display: none;"><?php echo $this->Form->control('fund.' . $i . '.received_date', ['class' => 'form-control datepicker' . $j . '', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select received Date', 'required']); ?></span>
    </td>
    <td><span class="yes_<?php echo  $i;  ?>" style="display: none;"><?php echo $this->Form->control('fund.' . $i . '.received_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Received amount', 'required']); ?></span>
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
        $("#serialvalue").val(i);
    }

    var i = <?php echo $j; ?>;
    $('.datepicker' + i).flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });
</script>