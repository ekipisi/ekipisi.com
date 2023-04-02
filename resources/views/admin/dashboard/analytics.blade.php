<div class="box-group" style="margin-bottom: 20px;">
    <div class="panel box box-solid" style="margin-bottom: 0px;">
        <div class="box-header with-border">
            <h4 class="box-title">
                 <i class="fa fa-fw fa-line-chart"></i>   Ziyaretçi Trafiği / Sayfa Görüntülenmesi
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="box-body">
                <canvas id="myAnalytics"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        window.chartColors = {
            red: 'rgba(255, 99, 132, 0.5)',
            orange: 'rgba(255, 159, 64, 0.5)',
            yellow: 'rgba(255, 205, 86, 0.9)',
            green: 'rgba(75, 192, 192, 0.5)',
            blue: 'rgba(54, 162, 235, 0.5)',
            purple: 'rgba(153, 102, 255, 0.5)',
            grey: 'rgba(201, 203, 207, 0.5)'
        };
        var config = {
            type: 'line',
            data: {
                labels: [
                    @foreach($totalvisitor_rows as $row)
                        "{{ $row[0] }}",
                    @endforeach
                ],
                datasets: [{
                    label: "Ziyaretci Sayisi",
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    data: [
                        @foreach($totalvisitor_rows as $row)
                        {{ $row[1] }},
                        @endforeach
                    ],
                    fill: true,
                }, {
                    label: "Sayfa Goruntulenmesi",
                    fill: true,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        @foreach($totalvisitor_rows as $row)
                        {{ $row[2] }},
                        @endforeach
                    ],
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: 'Ziyaretci Trafigi'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Gun'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        },
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Sayi'
                        }
                    }]
                }
            }
        };

        window.onload = function () {
            var ctx = document.getElementById("myAnalytics").getContext("2d");
            window.myLine = new Chart(ctx, config);
        };
    });
</script>