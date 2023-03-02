var URL = "http://localhost/cas/public";

function ambilId(file) {
    return document.getElementById(file);
}

function addbox() {
    var x = document.getElementById("belum_tersedia");
    var y = document.getElementById("tersedia");
    var check1 = document.getElementById("Check");
    var check2 = document.getElementById("Check2");
    if (check1.checked == true) {
        x.style.display = "block";
        y.style.display = "none";
    } else if (check2.checked == true) {
        y.style.display = "block";
        x.style.display = "none";
    }
}

function addbox_update() {
    var x = document.getElementById("belum_tersedia_update");
    var y = document.getElementById("tersedia_update");
    var check1 = document.getElementById("sudah_check");
    var check2 = document.getElementById("belom_check");
    if (check2.checked == true) {
        x.style.display = "block";
        y.style.display = "none";
    } else if (check1.checked == true) {
        y.style.display = "block";
        x.style.display = "none";
    }
}

function addbox_eksequtor_campaign() {
    var x = document.getElementById("cakupan");
    var prepaid = document.getElementById("area_prepaid");
    var postpaid = document.getElementById("area_postpaid");
    if (prepaid.checked == true) {
        x.style.display = "none";
        x.style.display = "block";
    } else if (postpaid.checked == true) {
        x.style.display = "none";
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function addbox_eksequtor_campaign_update() {
    var x = document.getElementById("cakupan_update");
    var prepaid = document.getElementById("area_prepaid_update");
    var postpaid = document.getElementById("area_postpaid_update");
    if (prepaid.checked == true) {
        x.style.display = "none";
        x.style.display = "block";
    } else if (postpaid.checked == true) {
        x.style.display = "none";
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function addbox_agile() {
    var x = document.getElementById("agile_program");
    var agile = document.getElementById("agile");
    if (agile.checked == true) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function addbox_agile_update() {
    var x = document.getElementById("agile_program_update");
    var agile = document.getElementById("agile_update");
    if (agile.checked == true) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function simpan_request() {
    var target = document.getElementById("wording");
    // const oFile = document.getElementById('berkas').files[0].size / 1024;
    var batas_karakter = 160;
    if (target.value.length >= batas_karakter) {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "Wording Anda Melebihi Batas Karakter !",
        });
    } else {
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda Ingin Mengirim Data ini ?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Kirim",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                $("#process").css("display", "block");
                document.getElementById("view_request").submit(function () {
                    $.ajax({
                        type: frm.attr("method"),
                        url: frm.attr("action"),
                        data: frm.serialize(),
                    });
                });
            }
        });
    }
}

function progress_bar_process(percentage, timer) {
    $(".progress-bar").css("width", percentage + "%");
    if (percentage > 100) {
        clearInterval(timer);
        $("#view_request")[0].reset();
        $("#process").css("display", "none");
        $(".progress-bar").css("width", "0%");
        $("#save").attr("disabled", false);
        $("#success_message").html(
            "<div class='alert alert-success'>Data Saved</div>"
        );
        setTimeout(function () {
            $("#success_message").html("");
        }, 5000);
    }
}

function delete_request(status, uniq_id) {
    if (status == "Approve") {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf Action Anda Tidak Bisa Dilakukan",
            text: "Validasi Approval Sudah Dilakukan !",
        });
    } else {
        Swal.fire({
            title: "Apakah Anda Yakin Data Akan dihapus ?",
            text: "Data Yang Telah Terhapus Tidak Bisa Dikembalikan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                var act = "../panel/aksi.php?aksi=delete_request&uniq_id=" + uniq_id;
                document.location.href = act;
            }
        });
    }
}

function Pesan_success() {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    });
}

