
<style>
.serial {
	width:25px !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
		  <div class="card-head">
            <header>Tentative Financial Programme</header>  
			 <div class="tools">
                                <?php echo $this->Html->link(__('Add Tentative Financial Programme<i class="fa fa-plus"></i>'), ['controller' => 'TentativeFinancialProgrammeDetails', 'action' => 'add'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				    </div>
          </div> 
            <div class="card-body ">
                <div class="row">
                        <div class="row">
                          <div class="table-scrollable">
						<!--table class="table table-bordered order-column" style="width: 100%" id="example4"-->
						  <table class="table table-bordered table-advanced" style="width: 100%" id="example4">
						      <thead>
                                    <tr class="text-center">
                                        <th class ="serial" style="width:1%;">Sno</th>
                                        <th style="width:10%;">Financial Year </th>
                                        <th style="width:10%;">Division</th>
                                        <th style="width:10%;">Total Amount</th>
                                        <th align="center" style="width:10%;"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>                   									<?php $sno = 1;
									foreach ($tentativeFinancialProgrammeDetails as $tentativeFinancialProgrammeDetail) : ?>
										<tr>
											<td><?php echo ($sno); ?></td>
											<td align="left"><?php echo $tentativeFinancialProgrammeDetail['financial_year']['name']; ?></td>
											<td align="left"><?php echo $tentativeFinancialProgrammeDetail['division']['name']; ?></td>
											<td align="left"><?php echo $tentativeFinancialProgrammeDetail['total_amount']; ?></td>
											<td align="center">
												<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view', $tentativeFinancialProgrammeDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?>
												<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $tentativeFinancialProgrammeDetail['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>

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

