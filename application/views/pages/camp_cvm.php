<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index.html">Dashboard</a>
            <span class="breadcrumb-item active">Performance CVM</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Performance CVM</h4>
            <p class="mg-b-0">Dashboard cards are used in an overview or summary of CVM.
            </p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pd-x-20 pd-sm-x-30">
        <div class="row pb-1">
            <div class="col-md-9"></div>
            <div class="col-md-3 text-right">
                <h5 for="" class="control-label">Update Last : <span id="lastupdate"><?= $last_date; ?></span>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- card filter -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Pilih Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" name="date_filter_cvm" id="date_filter_cvm"
                                            class="form-control" value="">
                                        <button class="btn btn-sm btn-primary" onclick="filterFullMonthCVM()">
                                            <i class="fa fa-filter"></i>
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card list Region-->
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-white font-weight-bold">Summary Package Performance AREA 1</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row pb-2">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <button class="btn btn-warning btn-sm" onclick="capture_cvm()">
                                        <i class="fa fa-camera"></i>
                                        Capture
                                    </button>
                                    <div class="dropdown bg-success">
                                        <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                            <div
                                                class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                <span class="mg-r-10 tx-13 tx-medium text-white">
                                                    Export File
                                                    <i class="fa fa-download"></i>
                                                </span>

                                                <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu pd-10 wd-200">
                                            <nav class="nav nav-style-1 flex-column">
                                                <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                        class="icon ion-ios-download"></i>
                                                    Export Last Update
                                                </a>
                                                <a href="#"" class=" nav-link" onclick="downloadbyfilterdate()"><i
                                                        class="icon ion-ios-download"></i>
                                                    Export Data Filter
                                                </a>
                                            </nav>
                                        </div><!-- dropdown-menu -->
                                    </div><!-- dropdown -->
                                </div>
                            </div>
                        </div>
                        <div class="row bg-white" id="cvm_table">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sm"
                                        style="width: 100%;background-color: white">
                                        <thead>
                                            <tr class="text-center text-white">
                                                <td class="text-judul bold" rowspan="2"
                                                    style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                    No
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                    class="text-judul bold" rowspan="2">
                                                    Region
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                    class="text-judul bold" rowspan="2">
                                                    Sub Package
                                                </td>
                                                <td class="text-judul bold" colspan="5"
                                                    style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                    Subs (000)
                                                </td>
                                                <td class="text-judul bold"
                                                    style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                    colspan="5">
                                                    TRX (000)
                                                </td>
                                                <td class="text-judul bold"
                                                    style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                    colspan="5">
                                                    Revenue in Bn
                                                </td>
                                                <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                    class="text-judul bold" rowspan="2">
                                                    Detail
                                                </td>
                                            </tr>
                                            <tr class="text-center text-dark" style="font-size: 8pt;">
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="subs_month1">Month 1</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="subs_month2">Month 2</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="subs_month3">Month 3</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                                    M2
                                                </td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                                </td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="trx_month1">Month 1</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="trx_month2">Month 2</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="trx_month3">Month 3</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                                    M2
                                                </td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                                </td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="rev_month1">Month 1</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="rev_month2">Month 2</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                                    id="rev_month3">Month 3</td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                                    M2
                                                </td>
                                                <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="table-list-cvm">

                                            <!--  -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- card list Cluster -->

                <!-- card maintenance -->
                <div class="card bd-0">
                    <div class="card-header bg-dark">
                        <h5 class="text-white font-weight-bold">
                            Cluster Performance
                        </h5>
                        <ul class="nav nav-tabs nav-tabs-for-dark card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link bd-0 active pd-y-8" href="#tab1" data-toggle="tab">
                                    Combo Sakti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab2" data-toggle="tab">
                                    Internet Sakti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab3" data-toggle="tab">
                                    Others
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab4" data-toggle="tab">
                                    Multisim
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab5" data-toggle="tab">
                                    Hot Promo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab6" data-toggle="tab">
                                    Inlife
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab7" data-toggle="tab">
                                    Churn
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab8" data-toggle="tab">
                                    4G
                                </a>
                            </li>
                        </ul>
                    </div><!-- card-header -->
                    <div class="card-body color-gray-lighter bd bd-t-0 rounded-bottom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_combo_sakti()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_combo_sakti">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_combo_sakti">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_combo_sakti">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_combo_sakti">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_combo_sakti">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_combo_sakti">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_combo_sakti">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_combo_sakti">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_combo_sakti">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_combo_sakti">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-combo-sakti">

                                                    <?php if (count($combo) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($combo as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class=" tab-pane" id="tab2">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm"
                                                onclick="capture_cvm_internet_sakti()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_internet_sakti">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_internet_sakti">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_internet_sakti">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_internet_sakti">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_internet_sakti">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_internet_sakti">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_internet_sakti">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_internet_sakti">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_internet_sakti">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_internet_sakti">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-internet-sakti">

                                                    <?php if (count($insak) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($insak as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="tab3">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_others()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_others">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_others">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_others">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_others">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_others">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_others">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_others">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_others">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_others">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_others">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-others">

                                                    <?php if (count($others) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($others as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="tab4">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_multisim()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_multisim">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_multisim">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_multisim">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_multisim">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_multisim">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_multisim">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_multisim">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_multisim">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_multisim">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_multisim">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-multisim">

                                                    <?php if (count($multisim) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($multisim as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="tab5">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_hotpromo()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_hotpromo">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_hotpromo">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_hotpromo">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_hotpromo">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_hotpromo">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_hotpromo">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_hotpromo">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_hotpromo">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_hotpromo">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_hotpromo">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-hotpromo">

                                                    <?php if (count($hotpromo) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($hotpromo as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="tab6">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_inlife()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_inlife">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_inlife">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_inlife">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_inlife">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_inlife">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_inlife">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_inlife">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_inlife">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_inlife">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_inlife">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-inlife">

                                                    <?php if (count($inlife) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($inlife as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="tab7">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_churn()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_churn">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>
                                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Detail
                                                        </td> -->
                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_churn">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_churn">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_churn">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_churn">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_churn">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_churn">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_churn">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_churn">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_churn">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-churn">

                                                    <?php if (count($churn) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($churn as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                            <div class="tab-pane" id="tab8">
                                <div class="row pb-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button class="btn btn-warning btn-sm" onclick="capture_cvm_4g()">
                                                <i class="fa fa-camera"></i>
                                                Capture
                                            </button>
                                            <div class="dropdown bg-success">
                                                <a href="#" class="tx-gray-800 d-inline-block" data-toggle="dropdown">
                                                    <div
                                                        class="ht-35 pd-x-10 bd d-flex align-items-center justify-content-center">
                                                        <span class="mg-r-10 tx-13 tx-medium text-white">
                                                            Export File
                                                            <i class="fa fa-download"></i>
                                                        </span>

                                                        <i class="fa fa-angle-down mg-l-10 text-white"></i>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu pd-10 wd-200">
                                                    <nav class="nav nav-style-1 flex-column">
                                                        <a href="<?= base_url('cvm/export_last') ?>" class="nav-link"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Last Update
                                                        </a>
                                                        <a href="#"" class=" nav-link"
                                                            onclick="downloadbyfilterdate()"><i
                                                                class="icon ion-ios-download"></i>
                                                            Export Data Filter
                                                        </a>
                                                    </nav>
                                                </div><!-- dropdown-menu -->
                                            </div><!-- dropdown -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-white" id="cvm_table_4g">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm"
                                                style="width: 100%;background-color: white">
                                                <thead>
                                                    <tr class="text-center text-white">
                                                        <td class="text-judul bold" rowspan="2"
                                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                                            No
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Region
                                                        </td>
                                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                                            class="text-judul bold" rowspan="2">
                                                            Sub Package
                                                        </td>
                                                        <td class="text-judul bold" colspan="5"
                                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                                            Subs (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            TRX (000)
                                                        </td>
                                                        <td class="text-judul bold"
                                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;"
                                                            colspan="5">
                                                            Revenue in Bn
                                                        </td>

                                                    </tr>
                                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month1_4g">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month2_4g">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="subs_month3_4g">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month1_4g">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month2_4g">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="trx_month3_4g">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month1_4g">
                                                            <?= $date2; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month2_4g">
                                                            <?= $date1; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul" id="rev_month3_4g">
                                                            <?= $last_date; ?>
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                            M2
                                                        </td>
                                                        <td style="background-color: rgb(230, 217, 204);"
                                                            class="text-judul">MoM
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-list-cvm-4g">

                                                    <?php if (count($fourG) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($fourG as $row) { ?>
                                                    <tr style="font-size: 9pt;">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->clsuter; ?></td>
                                                        <td><?= $row->paket; ?></td>
                                                        <td><?= $row->subs2; ?></td>
                                                        <td><?= $row->subs1; ?></td>
                                                        <td><?= $row->subs0; ?></td>
                                                        <?php if ($row->MoM_M2_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_Subs . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_Subs < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_Subs . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->trx2; ?></td>
                                                        <td><?= $row->trx1; ?></td>
                                                        <td><?= $row->trx0; ?></td>
                                                        <?php if ($row->MoM_M2_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_trx . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_trx < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_trx . "%"; ?></td>
                                                        <?php } ?>
                                                        <td><?= $row->rev_m2; ?></td>
                                                        <td><?= $row->rev_m1; ?></td>
                                                        <td><?= $row->rev_m0; ?></td>
                                                        <?php if ($row->MoM_M2_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_M2_rev . "%"; ?></td>
                                                        <?php } ?>

                                                        <?php if ($row->MoM_rev < 0) { ?>
                                                        <td
                                                            style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } else { ?>

                                                        <td style="background-color: rgb(201, 246, 153);">
                                                            <?= $row->MoM_rev . "%"; ?></td>
                                                        <?php } ?>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab-pane -->
                        </div><!-- tab-content -->
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
    </div><!-- br-pagebody -->
    <footer class="br-footer">
        <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; 2023. Campaign Area 1. PT Telekomunikasi Seluler
                (Telkomsel).</div>
        </div>
    </footer>
</div><!-- br-mainpanel -->



<!-- Modal Detail-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"
                    id="staticBackdropLabel">Detail Performance City CVM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row pb-2">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-warning btn-sm" onclick="capture_detail_cvm()">
                            <i class="fa fa-camera"></i>
                            Capture Image
                        </button>
                    </div>
                </div>
                <div class="row" id="cvm_table_detail">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm"
                                style="width: 100%;background-color: white;">
                                <thead>
                                    <tr class="text-center text-white">
                                        <td class="text-judul bold" rowspan="2"
                                            style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;">
                                            No
                                        </td>
                                        <td style="vertical-align : middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                            class="text-judul bold" rowspan="2">
                                            Region
                                        </td>
                                        <td style="vertical-align : middle;text-align:center;width: 100px;background-color: rgb(48, 45, 58);font-size: 8pt;"
                                            class="text-judul bold" rowspan="2">
                                            Sub Package
                                        </td>
                                        <td class="text-judul bold" colspan="5"
                                            style="background-color: rgb(114, 116, 60);font-size: 7pt;">
                                            Subs (000)
                                        </td>
                                        <td class="text-judul bold"
                                            style="background-color: rgb(69, 129, 79);font-size: 7pt;" colspan="5">
                                            TRX (000)
                                        </td>
                                        <td class="text-judul bold"
                                            style="background-color: rgb(175, 129, 79);font-size: 7pt;" colspan="5">
                                            Revenue in Bn
                                        </td>
                                        <!-- <td style="vertical-align:middle;text-align:center;background-color: rgb(48, 45, 58);font-size: 7pt;"
                                            class="text-judul bold" rowspan="2">
                                            Detail
                                        </td> -->
                                    </tr>
                                    <tr class="text-center text-dark" style="font-size: 8pt;">
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="subs_month1_detail">Month 1</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="subs_month2_detail">Month 2</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="subs_month3_detail">Month 3</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM M2
                                        </td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                        </td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="trx_month1_detail">Month 1</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="trx_month2_detail">Month 2</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="trx_month3_detail">Month 3</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM M2
                                        </td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                        </td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="rev_month1_detail">Month 1</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="rev_month2_detail">Month 2</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul"
                                            id="rev_month3_detail">Month 3</td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM M2
                                        </td>
                                        <td style="background-color: rgb(230, 217, 204);" class="text-judul">MoM
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="table-detail-cvm">

                                    <!--  -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-info">Submit</button> -->
            </div>
        </div>
    </div>
</div>
<!-- End Modal Detail -->