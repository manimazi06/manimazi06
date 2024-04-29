<?php $j = ($i + 1);   ?>
<tr class="delete_docdetails_class<?php echo $i ?> present_row">
    <td style="width:5%;"><?php echo $i + 1; ?></td>
    <td><?php echo $this->Form->control('monitoring.' . $i . '.photo_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required']); ?>
    </td>
    <td style="text-align:center;">
        <a onclick='delete_docdetails(<?php echo $i; ?>);'>
            <button class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:75px;">Remove</button>
        </a>
    </td>
</tr>
<script>
    var i = <?php echo $j; ?>;
    $('.datepicker' + i).flatpickr({
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