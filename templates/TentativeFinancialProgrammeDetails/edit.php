
<div class="col-md-12">
    <?php echo $this->Form->create($tentativeFinancialProgrammeDetail, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Edit Tentative Financial Programme Detail</header>
        </div>
        <div class="card-body">
            <div class="col-md-10" offset="2">
                <div class="form-body row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="control-label col-md-6">Financial Year</label>
                            <div class="col-md-4 lower">
                                <?php echo  ":&nbsp;&nbsp;".$tentativeFinancialProgrammeDetail->financial_year->name;?>
                                <?php echo $this->Form->control('financial_year_id', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false,'type'=>'hidden']); ?>
                            </div>
                        </div><br>
                        <center>
                            <table class="table table-bordered order-column" style="width: 60%">
                                <thead>
                                    <tr class="text-center">
                                        <th width="10%"> Sno </th>
                                        <th width="10%">Month</th>
                                        <th width="15%">Tentative Amount in(laksh) </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sno = 1; { ?>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "1"; ?></td>
                                            <td class="title"> April </td>
                                            <td class="title"><?php echo $this->Form->control('apr', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter April Amount', 'onkeyup' => "sum(this.value)",'id' => 'april','required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "2"; ?></td>
                                            <td class="title">May </td>
                                            <td class="title"><?php echo $this->Form->control('may', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter May Amount', 'onkeyup' => "sum(this.value)", 'id' => 'May', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "3"; ?></td>
                                            <td class="title">June </td>
                                            <td class="title"><?php echo $this->Form->control('june', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter June Amount', 'onkeyup' => "sum(this.value)", 'id' => 'june', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "4"; ?></td>
                                            <td class="title">July </td>
                                            <td class="title"><?php echo $this->Form->control('july', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter July Amount', 'onkeyup' => "sum(this.value)", 'id' => 'july', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "5"; ?></td>
                                            <td class="title">August </td>
                                            <td class="title"><?php echo $this->Form->control('aug', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter August Amount', 'onkeyup' => "sum(this.value)", 'id' => 'auge', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "6"; ?></td>
                                            <td class="title">september</td>
                                            <td class="title"><?php echo $this->Form->control('sep', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter September  Amount', 'onkeyup' => "sum(this.value)", 'id' => 'sep', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "7"; ?></td>
                                            <td class="title">october</td>
                                            <td class="title"><?php echo $this->Form->control('oct', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter october  Amount', 'onkeyup' => "sum(this.value)", 'id' => 'oct', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "8"; ?></td>
                                            <td class="title">November</td>
                                            <td class="title"><?php echo $this->Form->control('nov', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter November  Amount', 'onkeyup' => "sum(this.value)", 'id' => 'nov', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "9"; ?></td>
                                            <td class="title">December</td>
                                            <td class="title"><?php echo $this->Form->control('dece', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter December Amount', 'onkeyup' => "sum(this.value)", 'id' => 'dec', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "10"; ?></td>
                                            <td class="title">January</td>
                                            <td class="title"><?php echo $this->Form->control('jan', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter January Amount', 'onkeyup' => "sum(this.value)", 'id' => 'jan', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "11"; ?></td>
                                            <td class="title">February</td>
                                            <td class="title"><?php echo $this->Form->control('feb', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter February Amount', 'onkeyup' => "sum(this.value)", 'id' => 'feb', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "12"; ?></td>
                                            <td class="title">March</td>
                                            <td class="title"><?php echo $this->Form->control('mar', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Enter March Amount', 'onkeyup' => "sum(this.value)", 'id' => 'mar', 'required']); ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"></td>
                                            <td class="title">Total Amount</td>
                                            <td class="title"><?php echo $this->Form->control('total_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'min' => 1, 'maxlength' => 13, 'placeholder' => 'Total Amount', 'id' => 'cal_total', 'readonly', 'required']); ?> </td>
                                        </tr>
                                    <?php $sno++;
                                    } ?>
                                </tbody>
                            </table>
                        </center>

                        <div class="form-group" style="padding-top: 10px;">
                            <div class="offset-md-6 col-md-10">
                                <button type="submit" class="btn btn-info m-r-20 sub">Submit</button>
                                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            'apr': {
                required: true
            },
            'may': {
                required: true
            },
            'june': {
                required: true
            },
            'july': {
                required: true
            },
            'aug': {
                required: true
            },
            'sep': {
                required: true
            },
            'oct': {
                required: true
            },
            'nov': {
                required: true
            },
            'dece': {
                required: true
            },
            'jan': {
                required: true
            },
            'mar': {
                required: true
            },
            'total_amount': {
                required: true
            }
        },

        messages: {
            'financial_year_id': {
                required: "Select Financial Year"
            },
            'apr': {
                required: "Enter April Amount"
            },
            'may': {
                required: "Enter May Amount"
            },
            'june': {
                required: "Enter June Amount"
            },
            'july': {
                required: "Enter July Amount"
            },
            'aug': {
                required: "Enter August Amount"
            },
            'sep': {
                required: "Enter September Amount"
            },
            'oct': {
                required: "Enter october Amount"
            },
            'nov': {
                required: "Enter November  Amount"
            },
            'jan': {
                required: "Enter January Amount"
            },
            'feb': {
                required: "Enter February Amount"
            },
            'mar': {
                required: "Enter March Amount"
            },
            'total_amount': {
                required: "Total Amount"
            }
        },
        submitHandler: function(form) {
            form.submit();
            $(".btn").prop('disabled', true);
        }
    });

    function sum(count) {
        // alert(count);
        var aprnum = parseFloat(document.getElementById("april").value);
        var maynum = parseFloat(document.getElementById("May").value);
        var junenum = parseFloat(document.getElementById("june").value);
        var julynum = parseFloat(document.getElementById("july").value);
        var augenum = parseFloat(document.getElementById("auge").value);
        var sepnum = parseFloat(document.getElementById("sep").value);
        var octnum = parseFloat(document.getElementById("oct").value);
        var novnum = parseFloat(document.getElementById("nov").value);
        var decnum = parseFloat(document.getElementById("dec").value);
        var jannum = parseFloat(document.getElementById("jan").value);
        var febnum = parseFloat(document.getElementById("feb").value);
        var marnum = parseFloat(document.getElementById("mar").value);

  

        if (!isNaN(aprnum)) {
            // alert(aprnum);
            var aprnum = parseFloat(document.getElementById("april").value);
        } else {
            var aprnum = 0;
        }
        if (!isNaN(maynum)) {
            var maynum = parseFloat(document.getElementById("May").value);
        } else {
            var maynum = 0;
        }
        if (!isNaN(junenum)) {
            var junenum = parseFloat(document.getElementById("june").value);
        } else {
            var junenum = 0;
        }
        if (!isNaN(julynum)) {
            var julynum = parseFloat(document.getElementById("july").value);
        } else {
            var julynum = 0;
        }
        if (!isNaN(augenum)) {

            var augenum = parseFloat(document.getElementById("auge").value);
        } else {
            var augenum = 0;
        }
        if (!isNaN(sepnum)) {
            var sepnum = parseFloat(document.getElementById("sep").value);
        } else {
            var sepnum = 0;
        }
        if (!isNaN(octnum)) {
            var octnum = parseFloat(document.getElementById("oct").value);
        } else {
            var octnum = 0;
        }
        if (!isNaN(novnum)) {
            var novnum = parseFloat(document.getElementById("nov").value);

        } else {
            var novnum = 0;
        }
        if (!isNaN(decnum)) {
            var decnum = parseFloat(document.getElementById("dec").value);
        } else {
            var decnum = 0;
        }
        if (!isNaN(jannum)) {
            var jannum = parseFloat(document.getElementById("jan").value);
        } else {
            var jannum = 0;
        }
        if (!isNaN(febnum)) {
            var febnum = parseFloat(document.getElementById("feb").value);
        } else {
            var febnum = 0;
        }
        if (!isNaN(marnum)) {
            var marnum = parseFloat(document.getElementById("mar").value);
        } else {
            var marnum = 0;
        }

         var tot = (aprnum+maynum+junenum+julynum+augenum+sepnum+octnum+novnum+decnum+jannum+febnum+marnum);
      

        if (tot > 0) {
            document.getElementById("cal_total").value = tot.toFixed(2);
        }

    }

   
</script>
