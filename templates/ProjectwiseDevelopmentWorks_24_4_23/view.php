<style>
    .form-group {
        margin-bottom: 30px !important;
    }
</style>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>View Development Work</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

                        <div class="col-md-12">

                            <div class="form-group row">
                                <label class="control-label col-md-2">
                                    Work Name<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-4" style="margin-top:4px;">
                                    <?php echo $projectwiseDevelopmentWork->work_name; ?>
                                </div>
                                <label class="control-label col-md-2">Description<span class="required">&nbsp;&nbsp;: </span></label>
                                <div class="col-md-4" style="margin-top:4px;">
                                    <?php echo $projectwiseDevelopmentWork->work_description; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Estimated Cost(in Rs.) <span class="required">&nbsp;&nbsp;:</span></label>
                                <div class="col-md-4" style="margin-top:4px;">
                                    <?php echo $projectwiseDevelopmentWork->estimated_cost; ?>
                                </div>
                                <label class="control-label col-md-2">File Upload <span class="required">&nbsp;&nbsp;:</span></label>
                                <div class="col-md-4" style="margin-top:4px;">
                                    <?php if ($projectwiseDevelopmentWork['file_upload'] != '') {  ?>
                                        <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectwiseDevelopmentWork/' . $projectwiseDevelopmentWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                <ion-icon name="document-text-outline"></ion-icon>View
                                            </span></a>
                                    <?php  } ?>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                </div>
                <div class="form-group" style="padding-top: 10px;">
                    <div class="offset-md-5 col-md-11">
                        <button type="button" class="btn btn-info" onclick="javascript:history.back()">back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>