function update_request_show(id, status) {
    if (status == "Approve") {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf Action Anda Tidak Bisa Dilakukan",
            text: "Validasi Approval Sudah Dilakukan !",
        });
    } else {
        var postURL = "../panel/aksi.php?aksi=show_request_update";
        $.ajax({
            url: postURL,
            method: "GET",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (data) {
                var x = document.getElementById("cakupan_update");
                var y = document.getElementById("agile_program_update");
                var a = document.getElementById("tersedia_update");
                var b = document.getElementById("belum_tersedia_update");
                $("#warning").modal("show");
                $(".modal-body #id_update").val(id);
                $(".modal-body #camp_name_update").val(data[0]);
                if (data[1] == "Area-Prepaid Campaign") {
                    $(".modal-body #area_prepaid_update").prop("checked", true);
                    x.style.display = "block";

                    if (data[2] === "Prepaid Sumatera") {
                        $(".modal-body #Area1").prop("checked", true);
                    } else if (data[2] === "Prepaid Sumbagut") {
                        $(".modal-body #sumbagut").prop("checked", true);
                    } else if (data[2] === "Prepaid Sumbagteng") {
                        $(".modal-body #sumbagteng").prop("checked", true);
                    } else if (data[2] === "Prepaid Sumbagsel") {
                        $(".modal-body #sumbagsel").prop("checked", true);
                    } else {
                        x.style.display = "block";
                        $(".modal-body #Area1").prop("checked", false);
                        $(".modal-body #sumbagut").prop("checked", false);
                        $(".modal-body #sumbagteng").prop("checked", false);
                        $(".modal-body #sumbagsel").prop("checked", false);
                    }
                } else if (data[1] == "Area-Postpaid Campaign") {
                    $(".modal-body #area_postpaid_update").prop("checked", true);
                    x.style.display = "block";
                    if (data[2] === "Postpaid Sumatera") {
                        $(".modal-body #Area1").prop("checked", true);
                    } else if (data[2] === "Postpaid Sumbagut") {
                        $(".modal-body #sumbagut").prop("checked", true);
                    } else if (data[2] === "Postpaid Sumbagteng") {
                        $(".modal-body #sumbagteng").prop("checked", true);
                    } else if (data[2] === "Postpaid Sumbagsel") {
                        $(".modal-body #sumbagsel").prop("checked", true);
                    } else {
                        x.style.display = "none";
                        $(".modal-body #Area1").prop("checked", false);
                        $(".modal-body #sumbagut").prop("checked", false);
                        $(".modal-body #sumbagteng").prop("checked", false);
                        $(".modal-body #sumbagsel").prop("checked", false);
                    }
                } else if (data[1] == "Sumbagut") {
                    $(".modal-body #sumbagut_update").prop("checked", true);
                    x.style.display = "none";
                } else if (data[1] == "Sumbagteng") {
                    $(".modal-body #sumbagteng_update").prop("checked", true);
                    x.style.display = "none";
                } else if (data[1] == "Sumbagsel") {
                    $(".modal-body #sumbagsel_update").prop("checked", true);
                    x.style.display = "none";
                }

                if (data[3] === "Broadband") {
                    $(".modal-body #broadband_update").prop("checked", true);
                } else if (data[3] === "Digital") {
                    $(".modal-body #digital_update").prop("checked", true);
                } else if (data[3] === "Voice") {
                    $(".modal-body #voice_update").prop("checked", true);
                } else if (data[3] === "Loyalty") {
                    $(".modal-body #loyalty_update").prop("checked", true);
                } else if (data[3] === "Information") {
                    $(".modal-body #information_update").prop("checked", true);
                }

                if (data[4] === "Agile") {
                    $(".modal-body #agile_update").prop("checked", true);
                    y.style.display = "block";

                    if (data[5] === "C1") {
                        $(".modal-body #C1_update").prop("checked", true);
                    } else if (data[5] === "C2") {
                        $(".modal-body #C2_update").prop("checked", true);
                    } else if (data[5] === "C3") {
                        $(".modal-body #C3_update").prop("checked", true);
                    } else if (data[5] === "C4") {
                        $(".modal-body #C4_update").prop("checked", true);
                    } else if (data[5] === "M1") {
                        $(".modal-body #M1_update").prop("checked", true);
                    } else if (data[5] === "M2") {
                        $(".modal-body #M2_update").prop("checked", true);
                    } else if (data[5] === "M3") {
                        $(".modal-body #M3_update").prop("checked", true);
                    } else if (data[5] === "V1") {
                        $(".modal-body #V1_update").prop("checked", true);
                    } else if (data[5] === "S1") {
                        $(".modal-body #S1_update").prop("checked", true);
                    } else if (data[5] === "S2") {
                        $(".modal-body #S2_update").prop("checked", true);
                    } else if (data[5] === "S3") {
                        $(".modal-body #S3_update").prop("checked", true);
                    } else if (data[5] === "U1") {
                        $(".modal-body #U1_update").prop("checked", true);
                    } else if (data[5] === "L1") {
                        $(".modal-body #L1_update").prop("checked", true);
                    } else if (data[5] === "D1") {
                        $(".modal-body #D1_update").prop("checked", true);
                    } else if (data[5] === "P1") {
                        $(".modal-body #P1_update").prop("checked", true);
                    } else if (data[5] === "P2") {
                        $(".modal-body #P2_update").prop("checked", true);
                    } else if (data[5] === "P3") {
                        $(".modal-body #P3_update").prop("checked", true);
                    } else if (data[5] === "P4") {
                        $(".modal-body #P4_update").prop("checked", true);
                    } else if (data[5] === "P5") {
                        $(".modal-body #P5_update").prop("checked", true);
                    }
                } else {
                    $(".modal-body #non_agile_update").prop("checked", true);
                    y.style.display = "none";
                }

                if (data[6] === "BID") {
                    $(".modal-body #BID_update").prop("checked", true);
                } else if (data[6] === "Content ID") {
                    $(".modal-body #Content_ID_update").prop("checked", true);
                } else {
                    $(".modal-body #Offer_id_update").prop("checked", true);
                }

                $(".modal-body #detail_identitas_id_update").val(data[7]);
                $(".modal-body #broadcast_update").val(data[8]);
                $(".modal-body #wording_update").val(data[9]);

                if (data[10] === "Belum Tersedia") {
                    $(".modal-body #belom_check").prop("checked", true);
                    b.style.display = "block";
                    a.style.display = "none";

                    $(".modal-body #total_wl_update").val("");

                    $(".modal-body #arpu_update").val(data[13]);
                    $(".modal-body #los_update").val(data[14]);

                    if (data[15] === "Yes") {
                        $(".modal-body #data_user_yes_update").prop("checked", true);
                    } else {
                        $(".modal-body #data_user_no_update").prop("checked", true);
                    }

                    if (data[16] === "Yes") {
                        $(".modal-body #voice_yes_update").prop("checked", true);
                    } else {
                        $(".modal-body #voice_no_update").prop("checked", true);
                    }

                    $(".modal-body #lokasi_update").val(data[17]);
                    $(".modal-body #taker_package_update").val(data[18]);
                    $(".modal-body #kriteria_wl_update").val(data[19]);
                } else if (data[10] === "Sudah Tersedia") {
                    $(".modal-body #sudah_check").prop("checked", true);
                    a.style.display = "block";
                    b.style.display = "none";
                    $(".modal-body #total_wl_update").val(data[12]);
                    $(".modal-body .custom-file-input")
                        .addClass("selected")
                        .html(data[11]);

                    $(".modal-body #arpu_update").val("");
                    $(".modal-body #los_update").val("");

                    $(".modal-body #data_user_yes_update").prop("checked", false);
                    $(".modal-body #data_user_no_update").prop("checked", false);
                    $(".modal-body #voice_yes_update").prop("checked", false);
                    $(".modal-body #voice_no_update").prop("checked", false);
                    $(".modal-body #lokasi_update").val("");
                    $(".modal-body #taker_package_update").val("");
                    $(".modal-body #kriteria_wl_update").val("");
                }

                $(".modal-body #uniq_id_update").val(data[20]);
            },
        });
        // $('#warning').modal('show');
    }
}

