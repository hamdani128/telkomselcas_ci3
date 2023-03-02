// $('#region').multiselect({
//     nonSelectedText: 'Pilih Region',
//     enableFiltering: true,
//     enableCaseInsensitiveFiltering: true,
//     buttonWidth: '400px's
// });

var select1 = new MSFmultiSelect(
    document.querySelector('#multiselect'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 880,
        height: 40,
        onChange: function (checked, value, instance) {
            // console.log(checked, value, instance);
            // get_branch_from_region()
        },
        //appendTo: '#myselect',    
        //readOnly:true,
        placeholder: 'Silahkan Pilih',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
            // alert(values);
        }
    }
);

var select2 = new MSFmultiSelect(
    document.querySelector('#multiselect-branch'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 880,
        height: 80,
        onChange: function (checked, value, instance) {
            //console.log(checked, value, instance);
        },
        //appendTo: '#myselect',
        //readOnly:true,
        placeholder: 'Silahkan Pilih',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
        }
    }
);

var select3 = new MSFmultiSelect(
    document.querySelector('#multiselect-cluster'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 880,
        height: 100,
        onChange: function (checked, value, instance) {
            //console.log(checked, value, instance);
        },
        //appendTo: '#myselect',
        //readOnly:true,
        placeholder: 'Silahkan Pilih',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
        }
    }
);

var select4 = new MSFmultiSelect(
    document.querySelector('#multiselect-city'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 880,
        height: 150,
        onChange: function (checked, value, instance) {
            //console.log(checked, value, instance);
        },
        //appendTo: '#myselect',
        //readOnly:true,
        placeholder: 'Silahkan Pilih',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
        }
    }
);

var select1_filter = new MSFmultiSelect(
    document.querySelector('#multiselect-filter-region'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 250,
        height: 80,
        onChange: function (checked, value, instance) {
            //console.log(checked, value, instance);
        },
        //appendTo: '#myselect',
        //readOnly:true,
        placeholder: 'Silahkan Pilih Region',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
        }
    }
);

var select2_filter = new MSFmultiSelect(
    document.querySelector('#multiselect-filter-branch'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 250,
        height: 80,
        onChange: function (checked, value, instance) {
            //console.log(checked, value, instance);
        },
        //appendTo: '#myselect',
        //readOnly:true,
        placeholder: 'Silahkan Pilih Region',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
        }
    }
);

var select3_filter = new MSFmultiSelect(
    document.querySelector('#multiselect-filter-cluster'),
    {
        theme: 'theme2',
        selectAll: true,
        searchBox: true,
        width: 250,
        height: 80,
        onChange: function (checked, value, instance) {
            //console.log(checked, value, instance);
        },
        //appendTo: '#myselect',
        //readOnly:true,
        placeholder: 'Silahkan Pilih Region',
        //autoHide: false,
        afterSelectAll: function (checked, values, instance) {
            //console.log(checked, values, instance);
        }
    }
);


function get_branch_from_region() {
    var region = $('#multiselect').val();
    // alert(values);
    fetch("../panel/fetch.php?aksi=get_branch_region&region=" + region, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            // var select = $('#multiselect-branch');
            // var options;
            // for (var i = 0; i < data.length; i++) {
            //     // option += `<option value="${data[i].Branch}">${data[i].Branch}</option>`;
            //     options += [{ caption: data[i].Branch, value: data[i].Branch, selected: false }];
            // }
            // select2.loadSource(options)
            // select2.reload();
            // var list = $('.branch');
            // list.empty();
            // for (var i = 0; i < data.length; i++) {
            //     var options = {};
            // }
            // set/remove value
            // select2.setValue(['4', '8']);
            // select2.removeValue(['4', '8']);
            // get selected values
            // console.log(select2.getData());
            // // get an array of the current data
            // select2.getSource(data);
            // // select all values
            // select2.selectAll(false);
            // load more options
            // var options = [
            //     { caption: 'optiontext1', value: 'optionvalue1', selected: true },
            //     { caption: 'optiontext2', value: 'optionvalue2', selected: false }
            // ];


            // // // reload the instance

        })
}


