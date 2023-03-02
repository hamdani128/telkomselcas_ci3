<?php
// require_once '../query/query_taker.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Campaign_Taker_Filter_" . $date_first . "_" . $date_last . ".xls");

?>

<br>
<br>
<h6 class="text-judul">Campaign Taker Filter <?= $date_first; ?> And Last <?= $date_last; ?> </h6>
<table class="table" style="border: 1px;">
    <thead>
        <tr class="text-center text-white"
            style="border: 1px solid #ccc;background-color: rgb(150, 173, 173);vertical-align : middle;text-align:center; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size: 12pt;font-weight: bold;color: white;">
            <td class="text-judul bold" rowspan="2">No</td>
            <td class="text-judul bold" style="width: 135px;" rowspan="2">Region</td>
            <td class="text-judul bold" style="width: 135px;" rowspan="2">
                Branch
            </td>
            <td class="text-judul bold" style="width: 130px;" rowspan="2">
                Cluster
            </td>
            <td class="text-judul bold" colspan="24" style="background-color: rgb(237, 84, 41);">Campaign Daily</td>
        </tr>
        <tr class="text-center text-white"
            style="border: 1px solid #ccc;background-color: rgb(189, 147, 147);vertical-align : middle;text-align:center;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size: 12pt;color: white;">
            <td class="text-judul" style="background-color: rgb(12, 69, 136);">Insak WL</td>
            <td class="text-judul" style="background-color: rgb(12, 69, 136);">Insak Taker </td>
            <td class="text-judul" style="background-color: rgb(12, 69, 136);">Rev Insak </td>
            <td class="text-judul" style="background-color: rgb(12, 69, 136);">(%)</td>
            <td class="text-judul" style="background-color: rgb(18, 194, 143);">Comsak WL</td>
            <td class="text-judul" style="background-color: rgb(18, 194, 143);">Comsak Taker </td>
            <td class="text-judul" style="background-color: rgb(18, 194, 143);">Rev Comsak </td>
            <td class="text-judul" style="background-color: rgb(18, 194, 143);">(%)</td>
            <td class="text-judul" style="background-color: rgb(8,148,9);">HotPromo WL</td>
            <td class="text-judul" style="background-color: rgb(8,148,9);">HotPromo Taker </td>
            <td class="text-judul" style="background-color: rgb(8,148,9);">Rev HotPromo </td>
            <td class="text-judul" style="background-color: rgb(8,148,9);">(%)</td>
            <td class="text-judul" style="background-color: rgb(237,158,41);">Digital WL</td>
            <td class="text-judul" style="background-color: rgb(237,158,41);">Digital Taker </td>
            <td class="text-judul" style="background-color: rgb(237,158,41);">Rev Digital </td>
            <td class="text-judul" style="background-color: rgb(237,158,41);">(%)</td>
            <td class="text-judul" style="background-color: rgb(3,73,104);">Suprise Deal WL</td>
            <td class="text-judul" style="background-color: rgb(3,73,104);">Suprise Deal Taker </td>
            <td class="text-judul" style="background-color: rgb(3,73,104);">Rev Suprise Deal </td>
            <td class="text-judul" style="background-color: rgb(3,73,104);">(%)</td>
            <td class="text-judul" style="background-color: rgb(3,136,100);">Voice WL</td>
            <td class="text-judul" style="background-color: rgb(3,136,100);">Voice Taker </td>
            <td class="text-judul" style="background-color: rgb(3,136,100);">Rev Voice </td>
            <td class="text-judul" style="background-color: rgb(3,136,100);">(%)</td>
        </tr>
    </thead>
    <tbody>
        <?php if (count($area) > 0) { ?>
        <?php $no = 1 ?>
        <?php foreach ($area as $row) { ?>
        <?php
                $total_wl = $row->insak_wl + $row->comsak_wl + $row->hotpromo_wl + $row->digital_wl + $row->suprise_deal_wl + $row->voice_wl;
                $percent_insak = ($row->insak_wl / $total_wl) * 100;
                $percent_comsak = ($row->comsak_wl / $total_wl) * 100;
                $percent_hotpromo = ($row->hotpromo_wl / $total_wl) * 100;
                $percent_digital = ($row->digital_wl / $total_wl) * 100;
                $percent_suprise_deal_wl = ($row->suprise_deal_wl / $total_wl) * 100;
                $percent_voice_wl = ($row->voice_wl / $total_wl) * 100;
                ?>
        <tr style="font-size: 9pt;text-align: center;border: 1px solid #ccc;">
            <td><?= $no++ ?></td>
            <td><?= $row->region; ?></td>
            <td><?= $row->branch; ?></td>
            <td><?= $row->cluster; ?></td>
            <td>
                <?= str_replace(',', '.', number_format($row->insak_wl, 0)) ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->insak_taker, 0)) ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->rev_insak, 0)) ?>
            </td>
            <td>
                <?= number_format($percent_insak, 2) . "%" ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->comsak_wl, 0)) ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->comsak_taker, 0)) ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->rev_comsak, 0)) ?>
            </td>
            <td>
                <?= number_format($percent_comsak, 2) . "%" ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->hotpromo_wl, 0)) ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->hotpromo_taker, 0)) ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->rev_hotpromo, 0)) ?>
            </td>
            <td>
                <?= number_format($percent_hotpromo, 2) . "%" ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->digital_wl, 0)) ?>
            </td>
            <td>
                0
            </td>
            <td>
                0
            </td>
            <td>
                <?= number_format($percent_digital, 2) . "%" ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->suprise_deal_wl, 0)) ?>
            </td>
            <td>
                0
            </td>
            <td>
                0
            </td>
            <td>
                <?= number_format($percent_suprise_deal_wl, 2) . "%" ?>
            </td>
            <td>
                <?= str_replace(',', '.', number_format($row->voice_wl, 0)) ?>
            </td>
            <td>
                0
            </td>
            <td>
                0
            </td>
            <td>
                <?= number_format($percent_voice_wl, 2) . "%" ?>
            </td>
        </tr>
        <?php } ?>
        <?php } ?>
    </tbody>
</table>

<br>