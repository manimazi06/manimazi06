<?php echo $this->Form->create($projectWork, ['id' => 'FormID', 'class' => 'form-horizontal', "autocomplete" => "off", 'enctype' => 'multipart/form-data']); ?>
<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <!--div class="card-head">
            <header>Project Approval</header>
        </div-->
		   <div class="card-body">       
			 <h4 class = "sub-tile">Project - <?php  echo $projectWork['project_code']; ?> &nbsp;[<?php  echo $projectWork['project_status']['name']; ?>]</h4>	   
			 <!--legend class="bol" style="color: #0047AB; text-align: center;">Project - <?php  echo $projectWork['project_code']; ?> &nbsp;[<?php  echo $projectWork['project_status']['name']; ?>]</legend-->
			<fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;background-color:ghostwhite;padding:1px;">
				 <div class="col-md-12">
				    <div class="form-group row">                      
                        <label class="control-label col-md-2 bol">Project Name <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-8 lower">                           
						   <?php  echo $projectWork['project_name']; ?>   
                        </div>
                    </div>
					 <div class="form-group row">                       
						<label class="control-label col-md-2 bol">Project Description<span class="required">&nbsp;&nbsp;: </span></label>
                        <div class="col-md-8 lower">                           
						   <?php  echo $projectWork['project_description']; ?>   
                        </div>            
			         </div>  
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Departments <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
							<?php  echo $projectWork['department']['name']; ?>                       
					   </div>
                        <label class="control-label col-md-2 bol">Financial Year <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['financial_year']['name']; ?>              
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Building Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['building_type']['name']; ?>              
                        </div>
                         <label class="control-label col-md-2 bol">Rough Cost (Rs.)<span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower"> 
							<?php  echo  ($projectWork['project_amount'])?ltrim($fmt->formatCurrency((float)$projectWork['project_amount'],'INR'),'₹'):'0.00'; ?>
                         </div>
                    </div>                 
                    <div class="form-group row">
                        <label class="control-label col-md-2 bol">Coastal Area <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                             <?php  echo ($projectWork['coastal_area'] == 1)?'Coastal Area':'Non-Coastal Area'; ?>              
                        </div>
                        <label class="control-label col-md-2 bol">Scheme Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
						  <?php  echo $projectWork['scheme_type']['name']; ?>              
                        </div>
                    </div>                   
                    <div class="form-group row">                    
                       <label class="control-label col-md-2 bol">Upload <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                            <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/ProjectWorks/' . $projectWork['file_upload'], ['fullBase' => true]); ?>" target="_blank"><span>
                                    <ion-icon name="document-text-outline"></ion-icon>View
                                </span></a> 
						</div>
                        <label class="control-label col-md-2 bol">Approval Status <span class="required"> &nbsp;&nbsp;: </span></label>
						<div class="col-md-4 lower">
						  <?php  echo ($projectWork['ce_approved'] == 1)?"Approved":"Pending"; ?>              
						</div>			
			        </div> 
	               <div class="form-group row">                    
                       <label class="control-label col-md-2 bol">Work Type <span class="required"> &nbsp;&nbsp;: </span></label>
                        <div class="col-md-4 lower">
                          <?php  echo $projectWork['departmentwise_work_type']['name'];  ?>
						</div>
                        						
					
                    </div>					
						<?php if($projectWork['ce_approved'] == 1){  ?>
					<div class="form-group row">
						
						<label class="control-label col-md-2 bol">Approved Date<span class="required">&nbsp;&nbsp;: </span></label>
						<div class="col-md-4 lower">                           
						   <?php  echo ($projectWork['approved_date'])?date('d-m-Y',strtotime($projectWork['approved_date'])):''; ?>   
						</div>   
					</div>
						<?php } ?>		
                </div>
            </fieldset>	
		 </div>
		  <?php   if ($projectWorkSubdetailscount > 0) {   ?>
		  <div class="card-body"> 
          <h4 class = "sub-tile">Division Wise Work Details</h4>
             <fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:5px;margin-left:5px;margin-bottom:0%">
			 <div class="form-group">                               
				<table id="answerTable" class="table  table-bordered  order-column" style="max-width: 99%;margin-left: 1%;">
					<thead>
						<tr align="center">
							<th style="width:1%"> S.No</th>
							<th style="width:10%">Work Name</th>
							<th style="width:10%">District</th>
							<th style="width:10%">Division</th>
							<th style="width:10%">Circle</th>
							<th style="width:10%">Rough Cost <br>(in Rs.)</th>
						</tr>
					</thead>
					<tbody class="add_doc">
					   <?php
						$i = 0;
						foreach ($projectWorkSubdetails as $projectWorkSubdetail) : ?>										
						 <tr align="center">  
						   <td class="trcount"><?php echo $i + 1; ?></td>
						   <td><?php echo $projectWorkSubdetail['work_name']; ?></td>
						   <td><?php echo $projectWorkSubdetail['district']['name']; ?></td>								    
						   <td><?php echo $projectWorkSubdetail['division']['name']; ?></td>
						   <td><?php echo $projectWorkSubdetail['circle']['name']; ?></td>                                   
						   <td align="right"><?php echo $projectWorkSubdetail['rough_cost']; ?></td>							
				     	</tr>
						  <?php
							 $tot_rough    += $projectWorkSubdetail['rough_cost'];
						  $i++;
						endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
						   <th colspan="5" style="text-align:right;"><b>Total (in Rs.)</b></th>
						   <th style="text-align:right;"><?php echo $tot_rough;  ?></th>
						</tr>
					</tfoot>
				</table>		
           </div>			
			</fieldset>		  
        </div>			
		<?php  }  ?> 
		 <div class="card-body" >           
		   <div class="form-body row">
                <div class="col-md-12">                   
                    <div class="form-group row">                        
                        <label class="control-label col-md-2">Approval Status <span class="required"> * </span></label>
                        <div class="col-md-4">
                            <?php echo $this->Form->control('ce_approved', ['class' => 'form-select', 'templates' => ['inputContainer' => '{{content}}'],'empty' => 'select', 'options' => $statusproject, 'label' => false, 'error' => false, 'required', 'onchange' => 'projecttype(this.value)']); ?>
                        </div>
                    </div>                
                             
                    <div class="form-group row">
                        <label class="control-label col-md-2 remarks" <?php if($projectWork['ce_approved']!=2){ ?> style="display: none;" <?php } ?>>Remarks <span
                                class="required"> * </span></label>
                        <div class="col-md-4 remarks" <?php if($projectWork['ce_approved']!=2){ ?> style="display: none;" <?php } ?>>
                            <?php echo $this->Form->control('remarks', ['class' => 'form-control', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'error' => false, 'type' => 'textarea', 'rows'=>3,'required','id'=>'remarks']); ?>
                        </div>
                    </div>
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
        // 'district_id': {
        // required: true
        // },
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
        // 'longitude': {
        //     required: true
        // },
        'building_type_id': {
            required: true
        },
        // 'division_id': {
        // required: true
        // },
        'ce_approved': {
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
        // 'district_id': {
        // required: "Select District"
        // },
        'coastal_area': {
            required: "Select Coastal Area"
        },
        'project_name': {
            required: "Enter Project Name"
        },
        'project_amount': {
            required: "Enter Project Amount"
        },
        'file_upload': {
            required: "Select Document"
        },
        'remarks': {
            required: "Enter remarks"
        },
        // 'longitude': {
        //     required: "Enter Longitude"
        // },
        'building_type_id': {
            required: "Select Building Type"
        },
        // 'division_id': {
        // required: "Select division"
        // },
        'ce_approved': {
            required: "Enter Approval Status"
        }
    },
    submitHandler: function(form) {
        form.submit();
        $(".btn").prop('disabled', true);
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
</script>