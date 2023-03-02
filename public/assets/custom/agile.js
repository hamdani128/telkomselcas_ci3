function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost' || location.host == '10.32.18.206') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

$(function () {
    'use strict';
    $('#table-agile').DataTable();
    $('#datatable2').DataTable();
    // $('#table-summary-agile').DataTable();
});
load_summary_agile();


$(function () {
    'use strict';

    $('.inputfile').each(function () {
        var $input = $(this),
            $label = $input.next('label'),
            labelVal = $label.html();

        $input.on('change', function (e) {
            var fileName = '';

            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else if (e.target.value)
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                $label.find('span').html(fileName);
            else
                $label.html(labelVal);
        });

        // Firefox bug fix
        $input
            .on('focus', function () { $input.addClass('has-focus'); })
            .on('blur', function () { $input.removeClass('has-focus'); });
    });

});

function load_summary_agile() {
    var tbody = document.getElementById("table-summary-agile-tbody");
    $.ajax({
        url: base_url('campaign_dev2/getdata_summary_agile'),
        type: 'GET',
        dataType: "json",
        success: function (data) {
            if (data.status == 'success') {
                var tr = '';
                for (var i in data.agile) {
                    tr += `<tr>
                        <td align="center">${data.agile[i].no}</td>
                        <td>${data.agile[i].region}</td>
                        <td>${data.agile[i].channel}</td>
                        <td>${data.agile[i].program}</td>
                        <td>${data.agile[i].subs}</td>
                        <td>${data.agile[i].rev}</td>
                    </tr>`;
                }
                tbody.innerHTML = tr;
            } else if (data.status == "empty") {
                tbody.innerHTML = '<tr><td colspan="6" align="center"><h3>No Record Found.</h3></td></tr>'
            }
        }
    });
}


function simpan_data_agile() {
    var formupload = document.getElementById("form_agile");
    var campaign_date = $("#campaign_date").val();
    var program = $("#program").val();
    var date_bba = document.getElementById("date_bba").innerText;
    if (campaign_date == "" || program == "") {
        Swal.fire({
            icon: 'warning',
            title: 'alert',
            text: 'Wajib Mengisi Field Yang Sudah Tersedia !'
        });
    } else if (campaign_date > date_bba) {
        Swal.fire({
            icon: 'warning',
            title: 'alert',
            text: 'Pengecekan Taker Anda Tidak Bisa Dilakukan Karena Melampaui Data Tanggal Row Daily BBA, Anda Wajib Melakukan Penecekkan Taker Dibawah Tanggal Yang Telah Diinformasikan !'
        });
    } else {
        $('.button-prevent').attr('disabled', 'true');
        $('.spinner').show();
        $('.hide-text').hide();
        var formdata = new FormData(formupload);
        $.ajax({
            url: base_url('campaign_dev2/check_taker'),
            method: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Pengecekkan Telah Berhasil Silahkan Cek Hasilnya !'
                    });
                }
            }
        });
    }
}


function show_modal_data_agile(file, program, campaign_date) {
    var table = $('#table-list-progam').DataTable();
    table.destroy();
    table = $('#table-list-progam').DataTable({
        ajax: {
            url: base_url('campaign_dev2/list_data_taker/' + file),
            dataSrc: "",
        },
        columns: [
            { "data": "msisdn" },
            { "data": "region" },
            { "data": "city" },
            { "data": "channel" },
            { "data": "revenue" },
            { "data": "trx_date" },
            { "data": "program" },
        ],
    });
    var table2 = $('#table-list-region').DataTable();
    table2.destroy();
    table2 = $('#table-list-region').DataTable({
        ajax: {
            url: base_url('campaign_dev2/filtergroup2/' + file),
            dataSrc: "",
        },
        columns: [
            { "data": "region" },
            { "data": "channel" },
            { "data": "revenue" },
        ],
    });
    $.ajax({
        url: base_url('campaign_dev2/summary/' + file),
        dataType: "json",
        success: function (data) {

            if (data.MyTelkomsel == "" || data.MyTelkomsel == undefined) {
                document.getElementById("my-tsel").innerText = 0;
            } else {
                document.getElementById("my-tsel").innerText = data.MyTelkomsel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            if (data.URPModernChannel == "" || data.URPModernChannel == undefined) {
                document.getElementById("urp").innerText = 0;
            } else {
                document.getElementById("urp").innerText = data.URPModernChannel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            if (data.UMB == "" || data.UMB == undefined) {
                document.getElementById("umb").innerText = 0;
            } else {
                document.getElementById("umb").innerText = data.UMB.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            if (data.PESCMS == "" || data.PESCMS == undefined) {
                document.getElementById("pes").innerText = 0;
            } else {
                document.getElementById("pes").innerText = data.PESCMS.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            if (data.MKIOS == "" || data.MKIOS == undefined) {
                document.getElementById("mkios").innerText = 0;
            } else {
                document.getElementById("mkios").innerText = data.MKIOS.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            if (data.DSC == "" || data.DSC == undefined) {
                document.getElementById("desc").innerText = 0;
            } else {
                document.getElementById("desc").innerText = data.DSC.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            if (data.Others == "" || data.Others == undefined) {
                document.getElementById("others").innerText = 0;
            } else {
                document.getElementById("others").innerText = data.DSC.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        }
    });

    document.getElementById("list-program").innerText = program;
    document.getElementById("list-campaign-date").innerText = campaign_date;
    document.getElementById("list-filename").innerText = file;


    $("#my-modal-data").modal('show');
}

function delete_taker(id, program, campaign_date, file1, file2, file_upload) {
    Swal.fire({
        title: 'Apakah Anda ingin Menghapus Data Taker Program ' + program + ' Dengan Campaign Tanggal ' + campaign_date + ' ?',
        text: "Data Pegawai akan diaktifkan !",
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url('campaign_dev2/delete_data_taker'),
                type: 'POST',
                data: {
                    id: id,
                    file1: file1,
                    file2: file2,
                    file_upload: file_upload,
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        Swal.fire(
                            'Good Luck !',
                            'Data Berhasil Terhapus !',
                            'success'
                        )
                        window.location.reload();
                    }
                }
            });
        }
    });
}


function filter_program() {
    var program = $("#program_filter").val();
    var bulan = $("#month_filter").val();
    if (program == "" || bulan == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Jangan Lupa , Wajib Memilih Field Filter yang Sudah Tersedia !'
        });
    } else {
        var table = $('#table-agile').DataTable();
        table.destroy();
        table = $('#table-agile').DataTable({
            ajax: {
                url: base_url('campaign_dev2/agile_data/' + program + '/' + bulan),
                dataSrc: "",
            },
            columns: [
                { "data": "action" },
                { "data": "no" },
                { "data": "program" },
                { "data": "campaign_date" },
                { "data": "file_upload" },
                { "data": "file_taker" },
            ],
        });
    }
}

function download_all_taker_file_pivot() {
    var program = $("#program_filter").val();
    var bulan = $("#month_filter").val();
    if (program == "" || bulan == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Jangan Lupa , Wajib Memilih Field Filter yang Sudah Tersedia !'
        });
    } else {
        document.location.href = base_url('campaign_dev2/agile_data_download/' + program + '/' + bulan + '');
    }
}

