<tr class="row_remove_norms<?php echo $i ?> present_row_in_norms">
    <td style="width:5%;text-align:center;">
        <a onclick='row_remove(<?php echo $i; ?>);' title="Remove">
            <button class="btn btn-outline-danger btn-xs" style="margin-left:0px;width:25px;">-</button>
        </a>
    </td>
    <td style="width:2%;"><?php echo $i + 1; ?></td>
	<td style="width:70%;">
        <?php echo $this->Form->control('norms.'.$i.'.description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'empty' => '-Select-','data-rule-required'=>true,'data-msg-required'=>'Enter Description']); ?>
    </td>	
    <td style="width:20%;">
        <?php echo $this->Form->control('norms.'.$i.'.amount', ['class' => 'form-control amount normamount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','data-rule-required'=>true,'data-msg-required'=>'Enter Amount','onkeyup'=>'addsubtotal_3()','id'=>'amount_'.$i.'']); ?>
    </td>   
</tr>
<script>
    function row_remove(i) {
        $('.row_remove_norms' + i).remove();
	   addsubtotal_3();
    }   
</script>
