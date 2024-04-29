<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header>view Tentative Financial Programme Detail</header>
        </div>
        <div class="card-body">
            <div class="col-md-10" offset="2">
                <div class="form-body row">
                    <div class="col-md-12">
                        <center>
                            <div class="form-group row">
                                <label class="control-label col-md-6">Financial Year</label>
                                <div class="col-md-3">
                                    <?php echo $tentativeFinancialProgrammeDetail->financial_year->name; ?> </div>
                            </div>
                        </center>
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
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->apr; ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "2"; ?></td>
                                            <td class="title">May </td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->may; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "3"; ?></td>
                                            <td class="title">June </td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->june; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "4"; ?></td>
                                            <td class="title">July </td>
                                            <td class="title"> <?php echo $tentativeFinancialProgrammeDetail->july; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "5"; ?></td>
                                            <td class="title">August </td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->aug; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "6"; ?></td>
                                            <td class="title">september</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->sep; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "7"; ?></td>
                                            <td class="title">october</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->oct; ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "8"; ?></td>
                                            <td class="title">November</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->nov; ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "9"; ?></td>
                                            <td class="title">December</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->dece; ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "10"; ?></td>
                                            <td class="title">January</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->jan; ?></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "11"; ?></td>
                                            <td class="title">February</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->feb; ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo "12"; ?></td>
                                            <td class="title">March</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->mar; ?> </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-center"></td>
                                            <td class="title">Total Amount</td>
                                            <td class="title"><?php echo $tentativeFinancialProgrammeDetail->total_amount; ?></td>
                                        </tr>
                                    <?php $sno++;
                                    } ?>
                                </tbody>
                            </table>
                        </center>

                        <div class="form-group" style="padding-top: 10px;">
                            <div class="offset-md-6 col-md-10">
                                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>