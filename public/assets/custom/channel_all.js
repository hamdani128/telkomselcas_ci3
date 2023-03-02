function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost' || location.host == '10.32.18.206') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

function filtertakerallchannerl() {
    var date_filter = $("#date_filter").val();
    var monnow1 = new Date(date_filter);
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    monnow1.setMonth(monnow1.getMonth() - 1);
    var nd = new Date(monnow1);
    var d1 = ("0" + nd.getDate()).slice(-2);
    var y1 = nd.getFullYear();
    var hmin1 = d1 + "-" + monthNames[nd.getMonth()] + "-" + y1;
    $.ajax({
        url: base_url('campaign/filter_all_channel'),
        method: "POST",
        data: {
            date_filter: date_filter,
        },
        dataType: "JSON",
        success: function (data) {
            var tbody = document.getElementById('tbody_taker_all_channel');
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
                    <td style="font-size: 9pt;text-align: center;">${data[i].subs_m0}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].subs_m1}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].target}</td>
                    `;

                    if (data[i].acv_st == "positif") {
                        tr += `
                        <td style="font-size: 8pt;background-color:rgb(102,223,139);font-weight: bold;color: black;">${data[i].acv}</td>
                        `;
                    } else {
                        tr += `
                        <td style="font-size: 8pt;background-color:rgb(223, 106, 102);font-weight: bold;color: black;">${data[i].acv}</td>
                        `;
                    }

                    if (data[i].drr_st == "positif") {
                        tr += `
                        <td style="font-size: 8pt;background-color:rgb(102,223,139);font-weight: bold;color: black;">${data[i].drr}</td>
                        `;
                    } else {
                        tr += `
                        <td style="font-size: 8pt;background-color:rgb(223, 106, 102);font-weight: bold;color: black;">${data[i].drr}</td>
                        `;
                    }

                    if (data[i].MoM_st == "positif") {
                        tr += `
                        <td style="font-size: 8pt;background-color:rgb(102,223,139);font-weight: bold;color: black;">${data[i].MoM}</td>
                        `;
                    } else {
                        tr += `
                        <td style="font-size: 8pt;background-color:rgb(223, 106, 102);font-weight: bold;color: black;">${data[i].MoM}</td>
                        `;
                    }

                    tr += `
                    <td style="font-size: 9pt;text-align: center;">${data[i].taker_subs_m0}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].taker_subs_m1}</td>`;

                    if (data[i].Tur_m0_value == "positif") {
                        tr += `
                        <td style="font-size: 9pt;background-color:rgb(102,223,139);font-weight: bold;color: black;">${data[i].tur_m0}</td>
                        `;
                    } else {
                        tr += `
                        <td style="font-size: 9pt;background-color:rgb(223, 106, 102);font-weight: bold;color: black;">${data[i].tur_m0}</td>
                        `;
                    }

                    if (data[i].Tur_m1_value == "positif") {
                        tr += `
                        <td style="font-size: 9pt;background-color:rgb(102,223,139);font-weight: bold;color: black;">${data[i].tur_m1}</td>
                        `;
                    } else {
                        tr += `
                        <td style="font-size: 9pt;background-color:rgb(223, 106, 102);font-weight: bold;color: black;">${data[i].tur_m1}</td>
                        `;
                    }
                    tr += `
                    <td style="font-size: 9pt;text-align: center;">${data[i].rev_subs_m0}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].rev_subs_m1}</td>
                    <td style="font-size: 9pt;text-align: center;">${data[i].daily}</td>
                </tr>`;
                }
                tbody.innerHTML = tr;
                document.getElementById("m1").innerHTML = hmin1;
                document.getElementById("m0").innerHTML = date_filter;
                document.getElementById("m1").innerHTML = hmin1;
                document.getElementById("m0").innerHTML = date_filter;
                document.getElementById("taker_m1").innerHTML = "TAKER " + hmin1;
                document.getElementById("taker_m0").innerHTML = "TAKER " + date_filter;
                document.getElementById("tur_m1").innerHTML = "TUR" + hmin1;
                document.getElementById("tur_m0").innerHTML = "TUR" + date_filter;
                document.getElementById("rev_m1").innerHTML = "REV" + hmin1;
                document.getElementById("rev_m0").innerHTML = "REV" + date_filter;
            }
        },
    });

}

function download_file_all_channel() {
    var date_filter = $("#date_filter").val();
    if (date_filter == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Notification',
            text: 'Harap Jangan Lupa memilih Tanggal Filter !'
        });
    } else {
        document.location.href = base_url('campaign/download_all_channel_filter/' + date_filter);
    }
}
