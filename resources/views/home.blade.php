@extends('include.app')
@section('title', 'DataBank')
@section('content')
    <div class="container py5">
        <div class="ht-tm-cat">
            <div class="ht-tm-codeblock">
                <h2>Dashboard</h2>
                <hr>
                <div class="col-xs-12 col-md-6 float-right">
                    <div id="itemchart"></div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <table class="table table-hover table-striped ht-tm-element border">
                        <thead class="thead-dark">
                            <tr>
                                <th>Item Name</th>
                                <th>Item Active</th>
                                <th>Item Inactive</th>
                                <th>Item Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Shell Backdoor</th>
                                <th>{{ $data['shell_count_active'] }}</th>
                                <th>{{ $data['shell_count_inactive'] }}</th>
                                <th>{{ $data['shell_count'] }}</th>
                            </tr>
                            <tr>
                                <th>Virtual Private Server</th>
                                <th>{{ $data['vps_count_active'] }}</th>
                                <th>{{ $data['vps_count_inactive'] }}</th>
                                <th>{{ $data['vps_count'] }}</th>
                            </tr>
                            <tr>
                                <th>cPanel</th>
                                <th>{{ $data['cpanel_count_active'] }}</th>
                                <th>{{ $data['cpanel_count_inactive'] }}</th>
                                <th>{{ $data['cpanel_count'] }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        Highcharts.theme = {
            chart: {
                backgroundColor: {
                    linearGradient: {
                        x1: '#11111d',
                    },
                    stops: [
                        [0, '#11111d'],
                    ]
                },
            },
            title: {
                style: {
                    color: '#ffffff',
                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif',
                }
            },
        };
        Highcharts.setOptions(Highcharts.theme);
        Highcharts.chart('itemchart', {
            chart: {
                plotBackgroundColor: '#0c0d16',
                type: 'pie'
            },
            title: {
                text: 'List Item Available'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Count',
                colorByPoint: true,
                data: [{
                    name: 'Shell',
                    y: {{ $data['shell_count'] }}
                }, {
                    name: 'cPanel',
                    y: {{ $data['cpanel_count'] }},
                }, {
                    name: 'VPS',
                    y: {{ $data['vps_count'] }}
                }]
            }]
        });
        </script>
@endsection