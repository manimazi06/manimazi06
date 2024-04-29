<!--style>
.ajaxclass th, td {
  border: 1px solid;
  padding:10px;
}  
</style-->
 
<div  id="div_vc_1">
 <div class="table-scrollable">
<div class="container">
<div class="row">
 <div class="col-md-12">
 
	<table class="ajaxclass" style="width:97%">  
	  <th colspan="4" style="text-align:center;font-size:16px;"><span ><?php echo $projectworksubdetails['work_name'] ?></span></th>
	</table><br>
	<table class="ajaxclass" style="width:97%">   
	     <tr>
		   <th style="border: 1px solid; padding:6px;width:25%;">Place of Work:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $projectworksubdetails['place_name']; ?></td>
		   <th style="border: 1px solid; padding:6px;width:25%;">Distirct:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $projectworksubdetails['district']['name']; ?></td>
		</tr>
	     <tr>
		   <th style="border: 1px solid; padding:6px;width:25%;">Division:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $projectworksubdetails['division']['name']; ?></td>
		   <th style="border: 1px solid; padding:6px;width:25%;">Circle:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $projectworksubdetails['circle']['name']; ?></td>
		</tr>
	    <tr>
		   <th style="border: 1px solid; padding:6px;width:25%;">GO No:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $financialsanction['go_no']; ?></td>
		   <th style="border: 1px solid; padding:6px;width:25%;">GO Date:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo  date('d-m-Y',strtotime($financialsanction['go_date'])); ?></td>
		</tr>
	    <tr>
		   <th style="border: 1px solid; padding:6px;width:25%;">Financial Sanction amount:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo  $projectworksubdetails['fs_amount']; ?></td>
		   <th style="border: 1px solid; padding:6px;width:25%;">Present Stage:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $description[0] ?></td>
		</tr>
		 <tr>
		   <th style="border: 1px solid; padding:6px;width:25%;">Physical Percentage:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $monitoringDetails[0]['work_percentage']['name']; ?></td>
		   <th style="border: 1px solid; padding:6px;width:25%;">Financial Percentage:</th>
		   <td style="border: 1px solid; padding:6px;width:25%;"><?php echo $monitoringDetails[0]['financial_percentage']['name']; ?></td>
		</tr>
	</table><br><br>
	<table class="ajaxclass" style="width:97%">   
	  <tr>
	    <th colspan="2" style="border: 1px solid; padding:6px;width:50%;">Monitoring Date: &nbsp;<?php echo ($monitoringDetails[1]['monitoring_date'])?date('d-m-Y', strtotime($monitoringDetails[1]['monitoring_date'])):''; ?></th>
	    <th colspan="2" style="border: 1px solid; padding:6px;width:50%;">Monitoring Date: &nbsp;<?php echo ($monitoringDetails[0]['monitoring_date'])?date('d-m-Y', strtotime($monitoringDetails[0]['monitoring_date'])):'' ?></th>
	  </tr>
	  <tr>
	    <td colspan="2" style="border: 1px solid; padding:6px;width:50%;">
<table border="1px solid #121212"  cellpadding="0" cellspacing="0" width="100%" align="center" style="background-color:White;">
			   <tbody id = "galley_1">
						 <?php 
	 
				
						 
						 $key = 0;
						 foreach($photo[1] as $photos){	//print_r($photo);?>
						 
							<tr >    
								<td  style="text-align:center"><img data-original="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photos['file_upload']) ?>"  style="padding:1px;width:400px;height:250px;padding-top:1px;cursor: pointer;" src="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photos['file_upload']) ?>" alt="photo"/></td>
					   
							</tr>
							
							
						 <?php } ?>
					</tbody>
					<script>  
							   window.addEventListener('DOMContentLoaded', function() {  
							     var galley = document.getElementById('galley_1');        
							             var viewer = new Viewer(galley, {       
							             url: 'data-original',        
							               title: function(image) {   
							                     return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')'; 
							                      },  
							                   });   
							               });

							  
							</script>	
                         				
				</table>		</td>
	    <td colspan="2" style="border: 1px solid; padding:6px;width:50%;">
		<table border="1px solid #121212"  cellpadding="0" cellspacing="0" width="100%" align="center" style="background-color:White;">
			   <tbody id = "galley_0">
						 <?php 
	 
				
						 
						 $key = 0;
						 foreach($photo[0] as $photos){	//print_r($photo);?>
						 
							<tr >    
								<td  style="text-align:center"><img data-original="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photos['file_upload']) ?>"  style="padding:1px;width:400px;height:250px;padding-top:1px;cursor: pointer;" src="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photos['file_upload']) ?>" alt="photo"/></td>
					   
							</tr>
							
							
						 <?php } ?>
					</tbody>
					<script>  
							   window.addEventListener('DOMContentLoaded', function() {  
							     var galley = document.getElementById('galley_0');        
							             var viewer = new Viewer(galley, {       
							             url: 'data-original',        
							               title: function(image) {   
							                     return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')'; 
							                      },  
							                   });   
							               });

							  
							</script>	
                         				
				</table>
		</td>
	  </tr>
	   <tr>
	    <td colspan="2" style="border: 1px solid; padding:6px;width:50%;"><?php echo $description[1] ?></td>
	    <td colspan="2" style="border: 1px solid; padding:6px;width:50%;"><?php echo $description[0] ?></td>
	  </tr>
	</table>
	</div><br>
	<!--fieldset  style="border:1px solid #00355F;border-radius:10px; margin-top:0%;padding:5px;width:97%">
    <div class="form-group row" style="margin-left:10px;">
		 <div class="col-md-5">
        <div class="card" style="width: 37rem;">
            <h5> Monitoring Date: &nbsp;<?php echo date('d-m-Y', strtotime($monitoringDetails[1]['monitoring_date'])) ?></h5>
            <?php if ($photo[1] != '') { ?>
                <img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photo[1]) ?>" height="100%" width="80%">
            <?php } else {
                echo 'no data';
            } ?>
            <div class="card-body">
                <p class="card-text"><?php echo $description[1] ?></p>
            </div>
        </div>
        </div>	    
	
		<div class="col-md-5" style="margin-left:50px;">
        <div class="card" style="width: 37rem;">
            <h5> Monitoring Date: &nbsp;<?php echo date('d-m-Y', strtotime($monitoringDetails[0]['monitoring_date'])) ?></h5>
            <?php if ($photo[0] != '') { ?>
                <img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/'.$photo[0]) ?>" height="100%" width="80%">
            <?php } else {
                echo 'no data';
            } ?>
            <div class="card-body">
                <p class="card-text"><?php echo $description[0] ?></p>
            </div>
        </div>
        </div>
    </div>
	</fieldset-->
    </div>
    </div>
    </div>
    </div>

   <script>
    function print_receipt() {
        var content = $("#div_vc_1").html();
        var pwin = window.open("MSL", 'print_content',
            'width=900,height=1000,scrollbars=yes,location=0,menubar=no,toolbar=no');
        pwin.document.open();
        pwin.document.write('<html><head></head><body onload="window.print()"><tr><td>' + content +
            '</td></tr></body></html>');
        pwin.document.close();
    }
   </script>