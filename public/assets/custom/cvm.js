function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost' || location.host == '10.32.18.206') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

function getDataCVMLast() {
    var tbody = document.getElementById('table-list-cvm');
    tbody.innerHTML = '<tr><td colspan="20" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'
    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = document.getElementById('lastupdate').innerHTML;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1").innerHTML = month2;
    document.getElementById("subs_month2").innerHTML = month1;
    document.getElementById("subs_month3").innerHTML = day_new;
    document.getElementById("trx_month1").innerHTML = month2;
    document.getElementById("trx_month2").innerHTML = month1;
    document.getElementById("trx_month3").innerHTML = day_new;
    document.getElementById("rev_month1").innerHTML = month2;
    document.getElementById("rev_month2").innerHTML = month1;
    document.getElementById("rev_month3").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/performance_region'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h3>No Record Found.</h3></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    // subs
                    if (data[i].subs_m2 == null) {
                        subsm2 = 0;
                    } else {
                        subsm2 = data[i].subs_m2;
                    }

                    if (data[i].subs_m1 == null) {
                        subsm1 = 0;
                    } else {
                        subsm1 = data[i].subs_m1;
                    }

                    if (data[i].subs_m0 == null) {
                        subsm0 = 0;
                    } else {
                        subsm0 = data[i].subs_m0;
                    }
                    if (data[i].MoM_M2_Subs == null) {
                        MoM2_Subs = 0;
                    } else {
                        MoM2_Subs = data[i].MoM_M2_Subs;
                    }

                    if (data[i].MoM_Subs == null) {
                        MoM_Subs = 0;
                    } else {
                        MoM_Subs = data[i].MoM_Subs;
                    }
                    // end subs

                    // trx
                    if (data[i].trx_m2 == null) {
                        trxm2 = 0;
                    } else {
                        trxm2 = data[i].trx_m2;
                    }

                    if (data[i].trx_m1 == null) {
                        trxm1 = 0;
                    } else {
                        trxm1 = data[i].trx_m1;
                    }

                    if (data[i].trx_m0 == null) {
                        trxm0 = 0;
                    } else {
                        trxm0 = data[i].trx_m0;
                    }
                    if (data[i].MoM_M2_trx == null) {
                        MoM2_trx = 0;
                    } else {
                        MoM2_trx = data[i].MoM_M2_trx;
                    }

                    if (data[i].MoM_trx == null) {
                        MoM_trx = 0;
                    } else {
                        MoM_trx = data[i].MoM_trx;
                    }
                    // end trx
                    // rev
                    if (data[i].rev_m2 == null) {
                        revm2 = 0;
                    } else {
                        revm2 = data[i].rev_m2;
                    }

                    if (data[i].rev_m1 == null) {
                        revm1 = 0;
                    } else {
                        revm1 = data[i].rev_m1;
                    }

                    if (data[i].rev_m0 == null) {
                        revm0 = 0;
                    } else {
                        revm0 = data[i].rev_m0;
                    }
                    if (data[i].MoM_M2_rev == null) {
                        MoM2_rev = 0;
                    } else {
                        MoM2_rev = data[i].MoM_M2_rev;
                    }

                    if (data[i].MoM_rev == null) {
                        MoM_rev = 0;
                    } else {
                        MoM_rev = data[i].MoM_rev;
                    }


                    if (data[i].paket_group == 'Total') {
                        tr += `<tr style="background-color: rgb(187, 156, 151);text-align: right;font-size: 8pt;">
                            <td style="color: rgb(255, 255, 255);text-align: center;">${a++}</td>
                            <td style="color: rgb(255, 255, 255);text-align: left;">${data[i].region}</td>
                            <td style="color: rgb(255, 255, 255);text-align: left;">${data[i].paket_group}</td>
                            <td style="color: rgb(255, 255, 255);">${subsm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${subsm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${subsm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_Subs < 0) {
                            tr += `<td style="color: rgb(255, 38, 49);">${MoM2_Subs + "%"}</td>`
                        } else {
                            tr += `<td style="color: rgb(255, 255, 255);">${MoM2_Subs + "%"}</td>`

                        }
                        if (MoM_Subs < 0) {
                            tr += `<td style="color: rgb(255, 38, 49);">${MoM_Subs + "%"}</td>`
                        } else {
                            tr += `<td style="color: rgb(255, 255, 255);">${MoM_Subs + "%"}</td>`

                        }
                        tr += `
                            <td style="color: rgb(255, 255, 255);">${trxm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${trxm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${trxm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`

                        if (MoM2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM2_trx + "%"}</td>`

                        }
                        if (MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM_trx + "%"}</td>`

                        }
                        tr += `
                            <td style="color: rgb(255, 255, 255);">${revm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${revm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${revm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM2_rev + "%"}</td>`
                        }
                        if (MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM_rev + "%"}</td>`
                        }
                        tr += `
                        </tr>`;
                    } else {
                        tr += `<tr style="text-align:right;font-size: 8pt;">
                                <td style="text-align: center;">${a++}</td>
                                <td style="text-align: left;">${data[i].region}</td>
                                <td style="text-align: left;">${data[i].paket_group}</td>
                                <td>${subsm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${subsm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${subsm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                `
                        if (MoM2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM2_Subs + "%"}</td>`
                        }
                        if (MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM_Subs + "%"}</td>`
                        }

                        tr += `
                                <td>${trxm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${trxm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${trxm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM2_trx + "%"}</td>`
                        }
                        if (MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM_trx + "%"}</td>`
                        }

                        tr += `
                                <td>${revm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${revm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${revm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${MoM2_rev + "%"}</ > `
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM2_rev + "%"}</>`
                        }
                        if (MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${MoM_rev + "%"}</ > `
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM_rev + "%"}</td>`
                        }
                        tr += `
                            <td style="text-align:center;background-color: rgb(240, 223, 194);">
                                <a href="#" onclick="detail_last_view('${data[i].region}', '${data[i].paket_group}')">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr> `;
                    }
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

getDataCVMLast();


function getDataLastCluster() {
    var tbody = document.getElementById('table-list-cvm-cluster');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = document.getElementById('lastupdate').innerHTML;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_cluster").innerHTML = month2;
    document.getElementById("subs_month2_cluster").innerHTML = month1;
    document.getElementById("subs_month3_cluster").innerHTML = day_new;
    document.getElementById("trx_month1_cluster").innerHTML = month2;
    document.getElementById("trx_month2_cluster").innerHTML = month1;
    document.getElementById("trx_month3_cluster").innerHTML = day_new;
    document.getElementById("rev_month1_cluster").innerHTML = month2;
    document.getElementById("rev_month2_cluster").innerHTML = month1;
    document.getElementById("rev_month3_cluster").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/performance_cluster'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}
// getDataLastCluster();

function getDataLastClusterFilter() {
    var tbody = document.getElementById('table-list-cvm-cluster');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_cluster").innerHTML = month2;
    document.getElementById("subs_month2_cluster").innerHTML = month1;
    document.getElementById("subs_month3_cluster").innerHTML = day_new;
    document.getElementById("trx_month1_cluster").innerHTML = month2;
    document.getElementById("trx_month2_cluster").innerHTML = month1;
    document.getElementById("trx_month3_cluster").innerHTML = day_new;
    document.getElementById("rev_month1_cluster").innerHTML = month2;
    document.getElementById("rev_month2_cluster").innerHTML = month1;
    document.getElementById("rev_month3_cluster").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/performance_cluster'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterComboSakti() {
    var tbody = document.getElementById('table-list-cvm-combo-sakti');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_combo_sakti").innerHTML = month2;
    document.getElementById("subs_month2_combo_sakti").innerHTML = month1;
    document.getElementById("subs_month3_combo_sakti").innerHTML = day_new;
    document.getElementById("trx_month1_combo_sakti").innerHTML = month2;
    document.getElementById("trx_month2_combo_sakti").innerHTML = month1;
    document.getElementById("trx_month3_combo_sakti").innerHTML = day_new;
    document.getElementById("rev_month1_combo_sakti").innerHTML = month2;
    document.getElementById("rev_month2_combo_sakti").innerHTML = month1;
    document.getElementById("rev_month3_combo_sakti").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_combo_sakti'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterInternetSakti() {
    var tbody = document.getElementById('table-list-cvm-internet-sakti');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_internet_sakti").innerHTML = month2;
    document.getElementById("subs_month2_internet_sakti").innerHTML = month1;
    document.getElementById("subs_month3_internet_sakti").innerHTML = day_new;
    document.getElementById("trx_month1_internet_sakti").innerHTML = month2;
    document.getElementById("trx_month2_internet_sakti").innerHTML = month1;
    document.getElementById("trx_month3_internet_sakti").innerHTML = day_new;
    document.getElementById("rev_month1_internet_sakti").innerHTML = month2;
    document.getElementById("rev_month2_internet_sakti").innerHTML = month1;
    document.getElementById("rev_month3_internet_sakti").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_internet_sakti'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterOthers() {
    var tbody = document.getElementById('table-list-cvm-others');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_others").innerHTML = month2;
    document.getElementById("subs_month2_others").innerHTML = month1;
    document.getElementById("subs_month3_others").innerHTML = day_new;
    document.getElementById("trx_month1_others").innerHTML = month2;
    document.getElementById("trx_month2_others").innerHTML = month1;
    document.getElementById("trx_month3_others").innerHTML = day_new;
    document.getElementById("rev_month1_others").innerHTML = month2;
    document.getElementById("rev_month2_others").innerHTML = month1;
    document.getElementById("rev_month3_others").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_others'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterMultisim() {
    var tbody = document.getElementById('table-list-cvm-multisim');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_multisim").innerHTML = month2;
    document.getElementById("subs_month2_multisim").innerHTML = month1;
    document.getElementById("subs_month3_multisim").innerHTML = day_new;
    document.getElementById("trx_month1_multisim").innerHTML = month2;
    document.getElementById("trx_month2_multisim").innerHTML = month1;
    document.getElementById("trx_month3_multisim").innerHTML = day_new;
    document.getElementById("rev_month1_multisim").innerHTML = month2;
    document.getElementById("rev_month2_multisim").innerHTML = month1;
    document.getElementById("rev_month3_multisim").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_multisim'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterHotPromo() {
    var tbody = document.getElementById('table-list-cvm-hotpromo');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_hotpromo").innerHTML = month2;
    document.getElementById("subs_month2_hotpromo").innerHTML = month1;
    document.getElementById("subs_month3_hotpromo").innerHTML = day_new;
    document.getElementById("trx_month1_hotpromo").innerHTML = month2;
    document.getElementById("trx_month2_hotpromo").innerHTML = month1;
    document.getElementById("trx_month3_hotpromo").innerHTML = day_new;
    document.getElementById("rev_month1_hotpromo").innerHTML = month2;
    document.getElementById("rev_month2_hotpromo").innerHTML = month1;
    document.getElementById("rev_month3_hotpromo").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_hotpromo'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterInlife() {
    var tbody = document.getElementById('table-list-cvm-inlife');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_inlife").innerHTML = month2;
    document.getElementById("subs_month2_inlife").innerHTML = month1;
    document.getElementById("subs_month3_inlife").innerHTML = day_new;
    document.getElementById("trx_month1_inlife").innerHTML = month2;
    document.getElementById("trx_month2_inlife").innerHTML = month1;
    document.getElementById("trx_month3_inlife").innerHTML = day_new;
    document.getElementById("rev_month1_inlife").innerHTML = month2;
    document.getElementById("rev_month2_inlife").innerHTML = month1;
    document.getElementById("rev_month3_inlife").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_inlife'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilterChurn() {
    var tbody = document.getElementById('table-list-cvm-churn');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_churn").innerHTML = month2;
    document.getElementById("subs_month2_churn").innerHTML = month1;
    document.getElementById("subs_month3_churn").innerHTML = day_new;
    document.getElementById("trx_month1_churn").innerHTML = month2;
    document.getElementById("trx_month2_churn").innerHTML = month1;
    document.getElementById("trx_month3_churn").innerHTML = day_new;
    document.getElementById("rev_month1_churn").innerHTML = month2;
    document.getElementById("rev_month2_churn").innerHTML = month1;
    document.getElementById("rev_month3_churn").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_churn'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataLastClusterFilter4G() {
    var tbody = document.getElementById('table-list-cvm-4g');
    tbody.innerHTML = '<tr><td colspan="21" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'

    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    // var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_4g").innerHTML = month2;
    document.getElementById("subs_month2_4g").innerHTML = month1;
    document.getElementById("subs_month3_4g").innerHTML = day_new;
    document.getElementById("trx_month1_4g").innerHTML = month2;
    document.getElementById("trx_month2_4g").innerHTML = month1;
    document.getElementById("trx_month3_4g").innerHTML = day_new;
    document.getElementById("rev_month1_4g").innerHTML = month2;
    document.getElementById("rev_month2_4g").innerHTML = month1;
    document.getElementById("rev_month3_4g").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/filter_cvm_fourg'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h5>No Record Found.</h5></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                // var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    var tr = '';
                    var x = 1;
                    for (var i in data) {
                        tr += `<tr style="font-size: 8pt;">
                        <td align="center">${x++}</td>
                        <td style="text-align: left;">${data[i].clsuter}</td>
                        <td style="text-align: left;">${data[i].paket}</td>
                        <td>${data[i].subs2}</td>
                        <td>${data[i].subs1}</td>
                        <td>${data[i].subs0}</td>`;
                        if (data[i].MoM_M2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                        }
                        if (data[i].MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].trx2}</td>
                        <td>${data[i].trx1}</td>
                        <td>${data[i].trx0}</td>`
                        if (data[i].MoM_M2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                        }
                        if (data[i].MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                        }
                        tr += `
                        <td>${data[i].rev_m2}</td>
                        <td>${data[i].rev_m1}</td>
                        <td>${data[i].rev_m0}</td>`
                        if (data[i].MoM_M2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</td>`
                        }
                        if (data[i].MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                        }
                        tr += `
                    </tr>`;
                    }
                    tbody.innerHTML = tr;
                }
                tbody.innerHTML = tr;
            }
        }
    });

}

