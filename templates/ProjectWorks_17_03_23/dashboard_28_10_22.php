<style>
    .dbg {
        border: 1px solid red !important;
    }


    main,
    header,
    footer {
        margin: 0 auto;
        width: 90%;
        padding: 10px;
    }

    header,
    footer {
        display: flex;
        gap: 5rem;
        justify-content: space-between;
    }

    ul[role="breadcrumb"] {
        padding: 0;
    }

    ul[role="breadcrumb"] li {
        display: inline;
        list-style-type: none;
        font-size: 15px;
        color: #888;
    }

    ul[role="breadcrumb"] li::after {
        content: "/";
        margin-left: 7px;
    }

    header img {
        border-radius: 50%;
        background: #fca03e;
        width: 35px;
        height: 35px;
        line-height: 35px;
        font-size: 18px;
        text-align: center;
        color: #fee;
        border: 3px solid #dee;
    }

    nav {
        display: flex;
        gap: 1rem;
    }

    main {
        height: 80%;
        background: transparent;
    }

    hgroup h2 {
        margin-bottom: 0;
    }

    hgroup ul {
        margin-top: 0;
    }

    small {
        color: #888;
    }

    section {
        display: flex;
        gap: 10px;
        overflow-x: auto;
    }

   section div.examples, dl, article {
    flex: 1;
    text-align: center;
    background: #fff !important;
    padding: 20px;
    /* border: 1px solid #244F96; */
    border-radius: 5px;
    box-shadow: rgb(30 41 59 / 4%) 0 2px 4px 0;
    margin-bottom: 35px;
    -webkit-box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
    box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
}

    dt {
        font-size: 18px;
        color: #000;
    }

    dd {
        font-size: 35px;
        margin-left: 0;
    }


   
 .col-indigo
 {
    color: #fff !important;
 }
   
</style>


<div class="card-head">
    <header>Dashboard</header>
