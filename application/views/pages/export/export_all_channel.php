<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=campaign_all_taker.xls");
?>
<br>
<br>

<table class="table" style="border: 1px;">
    <thead>
        <tr>
            <th style="border: 1px solid #ccc;background-color: rgb(226,253,246);" rowspan="2">Region</th>
            <th style="border: 1px solid #ccc;background-color: rgb(226,253,246);" rowspan="2">Branch</th>
            <th style="border: 1px solid #ccc;background-color: rgb(226,253,246);" rowspan="2">Cluster</th>
            <th style="border: 1px solid #ccc;background-color: rgb(150, 173, 173);color: white;" colspan="2">
                Campaign Submission by Managed Tools
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" colspan="11">
                Campaign Performance
            </th>
        </tr>
        <tr>
            <th style="border: 1px solid #ccc;background-color: rgb(150, 173, 173);color: white;" id="m0">
                <?= $subs_m0; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(150, 173, 173);color: white;" id="m1">
                <?= $subs_m1; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;">Target</th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;">Acv(%)</th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;">DRR</th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;">MoM</th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="taker_m0">
                Taker <?= $subs_m0; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="taker_m1">
                Taker <?= $subs_m1; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="tur_m0">
                TUR <?= $subs_m0; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="tur_m1">
                TUR <?= $subs_m1; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="rev_m0">
                REV <?= $subs_m0; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="rev_m1">
                REV <?= $subs_m1; ?>
            </th>
            <th style="border: 1px solid #ccc;background-color: rgb(242, 48, 40);color: white;" id="daily">
                Daily
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($cluster) > 0) { ?>
        <?php $no = 1; ?>
        <?php foreach ($cluster as $row) { ?>
        <tr style="font-size: 8pt;">
            <td><?= $row->region; ?></td>
            <td><?= $row->branch; ?></td>
            <td><?= $row->cluster; ?></td>
            <td><?= str_replace(",", ".", number_format($row->subs_m0, 0)); ?></td>
            <td><?= str_replace(",", ".", number_format($row->subs_m1, 0)); ?></td>
            <td><?= str_replace(",", ".", number_format($row->target, 0)); ?></td>

            <?php if ($row->acv > 0) { ?>
            <td style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->acv, 2)) . "%"; ?>
            </td>
            <?php } else { ?>
            <td style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->acv, 2)) . "%"; ?>
            </td>
            <?php } ?>

            <?php if ($row->drr > 0) { ?>
            <td style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->drr, 2)) . "%"; ?>
            </td>
            <?php } else { ?>
            <td style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->drr, 2)) . "%"; ?>
            </td>
            <?php } ?>

            <?php if ($row->MoM > 0) { ?>
            <td style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->MoM, 2)) . "%"; ?>
            </td>
            <?php } else { ?>
            <td style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->MoM, 2)) . "%"; ?>
            </td>
            <?php } ?>
            <td>
                <?= str_replace(",", ".", number_format($row->taker_subs_m0, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->taker_subs_m1, 0)); ?>
            </td>
            <?php if ($row->Tur_m0 > 0) { ?>
            <td style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
            </td>
            <?php } else { ?>
            <td style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
            </td>
            <?php } ?>

            <?php if ($row->Tur_m1 > 0) { ?>
            <td style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
            </td>
            <?php } else { ?>
            <td style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
            </td>
            <?php } ?>

            <td>
                <?= str_replace(",", ".", number_format($row->rev_subs_m0, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->rev_subs_m1, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->daily, 0)); ?>
            </td>
        </tr>
        <?php } ?>
        <?php } ?>
        <?php foreach ($region as $row) { ?>
        <tr style="font-weight: bold;background-color: rgb(46, 131, 143);color: white;">
            <td colspan="3"><?= $row->region; ?></td>
            <td>
                <?= str_replace(",", ".", number_format($row->subs_m0, 0));; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->subs_m1, 0));; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->target, 0));; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->acv, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->drr, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->MoM, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->taker_subs_m0, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->taker_subs_m1, 0)); ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->rev_subs_m0, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->rev_subs_m1, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->daily, 0)); ?>
            </td>
        </tr>
        <?php } ?>

        <?php foreach ($area as $row) { ?>
        <tr style="font-weight: bold;background-color: rgb(40, 47, 42);color: white;">
            <td colspan="3"><?= $row->region; ?></td>
            <td>
                <?= str_replace(",", ".", number_format($row->subs_m0, 0));; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->subs_m1, 0));; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->target, 0));; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->acv, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->drr, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->MoM, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->taker_subs_m0, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->taker_subs_m1, 0)); ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->rev_subs_m0, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->rev_subs_m1, 0)); ?>
            </td>
            <td>
                <?= str_replace(",", ".", number_format($row->daily, 0)); ?>
            </td>
        </tr>
        <?php } ?>

    </tbody>
</table>

<br>