function getDataCVMFilter() {
    var tbody = document.getElementById('table-list-cvm');
    tbody.innerHTML = '<tr><td colspan="20" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'
    // var todayDate = new Date().toISOString().slice(0, 10);
    var todayDate = $("#date_filter_cvm").val();
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1").innerHTML = month2;
    document.getElementById("subs_month2").innerHTML = month1;
    document.getElementById("subs_month3").innerHTML = day_new;
    document.getElementById("trx_month1").innerHTML = month2;
    document.getElementById("trx_month2").innerHTML = month1;
    document.getElementById("trx_month3").innerHTML = day_new;
    document.getElementById("rev_month1").innerHTML = month2;
    document.getElementById("rev_month2").innerHTML = month1;
    document.getElementById("rev_month3").innerHTML = day_new;
    $.ajax({
        url: base_url('cvm/performance_region'),
        method: "POST",
        data: {
            tanggal: todayDate,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h3>No Record Found.</h3></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                var subsm1, subsm2, subsm0, trxm1, trxm2, trxm0, revm1, revm2, revm0, MoM2_Subs, MoM_Subs, MoM2_trx, MoM_trx, MoM2_rev, MoM_rev;
                for (var i in data) {
                    // subs
                    if (data[i].subs_m2 == null) {
                        subsm2 = 0;
                    } else {
                        subsm2 = data[i].subs_m2;
                    }

                    if (data[i].subs_m1 == null) {
                        subsm1 = 0;
                    } else {
                        subsm1 = data[i].subs_m1;
                    }

                    if (data[i].subs_m0 == null) {
                        subsm0 = 0;
                    } else {
                        subsm0 = data[i].subs_m0;
                    }
                    if (data[i].MoM_M2_Subs == null) {
                        MoM2_Subs = 0;
                    } else {
                        MoM2_Subs = data[i].MoM_M2_Subs;
                    }

                    if (data[i].MoM_Subs == null) {
                        MoM_Subs = 0;
                    } else {
                        MoM_Subs = data[i].MoM_Subs;
                    }
                    // end subs

                    // trx
                    if (data[i].trx_m2 == null) {
                        trxm2 = 0;
                    } else {
                        trxm2 = data[i].trx_m2;
                    }

                    if (data[i].trx_m1 == null) {
                        trxm1 = 0;
                    } else {
                        trxm1 = data[i].trx_m1;
                    }

                    if (data[i].trx_m0 == null) {
                        trxm0 = 0;
                    } else {
                        trxm0 = data[i].trx_m0;
                    }
                    if (data[i].MoM_M2_trx == null) {
                        MoM2_trx = 0;
                    } else {
                        MoM2_trx = data[i].MoM_M2_trx;
                    }

                    if (data[i].MoM_trx == null) {
                        MoM_trx = 0;
                    } else {
                        MoM_trx = data[i].MoM_trx;
                    }
                    // end trx
                    // rev
                    if (data[i].rev_m2 == null) {
                        revm2 = 0;
                    } else {
                        revm2 = data[i].rev_m2;
                    }

                    if (data[i].rev_m1 == null) {
                        revm1 = 0;
                    } else {
                        revm1 = data[i].rev_m1;
                    }

                    if (data[i].rev_m0 == null) {
                        revm0 = 0;
                    } else {
                        revm0 = data[i].rev_m0;
                    }
                    if (data[i].MoM_M2_rev == null) {
                        MoM2_rev = 0;
                    } else {
                        MoM2_rev = data[i].MoM_M2_rev;
                    }

                    if (data[i].MoM_rev == null) {
                        MoM_rev = 0;
                    } else {
                        MoM_rev = data[i].MoM_rev;
                    }


                    if (data[i].paket_group == 'Total') {
                        tr += `<tr style="background-color: rgb(187, 156, 151);text-align: right;font-size: 8pt;">
                            <td style="color: rgb(255, 255, 255);text-align: center;">${a++}</td>
                            <td style="color: rgb(255, 255, 255);text-align: left;">${data[i].region}</td>
                            <td style="color: rgb(255, 255, 255);text-align: left;">${data[i].paket_group}</td>
                            <td style="color: rgb(255, 255, 255);">${subsm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${subsm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${subsm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_Subs < 0) {
                            tr += `<td style="color: rgb(255, 38, 49);">${MoM2_Subs + "%"}</td>`
                        } else {
                            tr += `<td style="color: rgb(255, 255, 255);">${MoM2_Subs + "%"}</td>`

                        }
                        if (MoM_Subs < 0) {
                            tr += `<td style="color: rgb(255, 38, 49);">${MoM_Subs + "%"}</td>`
                        } else {
                            tr += `<td style="color: rgb(255, 255, 255);">${MoM_Subs + "%"}</td>`

                        }
                        tr += `
                            <td style="color: rgb(255, 255, 255);">${trxm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${trxm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${trxm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`

                        if (MoM2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM2_trx + "%"}</td>`

                        }
                        if (MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM_trx + "%"}</td>`

                        }
                        tr += `
                            <td style="color: rgb(255, 255, 255);">${revm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${revm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                            <td style="color: rgb(255, 255, 255);">${revm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM2_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM2_rev + "%"}</td>`
                        }
                        if (MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);">${MoM_rev + "%"}</td>`
                        } else {
                            tr += ` <td style="color: rgb(255, 255, 255);">${MoM_rev + "%"}</td>`
                        }
                        tr += `
                        </tr>`;
                    } else {
                        tr += `<tr style="text-align:right;font-size: 8pt;">
                                <td style="text-align: center;">${a++}</td>
                                <td style="text-align: left;">${data[i].region}</td>
                                <td style="text-align: left;">${data[i].paket_group}</td>
                                <td>${subsm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${subsm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${subsm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                `
                        if (MoM2_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM2_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM2_Subs + "%"}</td>`
                        }
                        if (MoM_Subs < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM_Subs + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM_Subs + "%"}</td>`
                        }

                        tr += `
                                <td>${trxm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${trxm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${trxm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM2_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM2_trx + "%"}</td>`
                        }
                        if (MoM_trx < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${MoM_trx + "%"}</td>`
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM_trx + "%"}</td>`
                        }

                        tr += `
                                <td>${revm2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${revm1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${revm0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                        if (MoM2_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${MoM2_rev + "%"}</ > `
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM2_rev + "%"}</>`
                        }
                        if (MoM_rev < 0) {
                            tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${MoM_rev + "%"}</ > `
                        } else {
                            tr += ` <td style="background-color: rgb(201, 246, 153);">${MoM_rev + "%"}</td>`
                        }
                        tr += `
                            <td style="text-align:center;background-color: rgb(240, 223, 194);">
                                <a href="#" onclick="detail_last_view('${data[i].region}', '${data[i].paket_group}')">
                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr> `;
                    }
                }
                tbody.innerHTML = tr;
            }
        }
    });
}
// loadTableCVM();
function filterFullMonthCVM() {
    getDataCVMFilter();
    // getDataLastClusterFilter();
    getDataLastClusterFilterComboSakti();
    getDataLastClusterFilterInternetSakti();
    getDataLastClusterFilterOthers();
    getDataLastClusterFilterMultisim();
    getDataLastClusterFilterHotPromo();
    getDataLastClusterFilterInlife();
    getDataLastClusterFilterChurn();
    getDataLastClusterFilter4G();
}

