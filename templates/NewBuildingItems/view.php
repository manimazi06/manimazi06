<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectWork $projectWork
 */
?>

<style>
    .form-group {
        margin-bottom: 30px !important;
    }
</style>
<?php echo $this->Form->create($projectWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>View Building Items</header>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

                        <div class="col-md-12">

                            <div class="form-group row">
                                <label class="control-label col-md-2">Building Type<span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-4" style="margin-top:8px;">
                                    <?php echo $newBuildingItem->building_item_type->name; ?>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Item Type<span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-4" style="margin-top:8px;">
                                    <?php echo $newBuildingItem['item_code']; ?>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2">Item Description<span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-10" style="margin-top:8px;">
                                    <?php echo $newBuildingItem['item_description']; ?>
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