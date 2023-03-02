<script src="<?= base_url() ?>public/assets/lib/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="<?= base_url() ?>public/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/peity/jquery.peity.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/rickshaw/vendor/d3.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/rickshaw/vendor/d3.layout.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/rickshaw/rickshaw.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/timepicker/jquery.timepicker.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/spectrum-colorpicker/spectrum.js"></script>
<script src="<?= base_url() ?>public/assets/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
<script src="<?= base_url() ?>public/assets/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/ion-rangeslider/js/ion.rangeSlider.min.js"></script>


<!-- datatabel -->
<script src="<?= base_url() ?>public/assets/lib/highlightjs/highlight.pack.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/assets/lib/select2/js/select2.min.js"></script>

<script src="<?= base_url() ?>public/assets/js/bracket.js"></script>
<script src="<?= base_url() ?>public/assets/js/ResizeSensor.js"></script>
<script src="<?= base_url() ?>public/assets/js/widgets.js"></script>
<script src="<?= base_url() ?>public/assets/js/tooltip-colored.js"></script>
<script src="<?= base_url() ?>public/assets/js/popover-colored.js"></script>


<!-- SweetAlert -->
<script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.js"></script>
<script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.all.js"></script>
<script src="<?= base_url() ?>public/assets/sweetalert/sweetalert2.all.min.js"></script>
<!-- custom -->
<script src="<?= base_url() ?>public/assets/custom/html2canvas.js"></script>
<script src="<?= base_url() ?>public/assets/custom/cvm.js"></script>
<script src="<?= base_url() ?>public/assets/custom/wa_blast.js"></script>
<script src="<?= base_url() ?>public/assets/custom/target_wl.js"></script>
<script src="<?= base_url() ?>public/assets/custom/agile.js"></script>
<!-- <script src="<?= base_url() ?>public/assets/custom/scrip2.js"></script> -->
<script src="<?= base_url() ?>public/assets/custom/channel_all.js"></script>
<!-- <script src="<?= base_url() ?>public/assets/custom/upload.js"></script> -->

<script>
$(function() {
    'use strict'

    // FOR DEMO ONLY
    // menu collapsed by default during first page load or refresh with screen
    // having a size between 992px and 1199px. This is intended on this page only
    // for better viewing of widgets demo.
    $(window).resize(function() {
        minimizeMenu();
    });

    minimizeMenu();

    function minimizeMenu() {
        if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1199px)')
            .matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
        } else if (window.matchMedia('(min-width: 1200px)').matches && !$('body').hasClass(
                'collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
        }
    }

    // $('#wa_channel').DataTable({
    //     bLengthChange: false,
    //     searching: false,
    //     responsive: true
    // });
});
</script>
</body>

</html>