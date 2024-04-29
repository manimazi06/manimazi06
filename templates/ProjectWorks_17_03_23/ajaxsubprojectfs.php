<?php $j = ($i +1);   ?>
<tr class="delete_docdetails_class_<?php echo $id ?> present_row">
   <td style="width:1%;"><?php echo $i+1; ?></td>
   <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
   <td align="right"><?php echo  number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', ''); ?></td>
   <td><?php echo $as_detail['supervision_charge']['name']; ?></td>     
   <td>
     <?php echo $this->Form->control('project.'.$i.'.fs_excluding_sc', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Sanction Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal('.$i.')','data-rule-required'=>true,'data-msg-required'=>'Enter Amount']) ?>
   </td> 
    <td>
     <?php echo $this->Form->control('project.'.$i.'.supervision_charge', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Supervision','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal('.$i.')','data-rule-required'=>true,'data-msg-required'=>'Enter Supervision Charge','value'=>0]) ?>
   </td>   
	<td>
    <?php echo $this->Form->control('project.'.$i.'.fs_amount', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Sanction Amount','min'=>1,'maxlength'=>13,'readonly']) ?>
    <?php echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.project_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['project_work_id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.sanctioned_amount', ['class'=>'sanctioned_amount','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['sanctioned_amount']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.division_id', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['division_id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.supervision_percentage', ['class'=>'supervision_charge','label' => false, 'error' => false, 'type' =>'hidden','value'=> rtrim($as_detail['supervision_charge']['name'], "%")]) ?>
	</td>  
</tr>
<script>
    jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });
</script>