function update_request() {
    document.getElementById("update_send_request").submit();
}

function upload_simpan() {
    var cmb_cluster = document.getElementById("cluster");
    var cmb_cluster_text = cmb_cluster.options[cmb_cluster.selectedIndex].text;
    var cmb_cluster_value = cmb_cluster.options[cmb_cluster.selectedIndex].value;

    var cmb_nama_program = document.getElementById("nama_program");
    var cmb_nama_program_text =
        cmb_nama_program.options[cmb_nama_program.selectedIndex].text;
    var cmb_nama_program_value =
        cmb_nama_program.options[cmb_nama_program.selectedIndex].value;
    var tanggal_campaign = $("#tgl_campaign").val();
    var file_upload = $("#file_upload").val();
    var note = $("#note").val();

    if (cmb_cluster_value === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa pilih Cluster",
        });
    } else if (cmb_nama_program_value === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa pilih Nama Program",
        });
    } else if (tanggal_campaign === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa pilih tanggal program",
        });
    } else if (file_upload === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa File Upload Anda",
        });
    } else {
        Swal.fire({
            title: "Apakah Anda Yakin ingin Menyimpan Data ini?",
            text: "Proses !",
            icon: "Quetion",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it Submit!",
        }).then((result) => {
            if (result.value) {
                $("#loading_wl_upload").css("display", "block");
                document.getElementById("management-upload-add").submit(function () {
                    $.ajax({
                        type: frm.attr("method"),
                        url: frm.attr("action"),
                        data: frm.serialize(),
                    });
                });
            }
        });
    }
}

function managemen_upload_filter() {
    var cmb_cluster = document.getElementById("cluster_filter");
    var cmb_cluster_text = cmb_cluster.options[cmb_cluster.selectedIndex].text;
    var cmb_cluster_value = cmb_cluster.options[cmb_cluster.selectedIndex].value;
    var cmb_porgram = document.getElementById("program_filter");
    var cmb_program_text = cmb_porgram.options[cmb_porgram.selectedIndex].text;
    var cmb_program_value = cmb_porgram.options[cmb_porgram.selectedIndex].value;
    var date_filter = $("#date_filter").val();

    if (cmb_cluster_value === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Pilih Cluster",
        });
    } else if (cmb_program_value === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Pilih Program",
        });
    } else if (date_filter === "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Tentukan Tanggal",
        });
    } else {
        $.ajax({
            url: "../panel/aksi.php?aksi=management_upload_filter",
            data: {
                cluster: cmb_cluster_value,
                program: cmb_program_value,
                date: date_filter,
            },
            success: function (data) {
                $("#table-list-upload").empty();
                $("#table-list-upload").append(data);
            },
        });
    }
}

function managemen_upload_refresh() {
    document.location.href = "../pages/upload.php";
}

function cekwording() {
    var target = document.getElementById("wording");
    var batas_karakter = 160;
    // jika jumlah karakter yg diketikkan lebih dari atau sama dengan 100

    if (target.value.length <= 0) {
        document.getElementById("characterLeft").innerHTML = "";
    } else if (target.value.length >= batas_karakter) {
        //disable textarea
        // target.readOnly = true;
        //memberikan warna merah pada text pemberitahuan
        document.getElementById("characterLeft").style.color = "red";
        // menampilkan pemberitahuan
        document.getElementById("characterLeft").innerHTML =
            "Maksimal 160 Karakter !";
    } else {
        //hitung jumlah karakter yg sudah diketikkan
        var jumlah_karakter = target.value.length;
        // untuk mengetahui jumlah karakter yg tersisa, maka batas_karakter dikurangi karakter yg telah diketikkan
        var sisa = batas_karakter - jumlah_karakter;
        document.getElementById("characterLeft").style.color = "black";
        // tampilkan pemberitahuan berapa karakter lagi yg tersisa
        document.getElementById("characterLeft").innerHTML =
            sisa + " Karakter tersisa !";
    }
}