</div>


    <section class="dashboard">
		    <a href="javascript:void(0);" onclick="getempdesgn(1);">

        <dl style="background-color:#000080 ;">
            <dt >Total project</dt>
            <dd>
                <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
                </h1> -->
                <span href="javascript:;" class="single-mail">
                    <?php foreach ($TotalProjectCount as $key => $value) { ?>

                        <h1 class="mt-1">
                            <div class="row">
                                <div class="thin">
                                    <?php if ($value['pwcount'] != 0) { ?>
                                        <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(1);"><?php echo $value['pwcount']; ?></a>
                                   <?php } else { ?>
                                        <span><?php echo "0"; ?></span>
                                   <?php  } ?>
                                </div>
                            </div>
                        </h1>
                    <?php $sno++;
                    } ?>
                </span>
            </dd>
        </dl></a>
		 <a href="javascript:void(0);" onclick="getempdesgn(2);">
        <dl style="background-color:#DC143C ;">
            <dt >Project In Progress</dt>
            <dd>
                <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo $progressCount[0]['pwcount']; ?>"> -->
                </h1>
                <span href="javascript:;" class="single-mail">
                    <?php foreach ($progressCount as $key => $value) { ?>
                        <h1 class="mt-1">
                            <div class="row">
                                <div class="thin">
                                    <?php if ($value['pwcount'] != 0) { ?>
                                        <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(2);"><?php echo $value['pwcount']; ?></a>
                                  <?php } else { ?>
                                        <span><?php echo "0"; ?></span>
                                   <?php  } ?>
                                </div>
                            </div>
                        </h1>
                    <?php $sno++;
                    } ?>
                </span>
            </dd>
        </dl></a>
		 <a href="javascript:void(0);" onclick="getempdesgn(3);">
        <dl style="background-color:#228B22 ;">
            <dt >Project Completed</dt>
            <dd>
                <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($Totalcompletecount[0]['pwcount']) ? ($Totalcompletecount[0]['pwcount']) : 0; ?>">
                </h1> -->
                <span href="javascript:;" class="single-mail">
                    <?php foreach ($Totalcompletecount as $key => $value) { ?>
                        <h1 class="mt-1">
                            <div class="row">
                                <div class="thin">
                                    <?php if ($value['pwcount'] != 0) { ?>
                                        <a href="javascript:void(0);" class="thin o-h" style="text-decoration:none; " onclick="getempdesgn(3);"><?php echo $value['pwcount']; ?></a>
                                    <?php } else { ?>
                                        <span><?php echo "0"; ?></span>
                                   <?php  } ?>
                                </div>
                            </div>
                        </h1>
                    <?php $sno++;
                    } ?>
                </span>
            </dd>
        </dl></a>
    </section>
	<?php if($role_id == 1 || $role_id == 6 || $role_id == 8 || $role_id == 9 || $role_id == 10){  ?>
	  <section class="dashboard">

        <dl style="background-color:#000080 ;">
            <dt >Division Wise</dt>
            <dd>
                <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
                </h1> -->
                <span href="javascript:;" class="single-mail">                  
					<h1 class="mt-1">
						<div class="row">
							<table class="table  table-bordered table-checkable order-column mobile-table">
								<thead>
									<tr class="text-center">
										<th> Sno </th>
										<th> Division Name </th>
										<th> Total Project </th>
										<th> Progress </th>
										<th> Completed</th>
									</tr>
								</thead>
								<tbody>
									<?php $sno = 1;
									foreach ($divisions_details as $key => $division) : ?>
										<tr class="odd gradeX">
											<td class ="bol"><?php echo ($sno); ?></td>
											<td class ="bol"><?php echo $division['division_name']; ?></td>
											<td class ="bol"><?php $totalproject     = $division['total_count']; ?>
												<?php if ($totalproject > 0) { ?>
													<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,1);"><?php echo $totalproject ?></a>
												<?php } else {
													echo "0";
												} ?>
											</td>
											<td class ="bol"><?php $total_progress   = $division['in_progress']; ?>
												<?php if ($total_progress > 0) { ?>
													<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo $key; ?>,2);"><?php echo $total_progress ?></a>
												<?php } else {
													echo "0";
												} ?>
											</td>

											<td class ="bol"><?php $totalcompleted   = $division['completed'] ?>
												<?php if ($totalcompleted > 0) { ?>
													<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo $key; ?>,3);"><?php echo $totalcompleted ?></a>
												<?php } else {
													echo "0";
												} ?>
											</td>
										</tr>
									<?php
										$sno++;
										$totalprojects     += $totalproject;
										$total_in_progress += $total_progress;
										$completed         += $totalcompleted;


									endforeach;
									?>
								</tbody>
								<tfoot>
									<tr class="odd gradeX">
										<td></td>
										<td class ="bol"><?php echo "Total"; ?></td>
										<td class ="bol"><?php echo $totalprojects; ?></td>
										<td class ="bol"><?php echo $total_in_progress; ?></td>
										<td class ="bol"><?php echo $completed; ?></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</h1>                  
                </span>
            </dd>
        </dl>&nbsp;
        <dl style="background-color:#000080 ;">
            <dt >Department Wise</dt>
            <dd>
                <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
                </h1> -->
                <span href="javascript:;" class="single-mail">                   
					<h1 class="mt-1">
						<div class="row">
							<table class="table  table-bordered table-checkable order-column mobile-table">
								<thead>
									<tr class="text-center">
										<th class ="bol"> Sno </th>
										<th class ="bol"> Department Name </th>
										<th class ="bol"> Total Project </th>
										<th class ="bol"> Progress </th>
										<th class ="bol"> Completed</th>
									</tr>
								</thead>
								<tbody>
									<?php $sn = 1;
									foreach ($department_details as $key => $department) : ?>
										<tr class="odd gradeX">
											<td class ="bol"><?php echo $sn; ?></td>
											<td class ="bol"><?php echo   $department['department_name']; ?></td>
											<td>
												<?php $totolproject   = $department['total_count']; ?>
												<?php if ($totolproject > 0) { ?>
													<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,1)"><?php echo $totolproject; ?></a>
												<?php } else {
													echo "0";
												} ?>
											</td>
											<td class ="bol">
												<?php $totalprogress  =  $department['inprogress']; ?>
												<?php if ($totalprogress > 0) { ?>
													<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,2)"><?php echo $totalprogress; ?></a>
												<?php } else {
													echo "0";
												} ?>
											</td>
											<td class ="bol">
												<?php $totalcompleted = $department['completed']; ?>
												<?php if ($totalcompleted > 0) { ?>
													<a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,3)"><?php echo $totalcompleted; ?></a>
												<?php } else {
													echo "0";
												} ?>
											</td>
										</tr>
									<?php $sn++;
										$totolprojectz += $totolproject;
										$totalprogressz += $totalprogress;
										$totalcompletedz += $totalcompleted;
									endforeach; ?>
								</tbody>
								<tfoot>
									<tr class="odd gradeX">
										<td></td>
										<td class ="bol"><?php echo "Total"; ?></td>
										<td class ="bol"><?php echo $totolprojectz; ?></td>
										<td class ="bol"><?php echo $totalprogressz; ?></td>
										<td class ="bol"><?php echo $totalcompletedz; ?></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</h1>
                </span>
            </dd>
        </dl>
		
    </section>
	<?php } ?>

<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
    <div class="modal-dialog" style="max-width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form add-unsent-form">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button

    function getempdesgn(val) {
        // alert(val);
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectwise/' + val,
            success: function(data, textStatus) {
                // alert(data);
                $(".add-unsent-form").html(data);
            }
        });
    }
	
	
	    function getdepart(key, type) {
        // alert("hii");
        // alert(key);
        // alert(type);
        $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
        $("#modal-add-unsent").modal('show');
        $.ajax({
            async: true,
            dataType: "html",
            type: "post",
            url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxdepartment/' + key + "/" + type,
            success: function(data, textStatus) {
                // alert(data);
                $(".add-unsent-form").html(data);
            }
        });
    }
	
	function getdivision(id, type) {
    // alert(id);
    // alert(type);
    $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
    $("#modal-add-unsent").modal('show');
    $.ajax({
        async: true,
        dataType: "html",
        type: "post",
        url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxdivisiontwisereport/' + id +
            "/" + type,
        success: function(data, textStatus) {
            // alert(data);
            $(".add-unsent-form").html(data);
        }
    });
}
</script>