function download_all_taker_file_complex() {
    var program = $("#program_filter").val();
    var bulan = $("#month_filter").val();
    if (program == "" || bulan == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Jangan Lupa , Wajib Memilih Field Filter yang Sudah Tersedia !'
        });
    } else {
        document.location.href = base_url('campaign_dev2/agile_data_download_csv/' + program + '/' + bulan + '');
    }
}

function insert_database_data(file_taker) {
    $.ajax({
        url: base_url('campaign_dev2/insert_database'),
        type: 'POST',
        data: {
            file_taker: file_taker,
        },
        dataType: "json",
        success: function (data) {
            if (data.status === 'any') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Alert Info!',
                    text: 'Data Sudah Pernah Tersimpan Row Table !'
                });
            } else if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Good Job !',
                    text: 'Row Data Berhasil Disimpan ke Table !'
                });
            }
        }
    });
}


function check_file_taker() {
    $("#my-modal-bba").modal('show');
}

function download_file_txt_from_filter() {
    var table = document.getElementById("table-agile");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i];
        var createClickHandler = function (row) {
            return function () {
                var cell = row.getElementsByTagName("td")[5];
                var file_taker = cell.innerHTML;
                document.location.href = base_url('campaign_dev2/download_file_all/' + file_taker);
            };
        };
        currentRow.onclick = createClickHandler(currentRow);
    }
}

function download_file_csv_from_filter() {
    var table = document.getElementById("table-agile");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i];
        var createClickHandler = function (row) {
            return function () {
                var cell1 = row.getElementsByTagName("td")[2];
                var cell2 = row.getElementsByTagName("td")[3];
                var program = cell1.innerHTML;
                var campaign_date = cell2.innerHTML;
                $.ajax({
                    url: base_url('campaign_dev2/download_file_all_filter'),
                    type: 'POST',
                    data: {
                        program: program,
                        campaign_date: campaign_date,
                    },
                    dataType: "json",
                    success: function (data) {
                    }
                });
                // document.location.href = base_url('campaign_dev2/download_file_all_filter/' + program + '/' + campaign_date);
            };
        };
        currentRow.onclick = createClickHandler(currentRow);
    }
}


function show_modal_data_agile_from_filter() {
    var table = document.getElementById("table-agile");
    var rows = table.getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table.rows[i];
        var createClickHandler = function (row) {
            return function () {
                var cell1 = row.getElementsByTagName("td")[2];
                var cell2 = row.getElementsByTagName("td")[3];
                var program = cell1.innerHTML;
                var campaign_date = cell2.innerHTML;

            };
        };
        currentRow.onclick = createClickHandler(currentRow);
    }
}

function CheckUlangtaker(id, campaign_date, program) {

    Swal.fire({
        title: 'Apakah Anda ingin Melakukakan Pengecekan Ulang Taker Dengan Program ' + program + ' Dengan Campaign Tanggal ' + campaign_date + ' ?',
        text: "Data Pengecek Akan Diproses dan Diharapkan menunggu Sampai Pesan Notifikasi disampaikan !",
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Check Ulang !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $("#my-modal-loading").modal("show");
            $.ajax({
                url: base_url('campaign_dev2/check_ulang_taker'),
                type: 'POST',
                data: {
                    id: id,
                    program: program,
                    campaign_date: campaign_date,
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('#my-modal-loading').modal('hide');
                        Swal.fire(
                            'Good Luck !',
                            'Data Berhasil Berhasil Dicek Ulang !',
                            'success'
                        )
                        window.location.reload();
                    }
                }
            });
        }
    });
}