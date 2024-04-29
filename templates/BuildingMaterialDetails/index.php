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
                <header>Building Material Details</header>
					<div class="tools">
					  <?php echo $this->Html->link(__('Add Material Details<i class="fa fa-plus"></i>'), ['action' => 'buildingmaterial'], ['escape' => false, 'class' => ' btn btn-info']); ?>
				</div>
				
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">                                

			                            <div class="table-scrollable">
											<table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
												<thead>
													<tr class="text-center">
														<th> Sno </th>
														<th> Building material </th>
														<th>Action</th>


													</tr>
												</thead>
												<tbody>
													<?php $sno = 1;
													foreach ($projects as $project) : ?>
														<tr class="odd gradeX">
															<td class="text-center"><?php echo $sno ?></td>
															<td class="text-center"><?php echo $project['material_name']; ?></td>

															<td class="text-center">
																<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'buildingmaterialedit',$project['material_id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm']); ?>&nbsp;&nbsp;
																<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> View'), ['action' => 'view',$project['material_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm']); ?><br>
  
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


    <!-- REPORT -->


    <script type="text/javascript">
        $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
    </script>

    <script>
        $(document).ready(function() {

            $(function() {
                $("#export_excel_button").click(function() {
                    $("#export_excel_button").removeClass("model-head");
                    var filename = $(this).attr("title");
                    var uri = $("#report").btechco_excelexport({
                        containerid: "report",
                        datatype: $datatype.Table,
                        returnUri: true
                    });

                    $(this).attr('download',
                            "ProjectWorkYearWise_Report.xls"
                        ) // set file name (you want to put formatted date here)
                        .attr('href', uri) // data to download
                        .attr('target', '_blank') // open in new window (optional)
                });



            });
        });

        function print_receipt() {
            var content = $("#div_vc").html();
            var pwin = window.open("MSL", 'print_content',
                'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
            pwin.document.open();
            pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
                '</td></tr></body></html>');
            pwin.document.close();
        }

        // $(".comp").attr("data-placeholder", "Select Company");
        // $(".client").attr("data-placeholder", "Select Client");
    </script>