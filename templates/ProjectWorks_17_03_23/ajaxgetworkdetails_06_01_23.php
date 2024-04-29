 <style>
.red-tooltip + .tooltip > .tooltip-inner {background-color: #939393}
.cursor{
	cursor:pointer;
}
.table.table-advanced thead tr th{border-width: 1px !important;text-align:center;}
#district_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;color: #FFF;}
#division_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;}
#scheme_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;}
#asset_full > thead.info tr th{background: #607D8B none repeat scroll 0 0;}
tr.shown td.details-control {
    background: rgba(0, 0, 0, 0) url("<?php echo $this->Url->build('/img/minus.png', ['fullBase' => true]); ?>") no-repeat scroll center 10px;
	padding:15px !important;
	background-size: 13px;
}
td.details-control {
    background: rgba(0, 0, 0, 0) url("<?php echo $this->Url->build('/img/plus.png', ['fullBase' => true]); ?>") no-repeat scroll center 10px;  
    cursor: pointer;
	padding:15px !important;
	background-size: 13px;
}

.info{	
	background-color:#222c3c !important;
	color:white !important;
}
</style>
<?php if($projectWorkSubdetailscount > 0) { ?>
 <div class="form-group" style= "background-color:#f3f4f6 !important">
	<fieldset>
		<table class="table table-hover table-bordered" style="max-width: 99%;margin-left: 1%;">
			<thead class="info">
				<tr  align="center">
					<th style="width:5%"> S.No</th>
					<th style="width:10%">Work ID</th>
					<th style="width:15%">Work Name</th>
					<th style="width:10%">District</th>
					<th style="width:7%">Division</th>
					<th style="width:7%">Circle</th>
					<th style="width:10%">Sanctioned Amount <br>(in Rs.)</th>
					<th style="width:10%">Technical Sanction<br> Approval</th>
					<th style="width:10%">Work Status</th>
				</tr>
			</thead>
			<tbody class="add_doc">
			   <?php
				$i = 0;
				foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>
				<tr >
					<td class="trcount"><?php echo $i + 1; ?></td>
					<td><a class="ex1" style="color:red;" href="<?php echo $this->Url->build('/project-works/workview/'.$id.'/'. $projectWorkSubdetail['id'], ['fullBase' => true]); ?>"
                                          target="_blank"><?php echo $projectWorkSubdetail['work_code']; ?></a></td>
					<td><?php echo $projectWorkSubdetail['work_name']; ?></td>
					<td><?php echo $projectWorkSubdetail['district']['name']; ?></td>
					<td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
					<td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
					<td><?php echo $projectWorkSubdetail['sanctioned_amount']; ?></td>                                                                                   
					<td><?php echo ($projectWorkSubdetail['is_approved'] == 1)?"<span class='badge badge-pill badge-success'>Approved</span>":"<span class='badge badge-pill badge-Danger'>Not Approved</span>"; ?></td>                                                                                   
					<td><?php echo $projectWorkSubdetail['project_work_status']['name']; ?></td>                                                                                   
					                                
				</tr>
				  <?php $i++;
				endforeach; ?>
			</tbody>		
		</table>
	</fieldset>                     
</div>
<?php }else{ ?>
	<div style="text-align:center" class="info">
		<b>No Records Found </b>
	</div>
<?php } ?>