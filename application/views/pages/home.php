<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="<?= base_url('home') ?>">Dashboard</a>
            <span class="breadcrumb-item active">Home</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Dasboard Campaign Analytic Sumatera (CAS)</h4>
            <p class="mg-b-0">Dashboard cards are used in an overview or summary of a campaign Analytic.
            </p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pd-x-20 pd-sm-x-30">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="height: 50px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title">Top Line Product CVM | Area 1</h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <span><?= date('d F Y', strtotime($lastdate)) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters widget-1 shadow-base">
            <?php foreach ($cvm as $row) { ?>
            <div class="col-sm-6 col-lg-3 mg-t-1 mg-sm-t-0">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">CVM | <?= $row->paket; ?></h6>
                        <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                    </div><!-- card-header -->
                    <div class="card-body">
                        <span class="peity-bar"
                            data-peity='{ "fill": ["#17A2B8","#6F42C1","#1CAF9A","#0866C6"], "height": 50, "width": 80 }'>10,5,7,4,6,5,8,4,5</span>
                        <span class="tx-small tx-inverse tx-10" style="font-size: 12pt;"><?= $row->subs; ?><small>
                                (subs)</small></span>
                    </div><!-- card-body -->
                    <div class="card-footer">
                        <div>
                            <span class="tx-11">subs (000)</span>
                            <h6 class="tx-inverse"><?= $row->subs; ?></h6>
                        </div>
                        <div>
                            <span class="tx-11">Trx (000)</span>
                            <h6 class="tx-inverse"><?= $row->trx; ?></h6>
                        </div>
                        <div>
                            <span class="tx-11">Revenue in Bn</span>
                            <h6 class="tx-success"><?= $row->rev; ?></h6>
                        </div>
                    </div><!-- card-footer -->
                </div><!-- card -->
            </div>
            <?php } ?>
        </div><!-- row -->





    </div><!-- br-pagebody -->
    <footer class="br-footer">
        <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; 2023. Campaign Area 1. PT Telekomunikasi Seluler (Telkomsel).</div>
        </div>
    </footer>
</div><!-- br-mainpanel -->