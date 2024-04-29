<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Unit Details (Quarter's)</header>
            </div>       
            <div class="card-body">
                <div class="form-body row">
                    <?php echo $this->Form->create($projectwiseQuartersDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <fieldset>
							   <div align="right" style="margin-right:70px;">
                                <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button>
								</div><br>
                                <table class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 5%;">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">S.no</th>
                                            <th style="width:10%">Designation</th>
                                            <th style="width:10%">No of Quarters</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
                                        <tr class="present_row_in_post">
                                            <td class="trcount">1</td>
                                            <td><?php echo $this->Form->control('quarters.0.police_designation_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $policeDesignations, 'empty' => 'Select Designation', 'required','data-rule-required'=>true,'data-msg-required'=>'Select Designation']); ?>

                                            </td>
                                            <td><?php echo $this->Form->control('quarters.0.no_of_quarters', ['class' => 'form-control num divided_total', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quarters','min'=>1, 'required', 'required','data-rule-required'=>true,'data-msg-required'=>'Enter Quarters','onkeyup'=>'calculateTotal(this.value)']); ?>
                                            </td>

                                            <input type="hidden" name="serialvalue" id="serialvalue" value="1">
                                        </tr>
                                    </tbody>
								      <tfoot>
										<tr>
										   <td colspan="2" align="right"><b>Total (in Rs.)</b></td>
										   <td ><?php echo $this->Form->control('total_units', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'readonly']) ?></td>
											<td></td>
										</tr>
									</tfoot>
                                </table>
                            </fieldset>
                        </div>


                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
                                <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->End(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($projectwiseQuartersDetailcount > 0){  ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Unit Details (Quarter's)</header>
			
            </div>
            <div class="card-body ">
                <div class="mdl-tabs mdl-js-tabs">
				
                    <div class="mdl-tabs__panel is-active p-t-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">                              
                                    <div class="table-scrollable">
									     <center>
                                         <table class="table  table-bordered table-checkable order-column" style="width: 50%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>S.No</th>
                                                    <th> Designation</th>
                                                    <th >No of Quarters</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                    foreach ($projectwiseQuartersDetail_lists as $projectwiseQuartersDetail) : ?>
                                                    <tr class="odd gradeX">
                                                        <td class="text-center"><?php echo $sno; ?></td>
                                                        <td class="text-center"><?php echo $projectwiseQuartersDetail['police_designation']['name'] ?></td>
                                                        <td style="text-align:right;"><?php echo $projectwiseQuartersDetail['no_of_quarters'] ?></td>
                                                    </tr>
                                                <?php 
												  $total += $projectwiseQuartersDetail['no_of_quarters'];												
												  $sno++;
                                                  endforeach; ?>
                                            </tbody>
											<tfoot>
												<tr>
												   <td colspan="2" style="text-align:right;"><b>Total (in Rs.)</b></td>
												   <td style="text-align:right;"><?php echo $total;  ?></td>
												</tr>
											</tfoot>
                                        </table>
										</center>
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
<?php } ?>
<script>
    function pageadding() {
        var j = ($('.present_row_in_post').length);
        //alert(j);
        var row_no = j - 1;
        var designation = $("#quarters-" + row_no + "-police-designation-id").val();
        var quarters = $("#quarters-" + row_no + "-no-of-quarters").val();

        if (designation != '' && quarters != '') {

            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/ProjectwiseQuartersDetails/ajaxquarters/' +
                    j,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                    // alert(data);
                    $('.adding').append(data);
                    //  j++;
                    // $("#serialvalue").val(j);
                }
            });

        } else if (designation == '') {
            alert("Select Designation");
            $("#quarters-" + row_no + "-police-designation-id").focus();
        } else if (quarters == '') {
            alert("Enter Quarters");
            $("#quarters-" + row_no + "-no-of-quarters").focus();
        }
    }

    $("#FormID").validate({
        rules: {
            'quarters[0][police_designation_id]': {
                required: true
            },
            'quarters[0][no_of_quarters]': {
                required: true
            }
        },

        messages: {
            'quarters[0][police_designation_id]': {
                required: "Select Designations"
            },
            'quarters[0][no_of_quarters]': {
                required: "Enter Quarters"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    }); 
	
function calculateTotal(){		
 var tot = 0;
   $(".divided_total").each(function() {	   
	   if(parseFloat(this.value) != 'NAN'){
		 tot += parseFloat(this.value);
	   }		 
	});
	
	//alert(tot);
	 if(!isNaN(tot)){	
	$('#total-units').val(tot);	
	}else{		
	$('#total-units').val('');
	}		
}
</script>

