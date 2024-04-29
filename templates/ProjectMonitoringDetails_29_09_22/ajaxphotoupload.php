<?php if ($photo_uploads != "") {  ?>
    <table style="width: 100%">


        <tbody>
            <?php $sno = 1;
            foreach ($photo_uploads as $photo_upload) : ?>

                <img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/' . $photo_upload['file_upload'], ['fullBase' => true]); ?>" width="300px">
                <br><br>
            <?php $sno++;
            endforeach; ?>
        </tbody>
    </table>
<?php } ?>