function upload_wl_taker() {

    // $("#my-modal-center").modal("hide");
    var cmb_region = document.getElementById('multiselect');
    var cmb_branch = document.getElementById("multiselect-branch");
    var cluster = document.getElementById("multiselect-cluster");
    var file_berkas = document.getElementById("file_upload").files[0].type;
    var cmb_identifier = document.getElementById("value_identifier");
    var cmb_identifier_value =
        cmb_identifier.options[cmb_identifier.selectedIndex].value;
    var tgl_date = $("#tgl_campaign").val();

    if (cmb_region.value == "") {
        Swal.fire("Warning", "Anda Wajib Memilih Region !", "warning");
    } else if (cmb_identifier_value == "") {
        Swal.fire("Warning", "Anda Wajib Memilih Identifier !", "warning");
    } else if (tgl_date == "") {
        Swal.fire("Warning", "Anda Wajib Memasukkan Tanggal Campaign !", "warning");
    } else {
        if (file_berkas == "text/plain" || file_berkas == 'application/vnd.ms-excel') {
            var formupload = document.getElementById("management-upload-add");
            var formdata = new FormData(formupload);
            // document.getElementById("loading_wl_upload").style.display = "block";
            $("#my-modal-center").modal("show");
            // $.ajax({
            //     url: "../panel/upload_controller1.php?aksi=management_upload",
            //     method: "POST",
            //     data: formdata,
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     dataType: "json",
            //     success: function (data) {
            //         if (data.status == 'success') {
            //             $("#my-modal-center").modal().toggle();
            //             Swal.fire(
            //                 'Berhasil !',
            //                 'Data Upload Whitelist Berhasil Di Proses !',
            //                 'success'
            //             )
            //             document.location = '../pages/upload.php';
            //         }

            //         // if (data.status == "success") {

            //         // }
            //     }
            // });
            document.getElementById("management-upload-add").submit(function () {
                $.ajax({
                    type: frm.attr("method"),
                    url: frm.attr("action"),
                    data: frm.serialize(),
                });
            });
        } else {
            Swal.fire("Warning", "File Hanya Boleh CSV dan Text/Plain (TXT) !", "warning");
        }

    }
}

function delete_file_upload(id, uniq_id) {
    Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda Yakin, Akan Menghapus Data ' + uniq_id + ' ?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        $.ajax({
            url: "../panel/upload_controller1.php?aksi=delete_file_upload",
            method: "POST",
            data: {
                id: id,
                uniq_id: uniq_id
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    Swal.fire(
                        'Berhasil !',
                        'Data Berhasil Dihapus !',
                        'success'
                    )
                    document.location = '../pages/upload.php';


                }
            }
        })
    });
}

function download_file_taker(file_taker) {
    // window.open("sftp://campaigna1:campaigna1%23xyz@10.32.18.206/home/mcdserver/datacdpm/data/taker/" + file_taker);
    window.open("../panel/download.php?aksi=upload_wl&file=" + file_taker);
}


function onChangeUploadWhitelist() {
    var x = document.getElementById("program_filter");
    var x_value = x.options[x.selectedIndex].value;
    var b = document.getElementById("content_id_filter");
    if (x_value == "By Content ID") {
        b.style.display = "block";
    } else {
        b.style.display = "none";
    }
}

function UploadWhitelist_Filter() {
    var cmb_region_filter = $("#multiselect-filter-region").val();
    var cmb_branch_filter = $("#multiselect-filter-branch").val();
    var cmb_cluster_filter = $("#multiselect-filter-cluster").val();
    var program_filter = document.getElementById("program_filter");
    var content_id = $("#content_id_fillter").val();
    var program_filter_value =
        program_filter.options[program_filter.selectedIndex].value;
    var date_filter = $("#date_filter").val();

    if (program_filter_value === "" || date_filter === "") {
        swal.fire({
            icon: "error",
            title: "Mohon Maaf !",
            text: "Filter Field Harus Terisi Semua !",
        });
    } else {
        if (program_filter_value == "By Content ID" && content_id == "") {
            swal.fire({
                icon: "error",
                title: "Mohon Maaf !",
                text: "Content ID Harus Terisi !",
            });
        } else if (program_filter_value == "By Content ID" && content_id != "") {
            $.ajax({
                url: "../panel/upload_controller1.php?aksi=filter_content_id",
                type: "GET",
                data: {
                    region: cmb_region_filter,
                    branch: cmb_branch_filter,
                    cluster: cmb_cluster_filter,
                    program_filter_value: program_filter_value,
                    content_id: content_id,
                    date_filter: date_filter,
                },
                success: function (data) {
                    $("#table-list-upload").empty();
                    $("#table-list-upload").html(data);
                },
            });
        } else {
            $.ajax({
                url: "../panel/upload_controller1.php?aksi=filter_program",
                type: "GET",
                data: {
                    region: cmb_region_filter,
                    branch: cmb_branch_filter,
                    cluster: cmb_cluster_filter,
                    program_filter_value: program_filter_value,
                    date_filter: date_filter,
                },
                success: function (data) {
                    $("#table-list-upload").empty();
                    $("#table-list-upload").html(data);
                },
            });
        }
    }
}