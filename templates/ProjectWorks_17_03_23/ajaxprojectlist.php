<option value="">Select</option>
<?php  foreach($project_works as $work){ ?>
<option value="<?php echo $work['id']; ?>"><?php echo  $work['project_code']; ?></option>
<?php  } ?>