function FilterDateNow() {
    var todayDate = $("#date_filter_cvm").val();
    var checkday = new Date(todayDate);
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var datenew = m + "/" + d + "/" + y;
        var m2 = m;
        var m3 = "0" + m2;
        var m4 = "0" + (m - 1);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var month1 = n1 + "-" + ("0" + mt1.getMonth()).slice(-2) + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = (n1 + 1) + "-" + ("0" + mt2.getMonth()).slice(-2) + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var month1 = d1 + "-" + m1 + "-" + y1;
        var month2 = d2 + "-" + m2 + "-" + y2;
    }
    document.getElementById("subs_month1").innerHTML = month2;
    document.getElementById("subs_month2").innerHTML = month1;
    document.getElementById("subs_month3").innerHTML = todayDate;
    document.getElementById("trx_month1").innerHTML = month2;
    document.getElementById("trx_month2").innerHTML = month1;
    document.getElementById("trx_month3").innerHTML = todayDate;
    document.getElementById("rev_month1").innerHTML = month2;
    document.getElementById("rev_month2").innerHTML = month1;
    document.getElementById("rev_month3").innerHTML = todayDate;
}


function downloadcvmbylast() {
    var today = document.getElementById("lastupdate").innerHTML;
    // document.location.href = "../pages/ekspor_cvm.php";
}

