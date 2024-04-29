<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>OpeningBalanceDetail</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($openingBalanceLogs, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <?php  if($role_id == 16){ ?>
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:0%">
						   <div class="form-group">                               
							<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
								<thead>
									<tr align="center">
										<th style="width:1%"> S.No</th>
										<th style="width:10%">Work Code</th>
										<th style="width:10%">Work Name</th>
										<th style="width:10%">Circle</th>
										<th style="width:10%">Division</th>
										<th style="width:10%">Request Amount</th>
									</tr>  
								</thead>
								<tbody>
								   <?php $i = 0;
								      foreach ($fund_request_to_user_details as $fund_request_to_user_detail): ?>										
									 <tr> 
									 
									   <td class="trcount"><?php echo $i + 1; ?></td>
									   <td><?php echo $fund_request_to_user_detail['project_work_subdetail']['work_code']; ?></td>
									   <td><?php echo $fund_request_to_user_detail['project_work_subdetail']['work_name']; ?></td>
									   <td><?php echo $fund_request_to_user_detail['project_work_subdetail']['circle_id']; ?></td>
									   <td><?php echo $fund_request_to_user_detail['project_work_subdetail']['division_id']; ?></td>
									   <td style="text-align:right;"><?php echo  number_format((float)$fund_request_to_user_detail['request_amount'], 2, '.', ''); ?></td>
										 <?php echo $this->Form->control('project.'.$i.'.fund_request_id', ['class'=>'request_amount','label' => false, 'error' => false, 'type' =>'hidden','value'=> $fund_request_to_user_detail['project_fund_request_detail_id']]) ?>
										 <?php //echo $this->Form->control('project.'.$i.'.work_id', ['class'=>'work_id','label' => false, 'error' => false, 'type' =>'hidden','value'=> $projectWorkSubdetail['work_id']]) ?>
									</tr>
									<?php
										 $tot_request_amount    += $fund_request_to_user_detail['request_amount'];
										 $i++;  endforeach;
									?>     
								</tbody>
								<tfoot>  
									<tr>
									   <td colspan="5" align="right"><b>Total (in Rs.)</b></td>
									   <td align="right"><b><?php echo  number_format((float)$tot_request_amount, 2, '.', '');  ?></b></td>
									</tr>
								</tfoot>
							</table>
						  </div>			
						</fieldset><br>
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:0%">

                           <div class="form-body row">  
                              <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label col-md-2">Fund Request Date<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('request_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => date('d-m-Y', strtotime($openingBalanceLog['request_date'])), 'required']); ?>
                                    </div>
                                    <label class="control-label col-md-2">Fund Request Amount<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('request_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $openingBalanceLog['request_amount'], 'required','readonly']); ?>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="control-label col-md-2">Is amount received<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <?php echo $this->Form->control('is_amount_received', ['class' => 'form-select', 'options' => $amount_received, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select amount status', 'onchange' => 'calling(this.value)', 'required','value'=>$openingBalanceLog['is_amount_received']]); ?>
                                    </div>
                                    <label class="control-label col-md-2 yes" style="display: none;">Fund Received Date<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <span class="yes" style="display: none;"><?php echo $this->Form->control('received_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, date('Y-m-d', strtotime($openingBalanceLog['received_date'])), 'required']); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row yes" style="display: none;">
                                    <label class="control-label col-md-2">Fund Received Amount<span class=" required"> *
                                        </span></label>
                                    <div class="col-md-4">
                                        <span class="yes"><?php echo $this->Form->control('received_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,  'value' => $openingBalanceLog['received_amount'], 'required']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
						</fieldset>
                    <?php } ?>
                    <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                        <div class="offset-md-5 col-md-10">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                        </div>
                    </div>
                    <?php echo $this->Form->End(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#FormID").validate({
        rules: {
            'request_date': {
                required: true
            },
            'request_amount': {
                required: true
            },
            'is_amount_receive_id': {
                required: true
            },
            'received_date': {
                required: true
            },
            'division_id': {
                required: true
            }
        },
        messages: {
            'request_date': {
                required: "Select Request date"
            },
            'request_amount': {
                required: "Enter Request Amount"
            },
            'is_amount_receive_id': {
                required: "Select Amount Received as Yes or No"
            },
            'received_date': {
                required: "Select Received amount"
            },
            'received_amount': {
                required: "Enter Received amount"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function calling(id) {
        if (id == 1) {
            $(".yes").show();
            $('#received-date').show();
            $('#received-amount').show();
        } else if (id == 2) {
            $('#received-date').hide();
            $('#received-amount').hide();
            $('#received-date').val('');
            $('#received-amount').val('');      
        }
    }
</script>