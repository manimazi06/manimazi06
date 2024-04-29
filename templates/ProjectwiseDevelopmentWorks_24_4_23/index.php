


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body ">
                <div class="row">
                    <?php if ($projectwiseDevelopmentWorks != '') {  ?>
                        <div class="row">
                            <div class="table-scrollable">
                                <!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
                                <table class="table table-hover table-bordered table-advanced tablesorter display" style="width: 100%" id="example4">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width:10%;">Sno</th>
                                            <th style="width:5%;">Work Name</th>
                                            <th style="width:25%;">Description</th>
                                            <th style="width:10%;">Estimated Cost</th>
                                            <th align="center" style="width:12%;"> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($projectwiseDevelopmentWorks)) { ?>
                                            <?php if (count($projectwiseDevelopmentWorks) > 0) { ?>
                                                <?php $sno = 1;
                                                foreach ($projectwiseDevelopmentWorks as $projectwiseDevelopmentWork) : ?>
                                                    <tr>
                                                        <td><?php echo ($sno); ?></td>
                                                        <td align="left"><?php echo $projectwiseDevelopmentWork['work_name']; ?></td>
                                                        <td align="left"><?php echo$projectwiseDevelopmentWork['work_description']; ?></td>
                                                        <td align="left"><?php echo $projectwiseDevelopmentWork['estimated_cost']; ?></td>
                                                        <td align="center">
                                                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view', $projectwiseDevelopmentWork['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
                                                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $projectwiseDevelopmentWork['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>

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
</div>