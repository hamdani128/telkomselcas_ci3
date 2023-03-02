$('.region').selectpicker();
$('.branch').selectpicker();
$('.cluster').selectpicker();
$('.city').selectpicker();

function cange_identifier() {
    var cmb_identifier = document.getElementById("value_identifier");
    var cmb_identifier_value =
        cmb_identifier.options[cmb_identifier.selectedIndex].value;

    var style_by_product = document.getElementById("by_product");
    var style_by_id = document.getElementById("by_id");

    if (cmb_identifier_value == "By Product") {
        style_by_product.style.display = "block";
        style_by_id.style.display = "none";
    } else if (cmb_identifier_value == "By ID") {
        style_by_product.style.display = "none";
        style_by_id.style.display = "block";
    } else {
        style_by_product.style.display = "none";
        style_by_id.style.display = "none";
    }
}

function modul_hashing_wl() {
    $.ajax({
        url: "../panel/menu.php?aksi=modul_hashing_wl",
        type: "GET",
        data: {
            log_action: "Form Hashing Whitelisst From",
            log_name: "Upload Hashing Whitelist Attempt",
        },
        success: function (data) {
            document.location.href = "../pages/hashing_wl";
        },
    });
}





function privacy_polici() {
    Swal.fire({
        title: "Warning Information!",
        text: " This system is for the use of Telkomsel authorized users only. " +
            "Individuals using this computer system without authority, or in " +
            "excess of their authority,are subject to having all of their " +
            "activities on this system monitored and recorded by system  " +
            "personnel. In the course of monitoring individuals improperly using this " +
            "system, or in the course of system maintenance," +
            "the activities of authorized users may also be monitored. " +
            "Anyone using this system expressly consents to such monitoring and is advised that " +
            "if such monitoring reveals possible evidence of criminal activity," +
            "system personnel may provide the evidence of such monitoring to law enforcement officials",
        // imageUrl: "https://unsplash.it/400/200",
        imageUrl: "../assets/images/Logo-3.png",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image",
    });
}

function update_password_profile() {
    Swal.fire({
        title: "Apakah Anda Yakin Ingin Memperbaharui Password ?",
        text: "Password Baru Anda Akan Confirm !",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Perbaharui !",
        cancelButtonText: "Batal",
        icon: "warning",
    }).then((result) => {
        if (result.value) {
            var username = $("#username").val();
            var password_new = $("#new_password").val();
            var password_confirm = $("#confirm_password").val();
            $.ajax({
                url: "../panel/controller1.php?aksi=update_password_profile",
                type: "GET",
                data: {
                    username: username,
                    password_new: password_new,
                    password_confirm: password_confirm,
                },
                dataType: "json",
                success: function (data) {
                    Swal.fire(
                        "Berhasil !",
                        "Password Berhasil Diperbaharui !",
                        "success"
                    );
                    document.location = "../pages/profile.php";
                },
            });
        }
    });
}

function insert_file_hashing() {
    var file = document.getElementById("berkas").files[0].type;
    var uploadpath = $("#berkas").val()
    var fileExtension = uploadpath.substring(uploadpath.lastIndexOf(".") + 1, uploadpath.length);
    var load = document.getElementById("load2");
    if (fileExtension == "txt" || fileExtension == "csv") {
        load.style.display = "block";
        let formData = new FormData(document.querySelector('form'));
        // document.getElementById("hashing_file").submit(function () {
        //     $.ajax({
        //         type: frm.attr("method"),
        //         url: frm.attr("action"),
        //         data: frm.serialize(),
        //     });
        // });
        $.ajax({
            url: "../panel/controller1.php?aksi=insert_file_hashing",
            type: "POST",
            contentType: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            data: formData,
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Disimpan !',
                    })
                    location.reload();
                }
            },
        });

        // alert("Gokilll...");

    } else {
        Swal.fire("Warning", "File Hanya Boleh CSV dan Text/Plain (TXT) !", "warning");
    }
}

function download_hashing_wl(file) {

    window.open("../panel/download.php?aksi=hash&file=" + file);
}

function delete_hashing_wl(id) {
    Swal.fire({
        title: "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
        text: "Data Yang Telah Dihapus Tidak Bisa Dikembalikan !",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus !",
        cancelButtonText: "Batal",
        icon: "warning",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "../panel/controller1.php?aksi=delete_hashing_wl",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (data) {
                    if (data.status === "success") {
                        Swal.fire(
                            "Berhasil !",
                            "Data Berhasil Dihapus !",
                            "success"
                        );
                        location.reload();
                    }
                },
            });
        }

    });
}
