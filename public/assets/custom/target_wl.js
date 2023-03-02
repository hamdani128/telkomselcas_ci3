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
    $('#datatable1').DataTable({
        ajax: {
            url: base_url('campaign_dev1/getdata'),
            dataSrc: "",
        },
        columns: [
            { "data": "no" },
            { "data": "region" },
            { "data": "branch" },
            { "data": "cluster" },
            { "data": "periode" },
            { "data": "value" },
        ],
    });
});


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

function tambah_data_target() {
    $("#my-modal").modal('show');
}

function simpan_data_target_wl() {
    $.ajax({
        url: base_url('campaign_dev1/simpan_data_target'),
        method: "POST",
        data: {
            username: username,
            password: password,
        },
        dataType: "JSON",
        success: function (data) {

        }
    });
}