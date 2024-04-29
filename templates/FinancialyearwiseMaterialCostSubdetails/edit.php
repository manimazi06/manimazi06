<div class="row">
                <?php echo $this->Form->create($financialyearwiseMaterialCostSubdetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit Financial Yearwise Material Cost Details</header>
            </div>
            <div class="card-body">
                <div class="col-md-12 ">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->
                        <?php //if ($financialyearwiseMaterialCostSubdetailcount == 0) { ?>
						<div class="card-body"> 
							<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:1%;background-color:ghostwhite;padding:15px;">

                            <div class="form-group row">

                                <label class="control-label col-md-2">Financial Year<span class=" required"> &nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
								    <?php echo $MaterialCostDetail['financial_year']['name']; ?>
                                    <?php echo $this->Form->control('main_id', ['label' => false, 'error' => false, 'type' => 'hidden', 'value'=>$MaterialCostDetail['id']]); ?>
                                </div>
                                <label class="control-label col-md-2">Material Type<span class=" required"> &nbsp;&nbsp;:
                                    </span></label>
                                <div class="col-md-4 lower">
								  <?php echo $MaterialCostDetail['building_material']['name']; ?>
                                    <?php //echo $this->Form->control('building_material_id', ['class' => 'form-select select2', 'options' => $building_materials, 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required','onchange'=>'loadmaterialDetails(this.value)']); ?>
                                </div>

                            </div>
							</fieldset>
							</div>		


                           <?php if($material_Detail_count > 0){ ?>

							<div class="card-body"> 
							<br>
							 <legend class="bol" style="color: #0047AB; text-align: center;">Material Sub Types
							 </legend>
							 <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 98%;margin-left: 2%;" bgcolor="white">
								 <thead>
									 <tr align="center">
										 <th style="width:5%"> S.No</th>
										 <th style="width:10%">Sub Type </th>
										 <th style="width:10%">Quantity</th>
										 <th style="width:10%">Rate</th>
										 <th style="width:10%">PER</th>  
										 <th style="width:10%">Amount</th>
									 </tr>
								 </thead>
								 <tbody class="add_doc">											 
									 <?php  $i = 0;  foreach ($material_Details as $key => $material_Detatil): ?>								 
									  <tr align="center">
										 <td class="trcount"><?php echo $i + 1; ?></td>
										 <td><?php echo $material_Detatil['subtype']; ?></td>
										 <td><?php echo $material_Detatil['quantity']; ?></td>                                 
										 <td><?php echo $this->Form->control('material.' . $key . '.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Rate', 'required','onkeyup'=>'calculateAmount(this.value,'.$key.')', 'value'=>$material_Detatil['rate']]); ?></td>                                 
											 <?php echo $this->Form->control('material.' . $key . '.building_material_detail_id', ['type'=>'hidden','label' => false, 'error' => false, 'value'=>$material_Detatil['id']]); ?>                               
											 <?php echo $this->Form->control('material.' . $key . '.quantity', ['type'=>'hidden','label' => false, 'error' => false, 'value'=>$material_Detatil['quantity']]); ?>                               
											 <?php echo $this->Form->control('material.' . $key . '.id', ['type'=>'hidden','label' => false, 'error' => false, 'value'=>$material_Detatil['id']]); ?>                               
										<td><?php echo $material_Detatil['name_code']; ?></td>       
										<td><?php echo $this->Form->control('material.' . $key . '.amount', ['class' => 'form-control divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount', 'readonly','value'=>0, 'value'=>$material_Detatil['amount']]); ?></td>                                 
									 </tr>
									 <?php $i++;   endforeach; ?>
								 </tbody>
								 
								 <tfoot>
									  <tr>
										 <th colspan="5" style="text-align:right">Total</th>
										 <th style="width:10%"><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Total', 'readonly','value'=>$tot_amount]); ?>                             
										 </th>
									 </tr>
								 
								 </tfoot>
								 
								 </table>
							</div>
							<?php } ?>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
	  <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
			<div class="offset-md-5 col-md-10">
				<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
				<!--button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default" onclick="javascript:history.back()">Cancel</button-->
			</div>
		</div>
		<?php echo $this->Form->End(); ?>
</div>


<script>  
	
   function calculateAmount(val,count){
      var count;
	  var quantity = $('#material-'+count+'-quantity').val();
	  var rate     = $('#material-'+count+'-rate').val()	  
	  
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