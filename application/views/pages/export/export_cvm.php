<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Pivot_CVM" . $datenow . ".xls");
?>
<br>
<h6 class="text-judul">Report Pivot CVM Last Date <?= $datenow; ?> </h6>
<table class="table table-bordered table-hover table-sm">
    <thead>
        <tr class="text-center text-white" style="background-color: rgb(48, 45, 58);">
            <td class="text-judul bold" rowspan="2" style="vertical-align:middle;text-align:center;color:white;">
                No
            </td>
            <td style="vertical-align:middle;text-align:center;color:white;" class="text-judul bold" rowspan="2">
                Region/Porto
            </td>
            <td style="color:white;vertical-align:middle;text-align:center;width: 100px;color:white;"
                class="text-judul bold" rowspan="2">
                Sub Package
            </td>
            <td class="text-judul bold" colspan="5"
                style="color:white;text-align: center;background-color: rgb(114, 116, 60);">
                Subs (000)
            </td>
            <td class="text-judul bold" style="color:white;text-align: center;background-color: rgb(69, 129, 79);"
                colspan="5">
                TRX (000)
            </td>
            <td class="text-judul bold" style="color:white;text-align: center;background-color: rgb(175, 129, 79);"
                colspan="5">
                Revenue in Bn
            </td>
        </tr>
        <tr class="text-center text-dark" style="background-color: rgb(230, 217, 204);">
            <td class="text-judul" id="subs_month1"><?= $date2; ?></td>
            <td class="text-judul" id="subs_month2"><?= $date1; ?></td>
            <td class="text-judul" id="subs_month3"><?= $datenow; ?></td>
            <td class="text-judul">MoM M2</td>
            <td class="text-judul">MoM</td>
            <td class="text-judul" id="trx_month1"><?= $date2; ?></td>
            <td class="text-judul" id="trx_month2"><?= $date1; ?></td>
            <td class="text-judul" id="trx_month3"><?= $datenow; ?></td>
            <td class="text-judul">MoM M2</td>
            <td class="text-judul">MoM</td>
            <td class="text-judul" id="rev_month1"><?= $date2; ?></td>
            <td class="text-judul" id="rev_month2"><?= $date1; ?></td>
            <td class="text-judul" id="rev_month3"><?= $datenow; ?></td>
            <td class="text-judul">MoM M2</td>
            <td class="text-judul">MoM</td>
        </tr>
    </thead>
    <tbody id="table-list-cvm">
        <?php
        if (count($cvm) > 0) {
            $no = 1;
            foreach ($cvm as $row) {
                if ($row['paket_group'] == 'Total') {
                    echo "<tr style='border: 1px solid #ccc;background-color:rgb(187, 156, 151);color:rgb(255, 255, 255);'>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $no . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['region'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['paket_group'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['subs_m2'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['subs_m1'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['subs_m0'] . "</td>";
                    if ($row['MoM_M2_Subs'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_M2_Subs'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;'>" . $row['MoM_M2_Subs'] . " %</td>";
                    }
                    if ($row['MoM_Subs'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_Subs'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;'>" . $row['MoM_Subs'] . " %</td>";
                    }
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['trx_m2'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['trx_m1'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['trx_m0'] . "</td>";
                    if ($row['MoM_M2_trx'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_M2_trx'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;'>" . $row['MoM_M2_trx'] . " %</td>";
                    }
                    if ($row['MoM_trx'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_trx'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;'>" . $row['MoM_trx'] . " %</td>";
                    }
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['rev_m2'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['rev_m1'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['rev_m0'] . "</td>";
                    if ($row['MoM_M2_rev'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_M2_rev'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;'>" . $row['MoM_M2_rev'] . " %</td>";
                    }
                    if ($row['MoM_rev'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_rev'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;'>" . $row['MoM_rev'] . " %</td>";
                    }
                    echo "</tr>";
                } else {
                    echo "<tr style='border: 1px solid #ccc;'>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $no . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['region'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['paket_group'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['subs_m2'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['subs_m1'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['subs_m0'] . "</td>";

                    if ($row['MoM_M2_Subs'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_M2_Subs'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;background-color: rgb(201, 246, 153);'>" . $row['MoM_M2_Subs'] . " %</td>";
                    }
                    if ($row['MoM_Subs'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_Subs'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;background-color: rgb(201, 246, 153);'>" . $row['MoM_Subs'] . " %</td>";
                    }

                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['trx_m2'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['trx_m1'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['trx_m0'] . "</td>";

                    if ($row['MoM_M2_trx'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_M2_trx'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;background-color: rgb(201, 246, 153);'>" . $row['MoM_M2_trx'] . " %</td>";
                    }
                    if ($row['MoM_trx'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_trx'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;background-color: rgb(201, 246, 153);'>" . $row['MoM_trx'] . " %</td>";
                    }

                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['rev_m2'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['rev_m1'] . "</td>";
                    echo "<td style='vertical-align:middle;text-align:center;'>" . $row['rev_m0'] . "</td>";
                    if ($row['MoM_M2_rev'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_M2_rev'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;background-color: rgb(201, 246, 153);'>" . $row['MoM_M2_rev'] . " %</td>";
                    }
                    if ($row['MoM_rev'] < 0) {
                        echo "<td style='vertical-align:middle;text-align:center;color: rgb(255, 38, 49)'>" . $row['MoM_rev'] . " %</td>";
                    } else {
                        echo "<td style='vertical-align:middle;text-align:center;background-color: rgb(201, 246, 153);'>" . $row['MoM_rev'] . " %</td>";
                    }
                    echo "</tr>";
                }
                $no++;
            }
        } else {
        }
        ?>
    </tbody>
</table>

<br>
<br>