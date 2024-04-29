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


<main>
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
        </dl></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
        </dl>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
        </dl>
    </section>
</main>
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
</script>