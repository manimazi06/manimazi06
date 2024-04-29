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
                <header>Districts</header>
				<div class="tools">
                   <?php echo $this->Html->link(__('Add Districts <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
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
											<th> Sno </th>
											<th> District Name </th>
											<th>  Division Name </th>
											<th> Actions </th>
										</tr>
									</thead>
									<tbody>
										<?php $sno = 1;	foreach ($districts as $district) : ?>										
											<tr class="odd gradeX">
												<td class="text-center" style="width:5%"><?php echo $sno; ?></td>
												<td class="title" style="width:35%"><?php echo $district['name'] ?></td>
												<td class="title" style="width:35%"><?php echo $district['division']['name'] ?></td>									   
												<td class="text-center" style="width:25%">
												   <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$district['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>&nbsp;&nbsp;
												   <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete',$district['id']], ['confirm' => __('Are you sure you want to delete District - {0}?',  $district['name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?>
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