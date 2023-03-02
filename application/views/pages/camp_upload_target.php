<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index.html">Dashboard</a>
            <span class="breadcrumb-item active">Upload Target</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Upload Target Submittion Campaign</h4>
            <p class="mg-b-0"> cards are used in submittion of summary of whitelist target.
            </p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody pd-x-20 pd-sm-x-30">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-md btn-primary" onclick="tambah_data_target()">
                                    <i class="fa fa-plus"></i>
                                    Tambah Target
                                </button>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="datatable1" class="table display responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Region</th>
                                                <th>Branch</th>
                                                <th>Cluster</th>
                                                <th>Periode</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
                <h5 class="modal-title text-white" id="my-modal-title">Import Data Target</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center bg-light">
                            <input type="file" name="file-3[]" id="file-3" class="inputfile"
                                data-multiple-caption="{count} files selected" multiple>
                            <label for="file-3" class="if-style-1 if-primary">
                                <div class="icon-wrapper">
                                    <i class="icon ion-ios-upload-outline"></i>
                                </div><!-- icon-wrapper -->
                                <span>Choose a file</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="">Periode Upload</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-dark" onclick="simpan_data_target_wl()">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>