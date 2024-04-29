<?php echo $this->Form->create($projectWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>Edit Project Work</header>
        </div>
        <div class="card-body" style="margin-top:20px ;"> 
		<div class="col-md-12">
            <div class="form-body row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="control-label col-md-2">Project Name <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('project_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3, 'required']); ?>
                        </div>
                        <label class="control-label col-md-2">Project Description</label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('project_description', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows' => 3]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2">Departments <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('department_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $departments, 'label' => false, 'error' => false, 'empty' => 'Select Department', 'required']); ?>
                        </div>
                        <label class="control-label col-md-2">Financial Year <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('financial_year_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $financialYears, 'label' => false, 'error' => false, 'empty' => 'Select Financial Year', 'required']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2">Building Type <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('building_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $buildingTypes, 'label' => false, 'error' => false, 'empty' => 'Select Building Type', 'required']); ?>
                        </div>
                        <label class="control-label col-md-2">Scheme Type <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('scheme_type_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $schemeTypes, 'label' => false, 'error' => false, 'empty' => 'Select Scheme Type', 'required']); ?>
                        </div>
                    </div>
					 <div class="form-group row">
							<label class="control-label col-md-2">Coastal Area <span class="required"> *
								</span></label>
							<div class="col-md-4 ">
								<?php echo $this->Form->control('coastal_area', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => ['1' => 'Yes', '2' => 'No'], 'label' => false, 'error' => false, 'empty' => 'Select Coastal Area', 'required','id'=>'coastal']); ?>
							</div>
							<label class="control-label col-md-2 ">Rough Cost (in Rs.)<span class="required"> * </span></label>
							<div class="col-md-4">
								<?php echo $this->Form->control('project_amount', ['class' => 'form-control amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'text', 'required','id'=>'project_cost','value'=>number_format((float)$projectWork['project_amount'], 2, '.', '')]); ?>
							</div>
                        </div>

                    <div class="form-group row">
                        <label class="control-label col-md-2">Proposal Upload <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('file_upload', ['class' => 'form-control num', 'label' => false, 'error' => true, 'type' => 'file', 'accept' => '.pdf,.jpg,.png,.jpeg', 'onchange' => 'validdocs(this)']); ?>

                            <?php if ($projectWork['file_upload'] != '') {  ?>
                            <?php echo $this->Form->control('file_upload1', ['type' => 'hidden', 'value' => $projectWork['file_upload']]); ?>

                            <a style="color:blue;"
                                href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>"
                                target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a>
                            <?php  } ?>
                        </div>
                        <!--label class="control-label col-md-2">Project Statuses <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('ce_approved', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'],'empty' => 'select project Status', 'options' => $statusproject, 'label' => false, 'error' => false, 'required', 'onchange' => 'projecttype(this.value)']); ?>
                        </div-->
                    </div>                   
            
					
                        
                          <legend class="bol" style="color: #0047AB; text-align: center;">Division Wise Work Details</legend>
						  <div align="right" style="margin-bottom:8px;margin-right:5px;">
							  <button type="button" class="btn btn-success btn-xs" onclick="getaddempdoc();"><i class="fa fa-plus-circle"></i> Add
												More</button>
							</div>
						<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:15px;margin-left:5px;margin-bottom:1%">
						 <div class="form-group">
                                <fieldset>
                                    <table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
                                        <thead>
                                            <tr align="center">
                                                <th style="width:1%"> S.No</th>
                                                <th style="width:18%">Work Name</th>
                                                <th style="width:15%">District</th>
                                                <th style="width:15%">Division</th>
											    <th style="width:15%">Circle</th>
                                                <th style="width:12%">Rough Cost (in Rs.)</th>
                                                <th style="width:8%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_doc">
										 <?php
                                            $i = 0;
                                            foreach ($projectWorkSubdetails as $key => $projectWorkSubdetail){ ?>
                                            <tr class="present_row row_<?php echo $key;  ?>">
                                                <td class="trcount"><?php echo $i+1; ?></td>
												 <td>
												  <?php echo $this->Form->control('project.'.$key.'.work_name', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => true, 'type' => 'textarea','rows'=>3,'data-rule-required'=>true,'data-msg-required'=>'Enter Work Name','value'=>$projectWorkSubdetail['work_name']]) ?>
												  <?php echo $this->Form->control('project.'.$key.'.is_active', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => true, 'type' => 'hidden','value'=>$projectWorkSubdetail['is_active'],'id'=>'is_active_'.$key.'']) ?>
											   </td>
												<td>
												   <?php echo $this->Form->control('project.'.$key.'.district_id', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $districts, 'label' => false, 'error' => true, 'empty' => 'Select District','onchange'=>'loadcircle(this.value,0)','data-rule-required'=>true,'data-msg-required'=>'Select District','value'=>$projectWorkSubdetail['district_id']]) ?>
                                                   <?php echo $this->Form->control('project.'.$key.'.id', ['label' => false, 'error' => false, 'type' => 'hidden','value'=>$projectWorkSubdetail['id']]) ?>
											   </td>
											  
                                                <td>
												  <?php echo $this->Form->control('project.'.$key.'.division_id1', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $divisions, 'label' => false, 'error' => true, 'empty' => 'Select Division','disabled','value'=>$projectWorkSubdetail['division_id']]) ?>
											      <?php echo $this->Form->control('project.'.$key.'.division_id', ['type'=>'hidden', 'label' => false, 'error' => true,'value'=>$projectWorkSubdetail['division_id']]) ?>
											   </td>
                                                <td>
												<?php echo $this->Form->control('project.'.$key.'.circle_id1', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'], 'options' => $circles, 'label' => false, 'error' => true, 'empty' => 'Select Circle','disabled','value'=>$projectWorkSubdetail['circle_id']]) ?>
												<?php echo $this->Form->control('project.'.$key.'.circle_id', ['type'=>'hidden', 'label' => false, 'error' => true,'value'=>$projectWorkSubdetail['circle_id']]) ?>
                                               </td>                                   
                                               <td><?php echo $this->Form->control('project.'.$key.'.rough_cost', ['class' => 'form-control amount divided_amount', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Rough Cost','min'=>1,'maxlength'=>13,'onkeyup'=>'calculateTotal()','data-rule-required'=>true,'data-msg-required'=>'Enter Cost','value'=>number_format((float)$projectWorkSubdetail['rough_cost'], 2, '.', '')]) ?>
                                               </td>                                                                                      
                                               <td>
											        <?php if ($key != 0) { ?>
														<button type="button" class="btn btn-outline-danger btn-sm" id="delete_<?php echo $key;  ?>" onclick="deleterow(<?php echo $key; ?>)">
															<i class="fas fa-minus-circle"></i> Delete
														</button>  
														<span id="deleted_<?php echo $key; ?>" style="display:none;"><span style="color:red;"><i class="fas fa-minus-circle"></i> Deleted</span></span>
													<?php } ?>
												
                                               </td>                                               
                                            </tr>
											<?php 
											 $rough_cost += $projectWorkSubdetail['rough_cost'];
											
											$i++; } ?>
                                        </tbody>
										<tfoot>
										    <tr>
											   <td colspan="5" align="right"><b>Total</b></td>
											   <td><?php echo $this->Form->control('total_amount', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'placeholder' =>'Total Amount','readonly','value'=>number_format((float)$rough_cost, 2, '.', '')]) ?></td>
										       <td></td>
											</tr>
										</tfoot>
                                    </table>
                                </fieldset>                     
                            </div>
						</fieldset>	

                    <div class="form-group" style="padding-top: 10px;">
                        <div class="offset-md-5 col-md-10">
                            <button type="submit" class="btn btn-info m-r-20">Submit</button>
                            <button type="button" class="btn btn-default"
                                onclick="javascript:history.back()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->End(); ?>



<script>
// $('.datepicker1').flatpickr({
// dateFormat: "d-m-Y",
// allowInput: false
// });

$("#FormID").validate({
    rules: {
        'department_type': {
            required: true
        },
        'department_id': {
            required: true
        },
        'financial_year_id': {
            required: true
        },
        'project_status_id': {
            required: true
        },
        'coastal_area': {
            required: true
        },
        'project_name': {
            required: true
        },
        'project_amount': {
            required: true
        },
        'file_upload': {
            required: false
        },
        'remarks': {
            required: true
        },
       'building_type_id': {
            required: true
        },       
        'project_description': {
            required: true
        },
		'scheme_type_id': {
			required: true
		}
    },

    messages: {
        'department_type': {
            required: "Select Department type"
        },
        'department_id': {
            required: "Select Department"
        },
        'financial_year_id': {
            required: "Select Financial Year"
        },
        'project_status_id': {
            required: "Select Project status"
        },
        
        'coastal_area': {
            required: "Select Coastal Area"
        },
        'project_name': {
            required: "Enter Project Name"
        },
        'project_amount': {
            required: "Enter Rough Cost"
        },
        'file_upload': {
            required: "Select Document"
        },
        'remarks': {
            required: "Enter remarks"
        },
       
        'building_type_id': {
            required: "Select Building Type"
        },      
        'project_description': {
            required: "Enter Project Description"
        },
		'scheme_type_id': {
			required: "Select Scheme Type"
		}
    },
    submitHandler: function(form) {
         var rough_cost = $('#project_cost').val();
		   
		   var amount = 0;
		   $(".divided_amount").each(function() {
				 amount += parseFloat(this.value);
			});
		     // alert(rough_cost);
		     // alert(amount);  
			 // exit();  
		   if(parseFloat(rough_cost) == parseFloat(amount)){
		    form.submit();
            $(".btn").prop('disabled', true);			
		   }else{			   
			   alert('Total Sum of Divided Amount should be equal to Rough Cost');
			    return false;			   
		   }
    }
});


function loaddepartment(id) {
    var id;
    if (id == 1) {
        $('#department-id').val('');
        $('.department').hide();
    } else if (id == 2) {
        $('.department').show();
    }


}

function projecttype(id) {
    if( id == 0){
        $('.project_cost').hide();
        $('.coastal').hide();
        $('.remarks').hide();
        $('#project_cost').val('');
        $('#coastal').val('');
        $('#remarks').val('');
    }
    if (id == 1) {
        // alert(id);
        
        $('.project_cost').show();
        $('.coastal').show();
        $('.remarks').hide();
        $('#remarks').val('');
    }else if(id == 2){
        $('.remarks').show();
        $('.project_cost').hide();
        $('#project_cost').val('');
        $('.coastal').hide();
        $('#coastal').val('');
    }

}

function validdocs(oInput) {
    var _validFileExtensions = [".pdf", ".jpg", ".jpeg", ".png"];
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
                //alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
        var file_size = oInput.files[0].size;
        if (file_size >= 5242880) {
            alert("File Maximum size is 5MB");
            oInput.value = "";
            return false;
        }

    }
    return true;
}


