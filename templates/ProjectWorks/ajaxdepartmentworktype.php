<option value="">Select Work Type</option> 
<?php foreach($work_types as $worktype){  ?>
<option value = "<?php echo $worktype['id']; ?>"><?php echo $worktype['name']; ?></option>
<?php } ?>



