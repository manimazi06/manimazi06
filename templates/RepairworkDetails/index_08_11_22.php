<?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); 
						?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Repair works</header>
            <div class="tools">
                <?php echo $this->Html->link(__('Add Repair work<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="control-label col-md-2">Financial Year<span class="required">*</span></label>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year']); ?>
                    </div>
                    <label class="control-label col-md-2">Department<span class="required">*</span></label>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department']); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- <label class="control-label col-md-2">Project Code<span class="required">*</span></label>
					<div class="col-md-4">
						<?php echo $this->Form->control('project_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text']); ?>
					</div> -->
                    <label class="control-label col-md-2">District<span class="required"> * </span></label>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => false, 'empty' => 'Select District']); ?>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-top:10px;">
                <div class="offset-md-6 col-md-10">
                    <button type="submit" class="btn btn-info ">Get Details</button>
                </div>
            </div>
        </div>
    </div>
</div><br>
<?php echo $this->Form->End(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!--div class="card-head">
				 <header>Proposed Projects				 	
				 </header>
					
			</div-->
            <div class="card-body ">
                <div class="row">

                    <?php if ($Workdetails != '') {  ?>
                    <div class="row">
                        <div class="table-scrollable">
                            <table class="table table-hover table-bordered table-advanced tablesorter display"
                                style="width: 100%" id="example4">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width:1%;">Sno</th>
                                        <th style="width:5%;">Work Name</th>
                                        <th style="width:25%;">Department</th>
                                        <th style="width:25%;">District</th>
                                        <th style="width:10%;">Estimated Cost</th>
                                        <th style="width:10%;">Financial Year </th>
                                        <th align="center" style="width:12%;"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($Workdetails)) { ?>
                                    <?php if (count($Workdetails) > 0) { ?>
                                    <?php $sno = 1;
												foreach ($Workdetails as $Workdetail) : ?>
                                    <tr>
                                        <td><?php echo ($sno); ?></td>
                                        <td align="left"><?php echo $Workdetail['work_name']; ?></td>
                                        <td align="left"><?php echo $Workdetail['department_name']; ?></td>
                                        <td align="left"><?php echo $Workdetail['diname']; ?></td>
                                        <td align="left"><?php echo $Workdetail['estimated_cost']; ?></td>
                                        <td align="left"><?php echo $Workdetail['financial_year']; ?></td>
                                        <td  align="center">
										<?php  echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$Workdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
										<?php  //echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$Workdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>
									
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
                    <?php } ?>
                </div>

            </div>

        </div>
    </div>

    <script>
    function print_receipt() {
        var content = $("#div_vc").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=842,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
    }

    $(".comp").attr("data-placeholder", "Select Company");
    $(".client").attr("data-placeholder", "Select Client");
    </script>