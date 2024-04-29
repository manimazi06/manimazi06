<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Update Project Minute Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectMinuteDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">                      
						  <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-md-2">Meeting date<span class=" required"> &nbsp; :
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y', strtotime($last_minute_detail->meeting_date)); ?>
                                    <?php echo $this->Form->control('minute_id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $last_minute_detail->id]); ?>
                                </div>
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
                                                    <td><?php echo $this->Form->control('meeting.'.$i.'.minutes_points', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Question', 'rows' => 3, 'required', 'readonly', 'value' => $projectminute->minutes_points]); ?>
                                                        <?php echo $this->Form->control('meeting.'.$i.'.id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value' => $projectminute->id]); ?>
                                                    </td>
                                                    <td><?php echo $this->Form->control('meeting.'.$i.'.action_taken_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => ($projectminute->action_taken_date != '')?date('d-m-Y',strtotime($projectminute->action_taken_date)):'', 'error' => false,'placeholder' => 'Select Date','data-rule-required'=>true,'data-msg-required'=>'Select Date']); ?>
                                                    </td>
                                                    <td><?php echo $this->Form->control('meeting.'.$i.'.action_taken', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'value' => ($projectminute->action_taken != '') ? ($projectminute->action_taken) : '', 'error' => false, 'placeholder' => 'Action Taken', 'rows' => 3,'data-rule-required'=>true,'data-msg-required'=>'Enter Action Taken']); ?>  
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            </div>
							<div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
								<div class="offset-md-5 col-md-10">
									<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Update</button>
									<!--button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button-->
								</div>
							</div>
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
</script>