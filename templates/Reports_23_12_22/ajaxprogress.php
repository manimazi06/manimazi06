<div class="table-scrollable">
    <?php if ($projectdetails != "") {  ?>
        <table class="table table-striped table-bordered" style="width: 80%">
            <thead>
                <tr class="text-center">
                    <th> Sno </th>
                    <th>Financial sanction ref no</th>
                    <th>Sanctioned Amount</th>
                    <th>Sanction Date </th>
                    <th>Sanction File upload </th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 1;
                foreach ($projectdetails as $conn) : ?>
                    <tr class="text-center">
                        <td><?php echo ($sno); ?></td>
                        <td><?php echo $conn['refno']; ?></td>
                        <td><?php echo $conn['samount']; ?></td>
                        <td><?php echo $conn['sdate']; ?></td>
                        <td class="text-center">
                            <?php if ($conn['sfile'] != '') {  ?>
                                <a style="color:blue;" href="<?php echo $this->Url->build('/uploads/financialsanction/' . $conn['sfile'], ['fullBase' => true]); ?>" target="_blank"><span>
                                        <ion-icon name="document-text-outline"></ion-icon>View
                                    </span></a>
                            <?php } ?>
                        </td>

                    </tr>
                <?php $sno++;
                endforeach; ?>
            </tbody>
        </table>
    <?php } ?>
</div>