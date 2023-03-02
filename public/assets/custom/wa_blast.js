function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost' || location.host == '10.32.18.206') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

function filter_taker() {
    var mulai = $("#date_start").val();
    var sampai = $("#date_end").val();

    var cmb_program = document.getElementById("program_filter");
    var cmb_program_text = cmb_program.options[cmb_program.selectedIndex].text;
    var cmb_program_value = cmb_program.options[cmb_program.selectedIndex].value;

    var cmb_channel = document.getElementById("channel_filter");
    var cmb_channel_text = cmb_channel.options[cmb_channel.selectedIndex].text;
    var cmb_channel_value = cmb_channel.options[cmb_channel.selectedIndex].value;

    if (
        cmb_channel_value === "" &&
        cmb_program_value === "" &&
        mulai === "" &&
        sampai === ""
    ) {
        $.ajax({
            url: "../panel/aksi.php?aksi=modul_log_filter_taker",
            type: "GET",
            data: {
                log_action: "Filter Taker Check All Data",
                log_name: "Filter All Taker Wa Blast",
            },
        });

        $.ajax({
            url: "../panel/aksi.php?aksi=filter_taker_all",
            success: function (data) {
                $("#table-list-taker").empty();
                $("#table-list-taker").append(data);
            },
        });
        $.ajax({
            url: "../panel/aksi.php?aksi=filter_taker_region_all",
            success: function (data) {
                $("#table-list-taker-region").empty();
                $("#table-list-taker-region").append(data);
            },
        });
    } else if (
        cmb_channel_value === "" &&
        cmb_program_value === "" &&
        mulai !== "" &&
        sampai !== ""
    ) {
        // Arae By Date
        $.ajax({
            url: "../panel/aksi.php?aksi=filter_taker_cluster_date",
            data: {
                mulai: mulai,
                sampai: sampai,
            },
            success: function (data) {
                $("#table-list-taker").empty();
                $("#table-list-taker").append(data);
            },
        });

        // Region By Date
        $.ajax({
            url: "../panel/aksi.php?aksi=filter_taker_region_date",
            data: {
                mulai: mulai,
                sampai: sampai,
            },
            success: function (data) {
                $("#table-list-taker-region").empty();
                $("#table-list-taker-region").append(data);
            },
        });
    } else if (
        cmb_channel_value !== "" &&
        cmb_program_value !== "" &&
        mulai !== "" &&
        sampai !== ""
    ) {
        $.ajax({
            url: "../panel/aksi.php?aksi=modul_log_filter_taker",
            type: "GET",
            data: {
                log_action: "Filter " +
                    cmb_channel_value +
                    "_" +
                    cmb_program_value +
                    "_" +
                    mulai +
                    "_" +
                    sampai,
                log_name: "Filter Taker Wa Blast",
            },
        });

        $.ajax({
            url: "../panel/aksi.php?aksi=filter_taker",
            data: {
                mulai: mulai,
                sampai: sampai,
                program: cmb_program_text,
                channel: cmb_channel_text,
            },
            success: function (data) {
                $("#table-list-taker").empty();
                $("#table-list-taker").append(data);
            },
        });

        // Tetap
        $.ajax({
            url: "../panel/aksi.php?aksi=filter_taker_region",
            data: {
                mulai: mulai,
                sampai: sampai,
                program: cmb_program_text,
                channel: cmb_channel_text,
            },
            success: function (data) {
                $("#table-list-taker-region").empty();
                $("#table-list-taker-region").append(data);
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "Filter Field Harus Terisi Semua !",
        });
    }
}

function filter_taker_all() {
    document.getElementById('date_start').value = '';
    document.getElementById('date_end').value = '';
    document.getElementById("program_filter").value = '';
    document.getElementById("channel_filter").value = '';
    $.ajax({
        url: "../panel/aksi.php?aksi=modul_log_filter_taker",
        type: "GET",
        data: {
            log_action: "Filter Taker Check All Data",
            log_name: "Filter All Taker Wa Blast",
        },
    });
    $.ajax({
        url: "../panel/aksi.php?aksi=filter_taker_all",
        success: function (data) {
            $("#table-list-taker").empty();
            $("#table-list-taker").append(data);
        },
    });
    $.ajax({
        url: "../panel/aksi.php?aksi=filter_taker_region_all",
        success: function (data) {
            $("#table-list-taker-region").empty();
            $("#table-list-taker-region").append(data);
        },
    });
}

filter_taker_all();

function export_excel_taker() {
    var mulai = $("#date_start").val();
    var sampai = $("#date_end").val();
    var cmb_program = document.getElementById("program_filter");
    var cmb_program_text = cmb_program.options[cmb_program.selectedIndex].text;
    var cmb_program_value = cmb_program.options[cmb_program.selectedIndex].value;
    var cmb_channel = document.getElementById("channel_filter");
    var cmb_channel_text = cmb_channel.options[cmb_channel.selectedIndex].text;
    var cmb_channel_value = cmb_channel.options[cmb_channel.selectedIndex].value;

    if (
        cmb_channel_value === "" &&
        cmb_program_value === "" &&
        mulai === "" &&
        sampai === ""
    ) {
        document.location.href = "../pages/ekspor_taker.php";
    } else if (
        cmb_channel_value === "" &&
        cmb_program_value === "" &&
        mulai !== "" &&
        sampai !== ""
    ) {
        document.location.href =
            "../pages/ekspor_taker_filter_date.php?start=" + mulai + "&end=" + sampai;
    } else if (
        cmb_channel_value !== "" &&
        cmb_program_value !== "" &&
        mulai !== "" &&
        sampai !== ""
    ) {
        document.location.href =
            "../pages/ekspor_filter_taker.php?program=" +
            cmb_program_text +
            "&channel=" +
            cmb_channel_text +
            "&start=" +
            mulai +
            "&end=" +
            sampai;
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "Filter Field Harus Terisi Semua !",
        });
    }
}

