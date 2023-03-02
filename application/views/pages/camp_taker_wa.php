<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index.html">Dashboard</a>
            <span class="breadcrumb-item active">Performance Taker Channel WA</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Performance Taker Channel (WhatsApp)</h4>
            <p class="mg-b-0">Overview or summary of Channel WhatsApp Whitelist Taker All Region.
            </p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pd-x-20 pd-sm-x-30">
        <div class="row pb-2">
            <div class="col-md-9"></div>
            <div class="col-md-3 text-right">
                <h5 for="">Update Last : <?= $last_update; ?> </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-2">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="date" name="date_filter" id="date_filter" class="form-control"
                                        onchange="filter_taker_wa()" placeholder="Filter Date">
                                    <div class="dropdown bg-info">
                                        <a href="" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                            <div
                                                class="ht-45 pd-x-20 bd d-flex align-items-center justify-content-center">
                                                <span class="mg-r-10 tx-13 tx-medium text-white">
                                                    Options
                                                    <i class="fa fa-cog"></i>
                                                </span>

                                                <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu pd-10 wd-200">
                                            <nav class="nav nav-style-1 flex-column">
                                                <a href="<?= base_url('campaign/download_last_update_wa_manual') ?>"
                                                    class="nav-link"><i class="icon ion-ios-download"></i>
                                                    Export Data Last
                                                </a>
                                                <a href="#"" class=" nav-link" onclick="dowload_file_taker_wa()"><i
                                                        class="icon ion-ios-download"></i>
                                                    Export Data Filter
                                                </a>
                                            </nav>
                                        </div><!-- dropdown-menu -->
                                    </div><!-- dropdown -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered responsive table-hover" id="wa_channel">
                                        <thead>
                                            <tr
                                                style="background-color: rgb(161, 2, 2);font-size: 12pt;font-weight: bold;color: white;text-align: center;">
                                                <th class="bg-light">Region</th>
                                                <th class="bg-light">Branch</th>
                                                <th class="bg-light">Cluster</th>
                                                <th class="bg-primary text-white">
                                                    Insak
                                                </th>
                                                <th class="bg-primary text-white">
                                                    Taker
                                                </th>
                                                <th class="bg-primary text-white">
                                                    Revenue
                                                </th>
                                                <th class="bg-primary text-white">
                                                    %
                                                </th>
                                                <th class="bg-info text-white">
                                                    Comsak
                                                </th>
                                                <th class="bg-info text-white">
                                                    Taker
                                                </th>
                                                <th class="bg-info text-white">
                                                    Revenue
                                                </th>
                                                <th class="bg-info text-white">
                                                    %
                                                </th>
                                                <th class="bg-success text-white">
                                                    Hot Promo
                                                </th>
                                                <th class="bg-success text-white">
                                                    Taker
                                                </th>
                                                <th class="bg-success text-white">
                                                    Revenue
                                                </th>
                                                <th class="bg-success text-white">
                                                    %
                                                </th>
                                                <th class="bg-danger text-white">
                                                    Digital
                                                </th>
                                                <th class="bg-danger text-white">
                                                    Taker
                                                </th>
                                                <th class="bg-danger text-white">
                                                    Revenue
                                                </th>
                                                <th class="bg-danger text-white">
                                                    %
                                                </th>
                                                <th class="bg-dark text-white">
                                                    Suprise Deal
                                                </th>
                                                <th class="bg-dark text-white">
                                                    Taker
                                                </th>
                                                <th class="bg-dark text-white">
                                                    Revenue
                                                </th>
                                                <th class="bg-dark text-white">
                                                    %
                                                </th>
                                                <th class="bg-info text-white">
                                                    Voice
                                                </th>
                                                <th class="bg-info text-white">
                                                    Taker
                                                </th>
                                                <th class="bg-info text-white">
                                                    Revenue
                                                </th>
                                                <th class="bg-info text-white">
                                                    %
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_taker_wa">
                                            <?php if (count($cluster) > 0) { ?>
                                            <?php foreach ($cluster as $row) { ?>
                                            <?php
                                                    $total_wl = $row->insak_wl + $row->comsak_wl + $row->hotpromo_wl + $row->digital_wl + $row->suprise_deal_wl + $row->voice_wl;
                                                    $percent_insak = ($row->insak_wl / $total_wl) * 100;
                                                    $percent_comsak = ($row->comsak_wl / $total_wl) * 100;
                                                    $percent_hotpromo = ($row->hotpromo_wl / $total_wl) * 100;
                                                    $percent_digital = ($row->digital_wl / $total_wl) * 100;
                                                    $percent_suprise_deal_wl = ($row->suprise_deal_wl / $total_wl) * 100;
                                                    $percent_voice_wl = ($row->voice_wl / $total_wl) * 100;
                                                    if ($row->digital_wl == null) {
                                                        $digital = 0;
                                                    } else {
                                                        $digital = str_replace(',', '.', number_format($row->digital_wl, 0));
                                                    }

                                                    if ($row->voice_wl == null) {
                                                        $voice = 0;
                                                    } else {
                                                        $voice = str_replace(',', '.', number_format($row->voice_wl, 0));
                                                    }

                                                    if ($row->suprise_deal_wl == null) {
                                                        $suprise_deal = 0;
                                                    } else {
                                                        $suprise_deal = str_replace(',', '.', number_format($row->suprise_deal_wl, 0));
                                                    }


                                                    if ($row->insak_wl == null) {
                                                        $insak = 0;
                                                    } else {
                                                        $insak = str_replace(',', '.', number_format($row->insak_wl, 0));
                                                    }

                                                    if ($row->insak_taker == null) {
                                                        $insak_taker = 0;
                                                    } else {
                                                        $insak_taker = str_replace(',', '.', number_format($row->insak_taker, 0));
                                                    }

                                                    if ($row->rev_insak == null) {
                                                        $rev_insak = 0;
                                                    } else {
                                                        $rev_insak = str_replace(',', '.', number_format($row->rev_insak, 0));
                                                    }

                                                    ?>
                                            <tr style="font-size: 9pt;text-align: center;">
                                                <td><?= $row->region; ?></td>
                                                <td><?= $row->branch; ?></td>
                                                <td><?= $row->cluster; ?></td>
                                                <td>
                                                    <?= $insak ?>
                                                </td>
                                                <td>
                                                    <?= $insak_taker ?>
                                                </td>
                                                <td>
                                                    <?= $rev_insak ?>
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
                                                    <?= $digital ?>
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
                                                    <?= $suprise_deal ?>
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
                                                    <?= $voice ?>
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

                                            <!-- Region -->
                                            <?php foreach ($region as $row) { ?>
                                            <?php

                                                $total_wl = $row->insak_wl + $row->comsak_wl + $row->hotpromo_wl + $row->digital_wl + $row->suprise_deal_wl + $row->voice_wl;
                                                $percent_insak = ($row->insak_wl / $total_wl) * 100;
                                                $percent_comsak = ($row->comsak_wl / $total_wl) * 100;
                                                $percent_hotpromo = ($row->hotpromo_wl / $total_wl) * 100;
                                                $percent_digital = ($row->digital_wl / $total_wl) * 100;
                                                $percent_suprise_deal_wl = ($row->suprise_deal_wl / $total_wl) * 100;
                                                $percent_voice_wl = ($row->voice_wl / $total_wl) * 100;
                                                ?>
                                            <tr
                                                style="font-weight: bold;background-color: rgb(46, 131, 143);color: white;">
                                                <td colspan="3"><?= $row->region; ?></td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->insak_wl, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->insak_taker, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->rev_insak, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= number_format($percent_insak, 2) . "%" ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->comsak_wl, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->comsak_taker, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->rev_comsak, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= number_format($percent_comsak, 2) . "%" ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->hotpromo_wl, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->hotpromo_taker, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->rev_hotpromo, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= number_format($percent_hotpromo, 2) . "%" ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->digital_wl, 0)); ?>
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
                                                    <?= str_replace(",", ".", number_format($row->suprise_deal_wl, 0)); ?>
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
                                                    <?= str_replace(",", ".", number_format($row->voice_wl, 0)); ?>
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

                                            <!-- Area -->
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
                                            <tr
                                                style="font-weight: bold;background-color: rgb(4, 59, 76);color: white;">
                                                <td colspan="3"><?= $row->region; ?></td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->insak_wl, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->insak_taker, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->rev_insak, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= number_format($percent_insak, 2) . "%" ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->comsak_wl, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->comsak_taker, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->rev_comsak, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= number_format($percent_comsak, 2) . "%" ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->hotpromo_wl, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->hotpromo_taker, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->rev_hotpromo, 0)); ?>
                                                </td>
                                                <td>
                                                    <?= number_format($percent_hotpromo, 2) . "%" ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(",", ".", number_format($row->digital_wl, 0)); ?>
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
                                                    <?= str_replace(",", ".", number_format($row->suprise_deal_wl, 0)); ?>
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
                                                    <?= str_replace(",", ".", number_format($row->voice_wl, 0)); ?>
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- br-pagebody -->
    <footer class=" br-footer">
        <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; 2023. Campaign Area 1. PT
                Telekomunikasi Seluler (Telkomsel).</div>
        </div>
    </footer>
</div><!-- br-mainpanel -->