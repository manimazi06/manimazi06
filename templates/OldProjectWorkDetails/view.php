<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-body">
            <fieldset style="border:1px solid #00355F;border-radius:10px; margin-top:1%;padding:15px;">
                <h4 class="sub-tile"><?php echo $oldProjectWorkDetail['project_name']; ?> </h4>
                <div class="form-group row">
                    <table style="max-width:98%;margin-left: 1%;">
					    <?php if($oldProjectWorkDetail['work_type'] == 2) { ?>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Ref No</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['ref_no']; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Circle</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['circle']['name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Division</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['division']['name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">District</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['district']['name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Financial Year</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['financial_year']['name']; ?></td>
                        </tr>
                        <?php if($oldProjectWorkDetail['work_type'] == 1) { ?>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Department</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['department']['name']; ?></td>
                        </tr>
                        <?php } ?>
						<tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Project Name</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['project_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Place Name</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['place_name']; ?></td>
                        </tr>
                        
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Sanction Amount</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['fs_value']; ?></td>
                        </tr>
                        <?php if($oldProjectWorkDetail['work_type'] == 1) { ?>
						<tr>
							<td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Go No</td>
							<td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['go_no']; ?></td>
						</tr>
                        <?php } ?>
                        <?php if($oldProjectWorkDetail['work_type'] == 1) { ?>
						<tr>
							<td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Go Date</td>
							<td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo ($oldProjectWorkDetail['go_date'])?date('d-m-Y', strtotime($oldProjectWorkDetail['go_date'])): ''; ?></td>
						</tr>
                        <?php } ?>
                        <tr>
                            <td style="padding:10px;width:20%;background-color: #244f96;color: #fff;border: 1px solid #fff;font-weight:600;">Work Stage</td>
                            <td colspan="3" style="padding:13px;width:80%;border: 1px solid black"><?php echo $oldProjectWorkDetail['work_stage']; ?></td>
                        </tr>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>