$(document).ready(function() {
    $('#district').on('change', function() {
        var distID = $(this).val();
        if (distID) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->webroot ?>/tnphc_staging/ProjectWorks/ajaxdivisions/' +
                    distID,
                success: function(data, textStatus) {
                    // alert(data)
                    $('#division').html(data);
                }
            });
        } else {
            $('#division').html('<option value="">Select division</option>');

        }
    });


});


	function getaddempdoc() {
        var j = ($('.present_row').length);
        // alert(j);
        var serial_id =  ($('.present_row').length - 1);;
        var district  = $("#project-" + serial_id + "-district-id").val();
        var amount    = $("#project-" + serial_id + "-amount").val();
		
	
        if (district != ''  && amount != '') {
            $.ajax({
                async: true,
                dataType: "html",
                url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxproject/' +j,

                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data, textStatus) {//alert(data);
                    $('.add_doc').append(data);
                 
                }
            });
        } else if (district == '') {
            alert("Select District");
            
            $("#project-" + serial_id + "-district-id").focus();
        }else if (amount == '') {
            alert("Enter Amount");
            $("#project-" + serial_id + "-amount").focus();
        }

    }	
	
	
	 function loadcircle(id,count){
            var id; 
             //var type_id = 2;			
            if (id) {
             				
				 $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxcircles/'+ id,
                    success: function(data, textStatus) {
						var value1 = parseInt(data);
                         //alert(value1)
                        $('#project-'+count+'-circle-id').val(value1);
                        $('#project-'+count+'-circle-id1').val(value1);
                    }
                });
				
				 $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxdivisions/'+ id,
                    success: function(data1, textStatus1) {
						var value2 = parseInt(data1);
                        // alert(value2)
                        $('#project-'+count+'-division-id').val(value2);
                        $('#project-'+count+'-division-id1').val(value2);
                    }
                });
            } else {
                $('#division-id').html('<option value="">Select division</option>');

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
	
	
	 function deleterow(memb_id) {
        var check = confirm("Are you sure to delete?");
        if (check) {
            var rowCount = ($('#answerTable tr').length - 1);
            if (rowCount) {
                $('#is_active_' + memb_id).val(0);
                $('#deleted_' + memb_id).show();
                $('#delete_' + memb_id).hide();
				// document.getElementsByClassName('row_'+memb_id).bgColor = '#00FF00';
				  $('.row_'+memb_id).css("background-color", "#000000");
            }
        }
    }
</script>