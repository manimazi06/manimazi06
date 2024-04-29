<?php if($projectdetails != ""){  ?>
<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
	<center><b><h3>Fund Details</h3></b></center>
	<div class="table-scrollable">
		<table class="table table-bordered table-advanced display">
			<thead>
				<tr class="text-center">
					<th>Sno</th>
					<th>Fund Received Date</th>
					<th>Cheque No.</th>					
					<th>Amount <br>(in Rs.)</th>  
				</tr>
			</thead>
			<tbody>
				<?php $sno =1; foreach ($projectdetails as $project): ?>
				<tr class="odd gradeX">
					<td><?php echo($sno); ?></td>
					<td><?php echo date('d-m-Y',strtotime($project['fund_received_date'])); ?></td>
					<td><?php echo $project['cheque_no']; ?></td>
					<td style="text-align:right;"><?php echo ($project['amount'])?ltrim($fmt->formatCurrency((float)$project['amount'],'INR'),'₹'):'0.00' ; ?></td>

				</tr>
				<?php
                 $total += $project['amount'];
 				$sno++; endforeach; ?>
			</tbody>
			<tfoot>
			    <tr>
				 <td style="text-align:right;" colspan="3">Total</td>
				 <td style="text-align:right;"><?php echo ($total)?ltrim($fmt->formatCurrency((float)$total,'INR'),'₹'):'0.00' ; ?></td>
			    </tr>
			</tfoot>
		</table>
	</div>
<?php } ?>