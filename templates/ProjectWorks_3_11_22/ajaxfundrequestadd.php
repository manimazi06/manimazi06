<?php //$j = ($i +1);   ?>

<tr class="delete_docdetails_class_<?php echo $id ?> present_row">
   <td style="width:1%;"><?php echo $i+1; ?></td>
   <td><?php echo $projectWorkSubdetail[0]['work_code']; ?></td>
   <td><?php echo $projectWorkSubdetail[0]['work_name']; ?></td>
   <td><?php echo $projectWorkSubdetail[0]['division_name']; ?></td>
   <td><?php echo $projectWorkSubdetail[0]['circle_name']; ?></td>                                   
   <td align="right"><?php echo $projectWorkSubdetail[0]['fsgo_no']; ?></td>
   <td align="right"><?php echo $projectWorkSubdetail[0]['sanctioned_amount']; ?></td>
   <td align="right"><?php echo ($projectWorkSubdetail[0]['balance_payment'])?$projectWorkSubdetail[0]['balance_payment']:$projectWorkSubdetail[0]['sanctioned_amount']; ?></td>
 	<td>
       <?php echo $this->Form->control('project.'.$i.'.request_amount', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Request Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal();calculatebalance(this.value,'.$i.')','data-rule-required'=>true,'data-msg-required'=>'Enter Request Amount','value'=>0]) ?>
  	</td>
	<td>
       <?php echo $this->Form->control('project.'.$i.'.balance_amount', ['class' => 'form-control amount bal_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Balance Amount','min'=>0,'maxlength'=>13,'readonly']) ?>
  	</td>	
    <?php echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail[0]['id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.project_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail[0]['project_work_id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.balance_payment', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> ($projectWorkSubdetail[0]['balance_payment'])?$projectWorkSubdetail[0]['balance_payment']:$projectWorkSubdetail[0]['sanctioned_amount']]) ?>
	
</tr>

<script>
    jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });
</script>