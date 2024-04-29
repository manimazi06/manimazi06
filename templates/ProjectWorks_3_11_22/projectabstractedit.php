<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit Project Abstract Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectDevelopmentWorkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                         <div class="form-group">
                            <fieldset>                             
                                <table class="table  table-bordered  order-column" style="max-width:100%;margin-right:1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:7%">Item code</th>
                                            <th style="width:25%">Item Description</th>
											<th style="width:10%">Quantity</th>
                                            <th style="width:10%">Rate</th>
                                            <th style="width:10%">Amount</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
									<?php $i= 0; foreach($abstract_subdetails as $key => $abstract){ ?>
                                        <tr class="present_row_in_post">
                                            <td class="trcount">1</td>
											<?php if($abstract['building_item_id'] != 0){  ?>
                                            <td>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,0)','data-rule-required'=>true,'data-msg-required'=>'Select Item Code','value'=>$abstract['building_item_id']]); ?>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_code_0','value'=>$abstract['item_code']]); ?>
                                            </td>
											<?php }else{ ?>
											<td></td>
											<?php } ?>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 4,'id'=>'description_0', 'readonly','value'=>$abstract['item_description']]); ?>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_id_0','value'=>$abstract['id']]); ?>
                                            </td>
											<td><?php echo $this->Form->control('workdetail.'.$key.'.quantity', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','id'=>'q_0','onkeyup'=>"product(0)",'data-rule-required'=>false,'data-msg-required'=>'Enter Quantity','value'=>$abstract['quantity']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.rate', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter rate','id'=>'r_0','onkeyup'=>"product(0)",'data-rule-required'=>false,'data-msg-required'=>'Enter Rate','value'=>$abstract['rate']]); ?>
                                            </td>                                            
                                            <td>
											<?php echo $this->Form->control('workdetail.'.$key.'.amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Amount','id'=>'cal_total_0', 'readonly','value'=>$abstract['amount']]); ?>
                                            </td>
                                            
                                        </tr>
									<?php  $i++; } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Update</button>
                                <button type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-default"
                                    onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                        <?php echo $this->Form->End(); ?>
                    </div>
                </div>
            </div>
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

<script type="text/javascript">
$(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button
</script>
<script>

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

function product(count) {
	var count;
    var num1 = parseFloat(document.getElementById("q_"+count).value);
    var num2 = parseFloat(document.getElementById("r_"+count).value);
    // alert(num1);
    // alert(num2);
	
	
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


    var tot = (n1*n2);
    //alert(tot);  
    if (tot > 0) {
        document.getElementById("cal_total_"+count).value = tot.toFixed(2);
    }
}
</script>