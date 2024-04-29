<?php
$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
?>
<?php echo $this->Form->create($projectFinancialSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Work Approval</header>
            </div>

            <div class="card-body">
                <!--h4 class = "sub-tile">Project Details:</h4-->
                <legend class="bol" style="color: #0047AB; text-align: center;">Project Details</legend>

                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="control-label col-md-2 bol">Project Code <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['project_code']; ?>
                            </div>
                            <label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['project_name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['department']['name']; ?>
                            </div>
                            <label class="control-label col-md-2 bol">Financial Year <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['financial_year']['name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['building_type']['name']; ?>
                            </div>
                            <label class="control-label col-md-2 bol">Project Status<span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['project_status']['name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 bol">Rough Cost (Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo ($projectWork['project_amount']) ? ltrim($fmt->formatCurrency((float)$projectWork['project_amount'], 'INR'), '₹') : '0.00'; ?>
                            </div>
                            <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo ($projectWork['coastal_area'] == 1) ? 'Coastal Area' : 'Non-Coastal Area'; ?>
                            </div>
                        </div>
                        <!--div class="form-group row">
                        <label class="control-label col-md-2 bol">District <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                          <?php echo $projectWork['district']['name']; ?>           
					   </div>
                        <label class="control-label col-md-2 bol">Division <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php echo $projectWork['division']['name']; ?>           
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Latitude <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php echo $projectWork['latitude']; ?>                          
						</div>


                        <label class="control-label col-md-2 bol">longitude <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php echo $projectWork['longitude']; ?>                          
						
						</div>
                    </div-->
                        <div class="form-group row">
                            <label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['scheme_type']['name']; ?>
                            </div>
                            <label class="control-label col-md-2 bol">Project Description<span class="required">&nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <?php echo $projectWork['project_description']; ?>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2 bol">Proposal Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                            <div class="col-md-4 lower">
                                <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                        <ion-icon name="document-text-outline"></ion-icon>View
                                    </span></a>
                            </div>
                            <!--label class="control-label col-md-2 bol">Project Description <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">                           
						   <?php echo $projectWork['project_description']; ?>   
                        </div-->
                        </div>

                    </div>
                </fieldset>
            </div>
            <div class="card-body">
                <?php if ($administrativesanctioncount > 0) {   ?>
                    <?php   //if (count($administrativesanction) > 0) {   
                    ?>
                    <legend class="bol" style="color: #0047AB; text-align: center;">Administrative Sanction Details</legend>

                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">
                        <div class="col-md-12" style="margin-top:">
                            <div class="form-group row">
                                <label class="control-label col-md-2 bol">GO No. <span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $administrativesanction['go_no']; ?>
                                </div>
                                <label class="control-label col-md-2 bol">GO Date <span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo date('d-m-Y', strtotime($administrativesanction['go_date'])); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-2 bol">GO Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-4 lower">
                                    <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/AdministrativeSanctions/' . $administrativesanction['go_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a>
                                </div>
                                <label class="control-label col-md-2 bol">Sanctioned Amount (in Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo ($administrativesanction['sanctioned_amount']) ? ltrim($fmt->formatCurrency((float)$administrativesanction['sanctioned_amount'], 'INR'), '₹') : '0.00'; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset><br>
                <?php } //} 
                ?>
                <?php if ($financialSanctionscount > 0) {  ?>
                    <?php   //if (count($financialsanctions) > 0) {  
                    ?>
                    <legend class="bol" style="color: #0047AB; text-align: center;">Financial Sanction Details</legend>

                    <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:25px;">
                        <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 1%;" bgcolor="white">
                            <thead>
                                <tr align="center">
                                    <th style="width:5%"> S.No</th>
                                    <th style="width:20%">GO No</th>
                                    <th style="width:20%">GO Date</th>
                                    <th style="width:20%">Sanction amount (in Rs.)</th>
                                    <th style="width:20%">GO Upload</th>
                                </tr>
                            </thead>
                            <tbody class="add_doc">
                                <?php
                                $i = 0;
                                foreach ($financialSanctions as $financialsanction) : ?>
                                    <tr align="center">
                                        <td class="trcount"><?php echo $i + 1; ?></td>
                                        <td><?php echo $financialsanction['fs_ref_no']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($financialsanction['sanctioned_date'])); ?></td>
                                        <td><?php echo $financialsanction['sanctioned_amount']; ?></td>
                                        <td>
                                            <?php if ($financialsanction['sanctioned_file_upload'] != '') {  ?>
                                                <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' . $financialsanction['sanctioned_file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                                        <ion-icon name="document-text-outline"></ion-icon>View
                                                    </span></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </fieldset><br>
                <?php } //} 
                ?>
                <?php echo $this->Form->End(); ?>
                <legend class="bol" style="color: #0047AB; text-align: center;"> Project Work Details</legend>

                <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;margin-left:5px;margin-bottom:1%">
                    <div class="form-group">
                        <fieldset>
                            <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;">
                                <thead>
                                    <tr align="center">
                                        <th style="width:5%"> S.No</th>
                                        <th style="width:20%">Work ID</th>
                                        <th style="width:20%">Division</th>
                                        <th style="width:20%">Circle</th>
                                        <th style="width:20%">Amount (in Rs.)</th>
                                        <th style="width:10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="add_doc">
                                    <?php
                                    $i = 0;
                                    foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>
                                        <tr class="present_row">
                                            <td class="trcount"><?php echo $i + 1; ?></td>
                                            <td><?php echo $projectWorkSubdetail['work_code']; ?></td>
                                            <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
                                            <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>
                                            <td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>
                                            <td align="center">
                                                <?php if ($division_id == $projectWorkSubdetail['division_id']) { ?>
                                                    <?php if ($projectWorkSubdetail['detailed_estimate_flag'] == 1) {  ?>
                                                        <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Detailed Estimate'), ['action' => 'projectdetailedestimateadd', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>

                                                    <?php } else if ($projectWorkSubdetail['detailed_estimate_flag'] == 0) { ?>
                                                        <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Detailed Estimate'), ['action' => 'projectdetailedestimateadd', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

                                                <?php }
                                                } ?>

                                                <?php //echo $this->Html->link(__('<i class="fa fa-plus"></i> Technical Sanction'), ['action' => 'technicalsanction',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); 
                                                ?><br><br>
                                                <?php //echo $this->Form->postLink(__('<i class="fa fa-pencil"></i>&nbsp;Approve'), ['action' => 'approval',$id,$projectWorkSubdetail['id']], ['confirm' => __('Are you sure you want to Approve {0}?',  $projectWorkSubdetail['work_code']),'escape' => false,'class'=>'btn btn-danger btn-xs']); 
                                                ?><br><br>

                                                <?php //echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Tender Details'), ['action' => 'tenderdetails',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); 
                                                ?><br><br>
                                                <?php //echo $this->Html->link(__('<i class="fa fa-pencil"></i> Site H/O to Contractor'), ['action' => 'sitehandover',$id,$projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); 
                                                ?><br><br>

                                                <?php if ($projectWorkSubdetail['approval_role'] == $role_id) {  ?>
                                                    <?php if ($division_id == $projectWorkSubdetail['division_id']) { ?>
                                                        <?php if ($projectWorkSubdetail['is_approved'] == 0) { ?>

                                                    <?php }
                                                    } ?>
                                                    <?php if ($projectWorkSubdetail['technical_sanction_flag'] == 1) {  ?>
                                                        <?php if ($projectWorkSubdetail['is_approved'] == 0) {  ?>

                                                            <?php echo $this->Form->postLink(__('<i class="fa fa-pencil"></i>&nbsp;Approve'), ['action' => 'approval', $id, $projectWorkSubdetail['id']], ['confirm' => __('Are you sure you want to Approve {0}?',  $projectWorkSubdetail['work_code']), 'escape' => false, 'class' => 'btn btn-danger btn-xs']); ?><br><br>
                                                    <?php  }
                                                    }
                                                }
                                                if ($projectWorkSubdetail['is_approved'] == 1) {   ?>
                                                    <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>view Technical Sanction'), ['action' => 'technicalsanction', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-info btn-sm']); ?><br><br>

                                                    <span class="badge badge-pill badge-success">Approved</span><br><br>
                                                    <?php if ($projectWorkSubdetail['approval_role'] == $role_id) {  ?>
                                                        <?php if ($projectWorkSubdetail['tender_detail_flag'] == 0) {  ?>
                                                <?php  }
                                                    }
                                                }   ?>
                                                <?php if ($projectWorkSubdetail['tender_detail_flag'] == 1) {  ?>
                                                    <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View Tender Details'), ['action' => 'tenderdetails', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
                                                    <?php if ($projectWorkSubdetail['approval_role'] == $role_id) {  ?>
                                                        <?php if ($projectWorkSubdetail['site_handover_flag'] == 0) {  ?>
                                                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Site H/O to Contractor'), ['action' => 'sitehandover', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if ($projectWorkSubdetail['site_handover_flag'] == 1) {  ?>

                                                    <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view Site Handover Details'), ['action' => 'sitehandover', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br><br>
                                                <?php } ?>
                                                <?php if ($role_id == 2) { ?>
                                                    <?php if ($division_id == $projectWorkSubdetail['division_id']) { ?>
                                                        <?php if ($projectWorkSubdetail['is_approved'] == 1) {    ?>

                                                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Timeline'), ['action' => 'projecttimeline', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
                                                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Project Monitoring'), ['controller' => 'ProjectMonitoringDetails', 'action' => 'projectmonitoring', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
                                                <?php }
                                                    }
                                                } ?>
                                                <?php if ($projectWorkSubdetail['site_handover_flag'] == 1) {  ?>
                                                    <?php if ($role_id == 4 || ($user_id == $projectWorkSubdetail['fund_approval_user_id'])) { ?>
                                                        <?php if ($division_id == $projectWorkSubdetail['division_id'] && $projectWorkSubdetail['fund_request_flag'] == 0) { ?>
                                                            <?php echo $this->Html->link(__('<i class="fa fa-money"></i>New Fund Request'), ['action' => 'fundrequest', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>
                                                    <?php }
                                                    } ?>

                                                <?php }  ?>

                                                <?php if ($projectWorkSubdetail['fund_request_flag'] == 1) { ?>
                                                    <?php if ($user_id == $projectWorkSubdetail['fund_approval_user_id']) { ?>

                                                        <?php echo $this->Html->link(__('<i class="fa fa-money"></i> New Fund Request'), ['action' => 'fundrequest', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

                                                    <?php } else {
                                                        //if($role_id != 4){

                                                    ?>

                                                        <?php echo $this->Html->link(__('<i class="fa fa-money"></i> Fund Request view'), ['action' => 'fundrequest', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

                                                <?php }
                                                } //}  
                                                ?>

                                                <?php if ($fundrequestcount > 0 && $projectWorkSubdetail['fund_request_flag'] == 0) { ?>
                                                    <?php if ($fundrequest['project_work_subdetail_id'] == $projectWorkSubdetail['id']) { ?>

                                                        <?php echo $this->Html->link(__('<i class="fa fa-money"></i> Fund Request View'), ['action' => 'fundrequestview', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

                                                <?php }
                                                } ?>

                                                <?php echo $this->Html->link(__('<i class="fa fa-clock-o"></i>Project Minute Details'), ['action' => 'projectminutedetail', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']);
                                                ?><br><br>

                                                <?php echo $this->Html->link(__('<i class="fa fa-money"></i>Project Fund Details'), ['action' => 'funddetails', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']);
                                                ?><br><br>

                                                <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Add Tender Details'), ['action' => 'tenderdetails', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm']); ?><br><br>

                                                <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Project Monitoring'), ['controller' => 'ProjectMonitoringDetails', 'action' => 'projectmonitoring', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>
                                                <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Project HandoverDetails'), ['controller' => 'ProjectHandoverDetails', 'action' => 'projecthandoverdetails', $id, $projectWorkSubdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?><br><br>

                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>

                            </table>
                        </fieldset>
                    </div>
                </fieldset>
            </div>
            <div class="form-group" style="padding-top: 10px;">
                <div class="offset-md-5 col-md-10">
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>
<script>
    function loaddescription(id) {
        var id;
        //alert(id);

        $.ajax({
            async: true,
            dataType: "html",
            url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxgetdescription/' + id,

            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data, textStatus) { //alert(data);
                $('#description').val(data);

            }
        });

    }



    function calculatetotal(val) {
        var val = $('#approved-estimate').val();
        var quantity = $('#quantity').val();


        var total = parseFloat(quantity) * parseFloat(val);

        if (!isNaN(total)) {
            $('#total-cost').val(total);

        } else {

            $('#total-cost').val('');

        }



    }




    $("#FormID").validate({
        rules: {
            'material_id': {
                required: true
            },
            'financial[0][sanctioned_date]': {
                required: true
            },
            'financial[0][sanctioned_amount]': {
                required: true
            },
            'financial[0][sanctioned_file_upload]': {
                required: true
            }
        },

        messages: {
            'material_id': {
                required: "Enter Reference No"
            },
            'financial[0][sanctioned_date]': {
                required: "select Date"
            },
            'financial[0][sanctioned_amount]': {
                required: "Enter Sanctioned Amount"
            },
            'financial[0][sanctioned_file_upload]': {
                required: "Select Document"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
</script>