function cekwording_update() {
    var target = document.getElementById("wording_update");
    var batas_karakter = 160;
    // jika jumlah karakter yg diketikkan lebih dari atau sama dengan 100

    if (target.value.length <= 0) {
        document.getElementById("characterLeft").innerHTML = "";
    } else if (target.value.length >= batas_karakter) {
        //disable textarea
        // target.readOnly = true;
        //memberikan warna merah pada text pemberitahuan
        document.getElementById("characterLeft").style.color = "red";
        // menampilkan pemberitahuan
        document.getElementById("characterLeft").innerHTML =
            "Maksimal 160 Karakter !";
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Karakter Sudah Melebihi Ketentuan 160 Karakter",
        });
        target.readonly = true;
    } else {
        //hitung jumlah karakter yg sudah diketikkan
        var jumlah_karakter = target.value.length;
        // untuk mengetahui jumlah karakter yg tersisa, maka batas_karakter dikurangi karakter yg telah diketikkan
        var sisa = batas_karakter - jumlah_karakter;
        document.getElementById("characterLeft").style.color = "black";
        // tampilkan pemberitahuan berapa karakter lagi yg tersisa
        document.getElementById("characterLeft").innerHTML =
            sisa + " Karakter tersisa !";
    }
}

function download_wl(file_wl) {
    if (file_wl == "") {
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Maaf Tidak Bisa Mendownload File !",
        });
    } else {
        var POSTurl = "../assets/uploads/" + file_wl;
        document.location.href = POSTurl;
    }
}

function next_lanjut() {
    // console.log("Biawak");
    var POSTurl = "../panel/aksi.php?aksi=lanjut_pass";
    document.location.href = POSTurl;
}

function update_password() {
    var POSTurl = "../panel/aksi.php?aksi=update_password";
    document.location.href = POSTurl;
}

function filter_data() {
    var mulai = $("#mulai").val();
    var sampai = $("#sampai").val();
    // var dt = $('#table1').DataTable();
    if (mulai != "" && sampai != "") {
        // $('#table1').DataTable().destroy();
        load_filter_data_request(mulai, sampai);
    } else {
        // alert('Pilih Filter Terlebih Dahulu');
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Filter Tanggal Dahulu!",
        });
    }
}

function filter_data_export() {
    var mulai = $("#mulai").val();
    var sampai = $("#sampai").val();
    // var dt = $('#table1').DataTable();
    if (mulai != "" && sampai != "") {
        // load_data_export(mulai, sampai);
        $("#table1").table2excel({
            name: "Request Campaign",
            filename: "ListRequest",
            // exclude: ".noExl",
            fileext: ".xls",
        });
    } else {
        // alert('Pilih Filter Terlebih Dahulu');
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Filter Tanggal Dahulu!",
        });
    }
}

function load_filter_data_request(mulai = "", sampai = "") {
    $.ajax({
        url: "../panel/aksi.php?aksi=filter_request",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            $("#show_data").empty();
            $("#show_data").append(data);
        },
    });
}

function load_data_export(mulai = "", sampai = "") {
    $.ajax({
        url: "../panel/aksi.php?aksi=export_request",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
    });
}

function approval_show(status, id_uniq) {
    if (status == "Approve") {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf",
            text: "Validasi Approval Sudah Dilakukan !",
        });
    } else {
        var POSTurl = "../panel/aksi.php?aksi=show_approval";
        $.ajax({
            url: POSTurl,
            method: "GET",
            data: {
                id_uniq: id_uniq,
            },
            dataType: "json",
            success: function (data) {
                $("#approval").modal("show");
                $("#id_uniq_approval").val(id_uniq);
                $(".modal-body #naming_approval").val(data);
            },
        });
    }
}

function update_approval() {
    const id_uniq = document.getElementById("id_uniq_approval").value;
    Swal.fire({
        title: "Apakah Anda Yakin melakukan Approved Data Tersebut ?",
        text: "ID Request : " + id_uniq,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Submit, Approved !",
    }).then((result) => {
        if (result.value) {
            // const act = '/send_request/delete/' + id;
            // document.location.href = act;
            document.getElementById("approval_update").submit();
        }
    });
}

function filter_data_approval() {
    var mulai = $("#mulai2").val();
    var sampai = $("#sampai2").val();
    // var dt = $('#table1').DataTable();
    if (mulai != "" && sampai != "") {
        // $('#table_naming_campaign').DataTable().destroy();
        load_filter_data_request_approval(mulai, sampai);
    } else {
        // alert('Pilih Filter Terlebih Dahulu');
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Filter Tanggal Dahulu!",
        });
    }
}

function load_filter_data_request_approval(mulai = "", sampai = "") {
    $.ajax({
        url: "/send_request/filter/approval",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            $("#table_naming_campaign").html(data);
        },
    });
}

