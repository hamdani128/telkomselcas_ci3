<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Dashboard</a>
            <span class="breadcrumb-item active">Performance Taker All Channel</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Performance Taker All Channel</h4>
            <p class="mg-b-0">Overview or summary of All Channel Whitelist Taker All Region.
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
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="date" name="date_filter" id="date_filter" class="form-control"
                                        onchange="filtertakerallchannerl()" placeholder="Filter Date">
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
                                                <a href="<?= base_url('campaign/download_all_channel_last') ?>"
                                                    class="nav-link"><i class="icon ion-ios-download"></i>
                                                    Export Data Last
                                                </a>
                                                <a href="#"" class=" nav-link" onclick="download_file_all_channel()"><i
                                                        class="icon ion-ios-download"></i>
                                                    Export Data Filter
                                                </a>
                                            </nav>
                                        </div><!-- dropdown-menu -->
                                    </div><!-- dropdown -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered responsive table-hover" id="wa_channel">
                                        <thead style="font-size: 8pt;text-align: center;">
                                            <tr>
                                                <th rowspan="2" class="bg-light">Region</th>
                                                <th rowspan="2" class="bg-light">Branch</th>
                                                <th rowspan="2" class="bg-light">Cluster</th>
                                                <th class="bg-dark text-white" colspan="2">
                                                    Campaign Submission by Managed Tools
                                                </th>
                                                <th class="bg-danger text-white" colspan="11">
                                                    Campaign Performance
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="bg-dark text-white" id="m0"><?= $subs_m0; ?></th>
                                                <th class="bg-dark text-white" id="m1"><?= $subs_m1; ?></th>
                                                <th class="bg-danger text-white">Target</th>
                                                <th class="bg-danger text-white">Acv(%)</th>
                                                <th class="bg-danger text-white">DRR</th>
                                                <th class="bg-danger text-white">MoM</th>
                                                <th class="bg-danger text-white" id="taker_m0">Taker <?= $subs_m0; ?>
                                                </th>
                                                <th class="bg-danger text-white" id="taker_m1">Taker <?= $subs_m1; ?>
                                                </th>
                                                <th class="bg-danger text-white" id="tur_m0">TUR <?= $subs_m0; ?></th>
                                                <th class="bg-danger text-white" id="tur_m1">TUR <?= $subs_m1; ?></th>
                                                <th class="bg-danger text-white" id="rev_m0">REV <?= $subs_m0; ?></th>
                                                <th class="bg-danger text-white" id="rev_m1">REV <?= $subs_m1; ?></th>
                                                <th class="bg-danger text-white" id="daily">Daily</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_taker_all_channel">
                                            <?php if (count($cluster) > 0) { ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($cluster as $row) { ?>
                                            <tr style="font-size: 8pt;">
                                                <td><?= $row->region; ?></td>
                                                <td><?= $row->branch; ?></td>
                                                <td><?= $row->cluster; ?></td>
                                                <td><?= $row->subs_m0 ?></td>
                                                <td><?= $row->subs_m1 ?></td>
                                                <td><?= $row->target  ?></td>

                                                <?php if ($row->acv > 0) { ?>
                                                <td
                                                    style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->acv, 2)) . "%"; ?>
                                                </td>
                                                <?php } else { ?>
                                                <td
                                                    style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->acv, 2)) . "%"; ?>
                                                </td>
                                                <?php } ?>

                                                <?php if ($row->drr > 0) { ?>
                                                <td
                                                    style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->drr, 2)) . "%"; ?>
                                                </td>
                                                <?php } else { ?>
                                                <td
                                                    style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->drr, 2)) . "%"; ?>
                                                </td>
                                                <?php } ?>

                                                <?php if ($row->MoM > 0) { ?>
                                                <td
                                                    style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->MoM, 2)) . "%"; ?>
                                                </td>
                                                <?php } else { ?>
                                                <td
                                                    style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->MoM, 2)) . "%"; ?>
                                                </td>
                                                <?php } ?>
                                                <td>
                                                    <?= $row->taker_subs_m0 ?>
                                                </td>
                                                <td>
                                                    <?= $row->taker_subs_m1 ?>
                                                </td>
                                                <?php if ($row->Tur_m0 > 0) { ?>
                                                <td
                                                    style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
                                                </td>
                                                <?php } else { ?>
                                                <td
                                                    style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
                                                </td>
                                                <?php } ?>

                                                <?php if ($row->Tur_m1 > 0) { ?>
                                                <td
                                                    style="background-color:rgb(102,223,139);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
                                                </td>
                                                <?php } else { ?>
                                                <td
                                                    style="background-color:rgb(223, 106, 102);font-weight: bold;color: black;">
                                                    <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
                                                </td>
                                                <?php } ?>

                                                <td>
                                                    <?= $row->rev_subs_m0 ?>
                                                </td>
                                                <td>
                                                    <?= $row->rev_subs_m1 ?>
                                                </td>
                                                <td>
                                                    <?= $row->daily ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php foreach ($region as $row) { ?>
                                            <tr
                                                style="font-weight: bold;background-color: cornflowerblue;color: white;">
                                                <td colspan="3"><?= $row->region; ?></td>
                                                <td>
                                                    <?= $row->subs_m0 ?>
                                                </td>
                                                <td>
                                                    <?= $row->subs_m1 ?>
                                                </td>
                                                <td>
                                                    <?= $row->target ?>
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
                                                    <?= $row->taker_subs_m0 ?>
                                                </td>
                                                <td>
                                                    <?= $row->taker_subs_m1 ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%"; ?>
                                                </td>
                                                <td>
                                                    <?= str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%"; ?>
                                                </td>
                                                <td>
                                                    <?= $row->rev_subs_m0 ?>
                                                </td>
                                                <td>
                                                    <?= $row->rev_subs_m1 ?>
                                                </td>
                                                <td>
                                                    <?= $row->daily ?>
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