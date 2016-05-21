$(function() {
    
    var url = "http://localhost/ta/web/index.php";

    $.ajax({
            url: url + '/home/grafik',
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {

            Morris.Bar({
                element: 'morris-bar-chart',
                data: response,
                xkey: 'namakecamatan',
                ykeys: ['pertama', 'kedua', 'ketiga'],
                labels: ['Hampir Miskin', 'Miskin', 'Sangat Miskin'],
                hideHover: 'auto',
                resize: true,
                xLabelAngle: 50,
                barColors: ['#000099', '#00cc00', '#ff0000']
            });
            var el = document.getElementById('load');
            el.parentNode.removeChild(el);
        });

    $.ajax({
            url: url + '/home/hampirmiskin',
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            Morris.Donut({
            element: 'morris-donut-chart',
            data: response,
            resize: true,
            colors: [
                '#000033',
                '#00004d',
                '#000066',
                '#000080',
                '#000099',
                '#0000b3',
                '#0000cc',
                '#0000e6',
                '#0000ff',
                '#1a1aff',
                '#3333ff',
                '#4d4dff',
                '#6666ff',
                '#8080ff',
                '#9999ff'
              ]
            });
            var el = document.getElementById('load1');
            el.parentNode.removeChild(el);
        });

    $.ajax({
            url: url + '/home/miskin',
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {

            Morris.Donut({
            element: 'morris-donut-chart2',
            data: response,
            resize: true,
            colors: [
                '#003300',
                '#004d00',
                '#006600',
                '#008000',
                '#009900',
                '#00b300',
                '#00cc00',
                '#00e600',
                '#00ff00',
                '#1aff1a',
                '#33ff33',
                '#4dff4d',
                '#66ff66',
                '#80ff80',
                '#99ff99'
            ]
            });
            var el = document.getElementById('load2');
            el.parentNode.removeChild(el);
        });

    $.ajax({
            url: url + '/home/sangatmiskin',
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {

            Morris.Donut({
            element: 'morris-donut-chart3',
            data: response,
            resize: true,
            colors: [
            '#330000',
            '#4d0000',
            '#660000',
            '#800000',
            '#990000',
            '#b30000',
            '#cc0000',
            '#e60000',
            '#ff0000',
            '#ff1a1a',
            '#ff3333',
            '#ff4d4d',
            '#ff6666',
            '#ff8080',
            '#ff9999'
            ]
            });
            var el = document.getElementById('load3');
            el.parentNode.removeChild(el);
        });
});
