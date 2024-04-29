<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header> Financial Yearwise Material Cost Details</header>				
				<div class="tools">
					  <?php echo $this->Html->link(__('Add Financial yearwise material<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				</div>
				
				
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <!--div class="col-md-6 col-sm-6 col-6">
                                            <?php echo $this->Html->link(__('Add Financial yearwise material <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 btn btn-info']); ?>
                                        </div-->

										<?php echo $this->Form->create($financialyearwiseMaterialCostSubdetails, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
										 <div class="card-body"> 
											<div class="col-md-12">
												<div class="form-group row">
													<label class="control-label col-md-2">Financial Year<span class="required"> * </span></label>
													<div class="col-md-4">
														 <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financial_year, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year','required']); ?>
													</div>															
												</div>																	
											</div> 
											   <div class="form-group">
													<div class="offset-md-6 col-md-10">
														<button type="submit" class="btn btn-info ">Get Details</button>  
													</div>
												</div>
										  </div>
									   
										<?php echo $this->Form->End(); ?>
										
                                         <?php if(isset($projects)){ ?>                                  
										<div class="table-scrollable">
											<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
												<thead>
													<tr class="text-center">
														<th> Sno </th>
														<th> Financial Year </th>
														<th> Material Type</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php $sno = 1;
													foreach ($projects as $project) : ?>
														<tr class="odd gradeX">
															<td class="text-center"><?php echo $sno; ?></td>
															<td class="text-center"><?php echo $project['fyear']; ?></td>
															<td class="text-center"><?php echo $project['bname']; ?></td>										
															<td class="text-center">
																<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$project['main_id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>&nbsp;&nbsp;&nbsp;
																<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$project['main_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?><br>

															</td>
														</tr>
													<?php $sno++;
													endforeach; ?>
												</tbody>
											</table>
										</div>	
										 <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <script>
        $("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: false
            }          
        },
        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            }
        },
        submitHandler: function(form) {
		       form.submit();	 
			
        }
    });   
    </script>