function export_png_taker() {
    html2canvas($("#table2area"), {
        onrendered: function (canvas) {
            var saveAs = function (uri, filename) {
                var link = document.createElement("a");
                if (typeof link.download === "string") {
                    document.body.appendChild(link); // Firefox requires the link to be in the body
                    link.download = filename;
                    link.href = uri;
                    link.click();
                    document.body.removeChild(link); // remove the link when done
                } else {
                    location.replace(uri);
                }
            };
            var img = canvas.toDataURL("image/png"),
                uri = img.replace(/^data:image\/[^;]/, "data:application/octet-stream");

            saveAs(uri, "TakerCluster.png");
        },
    });
    html2canvas($("#table-area"), {
        onrendered: function (canvas) {
            var saveAs = function (uri, filename) {
                var link = document.createElement("a");
                if (typeof link.download === "string") {
                    document.body.appendChild(link); // Firefox requires the link to be in the body
                    link.download = filename;
                    link.href = uri;
                    link.click();
                    document.body.removeChild(link); // remove the link when done
                } else {
                    location.replace(uri);
                }
            };

            var img = canvas.toDataURL("image/png"),
                uri = img.replace(/^data:image\/[^;]/, "data:application/octet-stream");

            saveAs(uri, "TakerReagionArea.png");
        },
    });
}

function export_pdf_taker() {
    var mulai = $("#date_start").val();
    var sampai = $("#date_end").val();
    var cmb_program = document.getElementById("program_filter");
    var cmb_program_text = cmb_program.options[cmb_program.selectedIndex].text;
    var cmb_program_value = cmb_program.options[cmb_program.selectedIndex].value;
    var cmb_channel = document.getElementById("channel_filter");
    var cmb_channel_text = cmb_channel.options[cmb_channel.selectedIndex].text;
    var cmb_channel_value = cmb_channel.options[cmb_channel.selectedIndex].value;

    if (
        cmb_channel_value === "" ||
        cmb_program_value === "" ||
        mulai === "" ||
        sampai === ""
    ) {
        document.location.href = "../panel/pages/ekspor_pdf.php";
    } else if (
        cmb_channel_value !== "" ||
        cmb_program_value !== "" ||
        mulai !== "" ||
        sampai !== ""
    ) {
        document.location.href =
            "../panel/pages/ekspor_pdf.php?program=" +
            cmb_program_text +
            "&channel=" +
            cmb_channel_text +
            "&start=" +
            mulai +
            "&end=" +
            sampai;
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "Filter Field Harus Terisi Semua !",
        });
    }
}

function filter_taker_wa() {
    var date_value = $("#date_filter").val();
    $.ajax({
        url: base_url('campaign/taker_wa_filter'),
        method: "POST",
        data: {
            date_filter: date_value,
        },
        dataType: "JSON",
        success: function (data) {
            var tbody = document.getElementById('tbody_taker_wa');
            tbody.innerHTML = '<tr><td colspan="27" align="center"><h3>No Record Found.</h3></td></tr>'
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="27" align="center"><h3>No Record Found.</h3></td></tr>'
            } else {
                var tr = '';
                for (var i in data) {
                    tr += `<tr>
                    <td style="font-size: 9pt;text-align: center;">${data[i].region}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].branch}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].cluster}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].insak_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].insak_taker}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].rev_insak}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].percent_insak}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].comsak_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].comsak_taker}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].rev_comsak}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].percent_comsak}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].hotpromo_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].hotpromo_taker}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].rev_hotpromo_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].percent_hotpromo}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].digital_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">0</td>
                    <td style="font-size: 9pt;text-align: center;">0</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].percent_digital}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].suprise_deal_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">0</td>
                    <td style="font-size: 9pt;text-align: center;">0</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].percent_suprise_deal}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].voice_wl}</td>
                    <td style="font-size: 9pt;text-align: center;">0</td>
                    <td style="font-size: 9pt;text-align: center;">0</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].percent_voice}</td>
                </tr>`;
                }
                tbody.innerHTML = tr;
            }
        },
    });
}

function dowload_file_taker_wa() {
    var date_filter = $("#date_filter").val();
    if (date_filter == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Notification',
            text: 'Harap Jangan Lupa memilih Tanggal Filter !'
        });
    } else {
        document.location.href = base_url('campaign/download_last_update_wa_manual_filter/' + date_filter);
    }
}
