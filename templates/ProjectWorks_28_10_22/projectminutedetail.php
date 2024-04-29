<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Project Minute Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectMinuteDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->
                        <?php if ($role_id == 6) { ?>
                            <div class="form-group row">
                                <?php if ($projectminutes == 0) { ?>
                                    <label class="control-label col-md-2">Meeting date<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('meeting_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Date', 'required']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- </div>  -->
                            <div class="form-group">
                                <fieldset>
                                    <br>
                                    <table class="table  table-bordered  order-column" style="max-width: 80%;margin-left: 5%;">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">S.no</th>
                                                <th style="width:15%">Question Minutes</th>
                                                <th style="width:5%"><button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button></th>
                                            </tr>
                                        </thead>
                                        <tbody class="adding">
                                            <tr class="present_row_in_post">
                                                <td class="trcount">1</td>
                                                <td><?php echo $this->Form->control('meeting.0.minutes_points', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Question', 'rows' => 3,'data-rule-required'=>true,'data-msg-required'=>'Enter Question']); ?>
                                                    <?php echo $this->Form->control('meeting.0.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => '']); ?>
                                                </td>
                                                </td>
                                                <input type="hidden" name="serialvalue" id="serialvalue" value="1">
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>

                        <?php } elseif ($role_id == 4) { ?>
						  <!--div class="card-body">
                            <div class="form-group row">
                                <?php //if ($projectminutedetail > 0) { 
                                ?>
                                <label class="control-label col-md-2">Meeting date<span class=" required"> &nbsp; :
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y', strtotime($last_minute_detail->meeting_date)); ?>


                                    <?php echo $this->Form->control('minute_id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $projectminutedetail->id]); ?>
                                </div>
                                <?php //} 
                                ?>
                            </div>
                            <div class="form-group">
                                <fieldset>
                                    <table class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">S.no</th>
                                                <th style="width:15%">Question Minutes</th>
                                                <th style="width:15%">Action Taken Date</th>
                                                <th style="width:15%">Action Taken</th>

                                                <th style="width:5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="adding">
                                            <?php $i = 0;
                                            foreach ($projectsubminutedetails as $projectminute) : ?>
                                                <tr class="present_row_in_post">
                                                    <td class="trcount"><?php echo  $i + 1; ?></td>

                                                    <td><?php echo $this->Form->control('meeting.' . $i . '.minutes_points', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Question', 'rows' => 3, 'required', 'readonly', 'value' => $projectminute->minutes_points]); ?>
                                                        <?php echo $this->Form->control('meeting.' . $i . '.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $projectminute->id]); ?>
                                                    </td>
                                                    <td><?php echo $this->Form->control('meeting.' . $i . '.action_taken_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => ($projectminute->action_taken_date != '') ? ($projectminute->action_taken_date) : '', 'error' => false, 'placeholder' => 'Select Action Taken Date']); ?>
                                                    </td>

                                                    <td><?php echo $this->Form->control('meeting.' . $i . '.action_taken', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => ($projectminute->action_taken != '') ? ($projectminute->action_taken) : '', 'error' => false, 'placeholder' => 'Action Taken', 'rows' => 3]); ?>

                                                    </td>

                                                    <input type="hidden" name="serialvalue" id="serialvalue" value="1">
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            </div-->
                        <?php } ?>
						 <?php if ($role_id == 6) { ?>
							<div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
								<div class="offset-md-5 col-md-10">
									<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
									<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
								</div>
							</div>
						  <?php } ?>
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($projectminutedetails) { ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
		 <div class="card-body">
			<div class="table-scrollable">
				<legend class="bol" style="color: #0047AB; text-align: center;">Project Minute Details List</legend>
				<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;">

					<table class="table table-bordered order-column" style="width: 100%">
						<thead>
							<tr class="text-center">
								<th width="5%"> Sno </th>
								<th>Meeting Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $sno = 1; ?>

							<?php foreach ($projectminutedetails as $projectminutedetail) : ?>
								<tr class="odd gradeX">
									<td class="text-center"><?php echo ($sno); ?></td>
									<td class="text-center"><?php echo  date('Y-m-d', strtotime($projectminutedetail->meeting_date)) ?></td>
									<td class="text-center">
									  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>view'), ['action' => 'projectminuteview', $projectminutedetail->id], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
									  <?php if ($role_id == 4){ ?>
									  <?php if ($projectminutedetail['reply_flag'] == 0){ ?>
   									  <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>Update'), ['action' => 'projectminutedetailupdate', $projectminutedetail->id], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br>
								      <?php } } ?>
								  </td>
								</tr>
							<?php $sno++;
							endforeach; ?>
						</tbody>
					</table>
				</fieldset>
			</div>
	    </div>
     </div>
  </div>
</div>
<?php  } ?>

<script>
    $("#FormID").validate({
        rules: {
            'meeting_date': {
                required: true
            }
        },
        messages: {
            'meeting_date': {
                required: "Select Meeting date"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function pageadding() {
        var j = ($('.present_row_in_post').length);
        // alert(j);
        var row_no = j - 1;
        var meeting = $("#meeting-" + row_no + "-minutes-points").val();
        if (meeting != '') {
            if (document != '' || document1 != '') {
                $.ajax({
                    async: true,
                    dataType: "html",
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectmeeting/'+j,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    },
                    success: function(data, textStatus) {
                        $('.adding').append(data);
                    }
                });
            }
        }else if (meeting == '') {
            alert("Enter Question");
            $("#meeting-" + row_no + "-minutes-points").focus();
        }
    }
</script>