function filter_data_export_approval() {
    var mulai = $("#mulai2").val();
    var sampai = $("#sampai2").val();
    // var dt = $('#table1').DataTable();
    if (mulai != "" && sampai != "") {
        // load_data_export(mulai, sampai);
        $("#table_naming_campaign").table2excel({
            name: "Request Campaign",
            filename: "Approval_" + mulai + "_" + sampai,
            // exclude: ".noExl",
            fileext: ".xls",
        });
    } else {
        // alert('Pilih Filter Terlebih Dahulu');
        swal.fire({
            icon: "error",
            title: "Oops...",
            text: "jangn lupa Filter Tanggal Dahulu!",
        });
    }
}
// Download WL Management Sumbagut
function download_wl_aceh() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var program = document.getElementById("program").innerHTML;
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_ACEH.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_ACEH.txt";

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_meulaboh() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var program = document.getElementById("program").innerHTML;
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_MEULABOH.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_MEULABOH.txt";

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_bireuen() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var program = document.getElementById("program").innerHTML;
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_BIREUEN.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_BIREUEN.txt";
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_serdang() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var program = document.getElementById("program").innerHTML;
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_SERDANG.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_SERDANG.txt";
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_medan() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var program = document.getElementById("program").innerHTML;
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_MEDAN.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_MEDAN.txt";
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_sidimpuan() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var program = document.getElementById("program").innerHTML;
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_SIDEMPUAN.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_SIDEMPUAN.txt";

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_asahan() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_ASAHAN.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_ASAHAN.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_tapanuli() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_TAPANULI.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_TAPANULI.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_karo() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_KARO.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_KARO.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_siantar() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_SIANTAR.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_SIANTAR.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_langkat() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_LANGKAT.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_LANGKAT.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_tamiang() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_TAMIANG.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_TAMIANG.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

// Download WL Management Sumbateng
function download_wl_batam() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file = "wl_wa_comsak_nontaker_" + todayDate + "_GREATER_BATAM.txt";
    var file = "wl_wa_inetsak_nontaker_" + todayDate + "_GREATER_BATAM.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_tanjung_pinang() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_TANJUNG_PINANG.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_TANJUNG_PINANG.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_rokan_hulu() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_ROKAN_HULU.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_ROKAN_HULU.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}


function download_wl_serdang() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_SERDANG.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_SERDANG.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_dumai() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_DUMAI.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_DUMAI.txt";
    var program = document.getElementById("program").innerHTML;

    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_solok_sraya() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_SOLOK_SRAYA.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_SOLOK_SRAYA.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_padang_pariaman() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_PADANG_PARIAMAN.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_PADANG_PARIAMAN.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_bukit_tinggi() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_BUKIT_TINGGI.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_BUKIT_TINGGI.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_tembilahan() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_TEMBILAHAN.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_TEMBILAHAN.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_pekanbaru() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_GREATER_PEKANBARU.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_GREATER_PEKANBARU.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

// Download WL Management Sumbagsel
function download_wl_bumi_reflesia() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_BUMI_RAFFLESIA.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_BUMI_RAFFLESIA.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_musi_rawas() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_MUSI_RAWAS.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_MUSI_RAWAS.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_jambi_inner() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_JAMBI_INNNER.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_JAMBI_INNNER.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_jambi_barat() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_JAMBI_BARAT.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_JAMBI_BARAT.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_lampung_utara() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_LAMPUNG_UTARA.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_LAMPUNG_UTARA.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_bandar_lampung() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_BANDAR_LAMPUNG.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_BANDAR_LAMPUNG.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_lampung_tengah() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_LAMPUNG_TENGAH.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_LAMPUNG_TENGAH.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_ogan_komering() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_OGAN_KOMERING.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_OGAN_KOMERING.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_banyuasin() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak = "wl_wa_comsak_nontaker_" + todayDate + "_BANYUASIN.txt";
    var file_insak = "wl_wa_inetsak_nontaker_" + todayDate + "_BANYUASIN.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_bumi_sriwijaya() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_BUMI_SRIWIJAYA.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_BUMI_SRIWIJAYA.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function download_wl_bangka_belitung() {
    var todayDate = new Date().toISOString().slice(0, 10);
    var file_comsak =
        "wl_wa_comsak_nontaker_" + todayDate + "_BANGKA_BELITUNG.txt";
    var file_insak =
        "wl_wa_inetsak_nontaker_" + todayDate + "_BANGKA_BELITUNG.txt";
    var program = document.getElementById("program").innerHTML;
    if (program === "Non-Taker Comsak") {
        var file = file_comsak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_comsak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else if (program === "Non-Taker Insak") {
        var file = file_insak;
        $.ajax({
            url: "../panel/aksi.php?aksi=download_wl_file",
            method: "GET",
            data: {
                file: file,
            },
            success: function (data) {
                document.location.href =
                    "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/" +
                    file_insak;
            },
        });
        // log activity
        $.ajax({
            url: "../panel/aksi.php?aksi=log_download_wl",
            type: "GET",
            data: {
                log_action: "Download " + file + " From",
                log_name: "Download Whitelist File " + file + " Attempt",
            },
        });
    } else {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "File ini Belum Tersedia Diserver !",
        });
    }
}

