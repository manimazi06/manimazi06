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
                <header>Contractor class levels</header>
				<div class="tools">                                          
					<?php echo $this->Html->link(__('Add Class Level<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false,'class'=>' btn btn-info']); ?>
				</div>
            </div>
            <div class="card-body ">
                <div class="row">
				<div class="col-md-12">
					<div class="card-body">					  
						<div class="table-scrollable user-table">
							<table class="table  table-bordered table-checkable order-column mobile-table" id="example4">
								<thead>
									<tr class="text-center">
										<th style="width:5%;"> Sno </th>
										 <th style="width:60%;"> Name </th>
										 <th style="width:20%;"> Actions </th>
									</tr>
								</thead>
								<tbody>
									<?php $sno =1; foreach ($contractorClassLevels as $contractorClassLevel): ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="title"><?php echo $contractorClassLevel['name'] ?></td>                                                 
										<td class="text-center">
											<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$contractorClassLevel['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>&nbsp;&nbsp;
											<?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete',$contractorClassLevel['id']], ['confirm' => __('Are you sure you want to delete Class Level - {0}?',  $contractorClassLevel['name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?>
										</td>
									</tr>
									<?php $sno++;
								 endforeach; ?>
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
<script type="text/javascript">
$(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>