function downloadbyfilterdate() {
    var day = $("#date_filter_cvm").val();
    if (day === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Notification',
            text: 'Harap Jangan Lupa memilih Tanggal Filter !'
        });
    } else {
        document.location.href = base_url('cvm/export_cvm_filter/' + day);
    }
}

function capture_cvm() {
    html2canvas($("#cvm_table"), {
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

            saveAs(uri, "CVM.png");
        },
    });
}


function getMonth(num, mont) {
    if (num == '01') {
        mont = 'Jan';
    } else if (num == '02') {
        mont = 'Feb';
    } else if (num == '03') {
        mont = 'Mar';
    } else if (num == '04') {
        mont = 'Apr';
    } else if (num == '05') {
        mont = 'May';
    } else if (num == '06') {
        mont = 'Jun';
    } else if (num == '07') {
        mont = 'Jul';
    } else if (num == '08') {
        mont = 'Aug';
    } else if (num == '09') {
        mont = 'Sep';
    } else if (num == '10') {
        mont = 'Oct';
    } else if (num == '11') {
        mont = 'Nov';
    } else if (num == '12') {
        mont = 'Dec';
    }
    return mont;
}


function detail_last_view(region, paket_group) {
    var tbody = document.getElementById('table-detail-cvm');
    tbody.innerHTML = '<tr><td colspan="20" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'
    $("#staticBackdrop").modal("show");
    var todayDate = document.getElementById("lastupdate").innerHTML;
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_detail").innerHTML = month2;
    document.getElementById("subs_month2_detail").innerHTML = month1;
    document.getElementById("subs_month3_detail").innerHTML = day_new;
    document.getElementById("trx_month1_detail").innerHTML = month2;
    document.getElementById("trx_month2_detail").innerHTML = month1;
    document.getElementById("trx_month3_detail").innerHTML = day_new;
    document.getElementById("rev_month1_detail").innerHTML = month2;
    document.getElementById("rev_month2_detail").innerHTML = month1;
    document.getElementById("rev_month3_detail").innerHTML = day_new;

    $.ajax({
        url: base_url('cvm/performance_detail'),
        method: "POST",
        data: {
            datenow: todayDate,
            region: region,
            cat_package: paket_group,
        },
        dataType: "JSON",
        success: function (data) {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h3>No Record Found.</h3></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                var subsm1, subsm2, subsm3, trxm1, trxm2, trxm3, revm1, revm2, revm3, MoM2_Subs;
                for (var i in data) {
                    tr += `<tr style="text-align:right;font-size: 8pt;">
                                <td style="text-align: center;">${a++}</td>
                                <td style="text-align: left;">${data[i].region}</td>
                                <td style="text-align: left;">${data[i].package_subgroup}</td>
                                <td>${data[i].subs_m2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].subs_m1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].subs_m0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                `
                    if (data[i].MoM_M2_Subs < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                    }
                    if (data[i].MoM_Subs < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                    }

                    tr += `
                                <td>${data[i].trx_m2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].trx_m1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].trx_m0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                    if (data[i].MoM_M2_trx < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                    }
                    if (data[i].MoM_trx < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                    }

                    tr += `
                                <td>${data[i].rev_m2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].rev_m1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].rev_m0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                    if (data[i].MoM_M2_rev < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${data[i].MoM_M2_rev + "%"}</ > `
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</>`
                    }
                    if (data[i].MoM_rev < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${data[i].MoM_rev + "%"}</ > `
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                    }
                    tr += `
                    </tr>`;
                }
                tbody.innerHTML = tr;
            }
        }
    });


}


function detail_filter_view(region, paket_group) {
    var tbody = document.getElementById('table-detail-cvm');
    tbody.innerHTML = '<tr><td colspan="20" align="center"><h7><img src="public/assets/img/load1.gif" alt=""style = "width: 100px;height: 100px;">data is being prepared, please wait ..</h7></td></tr>'
    $("#staticBackdrop").modal("show");
    var todayDate = $("#date_filter_cvm").val();
    var checkday = new Date(todayDate);
    var yyyy = checkday.getFullYear();
    var mm = checkday.getMonth() + 1;
    var dd = checkday.getDate();
    var month_now;
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day_new = monthNames[checkday.getMonth()] + '-' + yyyy;
    if (("0" + checkday.getDate()).slice(-2) == 31) {
        var d = "01";
        var m = ('0' + (checkday.getMonth() + 1)).slice(-2);
        var y = ("0" + checkday.getFullYear()).slice(-4);
        var m2 = m;
        var m3 = "0" + (m - 1);
        var m4 = "0" + (m - 2);
        var mt1 = new Date(y, m3, 0);
        var mt2 = new Date(y, m4, 0);
        var n1 = ("0" + mt1.getDate()).slice(-2) - 1;
        var mtd1, mtd2;
        var month1 = monthNames[mt1.getMonth()] + "-" + ("0" + mt1.getFullYear()).slice(-4);
        var month2 = monthNames[mt2.getMonth()] + "-" + ("0" + mt2.getFullYear()).slice(-4);
    } else {
        var monnow1 = new Date(todayDate);
        monnow1.setMonth(monnow1.getMonth() - 1);
        var monnow2 = new Date(todayDate);
        monnow2.setMonth(monnow2.getMonth() - 2);
        var nd = new Date(monnow1);
        var nd2 = new Date(monnow2);
        var d1 = ("0" + nd.getDate()).slice(-2);
        var m1 = ("0" + (nd.getMonth() + 1)).slice(-2);
        var y1 = nd.getFullYear()
        var d2 = ("0" + nd2.getDate()).slice(-2);
        var m2 = ("0" + (nd2.getMonth() + 1)).slice(-2);
        var y2 = nd2.getFullYear()
        var mtd01, mtd02;
        getMonth(m1, mtd01);
        getMonth(m2, mtd02);

        var month1 = monthNames[nd.getMonth()] + "-" + y1;
        var month2 = monthNames[nd2.getMonth()] + "-" + y2;
    }
    document.getElementById("subs_month1_detail").innerHTML = month2;
    document.getElementById("subs_month2_detail").innerHTML = month1;
    document.getElementById("subs_month3_detail").innerHTML = day_new;
    document.getElementById("trx_month1_detail").innerHTML = month2;
    document.getElementById("trx_month2_detail").innerHTML = month1;
    document.getElementById("trx_month3_detail").innerHTML = day_new;
    document.getElementById("rev_month1_detail").innerHTML = month2;
    document.getElementById("rev_month2_detail").innerHTML = month1;
    document.getElementById("rev_month3_detail").innerHTML = day_new;

    var formdata2 = {
        'datenow': todayDate,
        'region': region,
        'cat_package': paket_group,
    }

    jsondata2 = JSON.stringify(formdata2);

    fetch('../panel/cvm_detail.php?aksi=region', {
        method: 'POST',
        body: jsondata2,
        headers: {
            'Content-type': 'application/json',
        }
    })
        .then((response) => response.json())
        .then((data) => {
            if (data['empty']) {
                tbody.innerHTML = '<tr><td colspan="20" align="center"><h3>No Record Found.</h3></td></tr>'
            } else {
                var tr = '';
                var a = 1;
                var subsm1, subsm2, subsm3, trxm1, trxm2, trxm3, revm1, revm2, revm3, MoM2_Subs;
                for (var i in data) {
                    tr += `<tr style="text-align:right;font-size: 8pt;">
                                <td style="text-align: center;">${a++}</td>
                                <td style="text-align: left;">${data[i].region}</td>
                                <td style="text-align: left;">${data[i].package_subgroup}</td>
                                <td>${data[i].subs_m2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].subs_m1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].subs_m0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                `
                    if (data[i].MoM_M2_Subs < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_Subs + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_Subs + "%"}</td>`
                    }
                    if (data[i].MoM_Subs < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_Subs + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_Subs + "%"}</td>`
                    }

                    tr += `
                                <td>${data[i].trx_m2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].trx_m1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].trx_m0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                    if (data[i].MoM_M2_trx < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_M2_trx + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_trx + "%"}</td>`
                    }
                    if (data[i].MoM_trx < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);">${data[i].MoM_trx + "%"}</td>`
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_trx + "%"}</td>`
                    }

                    tr += `
                                <td>${data[i].rev_m2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].rev_m1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                <td>${data[i].rev_m0.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>`
                    if (data[i].MoM_M2_rev < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${data[i].MoM_M2_rev + "%"}</ > `
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_M2_rev + "%"}</>`
                    }
                    if (data[i].MoM_rev < 0) {
                        tr += ` <td style="color: rgb(255, 38, 49);background-color: rgb(255, 200, 202);" > ${data[i].MoM_rev + "%"}</ > `
                    } else {
                        tr += ` <td style="background-color: rgb(201, 246, 153);">${data[i].MoM_rev + "%"}</td>`
                    }
                    tr += `
                    </tr>`;
                }
                tbody.innerHTML = tr;
            }
        })
        .catch((error) => {
            // show_message('error', "Can't Fetch Data");
        });
}

function download_file_detail_cvm() {
    var todayDate = document.getElementById('lastupdate').innerHTML;
    open.uri = "../pages/ekspor_cvm_detail.php?date=" + todayDate;
}

function capture_detail_cvm() {
    html2canvas($("#cvm_table_detail"), {
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

            saveAs(uri, "CVM_Detail.png");
        },
    });
}