function manajemen_download_filter() {
    // File conntent Filter
    var cmb_cluster = document.getElementById("cluster_filter");
    var cmb_cluster_text = cmb_cluster.options[cmb_cluster.selectedIndex].text;
    var cmb_cluster_value = cmb_cluster.options[cmb_cluster.selectedIndex].value;
    var cmb_porgram = document.getElementById("program_filter");
    var cmb_program_text = cmb_porgram.options[cmb_porgram.selectedIndex].text;
    var cmb_program_value = cmb_porgram.options[cmb_porgram.selectedIndex].value;
    var date_filter = $("#date_filter").val();

    if (cmb_cluster_value == "" && cmb_program_value !== "" && date_filter == "") {
        var tabel1 = document.getElementById("datatable");
        for (var i = 0; i < tabel1.rows.length; i++) {
            tabel1.rows[i].cells[1].innerHTML = cmb_program_text;
        }
    } else if (cmb_cluster_value == "" && cmb_program_value !== "" && date_filter !== "") {
        var tabel1 = document.getElementById("datatable");
        for (var i = 0; i < tabel1.rows.length; i++) {
            tabel1.rows[i].cells[1].innerHTML = cmb_program_text;
            tabel1.rows[i].cells[3].innerHTML = date_filter;
        }
    } else if (cmb_cluster_value == "" && cmb_program_value == "" && date_filter !== "") {
        var tabel1 = document.getElementById("datatable");
        for (var i = 0; i < tabel1.rows.length; i++) {
            tabel1.rows[i].cells[3].innerHTML = date_filter;
        }
    } else if (cmb_cluster_value !== "" && cmb_program_value !== "" && date_filter !== "") {
        $("#datatable").empty();
        var table = document.getElementById("datatable");
        var row = table.insertRow(0);
        var no = row.insertCell(0);
        var nama_program = row.insertCell(1);
        var cluster = row.insertCell(2);
        var tanggal = row.insertCell(3);
        var action = row.insertCell(4);
        no.style.textAlign = "center";
        nama_program.style.textAlign = "left";
        cluster.style.textAlign = "center";
        tanggal.style.textAlign = "center";
        action.style.textAlign = "center";
        // class
        no.classList.add("text-sub");
        nama_program.classList.add("text-sub");
        cluster.classList.add("text-sub");
        tanggal.classList.add("text-sub");
        action.classList.add("text-sub");

        tanggal.setAttribute("id", "tgl");

        no.innerHTML = "1";
        nama_program.innerHTML = cmb_program_text;
        cluster.innerHTML = cmb_cluster_text;
        tanggal.innerHTML = date_filter;
        action.innerHTML =
            "<button type='button' class='btn btn-md btn-success' onclick='download_wl_kategori()'> Download <i data-feather='download-cloud'></i></button>";
    }
}

function download_wl_kategori() {
    var tabel1 = document.getElementById("datatable");
    var No, nama_program, cluster, date;
    var path_comsak =
        "sftp://campaigna1:campaigna1%23xyz@10.32.18.206/mnt/data2/campaign_area/whitelist/wa_blast/comsak/wl_wa_comsak_nontaker_";
    var path_insak = "";
    var cluster_path;
    for (var i = 1; i < tabel1.rows.length; i++) {
        No = tabel1.rows[i].cells[0].innerHTML;
        nama_program = tabel1.rows[i].cells[1].innerHTML;
        cluster = tabel1.rows[i].cells[2].innerHTML;
        date = tabel1.rows[i].cells[3].innerHTML;

        if (cluster === "GREATER BATAM") {
            cluster_path = "GREATER_BATAM";
        } else if (cluster === "TANJUNG PINANG") {
            cluster_path = "TANJUNG_PINANG";
        } else if (cluster === "ROKAN HULU") {
            cluster_path = "ROKAN_HULU";
        } else if (cluster === "SOLOK SRAYA") {
            cluster_path = "SOLOK_SRAYA";
        } else if (cluster === "PADANG PARIAMAN") {
            cluster_path = "PADANG_PARIAMAN";
        } else if (cluster === "BUKIT TINGGI") {
            cluster_path = "BUKIT_TINGGI";
        } else if (cluster === "GREATER PEKANBARU") {
            cluster_path = "GREATER_PEKANBARU";
        } else if (cluster === "BUMI RAFFLESIA") {
            cluster_path = "BUMI_RAFFLESIA";
        } else if (cluster === "MUSI RAWAS") {
            cluster_path = "MUSI_RAWAS";
        } else if (cluster === "JAMBI INNER") {
            cluster_path = "JAMBI_INNER";
        } else if (cluster === "JAMBI BARAT") {
            cluster_path = "JAMBI_BARAT";
        } else if (cluster === "LAMPUNG UTARA") {
            cluster_path = "LAMPUNG_UTARA";
        } else if (cluster === "LAMPUNG TENGAH") {
            cluster_path = "LAMPUNG_TENGAH";
        } else if (cluster === "BANDAR LAMPUNG") {
            cluster_path = "BANDAR_LAMPUNG";
        } else if (cluster === "OGAN KOMERING") {
            cluster_path = "OGAN_KOMERING";
        } else if (cluster === "BUMI SRIWIJAYA") {
            cluster_path = "BUMI_SRIWIJAYA";
        } else if (cluster === "BANGKA BELITUNG") {
            cluster_path = "BANGKA_BELITUNG";
        } else {
            cluster_path = cluster;
        }
        if (nama_program === "Non-Taker Comsak") {
            document.location.href = path_comsak + date + "_" + cluster_path + ".txt";
        } else {
            alert("gagal");
        }
    }
}

