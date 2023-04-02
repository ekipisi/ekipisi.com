<div class="box-group" style="margin-bottom: 20px;">
    <div class="panel box box-solid" style="margin-bottom: 0px;">
        <div class="box-header with-border">
            <h4 class="box-title">
                <i class="fa fa-fw fa-sitemap"></i> Yönlendirenler
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="box-body table-responsive no-padding">
                <div class="slimScroll2">
                    <table class="table table-hover sortable">
                        <thead>
                        <tr>
                            <th>Referrer</th>
                            <th>Oturum</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($referrers_rows as $referrer)
                            <tr>
                                <td>{{ $referrer['url'] }}</td>
                                <td>{{ $referrer['pageViews'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
