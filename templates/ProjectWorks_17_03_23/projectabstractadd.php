                <?php echo $this->Form->create($projectDevelopmentWorkDetail, ['id' =>'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Project Abstract / Technical Sanction Details	
				
				
				</header>
				<div class= "tools">
				  <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>&nbsp;View Items Codes with Description'), ['controller'=>'BuildingItems','action' => 'index'], ['escape' => false, 'class' => ' btn btn-info','target'=>'_blank']); ?>

				</div>
            </div>			
			<div class="form-group" style="padding-top: 10px;padding-bottom: 10px">
				 <div class="offset-md-1 col-md-2">
				 <button type="button" class = 'btn btn-outline-primary btn-sm' onclick='toggledetail()'><i class="fa fa-eye"></i>View Project Details</button>  
				 </div>
			  </div>
			 <div id ="project" style="display:none;">     
			   
			</div>			
			<?php  if($detailed_approval_stages_count > 0){  ?> 
			 <div class="card-body"> 
                   <h4 class = "sub-tile">Abstract Approval Stages</h4>			 
					<!--legend class="bol" style="color: #0047AB; text-align: center;"></legend-->  
			         <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

						<table class="table table-hover table-bordered table-advanced tablesorter display" style="width:98%" bgcolor="white">
							<thead>
								<tr class="text-center">
									<th style="width:1%">S.No</th>
									<th style="width:10%">Date</th>
									<th style="width:10%">Status</th>
									<th style="width:10%">Process</th>
									<th style="width:10%">Remarks</th>
								</tr>
							</thead>
							<tbody>							
				
								<?php $sno = 1;
								foreach ($detailed_approval_stages as $detailed_approval) : ?>
									<tr >
										<td class="text-center"><?php echo ($sno); ?></td>
										<td align="center" class="alignment"><?php echo date('d-m-Y',strtotime($detailed_approval['submit_date'])); ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['approval_status']['name']; ?></td>
										<td align="center" class="alignment"><?php echo $detailed_approval['current_status']; ?></td>
										<td align="left"   class="alignment"><?php echo $detailed_approval['remarks']; ?></td>
									</tr>
								<?php $sno++;
								endforeach; ?>								
							</tbody>							
						</table>
                    </fieldset>						
             </div>
			 <?php } ?>
            <div class="card-body addpage">
                <div class="col-md-12">
                    <div class="form-body row"> 
                         <div class="form-group">
                            <fieldset>                             
                                <table class="table  table-bordered  order-column" style="max-width:100%;margin-right:1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:10%">Item code</th>
                                            <th style="width:30%">Item Description</th>
											<th style="width:8%">Quantity</th>
											<th style="width:8%">Unit</th>
                                            <th style="width:8%">Rate</th>
                                            <th style="width:10%">Amount <br>(in Rs.)</th>
                                            <th style="width:5%"> 
												<!--button type="button" class="btn btn-success btn-xs" onclick="pageadding(1);"><i class="fa fa-plus-circle"></i>Add Code</button><br><br>
												<button type="button" class="btn btn-danger btn-xs" onclick="pageadding(2);"><i class="fa fa-plus-circle"></i>Add Description</button-->
											</th>
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
                                        <tr class="present_row_in_post">
                                            <td class="trcount">1</td>
                                            <td class="nodescription">
                                                <?php echo $this->Form->control('workdetail.0.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,0)','data-rule-required'=>true,'data-msg-required'=>'Select Item Code']); ?>
                                                <?php echo $this->Form->control('workdetail.0.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_code_0']); ?>
                                            </td>
                                            <td  class="nodescription"><?php echo $this->Form->control('workdetail.0.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 4,'id'=>'description_0', 'readonly']); ?>
                                            </td>
											
											<td class ="description" style="display:none;">
											   <?php //echo $this->Form->control('workdetail.0.building_item_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','value'=>0]); ?>
											   <?php //echo $this->Form->control('workdetail.0.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','value'=>0]); ?>

                                             </td>
                                            <td class ="description" style="display:none;"><?php echo $this->Form->control('workdetail.0.item_description1', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 4,'id'=>'description_0','data-rule-required'=>true,'data-msg-required'=>'Enter Description']); ?>
                                            </td>
											
											<td><?php echo $this->Form->control('workdetail.0.quantity', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','id'=>'q_0','onkeyup'=>"product(0)",'data-rule-required'=>false,'data-msg-required'=>'Enter Quantity']); ?>
                                            </td>
											<td>
											   <?php echo $this->Form->control('workdetail.0.unit_id', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Select Unit','data-rule-required'=>false,'data-msg-required'=>'Select Unit','options'=>$units,'empty'=>'-Select-']); ?>
                                            </td>
                                            <td>
											  <?php echo $this->Form->control('workdetail.0.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate','id'=>'r_0','onkeyup'=>"product(0)",'data-rule-required'=>false,'data-msg-required'=>'Enter Rate']); ?>
                                            </td>                                            
                                            <td>
											<?php echo $this->Form->control('workdetail.0.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'cal_total_0', 'readonly','value'=>0]); ?>
                                            <?php //echo $this->Form->control('workdetail.0.amount_test', ['class' => 'divided_amounts','type'=>'hid','value'=>0]); ?> 
											</td>
                                            <td>
											  <button type="button" class="btn btn-primary btn-xs" onclick="showdescription(0);"><i class="fa fa-pencil"></i>Description</button>
											  <!--button type="button" class="btn btn-primary btn-xs" onclick="showdescription(0);"><i class="fa fa-pencil"></i>Type Description</button-->
											   <?php echo $this->Form->control('type', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','value'=>0]); ?>

											</td>  
                                        </tr>
                                    </tbody>
									<tfoot >
										<tr>
										   <td colspan="6" align="right"><b>Total (in Rs.)</b></td>
										   <td>
										   <?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly']) ?>
										   </td>
										   <td>
										   	<button type="button" class="btn btn-success btn-xs" onclick="pageadding(1);"><i class="fa fa-plus-circle"></i>Add Code</button><br><br>
											<button type="button" class="btn btn-danger btn-xs" onclick="pageadding(2);"><i class="fa fa-plus-circle"></i>Add Description</button>
										
										   
										   </td>
										</tr>
									</tfoot>
                                </table>
                            </fieldset>
                        </div>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20" onclick="hidetechnical();">Submit</button>
                                <button type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default"
                                    onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
				 <?php echo $this->Form->control('abstract_amount', ['type' => 'hidden',  'label' => false, 'error' => false,'value'=>($tot_amount)?$tot_amount:'0.00']) ?>

        </div>
    </div>
</div>
<style>
.mdl-tabs__tab.tabs_three:hover {
    color: #6610f2 !important;
}

a.mdl-tabs__tab.tabs_three {
    max-width: 20%;
}
</style>
<?php if($abstractcount > 0){  ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Abstract Details</header>
				<div class="btn-group pull-right">
					<button class="mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 deepPink-bgcolor btn btn-outline dropdown-toggle btn-sm" data-bs-toggle="dropdown">Download
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right">
						<li>
							<a onClick="print_receipt('div_vc')">
								<i class="fa fa-print"></i> Print </a>
						</li>
						<li>
							<a id="export_excel_button">
								<i class="fa fa-file-excel-o"></i> Export to Excel </a>
						</li>
					</ul>
				</div><br>
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
                                                    <th style="width:1%">S.no</th>
													<th style="width:7%">Item code</th>
													<th style="width:45%">Item Description</th>
													<th style="width:8%">Quantity</th>
													<th style="width:8%">Unit</th>
													<th style="width:8%">Rate</th>
													<th style="width:10%">Amount <br>(in Rs.)</th>
                                                    <th style="width:5%">Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                    foreach ($abstract_subdetails  as $abstract_subdetail) : ?>
													<tr class="odd gradeX">
														<td class="text-center"><?php echo $sno; ?></td>
														<td class="title"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
														<td class="title"><?php echo $abstract_subdetail['item_description'] ?></td>
														<td class="title" style="text-align:right"><?php echo $abstract_subdetail['quantity'] ?></td>
														<td class="title" style="text-align:right"><?php echo $abstract_subdetail['unit']['name'] ?></td>
														<td class="title" style="text-align:right"><?php echo $abstract_subdetail['rate'] ?></td>
														<td class="title" style="text-align:right"><?php echo ($abstract_subdetail['amount'] != 0)?$abstract_subdetail['amount']:''; ?></td>
														<td class="text-center">
															<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'projectabstractedit',$id,$work_id,$abstract_subdetail['id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm','target'=>'_blank']); ?>
														</td>
													</tr>
                                                <?php $sno++;
                                                    endforeach; ?>
                                            </tbody>
											<tfoot >  
												<tr>
												   <td colspan="6" style="text-align:right"><b>Total (in Rs.)</b>&nbsp;&nbsp;</td>
												   <td style="text-align:right"><?php echo ($tot_amount)?$tot_amount:'0.00'; ?>&nbsp;</td>
												   <td></td>
												</tr>
											</tfoot>
                                        </table>
                                    </div>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br><br>
				<center><button type="button" class = 'btn btn-outline-primary btn-sm' onclick="loadtechnicalsanction();"><i class="fa fa-pencil"></i>Technical Sanction</button></center><br>
				<!--a onclick="loadtechnicalsanction();">Technical Sanction</a-->
				<div id ="technical" style= "display:none;">
				 <h4 class = "sub-tile">Technical Sanction :</h4> 
                 <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:10px;margin-left:5px;margin-bottom:0%">
				 <div class="col-md-12" style="margin-top:">						 
					<div class="form-group row">
					  <label class="control-label col-md-2 bol">Sanction No <span class="required">* </span></label>
						<div class="col-md-4">
							 <?php echo $this->Form->control('sanction_no', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Sanction No','data-rule-required'=>true,'data-msg-required'=>'Enter Sanction No','required']) ?>
											
						</div>
						<label class="control-label col-md-2 bol">Sanction Date <span class="required">* </span></label>
						<div class="col-md-4">
							 <?php echo $this->Form->control('sanctioned_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'select date','required','data-rule-required'=>true,'data-msg-required'=>'Select Date']) ?>
						</div>								
					</div>                             
					<div class="form-group row">
					   <label class="control-label col-md-2 bol">Sanctioned Amount <br>(in Rs.)<span class="required">*  </span></label>
						<div class="col-md-4">
								 <?php echo $this->Form->control('amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Amount','required','value'=>($tot_amount)?$tot_amount:'0.00','readonly']) ?>
							</div>
						<label class="control-label col-md-2 bol">Description <span class="required">*  </span></label>
						<div class="col-md-4">
								 <?php echo $this->Form->control('description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'type' => 'textarea', 'rows' => 3, 'required','data-rule-required'=>true,'data-msg-required'=>'Enter Description']) ?>
						</div>								
					</div>							
					<div class="form-group row">
					  <label class="control-label col-md-2 bol">File Upload. <span class="required">* <br>(upload .pdf,.jpg,.jpeg,.png) <br> (Maximum 5mb only)</span></label>
						<div class="col-md-4">
							 <?php echo $this->Form->control('detailed_estimate_upload', ['class' => 'form-control', 'type' => 'file', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onchange' => 'validdocs(this)', 'required','data-rule-required'=>true,'data-msg-required'=>'Select File Upload']); ?>
					   </div>								
					</div>							
				 </div>
			  </fieldset>
              </div>
            </div>
        </div>
		    <div class="form-group" style="padding-top: 10px;">
				<div class="offset-md-5 col-md-10">
					<?php echo $this->Form->control('completed_flag', ['label' => false, 'error' => false, 'type' => 'hidden']) ?>
					<?php if($tot_amount <= 600000){ ?>
					<button type="submit" class="btn btn-success" onclick="setvalue()">Forward to EE / Final Submit</button>
					<?php }else if($tot_amount > 600000 && $tot_amount <= 3000000){ ?>
					<button type="submit" class="btn btn-success" onclick="setvalue()">Forward to SE / Final Submit</button>
					<?php }else if($tot_amount > 3000000){ ?>
					<button type="submit" class="btn btn-success" onclick="setvalue()">Forward to CE / Final Submit</button>
					<?php } ?>
				</div>
			</div>
    </div>
</div>
<?php } ?>
 <?php echo $this->Form->End(); ?>
<div id="report" style="display:none;">
    <div class="table-responsive" id="div_vc">
        <table class="table table-striped tbl-simple table-bordered dataTable display" aria-describedby="DataTables_Table_0_info" border="1" style="border-collapse: collapse;">
            <tr>
                <td style='text-align:center' colspan="7">
                    <strong size="4">TAMILNADU POLICE HOUSING CORPORATION(TNPHC).<br />
                    </strong>
                </td>
            </tr>
			<tr class="text-center">
				<th style="width:1%">S.no</th>
				<th style="width:7%">Item code</th>
				<th style="width:50%">Item Description</th>
				<th style="width:10%">Quantity</th>
				<th style="width:10%">Unit</th>
				<th style="width:10%">Rate</th>
				<th style="width:10%">Amount</th>
			</tr>
		<tbody>
			<?php $sno = 1;
				foreach ($abstract_subdetails  as $abstract_subdetail) : ?>
				<tr class="odd gradeX">
					<td class="text-center"><?php echo $sno; ?></td>
					<td class="title"><?php echo ($abstract_subdetail['item_code'] != 0)?$abstract_subdetail['item_code']:'' ?></td>
					<td class="title"><?php echo $abstract_subdetail['item_description'] ?></td>
					<td class="title"><?php echo $abstract_subdetail['quantity'] ?></td>
					<td class="title"><?php echo $abstract_subdetail['unit']['name'] ?></td>
					<td class="title"><?php echo $abstract_subdetail['rate'] ?></td>
					<td class="title" style="text-align:right"><?php echo ($abstract_subdetail['amount'] != 0)?$abstract_subdetail['amount']:''; ?></td>					
				</tr>
			<?php $sno++;
				endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
			   <td colspan="6" style="text-align:right"><b>Total (in Rs.)</b>&nbsp;&nbsp;</td>
			   <td style="text-align:right"><b><?php echo ($tot_amount)?$tot_amount:'0.00'; ?></b>&nbsp;</td>
			</tr>
		</tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
$(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>
<script>
function hidetechnical(){
	 $('#technical').hide(); 
}
function loadtechnicalsanction(){
	 $('#technical').toggle();
	
}
function setvalue(){ 
    $('#technical').show(); 

		if(confirm('Are you sure for final submit')){		
			$('.addpage').hide();
			$('#completed-flag').val(1);
			$("#FormID").validate({
			rules: {
				'detailed_estimate_upload': {
					<?php if ($technical['detailed_estimate_upload'] != '') {   ?>
					required: false
					<?php } else {   ?>
					required: true
					<?php } ?>
				},
				'description': {
					required: true
				},
				'amount': {
					required: true
				},
				'sanctioned_date': {
					required: true
				},
				'description': {
					required: true
				},
				'sanction_no': {
					required: true
				}
			},

			messages: {
				'detailed_estimate_upload': {
					required: " Select File Upload"
				},
				'description': {
					required: "Enter Description"
				},
				'amount': {
					required: "Enter Amount"
				},
				'sanctioned_date': {
					required: "select sanctions date"
				},
				'description': {
					required: "Enter Description"
				},
				'sanction_no': {
					required: "Enter Sanction No."
				}
			},
			submitHandler: function(form) {
				  form.submit();
                  $(".btn").prop('disabled', true);				  
			}
		});            	  
	}else{
		$('#technical').hide(); 
	  return false;	
	}	

}

$("#FormID").validate({
    rules: {
        'development_work_id': {
            required: true
        }
    },
    messages: {
        'development_work_id': {
            required: "Select Development Work"
        }
    },
    submitHandler: function(form) {
        form.submit();
        $(".btn").prop('disabled', true);
    }
});

function pageadding(type) {
	var type
    var j = ($('.present_row_in_post').length);
    var row_no = j - 1;
    var code = $("#workdetail-"+row_no+"-item-description").val();
	//alert(code);
    if (code != '') {
        if (document != '' || document1 != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectdevelopmentwork/' +
                    j+'/'+type,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    $('.adding').append(data);
                }
            });
        }
    }else if (code == '') {
        alert("Select Item Code");
        $("#workdetail-"+row_no+"-building-item-id").focus();
    }
}  

function descriptionid(id,count) {
    var id;
    if (id != '') {
        $.ajax({
            async: true,
            dataType: "html",
            url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxitemcode/' + id,

            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data, textStatus) {
                var detail = JSON.parse(data);
                $('#description_'+count).val(detail.item_description);
                $('#item_code_'+count).val(detail.item_code);
            }
        });
    }
}

function userAvailability(id) {
    var p_id = <?php echo $id ?>;
    var w_id = <?php echo $work_id ?>;

    $.ajax({
        async: true,
        dataType: "html",
        url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxdevelopmentavailability/' + id + '/' +p_id + '/' + w_id,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(data, textStatus) {
            if (data == 1) {
                alert('Development work already exist');
                $('#development-work-id').val('');
            }      
        }
    });
}


function product(count) {
	var count;
    var num1 = parseFloat(document.getElementById("q_"+count).value);
    var num2 = parseFloat(document.getElementById("r_"+count).value);
	
	
	if(isNaN(num1) && isNaN(num2)){
		var n1 = 0;
		var n2 = 0;
		//alert('hi');
	}else{	
	   	//alert('hi da');
		if (!isNaN(num1)) {
		   var n1 = parseFloat(document.getElementById("q_"+count).value);
		}else{
			var n1 = 1;
		}

		if (!isNaN(num2)) {
			var n2 = parseFloat(document.getElementById("r_"+count).value);
		}else{
			var n2 = 1;
		}
	
	}	
	
    var tot = (n1*n2);
    //alert(tot);  
    if (tot >= 0) {
		if(tot > 0){
        document.getElementById("cal_total_"+count).value = tot.toFixed(2);
		}else{
		document.getElementById("cal_total_"+count).value = tot;	
		}
		calculateTotal();
    }
}

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
                        "Abstract.xls"
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
	
	function showdescription(){
		var type = $('#type').val();
		if(type == 0){
			$('.description').show();
			$('.nodescription').hide();
			$('#type').val(1);
		}else{
			$('.description').hide();
			$('.nodescription').show();
			$('#type').val(0);
			
		}	
		
	}
	
	
	function calculateTotal(){	
	 var amount = 0;
	   $(".divided_amount").each(function() {       
		   
		   if(parseFloat(this.value) != 'NAN'){
			 amount += parseFloat(this.value);
		   }			 
		});
		

		 if (!isNaN(amount)) {
		
		$('#total-amount').val(amount.toFixed(2));
		
		}else{
			
		$('#total-amount').val('');

		}		
	}
	
	function validdocs(oInput) {
    var _validFileExtensions = [".pdf", ".jpg",".jpeg",".png"];
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                    sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
            if (!blnValid) {
                alert(_validFileExtensions.join(", ") + " File Formats only Allowed");
                oInput.value = "";
                return false;
            }
        }
        var file_size = oInput.files[0].size;
        if (file_size >= 8388608) {
            alert("File Maximum size is 8MB");
            oInput.value = "";
            return false;
        }

    }
    return true;
}


 function toggledetail(){
    $('#project').toggle();

 }

$(document).ready(function() {
        var ProjectID    = <?php echo $id;  ?>;
        var ProjectSubID = <?php echo $work_id;  ?>;
        if (ProjectID !='' && ProjectSubID != '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/ProjectWorks/ajaxprojectfulldetails/' + ProjectID +'/'+ProjectSubID,
                success: function(data, textStatus) { //alert(data);
                     $('#project').html(data);
                }
            });
        } 
    });
</script>