function manajemen_download_refresh() {
    document.location.href = "../pages/download.php";
}



function check_reset_password() {
    var username = $("#username").val();
    $.ajax({
        url: "../panel/aksi.php?aksi=check_lupa_pasword",
        type: "GET",
        data: {
            username: username,
        },
        dataType: "json",
        success: function (data) {
            if (data[0] === "check gagal") {
                var keterangan = document.getElementById("keterangan");
                var text = document.getElementById("text-keterangan");
                var reset_pass = document.getElementById("reset-password");
                keterangan.style.display = "block";
                text.innerHTML = "username Anda Tidak Valid !";
                text.style.color = "magenta";
                reset_pass.style.display = "none";
            } else if (data[0] === "Password Anda Valid") {
                var keterangan = document.getElementById("keterangan");
                var text = document.getElementById("text-keterangan");
                var reset_pass = document.getElementById("reset-password");
                keterangan.style.display = "block";
                text.innerHTML = "Password Anda Valid,Password Berhasil Terreset";
                reset_pass.style.display = "block";
            }
        },
    });
}

function update_password_from_reset() {
    var username = $("#username").val();
    var password_baru = $("#password_baru").val();
    var password_baru_confirm = $("#password_baru_confirm").val();

    $.ajax({
        url: "../panel/aksi.php?aksi=update_password_from_reset",
        type: "GET",
        data: {
            username: username,
            password_baru: password_baru,
            password_baru_confirm: password_baru_confirm,
        },
        success: function (data) {
            swal.fire({
                icon: "success",
                title: "Good Jobs !",
                text: "Update Password Anda Berhasil !",
            });
            document.location.href = "../auth/login.php";
        },
    });
}

function modul_requst_campaign() {
    $.ajax({
        url: "../panel/aksi.php?aksi=modul_request_campaign",
        type: "GET",
        data: {
            log_action: "Request Campaign From",
            log_name: "Request Campaign Attempt",
        },
        success: function (data) {
            document.location.href = "../pages/send_request";
        },
    });
}

function modul_taker_wa() {
    $.ajax({
        url: "../panel/aksi.php?aksi=modul_taker_wa",
        type: "GET",
        data: {
            log_action: "Taker Wa From",
            log_name: "Taker Wa Attempt",
        },
        success: function (data) {
            document.location.href = "../pages/taker_wa";
        },
    });
}

function modul_taker_performance() {
    $.ajax({
        url: "../panel/aksi.php?aksi=modul_taker_wa",
        type: "GET",
        data: {
            log_action: "Taker Wa From",
            log_name: "Taker Wa Attempt",
        },
        success: function (data) {
            document.location.href = "../pages/taker_wa";
        },
    });
}

function modul_download_wl() {
    $.ajax({
        url: "../panel/aksi.php?aksi=modul_download_wl",
        type: "GET",
        data: {
            log_action: "Form Download Whitelist From",
            log_name: "Download Whitelist Attempt",
        },
        success: function (data) {
            document.location.href = "../pages/download";
        },
    });
}

function modul_upload_wl() {
    $.ajax({
        url: "../panel/aksi.php?aksi=modul_upload_wl",
        type: "GET",
        data: {
            log_action: "Form Upload Whitelist From",
            log_name: "Upload Whitelist Attempt",
        },
        success: function (data) {
            document.location.href = "../pages/upload";
        },
    });
}

function showPage() {
    document.getElementById("loader").style.display = "none";

    document.getElementById("myDiv").style.display = "block";
}

// calender
document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        editable: true,
        selectable: true,
        selectHelper: true,
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay",
        },
        buttonText: {
            today: "today",
            month: "month",
            week: "week",
            day: "day",
        },
        events: "../panel/aksi.php?aksi=get_event",
    });
    calendar.render();
});


$(document).ready(function () {
    $('#region').multiselect({
        includeSelectAllOption: true, // add select all option as usual
        optionClass: function (element) {
            var value = $(element).val();
        }
    });
});

$(document).ready(function () {
    $('#region_filter').multiselect({
        includeSelectAllOption: true, // add select all option as usual
        optionClass: function (element) {
            var value = $(element).val();
        }
    });
});

$(document).ready(function () {
    $('#branch_filter').multiselect({
        includeSelectAllOption: true, // add select all option as usual
        optionClass: function (element) {
            var value = $(element).val();
        }
    });
});

$(document).ready(function () {
    $('#cluster_filter').multiselect({
        includeSelectAllOption: true, // add select all option as usual
        optionClass: function (element) {
            var value = $(element).val();
        }
    });
});

$("#region_filter").change(function () {
    var $this = $(this);
    var selectedValue = $this.val();
    var branch = {
        Sumbagut: [
            "Pilih Branch",
            "ACEH",
            "WESTERN MEDAN",
            "PEMATANG SIANTAR",
            "CENTRAL MEDAN",
            "PADANG SIDIMPUAN",
        ],
        Sumbagteng: ["Pilih Branch", "PADANG", "BATAM", "DUMAI", "PEKANBARU"],
        Sumbagsel: ["Pilih Branch", "PANGKAL PINANG", "JAMBI", "BENGKULU", "PALEMBANG", "LAMPUNG"],
    };
    if (selectedValue) {
        var $branch = $("#branch_filter").empty();
        var newCars = branch[selectedValue];
        $.each(newCars, function () {
            $("<option>" + this + "</option>").appendTo($branch);
        });
    }
});

