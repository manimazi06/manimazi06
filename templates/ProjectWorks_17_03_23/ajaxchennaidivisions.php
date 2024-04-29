<option value="">Select Division</option> 
<?php foreach($divisions as $division){  ?>
<option value = "<?php echo $division['id']; ?>"><?php echo $division['name']; ?></option>
<?php } ?>



