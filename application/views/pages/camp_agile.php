<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index.html">Dashboard</a>
            <span class="breadcrumb-item active">Taker Agile</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Taker Agile</h4>
            <p class="mg-b-0"> cards are used in submittion of whitelist and check Takered.
            </p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pd-x-20 pd-sm-x-30">
        <div class="row">
            <div class="col-md-12 text-right">
                <span>
                    Update Data raw_bba_daily_region to
                    <h6 id="date_bba"><?= $date_bba; ?></h6>
                    <button class="btn btn-sm btn-warning" type="button" onclick="check_file_taker()">
                        <i class="fa fa-eye"></i>
                    </button>
                </span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <ul class="nav nav-tabs nav-tabs-for-dark card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link bd-0 active pd-y-8" href="#tab1" data-toggle="tab">
                                    Summary
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bd-0 tx-gray-light" href="#tab2" data-toggle="tab">
                                    Input Whitelist
                                </a>
                            </li>
                        </ul>
                    </div><!-- card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Summary -->
                            <div class="tab-pane active" id="tab1">
                                <div class="table-responsive">
                                    <table id="table-summary-agile"
                                        class="table display responsive nowrap table-hover table-bordered">
                                        <thead class="bg-info">
                                            <tr>
                                                <th class="text-white text-center">No</th>
                                                <th class="text-white">Region</th>
                                                <th class="text-white">Channel</th>
                                                <th class="text-white">Program</th>
                                                <th class="text-white">Subs</th>
                                                <th class="text-white">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-summary-agile-tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Inputan WL -->
                            <div class="tab-pane" id="tab2">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <p class="tx-14 mg-b-10">Filter Program dan Periode Campaign</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-md btn-primary" onclick="tambah_data_target()">
                                            <i class="fa fa-plus"></i>
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="input-group">
                                            <select name="program_filter" id="program_filter" class="form-control">
                                                <option value="">Pilih Program</option>
                                                <option value="All">All</option>
                                                <option value="Winback_YYN_Comsak_-_Non_Insak">Winback YYN Comsak - Non
                                                    Insak
                                                </option>
                                                <option value="Winback_YYN_Insak">Winback YYN Insak</option>
                                                <option value="Stimulate_NNN_Sakti">Stimulate NNN Sakti</option>
                                                <option value="Core_Lapser">Core Lapser</option>
                                                <option value="Core_Downgrade_Consistent">Core Downgrade Consistent
                                                </option>
                                                <option value="Core_Retention">Core Retention</option>
                                                <option value="Lapser_HP_Non_Taker">Lapser HP Non Taker</option>
                                                <option value="USIM_No_Pack">USIM No Pack</option>
                                                <option value="Prepaid_Churn_High_Prospensity">Prepaid Churn High
                                                    Prospensity
                                                </option>
                                                <option value="Uplift_LVC_to_HVC">Uplift LVC to HVC</option>
                                                <option value="Winback_Lapser_HVC">Winback Lapser HVC</option>
                                                <option value="HVC_Prevention">HVC Prevention</option>
                                                <option value="Multisim">Multisim</option>
                                            </select>
                                            <select class="form-control" name="month_filter" id="month_filter">
                                                <option value="">Pilih Periode Bulan</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                            <button class="btn btn-md btn-dark" onclick="filter_program()">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                            <div class="dropdown dropleft">
                                                <button class="btn btn-md btn-success dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-download"></i>
                                                </button>
                                                <div class="dropdown-menu text-left"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#"
                                                        onclick="download_all_taker_file_complex()">
                                                        Dowload File Taker Complex
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="download_all_taker_file_pivot()">
                                                        Download File Taker Pivot
                                                    </a>
                                                </div>
                                            </div>
                                            <button class="btn btn-md btn-primary" onclick="DroptoTable()">
                                                <i class="fa fa-database"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="table-agile" class="table display responsive nowrap"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#Aksi</th>
                                                        <th>No</th>
                                                        <th>Program</th>
                                                        <th>Campaign Date</th>
                                                        <th>File Upload</th>
                                                        <th>File Taker</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (count($rowUpload) > 0) { ?>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($rowUpload as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="button-group">
                                                                <button class="btn btn-sm btn-danger"
                                                                    onclick="delete_taker('<?= $row->id; ?>', '<?= $row->program; ?>', '<?= $row->campaign_date; ?>', '<?= $row->file_taker1; ?>', '<?= $row->file_taker2; ?>', '<?= $row->file_upload; ?>')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-sm btn-success dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        <i class="fa fa-download"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item"
                                                                            href="<?= base_url('campaign_dev2/download_file_all/' . $row->file_taker1) ?>">
                                                                            Dowload Taker Complex
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="<?= base_url('campaign_dev2/download_file_all/' . $row->file_taker2) ?>">
                                                                            Download Taker Pivot
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-sm btn-primary"
                                                                    onclick="show_modal_data_agile('<?= $row->file_taker2; ?>', '<?= $row->program; ?>', '<?= $row->campaign_date; ?>')">
                                                                    <i class="fa fa-th"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-dark"
                                                                    onclick="insert_database_data('<?= $row->file_taker2; ?>')">
                                                                    <i class="fa fa-database"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-purple"
                                                                    onclick="CheckUlangtaker('<?= $row->id; ?>', '<?= $row->campaign_date; ?>', '<?= $row->program; ?>')">
                                                                    <i class="fa fa-cog"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?= $no++; ?>
                                                        </td>
                                                        <td><?= $row->program; ?></td>
                                                        <td>
                                                            <?= $row->campaign_date; ?>
                                                        </td>
                                                        <td>
                                                            <a href=""><?= $row->file_upload; ?></a>
                                                        </td>
                                                        <td>
                                                            <a href=""><?= $row->file_taker1; ?></a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
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
            </div>
        </div>
    </div><!-- br-pagebody -->
    <footer class="br-footer">
        <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; 2023. Campaign Area 1. PT Telekomunikasi Seluler (Telkomsel).</div>
        </div>
    </footer>
</div><!-- br-mainpanel -->


<!-- Modal Tambah -->
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="my-modal-title">Upload Whitelist</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form_agile" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center bg-light">
                                <input type="file" name="file-3" id="file-3" class="inputfile"
                                    data-multiple-caption="{count} files selected" multiple>
                                <label for="file-3" class="if-style-1 if-primary">
                                    <div class="icon-wrapper">
                                        <i class="icon ion-ios-upload-outline"></i>
                                    </div><!-- icon-wrapper -->
                                    <span>Choose a file</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">Campaign Date</label>
                                <input type="date" name="campaign_date" id="campaign_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Program Agile</label>
                                <select name="program" id="program" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="Winback YYN Comsak - Non Insak">Winback YYN Comsak - Non Insak
                                    </option>
                                    <option value="Winback YYN Insak">Winback YYN Insak</option>
                                    <option value="Stimulate NNN Sakti">Stimulate NNN Sakti</option>
                                    <option value="Core Lapser">Core Lapser</option>
                                    <option value="Core Downgrade Consistent">Core Downgrade Consistent</option>
                                    <option value="Core Retention">Core Retention</option>
                                    <option value="Lapser HP Non Taker">Lapser HP Non Taker</option>
                                    <option value="USIM No Pack">USIM No Pack</option>
                                    <option value="Prepaid Churn High Prospensity">Prepaid Churn High Prospensity
                                    </option>
                                    <option value="Uplift LVC to HVC">Uplift LVC to HVC</option>
                                    <option value="Winback Lapser HVC">Winback Lapser HVC</option>
                                    <option value="HVC Prevention">HVC Prevention</option>
                                    <option value="Multisim">Multisim</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-dark button-prevent" onclick="simpan_data_agile()">
                            <i class="fa fa-save hide-text"></i>
                            <span class="hide-text">Simpan Data</span>
                            <div class="spinner" style="display: none;">
                                <img src="<?= base_url() ?>public/assets/img/loading_2.gif" alt=""
                                    style="width: 15%;height: 15%;">
                                Loading..
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show Data -->
<div id="my-modal-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="my-modal-title">Row Program Taker </h5><br>
                        <h6 class="modal-title" id="my-modal-title">Program : <span id="list-program"></span></h6><br>
                        <h6 class="modal-title" id="my-modal-title">Campaign Date : <span
                                id="list-campaign-date"></span></h6>
                        <br>
                        <h6 class="modal-title" id="my-modal-title">FileName : <span id="list-filename"></span></h6>
                    </div>
                </div>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row row-sm mg-t-20">
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        My Telkomsel
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="my-tsel">0</p>
                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        UMB
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="umb">0</p>

                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        PES and CMS
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="pes">0</p>

                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        URP Modern Channel
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="urp">0</p>

                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        MKios
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="mkios">0</p>

                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        DESC
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="desc">0</p>

                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <div class="mg-l-20">
                                    <p class="tx-15 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-10">
                                        OThers
                                    </p>
                                    <p class="tx-15 tx-inverse tx-lato tx-black mg-b-0 lh-1" id="others">0</p>

                                </div>
                            </div>
                            <div id="ch5" class="ht-20 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <div class="row pt-5">
                    <div class="col-md-12">
                        <div class="card pb-2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered responsive table-hover" id="table-list-region"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>REGION</th>
                                                <th>CHANNEL</th>
                                                <th>REVENUE</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered responsive table-hover" id="table-list-progam"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>MSISDN</th>
                                                <th>REGION</th>
                                                <th>CITY</th>
                                                <th>CHANNEL NEW</th>
                                                <th>REVENUE</th>
                                                <th>TRX DATE</th>
                                                <th>PROGRAM</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                Footer
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal bba  -->
<div id="my-modal-bba" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title text-white" id="my-modal-title">Info Folder Sumber BBA</h5><br>
                    </div>
                </div>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="datatable2" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($file_bba as $file) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $file; ?></td>
                                        <td><?= filesize($folder . "/" . $file) . " bytes"; ?></td>
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
<!-- Modal File Check Taker -->


<!-- Modal Loading Check Ulang -->
<div id="my-modal-loading" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group text-right">
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <img style="width: 100%;height: 80%;" src="<?= base_url() ?>public/assets/img/load2.gif"
                                alt="">
                            <h6>Loading . . .</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->