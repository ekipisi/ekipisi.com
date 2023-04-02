<div class="box-group" style="margin-bottom: 20px;">
    <div class="panel box box-solid" style="margin-bottom: 0px;">
        <div class="box-header with-border">
            <h4 class="box-title">
                <i class="fa fa-fw fa-users"></i> Aktif Ziyaretçiler
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="box-body table-responsive no-padding">
                <div class="slimScrolluser">
                    <table class="table table-hover sortable">
                        <thead>
                        <tr>
                            <th>Ip Adresi</th>
                            <th>Robot</th>
                            <th>Tarayıcı</th>
                            <th>Ziyaret</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($online_users as $user)
                            <tr>
                                <td>
                                    @if ($user->client_ip == $ip)
                                        <span class='label label-success'>Siz</span>
                                    @else 
                                        {{ $user->client_ip }}
                                    @endif
                                </td>
                                <td>{{ $user->is_robot ? "Evet" : "Hayır" }}</td>
                                <td title="{{ $user['agent']->name }}">{{ str_limit($user['agent']->name, $limit = 20, $end = '...') }}</td>
                                <td>{{ count($user->log) }}</td>
                                <td>
                                <a class="btn btn-info btn-xs" data-toggle="tooltip" title="" href="{{ admin_url('tracker/detail/' . $user->id) }}" data-original-title="Detaylı Bilgi"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.slimScrolluser').slimScroll({
            height: '625px',
            alwaysVisible: false,
            railVisible: true,
            allowPageScroll: false
        });
    });
</script>