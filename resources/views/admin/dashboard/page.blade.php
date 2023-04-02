<div class="box-group" style="margin-bottom: 20px;">
    <div class="panel box box-solid" style="margin-bottom: 0px;">
        <div class="box-header with-border">
            <h4 class="box-title">
                <i class="fa fa-fw fa-eye"></i> Sayfa Görüntülenmeleri
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="box-body table-responsive no-padding">
                <div class="slimScroll2">
                <table class="table table-hover sortable">
                    <thead>
                    <tr>
                        <th>Sayfa Başlığı</th>
                        <th>Görüntülenme</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mostvisited_rows as $page)
                        <tr>
                            <td><a href="{{ config('app.link') }}{{ $page[0] }}" target="_blank">{{ $page[1] }}</a></td>
                            <td>{{ $page[2] }}</td>
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
            $('.slimScroll2').slimScroll({
                height: '406px',
                alwaysVisible: false,
                railVisible: true,
                allowPageScroll: false
            });
        });
    </script>