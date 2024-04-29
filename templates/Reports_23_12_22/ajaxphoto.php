<div class="container">
    <h3 style="text-align: center;"><?php echo $projectworksubdetails['work_name'] ?> </h3>
    <div class="form-group row site">
        <div class="col-md-5">
            <span>GO No:&nbsp;&nbsp;<?php echo $financialsanction['go_no']; ?></span>
        </div>
        <div class="col-md-5">
            <span>GO Date:&nbsp;&nbsp;<?php echo  $financialsanction['go_date']; ?></span>
        </div>
        <div class="col-md-5">
            <span>Financial Sanction amount:&nbsp;&nbsp;<?php echo  $projectworksubdetails['fs_amount']; ?></span>
        </div>
        <div class="col-md-5">
            <span>Present Stage:&nbsp;&nbsp;<?php echo $descri ?></span>
        </div>
        <div class="col-md-5">
            <span>Financial year:&nbsp;&nbsp; <?php echo $name ?></span>
        </div>
    </div>
    <br><br>

    <div class="form-group row">


        <div class="card" style="width: 40rem;">
            <h5> <?php echo date('d-m-Y', strtotime($monitoringDetails['monitoring_date'])) ?></h5>
            <?php if ($photo != '') { ?>
                <img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/' . $photo) ?>" height="100%" width="80%">
            <?php } else {
                echo 'no data';
            } ?>
            <div class="card-body">
                <p class="card-text"><?php echo $descri ?></p>
            </div>
        </div>


        <div class="card" style="width: 40rem;">
            <h5> <?php echo date('d-m-Y', strtotime($monitoringDetails['monitoring_date'])) ?></h5>
            <?php if ($photo != '') { ?>
                <img src="<?php echo $this->Url->build('/uploads/Projectmonitoring/' . $photo) ?>" height="100%" width="80%">
            <?php } else {
                echo 'no data';
            } ?>
            <div class="card-body">
                <p class="card-text"><?php echo $descri ?></p>
            </div>
        </div>
    </div>

    <style>
        h5 {
            font-weight: bold;
        }

        .site {
            border: 1px solid #00355F;
            border-radius: 10px;
            padding: 15px;
            line-height: 30px;
            width: 80%;

        }
    </style>