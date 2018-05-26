<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Pembeli Tahun <?=date('Y')?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [<?=$list_bulan?>],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Pembeli/Orang'
            }
        },
        tooltip: {
            headerFormat: '<span style=font-size:10px>{point.key}</span><table class=table-no-border>',
            pointFormat: '<tr>' +
                '<td style=padding:0><b>{point.y:1f} Pembeli</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Data Pembeli',
            data: [<?=$list_jumlah_pembeli?>]

        }]
    });
</script>