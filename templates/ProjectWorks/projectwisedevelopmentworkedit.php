<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>Edit Projectwise Development Work Details</header>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($projectwiseDevelopmentWorkDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
                <div class="col-md-12">
                    <div class="form-body row">
                        <!-- <div class="col-md-12"> -->
                         <div class="form-group row">
                            <label class="control-label col-md-4">Development Works<span class=" required"> &nbsp;&nbsp;:
                                </span></label>
                            <div class="col-md-4 lower">
                                          <?php echo $DevelopmentWorkDetail['development_work']['name']; ?>
										  <?php echo $this->Form->control('main_id', ['label' => false, 'error' => false, 'type' => 'hidden','value'=>$DevelopmentWorkDetail['id']]); ?>

                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="form-group">
                            <fieldset>

                                <table class="table  table-bordered  order-column"
                                    style="max-width: 98%;margin-right: 1%;">
                                    <thead>
                                        <tr>
                                            <th style="width:1%">S.no</th>
                                            <th style="width:10%">Item code</th>
                                            <th style="width:10%">Item Description</th>
                                            <th style="width:10%">Number1</th>
                                            <th style="width:10%">Number2</th>
                                            <th style="width:10%">Length</th>
                                            <th style="width:10%">Breath</th>
                                            <th style="width:10%">Depth</th>
                                            <th style="width:10%">Quantity</th>
                                            <th style="width:10%"> <button type="button" class="btn btn-success btn-xs"
                                                    onclick="pageadding();">
                                                    <i class="fa fa-plus-circle"></i>Add More</button></th>
                                        </tr>
                                    </thead>
                                    <tbody class="adding">
                                        <?php        // echo"<pre>";print_r($DevelopmentWorkSubdetails);exit();

                                                   $i= 0;
                                            foreach ($DevelopmentWorkSubdetails as $key => $works){ ?>
                                        <tr class="present_row_in_post">
                                            <td><?php echo $i + 1; ?></td>

                                            <td>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.building_item_id', ['class' => 'form-control select2', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Item Code','options' => $buildingItems, 'empty' => '-Select-', 'onchange' => 'descriptionid(this.value,'.$key.')','data-rule-required'=>true,'data-msg-required'=>'Select Item Code','value'=>$works['building_item_id']]); ?>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.item_code', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'hidden','id'=>'item_code_'.$key.'','value'=>$works['item_code']]); ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.item_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Description', 'rows' => 3, 'required','id'=>'description_'.$key.'','value'=>$works['item_description']]); ?>
                                                <?php echo $this->Form->control('workdetail.'.$key.'.id', ['label' => false, 'error' => false, 'type' => 'hidden','value'=>$works['id']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.number_1', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Number1', 'onkeyup'=>"Sum(".$key.")",'required','id'=>'n1_'.$key.'','data-rule-required'=>true,'data-msg-required'=>'Enter Number1','value'=>$works['number_1']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.number_2', ['class' => 'form-control num', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Number2','onkeyup'=>"Sum(".$key.")",'required','id'=>'n2_'.$key.'','data-rule-required'=>true,'data-msg-required'=>'Enter Number2','value'=>$works['number_2']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.length', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Length', 'onkeyup'=>"Sum(".$key.")",'id'=>'length_'.$key.'','data-rule-required'=>true,'data-msg-required'=>'Enter Length','value'=>$works['length']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.breath', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Breath', 'onkeyup'=>"Sum(".$key.")",'id'=>'breath_'.$key.'','data-rule-required'=>true,'data-msg-required'=>'Enter Breath','value'=>$works['breath']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.depth', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Depth','onkeyup'=>"Sum(".$key.")",'id'=>'depth_'.$key.'', 'data-rule-required'=>true,'data-msg-required'=>'Enter Depth','value'=>$works['depth']]); ?>
                                            </td>
                                            <td><?php echo $this->Form->control('workdetail.'.$key.'.quantity', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' => 'Enter Quantity','id'=>'cal_total_'.$key.'','readonly','value'=>$works['quantity']]); ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <?php $i++;
                                           } ?>
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
    // alert(j);
    var row_no = j - 1;
    // var file = $("#technical-" + serial_id + "-detailed-estimate-upload").val();
    var ref_no = $("#financial-" + row_no + "-fs-ref-no").val();

    if (ref_no != '') {
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
        } else if (ref_no == '') {
            alert("Enter Question");
            $("#financial-" + row_no + "-fs-ref-no").focus();
        }
    }
}

function descriptionid(id,count) {
    // alert(id);
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
                //  alert(data);
                var detail = JSON.parse(data);
                $('#description_'+ count).val(detail.item_description);
                $('#item_code_'+ count).val(detail.item_code);

            }
        });
    }
}

function userAvailability(id) {
    // alert(id); // alert(w_id);
    var p_id = <?php echo $id ?>;
    var w_id = <?php echo $work_id ?>;

    $.ajax({
        async: true,
        dataType: "html",
        url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdevelopmentavailability/' + id + '/' +
            p_id + '/' + w_id,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
        },
        success: function(data, textStatus) {
            if (data == 1) {
                alert('already exist');
                $('#development-work-id').val('');
            }

        }
    });

}

function Sum(count) {
    var num1 = parseInt(document.getElementById("n1_" + count).value);
    var num2 = parseInt(document.getElementById("n2_" + count).value);
    var num3 = parseInt(document.getElementById("length_" + count).value);
    var num4 = parseInt(document.getElementById("breath_" + count).value);
    var num5 = parseInt(document.getElementById("depth_" + count).value);


    if (!isNaN(num1)) {
        var n1 = parseInt(document.getElementById("n1_" + count).value);

    } else {
        var n1 = 1;
    }

    if (!isNaN(num2)) {
        var n2 = parseInt(document.getElementById("n2_" + count).value);

    } else {
        var n2 = 1;
    }

    if (!isNaN(num3)) {
        var n3 = parseInt(document.getElementById("length_" + count).value);

    } else {
        var n3 = 1;
    }
    if (!isNaN(num4)) {
        var n4 = parseInt(document.getElementById("breath_" + count).value);

    } else {
        var n4 = 1;
    }
    if (!isNaN(num5)) {
        var n5 = parseInt(document.getElementById("depth_" + count).value);

    } else {
        var n5 = 1;
    }

    var tot = (n1 * n2 * n3 * n4 * n5);

    if (tot > 0) {
        document.getElementById("cal_total_" + count).value = tot;
    }
}
</script>