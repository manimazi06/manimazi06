<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Add Projectwise Development Work Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectwiseDevelopmentWorkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->
                        <div class="form-group row">
                            <label class="control-label col-md-4">Development Works<span class=" required"> *
                                </span></label>
                            <div class="col-md-4">
                                <?php echo $this->Form->control('development_work_id',['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'empty' => '-Select-', 'options' => $developmentWorks, 'placeholder' => 'select development','onchange'=>'userAvailability(this.value)','required']); ?>
                            </div>
                         </div>
                         <!-- </div> -->
                         <div class="form-group">
                            <fieldset>                             
                                <table class="table  table-bordered  order-column" style="max-width:100%;margin-right:1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:9%">Item code</th>
                                            <th style="width:15%">Item Description</th>
                                            <th style="width:10%">Number1</th>
                                            <th style="width:10%">Number2</th>
                                            <th style="width:10%">Length</th>
                                            <th style="width:10%">Breath</th>
                                            <th style="width:10%">Depth</th>
                                            <th style="width:10%">Quantity</th>
                                            <th style="width:10%"> <button type="button" class="btn btn-success btn-xs" onclick="pageadding();"><i class="fa fa-plus-circle"></i>Add More</button></th>
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
                                        <tr class="present_row_in_post">
                                            <td class="trcount">1</td>
                                            <td>
                                                <?php echo $this->Form->control('workdetail.0.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code', 'options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,0)','data-rule-required'=>true,'data-msg-required'=>'Select Item Code']); ?>
                                                <?php echo $this->Form->control('workdetail.0.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'required', 'type' => 'hidden','id'=>'item_code_0']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 3,'id'=>'description_0', 'readonly']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.number_1', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Number1','id'=>'n1_0','onkeyup'=>"Sum(0)",'data-rule-required'=>true,'data-msg-required'=>'Enter Number1']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.number_2', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Number2','id'=>'n2_0','onkeyup'=>"Sum(0)",'data-rule-required'=>true,'data-msg-required'=>'Enter Number2']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.length', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Length','id'=>'length_0','onkeyup'=>"Sum(0)",'data-rule-required'=>true,'data-msg-required'=>'Enter Length']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.breath', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Breath','id'=>'breath_0','onkeyup'=>"Sum(0)",'data-rule-required'=>true,'data-msg-required'=>'Enter Breath']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.depth', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Depth','id'=>'depth_0','onkeyup'=>"Sum(0)",'data-rule-required'=>true,'data-msg-required'=>'Enter Depth']); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.0.quantity', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','id'=>'cal_total_0', 'readonly']); ?>
                                            </td>
                                            <td>
											</td>  
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div class="form-group" style="padding-top: 10px;margin-bottom: -20px;">
                            <div class="offset-md-5 col-md-10">
                                <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn btn-primary m-r-20">Submit</button>
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
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Projectwise Development Work Details</header>
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
                                                    <th> Sno </th>
                                                    <th> Name </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                    foreach ($projectdevelopment  as $department) : ?>
													<tr class="odd gradeX">
														<td class="text-center"><?php echo $sno; ?></td>
														<td class="title"><?php echo $department['development_work']['name'] ?></td>
														<td class="text-center">
															<?php echo $this->Html->link(__('<i class="fa fa-eye"></i> view'), ['action' => 'projectwisedevelopmentworkview',$id,$work_id,$department['development_work_id']], ['escape' => false, 'class' => 'btn btn-outline-success btn-sm','target'=>'_blank']); ?>&nbsp;&nbsp;&nbsp;
															<?php echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'projectwisedevelopmentworkedit',$id,$work_id,$department['development_work_id']], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm','target'=>'_blank']); ?>
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

function pageadding() {
    var j = ($('.present_row_in_post').length);
    var row_no = j - 1;
    var code = $("#workdetail-"+row_no+"-building-item-id").val();
    if (code != '') {
        if (document != '' || document1 != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdevelopwork/' +
                    j,
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
            url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxitemcode/' + id,

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
        url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdevelopmentavailability/' + id + '/' +p_id + '/' + w_id,
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

function Sum(count) {
	var count;
    var num1 = parseInt(document.getElementById("n1_"+count).value);
    var num2 = parseInt(document.getElementById("n2_"+count).value);
    var len  = parseInt(document.getElementById("length_"+count).value);
    var bre  = parseInt(document.getElementById("breath_"+count).value);
    var dep  = parseInt(document.getElementById("depth_"+count).value);
	
	if (!isNaN(num1)) {
       var n1 = parseInt(document.getElementById("n1_"+count).value);
    }else{
        var n1 = 1;
    }

    if (!isNaN(num2)) {
        var n2 = parseInt(document.getElementById("n2_"+count).value);
    }else{
        var n2 = 1;
    }

    if (!isNaN(len)) {
       var n3  = parseInt(document.getElementById("length_"+count).value);
    }else{
        var n3 = 1;
    }
	
	if (!isNaN(bre)) {
        var n4  = parseInt(document.getElementById("breath_"+count).value);
    }else{
        var n4 = 1;
    }
	
	
	if (!isNaN(dep)) {
       var n5  = parseInt(document.getElementById("depth_"+count).value);
    }else{
        var n5 = 1;
    }
	

    var tot = (n1*n2*n3*n4*n5);
    //alert(tot);
    if (tot > 0) {
        document.getElementById("cal_total_"+count).value = tot;
    }
}
</script>