$("#branch_filter").change(function () {
    var $this = $(this);
    var selectedValue = $this.val();
    var cluster = {
        ACEH: ["Pilih Cluster", "ACEH", "BIREUEN", "MEULABOH"],
        "WESTERN MEDAN": ["Pilih Cluster", "LANGKAT", "TAMIANG"],
        "PEMATANG SIANTAR": ["Pilih Cluster", "KARO", "ASAHAN", "SIANTAR"],
        "CENTRAL MEDAN": ["Pilih Cluster", "MEDAN", "SERDANG"],
        "PADANG SIDIMPUAN": ["Pilih Cluster", "SIDEMPUAN", "TAPANULI"],
        PADANG: ["Pilih Cluster", "BUKIT TINGGI", "PADANG PARIAMAN", "SOLOK SRAYA"],
        BATAM: ["Pilih Cluster", "GREATER BATAM", "TANJUNG PINANG"],
        DUMAI: ["Pilih Cluster", "DUMAI", "ROKAN HULU"],
        PEKANBARU: ["Pilih Cluster", "GREATER PEKANBARU", "TEMBILAHAN"],
        "PANGKAL PINANG": ["Pilih Cluster", "BANGKA BELITUNG"],
        JAMBI: ["Pilih Cluster", "JAMBI BARAT", "JAMBI INNER"],
        BENGKULU: ["Pilih Cluster", "BUMI RAFFLESIA", "MUSI RAWAS"],
        PALEMBANG: ["Pilih Cluster", "BANYUASIN", "BUMI SRIWIJAYA", "OGAN KOMERING"],
        LAMPUNG: ["Pilih Cluster", "BANDAR LAMPUNG", "LAMPUNG TENGAH", "LAMPUNG UTARA"],
    };
    if (selectedValue) {
        var $cluster = $("#cluster_filter").empty();
        var newCars = cluster[selectedValue];
        $.each(newCars, function () {
            $("<option>" + this + "</option>").appendTo($cluster);
        });
    }
});

$("#region").change(function () {
    var $this = $(this);
    var selectedValue = $this.val();
    var branch = {
        Sumbagut: [
            "Pilih Branch",
            "ACEH",
            "WESTERN MEDAN",
            "PEMATANG SIANTAR",
            "CENTRAL MEDAN",
            "PADANG SIDIMPUAN",
        ],
        Sumbagteng: ["Pilih Branch", "PADANG", "BATAM", "DUMAI", "PEKANBARU"],
        Sumbagsel: ["Pilih Branch", "PANGKAL PINANG", "JAMBI", "BENGKULU", "PALEMBANG", "LAMPUNG"],
    };
    if (selectedValue) {
        var $branch = $("#branch").empty();
        var newCars = branch[selectedValue];
        $.each(newCars, function () {
            $("<option>" + this + "</option>").appendTo($branch);
        });
    }
});

$("#branch").change(function () {
    var $this = $(this);
    var selectedValue = $this.val();
    var cluster = {
        ACEH: ["Pilih Cluster", "ACEH", "BIREUEN", "MEULABOH"],
        "WESTERN MEDAN": ["Pilih Cluster", "LANGKAT", "TAMIANG"],
        "PEMATANG SIANTAR": ["Pilih Cluster", "KARO", "ASAHAN", "SIANTAR"],
        "CENTRAL MEDAN": ["Pilih Cluster", "MEDAN", "SERDANG"],
        "PADANG SIDIMPUAN": ["Pilih Cluster", "SIDEMPUAN", "TAPANULI"],
        PADANG: ["Pilih Cluster", "BUKIT TINGGI", "PADANG PARIAMAN", "SOLOK SRAYA"],
        BATAM: ["Pilih Cluster", "GREATER BATAM", "TANJUNG PINANG"],
        DUMAI: ["Pilih Cluster", "DUMAI", "ROKAN HULU"],
        PEKANBARU: ["Pilih Cluster", "GREATER PEKANBARU", "TEMBILAHAN"],
        "PANGKAL PINANG": ["Pilih Cluster", "BANGKA BELITUNG"],
        JAMBI: ["Pilih Cluster", "JAMBI BARAT", "JAMBI INNER"],
        BENGKULU: ["Pilih Cluster", "BUMI RAFFLESIA", "MUSI RAWAS"],
        PALEMBANG: ["Pilih Cluster", "BANYUASIN", "BUMI SRIWIJAYA", "OGAN KOMERING"],
        LAMPUNG: ["Pilih Cluster", "BANDAR LAMPUNG", "LAMPUNG TENGAH", "LAMPUNG UTARA"],
    };
    if (selectedValue) {
        var $cluster = $("#cluster").empty();
        var newCars = cluster[selectedValue];
        $.each(newCars, function () {
            $("<option>" + this + "</option>").appendTo($cluster);
        });
    }
});