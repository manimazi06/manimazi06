<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>View Projectwise Development Work Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectwiseDevelopmentWorkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">

                    <div class="form-body row">
							<div style="text-align: right;  color:blue" ><a href="#" id="export_excel_button" title="assigment Details" ><img title="Excelsheet" src="<?php echo $this->Url->build('/img/excel.png', ['fullBase' => true]); ?>" height="22px" /></a></div><br>

                        <!-- <div class="col-md-12"> -->
                        <div class="form-group row">
                            <label class="control-label col-md-4">Development Works<span class=" required"> &nbsp;&nbsp;:
                                </span></label>
                            <div class="col-md-4 lower">
                                          <?php echo $projectdevelopment['development_work']['name']; ?>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="form-group">
                            <fieldset>
                               <br>
                                <table class="table  table-bordered  order-column"style="max-width: 98%;margin-right: 1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:9%">Item code</th>
                                            <th style="width:20%">Item Description</th>
                                            <th style="width:8%">Number1</th>
                                            <th style="width:8%">Number2</th>
                                            <th style="width:8%">Length</th>
                                            <th style="width:8%">Breath</th>
                                            <th style="width:8%">Depth</th>
                                            <th style="width:8%">Quantity</th>                                     
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
									  <?php $i=1; foreach($projectdevelopment_subdetails as $subdetail){ ?>
                                        <tr class="present_row_in_post">
                                            <td class="trcount"><?php echo $i; ?></td>
                                            <td>
                                                <?php echo $subdetail['item_code']; ?>
                                            </td>
                                            <td>
                                                <?php echo $subdetail['item_description']; ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php echo $subdetail['number_1']; ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php echo $subdetail['number_2']; ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php echo $subdetail['length']; ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php echo $subdetail['breath']; ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?php echo $subdetail['depth']; ?>
                                            </td >
                                            <td style="text-align:right;">
											   <?php echo $subdetail['quantity']; ?>

                                            </td>
                                          
                                        </tr>
									  <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                      
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id = "report" style="display:none;">

          <table class="table  table-bordered  order-column"style="max-width: 98%;margin-right: 1%;">
			<thead>
			    <tr>
				   <th colspan="9">TAMILNADU POLICE HOUSING CORPORATION LIMITED	</th>
			    </tr>
				 <tr>
				   <th colspan="9">Division :&nbsp;<?php echo $division[$projectdevelopment['project_work_subdetail']['division_id']]; ?></th>
			    </tr>
				
				 <tr>
				   <th colspan="9"><?php echo $projectdevelopment['development_work']['name']; ?>	</th>
			    </tr>
			    <tr>
				   <th colspan="9"><?php echo $projectdevelopment['project_work']['project_name']; ?></th>
			    </tr>
				<tr>
				   <th colspan="9">Work Code ::&nbsp;<?php echo $projectdevelopment['project_work_subdetail']['work_code']; ?></th>
			    </tr>
				 <tr>
				   <th colspan="9">Detailed Estimate</th>
			    </tr>
				<tr>
					<th style="width:1%">S.no</th>
					<th style="width:9%">Item code</th>
					<th style="width:20%">Item Description</th>
					<th style="width:16%" colspan="2">No</th>					
					<th style="width:8%">Length</th>
					<th style="width:8%">Breath</th>
					<th style="width:8%">Depth</th>
					<th style="width:8%">Quantity</th>                                     
				</tr>
			</thead>
			<tbody class="adding">
			  <?php $i=1; foreach($projectdevelopment_subdetails as $subdetail){ ?>
				<tr class="present_row_in_post">
					<td class="trcount"><?php echo $i; ?></td>
					<td>
						<?php echo $subdetail['item_code']; ?>
					</td>
					<td>
						<?php echo $subdetail['item_description']; ?>
					</td>
					<td style="text-align:right;">
						<?php echo $subdetail['number_1']; ?>
					</td>
					<td style="text-align:right;">
						<?php echo $subdetail['number_2']; ?>
					</td>
					<td style="text-align:right;">
						<?php echo $subdetail['length']; ?>
					</td>
					<td style="text-align:right;">
						<?php echo $subdetail['breath']; ?>
					</td>
					<td style="text-align:right;">
						<?php echo $subdetail['depth']; ?>
					</td >
					<td style="text-align:right;">
					   <?php echo $subdetail['quantity']; ?>

					</td>
				  
				</tr>
			  <?php $i++; } ?>
			</tbody>
		</table>
</div>
<script>
var develop_name = "<?php echo $projectdevelopment['development_work']['name']; ?>";
 $(document).ready(function(){
	$(function(){
		$("#export_excel_button").click(function () {
			var dt = <?php echo date("YmdHis");?>;
			var filename = "Development_work_"+develop_name+"_"+dt;
			var uri = $("#report").btechco_excelexport({
				containerid: "report", 
				datatype: $datatype.Table,
				returnUri: true
			});
			$(this).attr('download', filename+".xls") // set file name (you want to put formatted date here)
			.attr('href', uri)                     // data to download
			.attr('target', '_blank')              // open in new window (optional)
		});
	});
	
 });
 
</script>

