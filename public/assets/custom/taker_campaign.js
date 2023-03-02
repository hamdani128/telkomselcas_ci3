function SummaryUpdateWLofMonth() {
    var utc = new Date().toJSON().slice(0, 10).replace(/-/g, '-');
    summaryWL(utc);
}

// SummaryUpdateWLofMonth();

function PeriodeSummary() {
    var cmb_periode_value = doc
    alert(cmb_periode_value);
}

function summaryWL(tgl) {
    // alert(tgl);
    $.ajax({
        url: "../panel/taker_campaign.php?aksi=summarywl",
        type: "POST",
        data: {
            tgl: tgl,
        },
        dataType: "JSON",
        success: function (data) {
            // alert(data.total_comsak)
            document.getElementById("tot_wl").innerHTML = new Intl.NumberFormat().format(data.total_comsak)
            document.getElementById("tot_wl_hot_promo").innerHTML = new Intl.NumberFormat().format(data.total_hotpromo)
            document.getElementById("tot_wl_insak").innerHTML = new Intl.NumberFormat().format(data.total_insak)
            document.getElementById("tot_wl_comsak_taker").innerHTML = new Intl.NumberFormat().format(data.total_comsak_taker)
            document.getElementById("tot_wl_hot_promo_taker").innerHTML = new Intl.NumberFormat().format(data.total_hotpromo_taker)
            document.getElementById("tot_wl_insak_taker").innerHTML = new Intl.NumberFormat().format(data.total_insak_taker)
            document.getElementById("tot_wl_comsak_non_taker").innerHTML = new Intl.NumberFormat().format(data.total_comsak_non_taker)
            document.getElementById("tot_wl_hot_promo_non_taker").innerHTML = new Intl.NumberFormat().format(data.total_hotpromo_non_taker)
            document.getElementById("tot_wl_insak_non_taker").innerHTML = new Intl.NumberFormat().format(data.total_insak_non_taker)
        }
    });
}


function download_file_msisdn(file_msisdn) {
    window.open("file_msisdn&file=" + file_msisdn);
}

function download_file_cektaker(file_taker) {
    window.open("../panel/taker_campaign.php?aksi=file_taker&file=" + file_taker);
}

function render_load_data(kategori, file_taker) {
    if (kategori == 'Sumbagut') {
        $("#sumbagut_detail").modal("show");
        var tbody = document.getElementById('datatable-detail-taker');
        tbody.innerHTML = '<tr><td colspan="20" align="center"><h7><img src="../assets/images/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'
        $.ajax({
            url: "../panel/taker_campaign.php?aksi=file_load&file=" + file_taker + "&region=" + kategori,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if (data['empty']) {
                    tbody.innerHTML = '<tr><td colspan="20" align="center"><h3>No Record Found.</h3></td></tr>'
                } else {
                    var tr = '';
                    var a = 1;
                    var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                    for (var i in data) {

                    }
                    tbody.innerHTML = tr;
                }
            },
        });
    }

}


function filter_date_taker_campaign() {
    var date_taker = $("#date_taker").val();
    var tbody = document.getElementById('table-list-taker');
    $.ajax({
        url: "../panel/taker_campaign.php?aksi=filter_report",
        type: "POST",
        data: {
            date_taker: date_taker,
        },
        dataType: "json",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="12" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                tbody.innerHTML = '';
                var tr = '';
                var a = 1;
                for (var i in data) {
                    tr += `<tr style="text-align:right;font-size: 8pt;">
                                <td style="text-align: center;">${a++}</td>
                                <td>
                                    <a href="#"
                                        onclick="download_file_msisdn('${data[i].file_msisdn}')"
                                        class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <svg width="25" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.1221 15.436L12.1221 3.39502"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                                <path
                                                    d="M15.0381 12.5083L12.1221 15.4363L9.20609 12.5083"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                                <path
                                                    d="M16.7551 8.12793H17.6881C19.7231 8.12793 21.3721 9.77693 21.3721 11.8129V16.6969C21.3721 18.7269 19.7271 20.3719 17.6971 20.3719L6.55707 20.3719C4.52207 20.3719 2.87207 18.7219 2.87207 16.6869V11.8019C2.87207 9.77293 4.51807 8.12793 6.54707 8.12793L7.48907 8.12793"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                        </svg>
                                    </a>
                                    <button class="btn btn-sm btn-info"
                                            onclick="download_file_cektaker('${data[i].file_taker}')">
                                            <svg width="25" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.1221 15.436L12.1221 3.39502"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path
                                                        d="M15.0381 12.5083L12.1221 15.4363L9.20609 12.5083"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path
                                                        d="M16.7551 8.12793H17.6881C19.7231 8.12793 21.3721 9.77693 21.3721 11.8129V16.6969C21.3721 18.7269 19.7271 20.3719 17.6971 20.3719L6.55707 20.3719C4.52207 20.3719 2.87207 18.7219 2.87207 16.6869V11.8019C2.87207 9.77293 4.51807 8.12793 6.54707 8.12793L7.48907 8.12793"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                            </svg>
                                    </button>
                                    <button class="btn btn-sm btn-dark"
                                        onclick="render_load_data('${data[i].kategori}', '${data[i].file_taker}')">
                                        <svg width="25" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.33 16.5928H4.0293"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M13.1406 6.90042H19.4413"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.72629 6.84625C8.72629 5.5506 7.66813 4.5 6.36314 4.5C5.05816 4.5 4 5.5506 4 6.84625C4 8.14191 5.05816 9.19251 6.36314 9.19251C7.66813 9.19251 8.72629 8.14191 8.72629 6.84625Z"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M20.0002 16.5538C20.0002 15.2581 18.9429 14.2075 17.6379 14.2075C16.3321 14.2075 15.2739 15.2581 15.2739 16.5538C15.2739 17.8494 16.3321 18.9 17.6379 18.9C18.9429 18.9 20.0002 17.8494 20.0002 16.5538Z"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                                <td style="text-align: center;">${data[i].periode}</td>
                                <td style="text-align: center;">${data[i].region}</td>
                                <td style="text-align: center;">${data[i].kategori}</td>
                                <td style="text-align: left;">${data[i].file_msisdn}</td>
                                <td style="text-align: left;">${data[i].file_taker}</td>
                                <td style="text-align: center;">${data[i].total_whitelist}</td>
                                <td style="text-align: center;">${data[i].taker_whitelist}</td>
                                <td style="text-align: center;">${data[i].non_taker_whitelist}</td>
                                <td style="text-align: center;">${data[i].revenu}</td>
                                <td style="text-align: center;">${((data[i].taker_whitelist / data[i].total_whitelist) * 100).toFixed(2) + "%"}</td>
                        </tr>`;
                }
                tbody.innerHTML = tr;
            }
        },
    });
}


