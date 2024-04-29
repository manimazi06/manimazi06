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
                <header>UC Fund Sanctioned Details</header>  
				<div class="tools">
					  <?php //echo $this->Html->link(__('Add Fund Details<i class="fa fa-plus"></i>'), ['action' => 'funddetails'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				</div>
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body"> 
                                    
                                    <div class="table-scrollable">
                                        <table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width:10%">Sno</th>
                                                    <th style="width:10%">GO NO </th>
                                                    <th style="width:10%">Project Name </th>
                                                    <th style="width:10%">Place </th>
                                                    <th style="width:10%">Date</th>
                                                    <th style="width:10%">Amount</th>
                                                    <th style="width:10%">UC File</th>
                                                    <!--th style="width:10%">Remarks</th-->
                                                    <th style="width:10%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                    foreach ($uc_lists as $uc_list) :
                                                ?>
												<tr class="odd gradeX">
													<td class="text-center"><?php echo ($sno); ?></td>
													<td class="text-center"><?php echo $uc_list['go_no']; ?></td>
													<td class="text-center"><?php echo $uc_list['work_name']; ?></td>
													<td class="text-center"><?php echo $uc_list['place_name']; ?></td>
													<td class="text-center"><?php if ($uc_list['certificated_date'] != '') {	echo date('d-m-Y', strtotime($uc_list['certificated_date'])); }else{	echo '';	}   ?></td>
                                                    <td class="text-center"><?php echo $uc_list['amount']; ?></td>
                                                    <td class="text-center">	<a style="color:blue;" href="<?php echo $this->Url->build('/uploads/utilizationCertificates/'.$uc_list['certificate_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                            <ion-icon name="document-text-outline"></ion-icon>View
                                        </span></a></td>
                                                    <!--td class="text-center"><?php echo $uc_list['remarks']; ?></td-->                        
                                                    <td class="text-center"> 									
													 <?php if($uc_list['uc_sanctioned'] == 0){ ?>  
													 <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> update'), ['action' => 'add',$uc_list['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>&nbsp;&nbsp;&nbsp;
	                                                 <?php }else{ ?>
													 <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['action' => 'view',$uc_list['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>&nbsp;&nbsp;&nbsp;
	                                                 <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $sno++;
                                                    endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>