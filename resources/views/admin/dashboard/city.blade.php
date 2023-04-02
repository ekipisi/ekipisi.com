<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Harita</a></li>
        <li><a href="#tab_2-2" data-toggle="tab">Liste</a></li>
        <li class="pull-left header"><i class="fa fa-fw fa-globe"></i> Şehirlere Göre Ziyaretçi ve Sayfa
            Görüntülemeleri
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1" style="position:relative">
            <div id="world-map-markers" style="height: 334px;"></div>

            <div class="btn-group" style="position:absolute; right: 2px; top:2px;">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-fw fa-calendar"></i>
                </button>
                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ admin_url('/?day=1') }}">Bugün</a></li>
                  <li><a href="{{ admin_url('/?day=7') }}">Son 7 Gün</a></li>
                  <li><a href="{{ admin_url('/?day=30') }}">1 Ay</a></li>
                  <li><a href="{{ admin_url('/?day=60') }}">2 Ay</a></li>
                  <li><a href="{{ admin_url('/?day=90') }}">3 Ay</a></li>
                  <li><a href="{{ admin_url('/?day=180') }}">6 Ay</a></li>
                  <li><a href="{{ admin_url('/?day=270') }}">9 Ay</a></li>
                  <li><a href="{{ admin_url('/?day=365') }}">1 Yıl</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-pane table-responsive no-padding" id="tab_2-2">
            <div class="slimScroll">
                <table class="table table-hover sortable">
                    <thead>
                    <tr>
                        <th>Şehir</th>
                        <th>Ziyaretçi Sayısı</th>
                        <th>Sayfa Görüntülenmesi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities_rows as $city)
                        <tr>
                            <td><a target="_blank"
                                   href="https://www.google.com.tr/maps/place/{{ $city[0] }}">{{ $city[0] }}</a></td>
                            <td>{{ $city[3] }}</td>
                            <td>{{ $city[4] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.slimScroll').slimScroll({
            height: '334px',
            alwaysVisible: false,
            railVisible: true,
            allowPageScroll: false
        });
        $('#world-map-markers').vectorMap({
            map: 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity: 0.7,
            hoverColor: false,
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: 'rgb(210, 214, 222)',
                    'fill-opacity': 1,
                    stroke: 'none',
                    'stroke-width': 0,
                    'stroke-opacity': 1
                },
                hover: {
                    'fill-opacity': 0.7,
                    cursor: 'pointer'
                },
                selected: {
                    fill: 'yellow'
                },
                selectedHover: {}
            },
            markerStyle: {
                initial: {
                    fill: 'rgba(255, 99, 132, 3)',
                    stroke: '#fd2d5c'
                }
            },
            markers: [
                    @foreach($cities_rows as $city)
                {
                    latLng: [{{ $city[1] }}, {{$city[2] }}],
                    name: '***{{ $city[0] }}** -Ziyaretçi Sayısı : {{ $city[3] }} -Sayfa Görüntülenmesi : {{ $city[4] }}',
                },
                @endforeach
            ],
            onMarkerTipShow: function (event, tip, index) {
                tip.html(tip.html().replace(/-/g, "<br />").replace('***', "<strong style='font-size:16px;'>").replace('**', "</strong>"));
            },
        });
    });
</script>