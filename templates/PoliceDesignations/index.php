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
                <header>Police Designations</header>
                <div class="tools">
                    <?php echo $this->Html->link(__('Add Police Designation<i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
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
                                                    <th>Sno</th>
                                                    <th>Designation Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                foreach ($policeDesignations as $policeDesignation) : ?>
                                                    <tr class="odd gradeX">
                                                        <td class="text-center"><?php echo $sno; ?></td>
                                                        <td class="title"><?php echo $policeDesignation['name'] ?></td>
														<td class="text-center" style="width:25%">
														   <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$policeDesignation['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?>&nbsp;&nbsp;
														   <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete',$policeDesignation['id']], ['confirm' => __('Are you sure you want to delete police Designation - {0}?',  $policeDesignation['name']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?>
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
    </div>
</div>
<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>