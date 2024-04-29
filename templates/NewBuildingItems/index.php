<style>
    .mdl-tabs__tab.tabs_three:hover {
        color: #6610f2 !important;
    }

    a.mdl-tabs__tab.tabs_three {
        max-width: 20%;
    }
</style>
<?php echo $this->Form->create($projectAdministrativeSanction, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12"><?php //echo 'hi'; exit(); ?>
    <div class="card card-topline-aqua">
        	<div class="card-head">
				<header>Building Items (Updated)</header>
                   <?php if($role_id == 1 || $role_id == 10){  ?>
				     <div class="tools">
					  <?php echo $this->Html->link(__('Add <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => ' btn btn-info','target'=>'_blank']); ?>
				    </div>
					<?php  } ?>						
			</div>
		  <div class="card-body"> 
		    <div class="col-md-12">
				<div class="form-group row">
					<label class="control-label col-md-2">Type<span class="required">*</span></label>
					<div class="col-md-4">
                         <?php echo $this->Form->control('building_item_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $buildingItemtypes, 'label' => false, 'error' => false, 'empty' => 'Select Type']); ?>
					</div>					
				</div>              		
		    </div> 
		      <div class="form-group" style="margin-top:10px;">
				<div class="offset-md-6 col-md-10">
					<button type="submit" class="btn btn-info ">Get Details</button>  
				</div>
			 </div>
		  </div>		  
	 </div>  
 </div><br>
  <?php echo $this->Form->End(); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">           
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                     <div class="btn-group pull-right">
										<button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Download
											<i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu pull-right">											
											<li>
												<a id="export_excel_button">
												<i class="fa fa-file-excel-o"></i> Export to Excel</a>
											</li>
										</ul>
									</div>
                                    <div class="table-scrollable">
                                        <table class="table  table-bordered table-checkable order-column" style="width: 100%" id="example4">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width:1%;"> Sno </th>
                                                    <th style="width:10%;"> Type</th>
                                                    <th style="width:10%;"> Item code </th>
                                                    <th style="width:60%;"> Item Description </th>
                                                    <th style="width:10%;"> unit </th>
													<?php if($LOGGED_ROLE == 1 || $LOGGED_ROLE == 10){ ?>
                                                    <th style="width:10%;"> Actions </th>
													<?php  } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                    foreach ($newbuildingItems as $buildingItem) : ?>
                                                    <tr class="odd gradeX">
                                                        <td class="text-center"><?php echo $sno; ?></td>
														<td class="title"><?php echo $buildingItem['building_item_type']['name']; ?></td>
                                                        <td class="title"><?php echo $buildingItem['item_code'] ?></td>
                                                        <td class="title"><?php echo $buildingItem['item_description'] ?></td>						
                                                        <td class="title"><?php echo $buildingItem['unit']['name'] ?></td>						
														
													<?php if($LOGGED_ROLE == 1 || $LOGGED_ROLE == 10){ ?>
                                                        <td class="text-center">
                                                           	 <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$buildingItem['id']], ['escape' => false, 'class' => 'btn btn-outline-primary btn-sm','target'=>'_blank']); ?><br><br>
											            	 <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete',$buildingItem['id']], ['confirm' => __('Are you sure you want to delete Item - {0}?',  $buildingItem['item_code']), 'class' => 'btn btn-outline-danger btn-sm', 'escape' => false]); ?>
                                                        </td>
														<?php  } ?>
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
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
		   <tr style="text-align:center;">
			  <th colspan="4">TamilNadu Police Housing Corporation (TNPHC)</th>
		   </tr>
		   <tr style="text-align:center;">
			  <th colspan="4">Item Details</th>
		   </tr>
			<tr style="text-align:center;">
				<th style="width:1%;"> Sno </th>
				<th style="width:10%;"> Type</th>
				<th style="width:10%;"> Item code </th>
				<th style="width:60%;"> Item Description </th>
			</tr>
		<tbody>
			<?php $sno1 = 1;
            foreach ($newbuildingItems as $buildingItem) : ?>
				<tr class="odd gradeX">
					<td style="text-align:center;"><?php echo $sno1; ?></td>
					<td style="text-align:center;"><?php echo $buildingItem['building_item_type']['name']; ?></td>
                    <td style="text-align:center;"><?php echo $buildingItem['item_code'] ?></td>
                    <td style="text-align:center;"><?php echo $buildingItem['item_description'] ?></td>	
				</tr>
			<?php $sno1++;
			endforeach; ?>
		</tbody>
	</table>
    </div>
</div>
<script type="text/javascript">
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
                        "Item_details.xls"
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
</script>
<script type="text/javascript">	
	  $("#FormID").validate({
        rules: {
            'building_item_type_id': {
                required: false
            }        
        },
        messages: {
            'financial_year_id': {
                required: "Select Type"
            }
        },
        submitHandler: function(form) {		
               form.submit();			 
        }
    });   
</script>