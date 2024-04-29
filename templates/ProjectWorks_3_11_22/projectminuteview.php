<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
		    <div class="card-head">
                <header>Project Minute Details View</header>
            </div>
			<div class="card-body">
				<div class="col-md-11 offset-1">
					<div class="form-group row">
							<label class="control-label col-md-2">Meeting date<span class=" required">&nbsp;&nbsp;:	</span></label>
							<div class="col-md-2">
							<?php echo date('d-m-Y',strtotime($projectminutedetail['meeting_date'])); ?>
							</div>
					</div>
				</div>
			</div>
			 <div class="card-body">
				<div class="table-scrollable">
					<legend class="bol" style="color: #0047AB; text-align: center;"></legend>
					<fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:25px;">

						<table class="table table-bordered order-column" style="width: 98%">
							<thead>
								<tr class="text-center">
									<th width="1%"> Sno </th>
									<th>Question</th>
									<th>Action Taken Date</th>
									<th>Action Taken </th>
								</tr>
							</thead>
							<tbody>
								<?php $sno = 1; ?>

								<?php foreach ($projectsubminutedetails as $projectsubminutedetail) : ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo ($sno); ?></td>
										<td class="text-center"><?php echo $projectsubminutedetail['minutes_points']; ?></td>
										<td class="text-center"><?php echo ($projectsubminutedetail['action_taken_date'] != '') ? date('Y-m-d', strtotime($projectsubminutedetail['action_taken_date'])) : '' ?></td>
										<td class="text-center"><?php echo $projectsubminutedetail['action_taken']; ?></td>
									</tr>
								<?php $sno++;
								endforeach; ?>
							</tbody>
						</table>
					</fieldset>
				</div>
			</div>
      </div>
   </div>
</div>