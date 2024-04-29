
<style>
    .area {
        resize: none;
    }
</style>
<div class="row">
<div class="col-md-12">
        <div class="card">
    <?php echo $this->Form->create($projectwiseDevelopmentWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Add Development Work</header>
        </div>
		  <div class="form-group" style="padding-top: 10px">
             <div class="offset-md-1 col-md-2">
		     <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
             </div>
          </div>
         <div id ="project" style="display:none;"> </div> 
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-body row">
                    <div class="col-md-12">
					   <fieldset	 style="border:1px solid #00355F;border-radius:10px;padding:15px;margin-left:1px;margin-bottom:1%">

                        <div class="form-group row">
                            <label class="control-label col-md-2">Work Name <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('work_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Work Name',  'required']); ?>
                            </div>
                            <label class="control-label col-md-2">Description<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('work_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'type' => 'textarea', 'rows' => 3, 'error' => false, 'placeholder' => 'Enter Description', 'required']); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 ">Estimated Cost (in Rs.)<span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('estimated_cost', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'required']); ?>
                            </div>
                            <label class="control-label col-md-2">File Upload <span class="required"> * </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('file_upload', ['class' => 'form-control ', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)', 'required']); ?>
                            </div>
                        </div>
                      </fieldset>
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="btn btn-info m-r-20">Submit</button>
                                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->End(); ?>
</div>
</div>
</div><br>
<?php if ($ProjectwiseDevelopmentWorkscount >0) {  ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body ">
                <div class="row">                   
					 <h4 class = "sub-tile">Development Work List</h4>
                        <div class="row">
                            <div class="table-scrollable">
                                <!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
                                <table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width:1%;">Sno</th>
                                            <th style="width:10%;">Work Name</th>
                                            <th style="width:25%;">Description</th>
                                            <th style="width:10%;">Estimated Cost</th>
                                            <th style="width:10%;">File Upload</th>
                                            <th align="center" style="width:12%;"> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($ProjectwiseDevelopmentWorkslists)) { ?>
                                            <?php if (count($ProjectwiseDevelopmentWorkslists) > 0) { ?>
                                                <?php $sno = 1;
                                                foreach ($ProjectwiseDevelopmentWorkslists as $ProjectwiseDevelopmentWorkslist) : ?>
                                                    <tr>
                                                        <td><?php echo ($sno); ?></td>
                                                        <td align="left"><?php echo $ProjectwiseDevelopmentWorkslist['work_name']; ?></td>
                                                        <td align="left"><?php echo$ProjectwiseDevelopmentWorkslist['work_description']; ?></td>
                                                        <td align="left"><?php echo $ProjectwiseDevelopmentWorkslist['estimated_cost']; ?></td>
                                                        <td align="left">														
														<?php if ($ProjectwiseDevelopmentWorkslist['file_upload'] != '') {  ?>
															<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectwiseDevelopmentWork/'.$ProjectwiseDevelopmentWorkslist['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
																	<ion-icon name="document-text-outline"></ion-icon>View
																</span></a>
														<?php  } ?>														
														</td>
                                                        <td align="center">
                                                            <?php //echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$pid,$work_id,$id, $ProjectwiseDevelopmentWorkslist['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
                                                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$pid,$work_id,$id, $ProjectwiseDevelopmentWorkslist['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>
                                                        </td>
                                                    </tr>
                                                <?php $sno++;
                                                endforeach; ?>
                                            <?php } else {
                                                //echo "<center><hr>No Data available!</center>";
                                            } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  
                </div>

            </div>

        </div>
    </div>
</div>
  <?php } ?>
<script>
    $("#FormID").validate({
        rules: {
            'work_name': {
                required: true
            },
            'work_description': {
                required: true
            },
            'estimated_cost': {
                required: true
            },
            'file_upload': {
                required: true
            }
        },

        messages: {
            'work_name': {
                required: "Enter Work Name"
            },
            'work_description': {
                required: "Enter Description"
            },
            'estimated_cost': {
                required: "Enter Estimated Cost"
            },
            'file_upload': {
                required: "Select Document"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function validdocs(oInput) {
        var _validFileExtensions = [".jpg", ".png", ".jpeg", ".pdf"];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                        sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                if (!blnValid) {
                    alert(_validFileExtensions.join(", ") + " File Formats only Allowed");
                    //alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
            var file_size = oInput.files[0].size;
            if (file_size >= 5242880) {
                alert("File Maximum size is 5MB");
                oInput.value = "";
                return false;
            }

        }
        return true;
    }
	
	
	 function toggledetail(){
    $('#project').toggle();

    }

  $(document).ready(function() {
        var ProjectID    = <?php echo $pid;  ?>;
        var ProjectSubID = <?php echo $work_id;  ?>;
        if (ProjectID !='' && ProjectSubID != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });

</script>