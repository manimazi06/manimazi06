<tr class="row_remove_tr<?php echo $i ?> present_row_in_post">
    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <td><?php echo $this->Form->control('quarters.' . $i . '.police_designation_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $policeDesignations, 'empty' => 'Select Designation', 'required','data-rule-required'=>true,'data-msg-required'=>'Select Designation']); ?>
    </td>
    <td><?php echo $this->Form->control('quarters.' . $i . '.no_of_quarters', ['class' => 'form-control num divided_total', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'min'=>1, 'placeholder' => 'Enter Quarters', 'required','data-rule-required'=>true,'data-msg-required'=>'Enter Quarters','onkeyup'=>'calculateTotal(this.value)']); ?>
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
        $("#serialvalue").val(i);
		calculateTotal();
		
    }

    $('.datepicker1').flatpickr({
        dateFormat: "d-m-Y",
        allowInput: false
    });
</script>