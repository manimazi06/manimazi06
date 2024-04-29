<?php if ($photo_uploads != "") {  ?>
    <center>
    <table style="width: 100%">
  	   <tbody>
            <?php $sno = 1;
            foreach ($photo_uploads as $photo_upload) : ?>

                <img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photo_upload['photo_upload'], ['fullBase' => true]); ?>" width="500px">
                <br><br>
            <?php $sno++;
            endforeach; ?>
			
        </tbody>
		<tfoot>
		  <?php echo $photo_upload['description'];  ?>
		</tfoot>
    </table>
	</center>
<?php } ?>