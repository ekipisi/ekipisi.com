<div class="box-group" style="margin-bottom: 20px;">
    <div class="panel box box-solid" style="margin-bottom: 0px;">
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="box-body">
                <canvas id="myVisitor"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        var config_pie = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        @foreach($fetchUserTypes_rows as $user)
                        {{ $user['sessions'] }},
                        @endforeach
                    ],
                    backgroundColor: [
                        window.chartColors.purple,
                        window.chartColors.yellow,
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    @foreach($fetchUserTypes_rows as $user)
                        '{{ str_replace('Returning Visitor','Geri Gelen Ziyaretçi',str_replace('New Visitor','Yeni Ziyaretçi',$user['type'])) }}',
                    @endforeach
                ]
            },
            options: {
                responsive: true
            }
        };

        var ctx_pie = document.getElementById("myVisitor").getContext("2d");
        window.ctx_pie = new Chart(ctx_pie, config_pie);
    });
</script>