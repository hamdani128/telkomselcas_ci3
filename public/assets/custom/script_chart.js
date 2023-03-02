// Api
// var url = 'http://localhost/cas/api/taker_wa.php';
// $.getJSON(url, function (response) {
//     chart1.updateseries([{
//         name: response.data[1],
//         data: response.data[12],
//     }]),
// });

// var url = 'http://localhost/cas/api/taker_wa.php';
// axios({
//     method: 'GET',
//     url: url,
// }).then(function (response) {
//     chart1.Series([{
//         name: response.data[1],
//         data: response.data[12],
//     }]),
// })

var options1 = {
    chart: {
        height: 350,
        type: 'bar',
    },
    dataLabels: {
        enabled: false
    },
    series: [],
    title: {
        text: 'Ajax Example',
    },
    noData: {
        text: 'Loading...'
    }
}

var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
chart1.render();

// var url = 'http://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly';
var url = 'http://localhost/cas/api/taker_wa';

$.getJSON(url, function (response) {
    chart1.updateSeries([{
        name: 'Sales',
        // name: response.data.area,
        data: [
            response[0],
            response[12],
        ],
    }])
});

var options2 = {
    series: [{
        name: 'Website Blog',
        type: 'column',
        data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
    }, {
        name: 'Social Media',
        type: 'line',
        data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
    }],
    chart: {
        height: 350,
        type: 'line',
    },
    stroke: {
        width: [0, 4]
    },
    title: {
        text: 'Traffic Sources'
    },
    dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
    },
    labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
    xaxis: {
        type: 'datetime'
    },
    yaxis: [{
        title: {
            text: 'Website Blog',
        },

    }, {
        opposite: true,
        title: {
            text: 'Social Media'
        }
    }]
};

var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
chart2.render();