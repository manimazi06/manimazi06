<div class="row">
                <?php echo $this->Form->create($financialyearwiseMaterialCostSubdetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Financial Yearwise Material Cost Details</header>
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->
                        <?php //if ($financialyearwiseMaterialCostSubdetailcount == 0) { ?>
                            <div class="form-group row">

                                <label class="control-label col-md-2">Financial Year<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'options' => $financial_year, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                                </div>
                                <label class="control-label col-md-2">Material Type<span class=" required"> *
                                    </span></label>
                                <div class="col-md-4">
                                    <?php echo $this->Form->control('building_material_id', ['class' => 'form-select select2', 'options' => $building_materials, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required','onchange'=>'loadmaterialDetails(this.value)']); ?>
                                </div>

                            </div>


                            <!-- </div>  -->
							<div id ="materialload">
							</div>
                            <!--div class="form-group">
                                <fieldset>
                                    <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button><br><br>
                                    <table class="table  table-bordered  order-column" style="max-width: 90%;margin-left: 2%;">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">S.no</th>                                                
                                                <th style="width:10%">Building Material</th>
                                                <th style="width:10%">Units</th>
                                                <th style="width:10%">Rate</th>
                                                <th style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="adding">
                                            <tr class="present_row_in_post">
                                                <td class="trcount">1</td>
                                              
                                                <td>
                                                    <?php echo $this->Form->control('financial.0.building_material_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $building, 'empty' => 'Select Building Material', 'required']) ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('financial.0.unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $units, 'empty' => 'Select units', 'required']) ?>

                                                </td>
                                                <td>
                                                    <?php echo $this->Form->control('financial.0.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate', 'required']) ?>

                                                </td>

                                                <td>
                                                    <input type="hidden" name="serialvalue" id="serialvalue" value="1">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div-->

                        <?php /*} elseif ($financialyearwiseMaterialCostSubdetailcount > 0) { ?>
                            <div class="form-group row">


                                <label class="control-label col-md-2">Financial Year<span class=" required"> &nbsp; :
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'options' => $financial_year, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'onblur' => 'calling(this.value)', 'error' => false, 'value' => $MaterialCostDetail['financial_year_id'], 'empty' => 'Select Financial Year']); ?>
                                    <?php echo $this->Form->control('id', ['type' => 'hidden', 'label' => false, 'error' => false, 'value' => $MaterialCostDetail['id']]); ?>

                                </div>
                                <!-- <label class="control-label col-md-2">Submit Date<span class=" required"> &nbsp; :
                                    </span></label>
                                <div class="col-md-4 lower">
                                    <?php echo $this->Form->control('financial.0.submit_date', ['class' => 'form-control datepicker', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'readonly', 'error' => false, 'placeholder' => 'Select submit Date', 'required', 'value' => date('Y-m-d', strtotime($financialyearwiseMaterialCostDetails->submit_date))]); ?>

                                </div> -->

                            </div>
                            <!-- </div> -->
                            <div class="form-group">
                                <fieldset>
                                    <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button><br><br>
                                    <table class="table  table-bordered  order-column" style="max-width: 80%;margin-left: 5%;">
                                        <thead>
                                            <tr>
                                                <th style="width:1%">S.no</th>
                                                <th style="width:10%">Building Material</th>
                                                <th style="width:10%">Units</th>
                                                <th style="width:10%">Rate</th>
                                                <th style="width:10%"></th>

                                                <th style="width:5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="adding">
                                            <?php $i = 0;
                                            foreach ($MaterialCostsubDetail as $financialyearwiseMaterialCostSubdetail) : ?>
                                                <tr class="present_row_in_post">
                                                    <td class="trcount"><?php echo  $i + 1; ?></td>

                                                    <td>
                                                        <?php echo $this->Form->control('financial.' . $i . '.building_material_id',  ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $building, 'value' => $financialyearwiseMaterialCostSubdetail->building_material_id, 'empty' => 'Select Building Material', 'required']) ?>
                                                        <?php echo $this->Form->control('id', ['type' => 'hidden', 'label' => false, 'error' => false, 'value' => $financialyearwiseMaterialCostSubdetail['id']]); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->control('financial.' . $i . '.unit_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'options' => $units, 'value' => $financialyearwiseMaterialCostSubdetail->unit_id, 'empty' => 'Select units', 'required']) ?>

                                                    </td>

                                                    <td>
                                                        <?php echo $this->Form->control('financial.' . $i . '.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'value' => $financialyearwiseMaterialCostSubdetail->rate, 'placeholder' => 'Enter rate', 'required']) ?>

                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="serialvalue" id="serialvalue" value="1">
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        <?php }*/ ?>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
	  <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
			<div class="offset-md-5 col-md-10">
				<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
				<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button>
			</div>
		</div>
		<?php echo $this->Form->End(); ?>
</div>


<script>
$("#FormID").validate({
        rules: {
            'financial_year_id': {
                required: true
            },            
            'building_material_id': {
                required: true
            }
        },
        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            },            
            'building_material_id': {
                required: "Select Material Type"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

   function loadmaterialDetails(material_id){	   
	   var financial_year_id = $('#financial-year-id').val();
	   var material_id;
	   
	         $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/FinancialyearwiseMaterialCostSubdetails/checkentrycount/'+financial_year_id+'/'+material_id,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {
                   // alert(data);
                   // $('#materialload').html(data);
				   if(data == 0){
					     $.ajax({
						async: true,
						dataType: "html",
						url: '<?php echo $this->Url->webroot ?>/tnphc/FinancialyearwiseMaterialCostSubdetails/ajaxloadmaterialdetails/'+material_id,
						beforeSend: function(xhr) {
							xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
						},
						success: function(data, textStatus) {
							//alert(data);
							$('#materialload').html(data);
						  
						}
						}); 
					   
					   
				   }else if(data == 1){
					   //$('#select2-building-material-id-container').html('');
					   $("#building-material-id").val('').trigger('change');
					   alert('Material Type Already present for this Financial Year');
					   
				   }
                  
                }
            }); 
			
			
	   
      }
   
   

    
	
function calculateAmount(val,count){
      var count;
	  var quantity = $('#material-'+count+'-quantity').val();
	  var rate     = $('#material-'+count+'-rate').val()	  
	  
	  <!-- alert(quantity); -->
	  <!-- alert(rate); -->
	  var total = parseFloat(quantity)*parseFloat(rate);
	  var tot   = parseFloat(total).toFixed(2);
	   
	 
     if(!isNaN(total)){
	   $('#material-'+count+'-amount').val(tot);
	   
	   calculateTotal();
 
     }else{		 
		  $('#material-'+count+'-amount').val(0);	
          calculateTotal();		  
	 } 	  
  }

 	  function calculateTotal(){			
			
			 var amount = 0;
			   $(".divided_amount").each(function() {
				   
				   if(parseFloat(this.value) != 'NAN'){
					 amount += parseFloat(this.value);
				   }
					 
				});
				
				//alert(amount);
				 if(!isNaN(amount)){
				
				$('#total-amount').val(amount);
				
				}else{
					
				$('#total-amount').val('');
		
				}
			
			
		}


</script>