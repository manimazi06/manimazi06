<?php $j = ($i +1);   ?>

<tr class="delete_docdetails_class_<?php echo $id ?> present_row">
   <td style="width:1%;"><?php echo $i+1; ?></td>
   <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
   <td align="right"><?php echo  number_format((float)$projectWorkSubdetail['sanctioned_amount'], 2, '.', ''); ?></td>
 	<td><?php //echo $this->Form->control('project.' . $i . '.rough_cost', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Enter Sanction Amount','onkeyup'=>'calculateTotal()','data-rule-required'=>true,'min'=>1,'data-msg-required'=>'Enter Sanctioned Amount']) ?>
    <?php echo $this->Form->control('project.'.$i.'.amount', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Sanction Amount','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal()','data-rule-required'=>true,'data-msg-required'=>'Enter Sactioned Amount']) ?>
    <?php echo $this->Form->control('project.'.$i.'.id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.project_id', ['label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['project_work_id']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.sanctioned_amount', ['class'=>'sanctioned_amount','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['sanctioned_amount']]) ?>
    <?php echo $this->Form->control('project.'.$i.'.division_id', ['class'=>'division_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['division_id']]) ?>

	</td>    
</tr>

<script>
   // function delete_docdetails(i) {
        // $('.delete_docdetails_class_' + i).remove();
         // calculateTotal();
    // } 

    jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });
</script>