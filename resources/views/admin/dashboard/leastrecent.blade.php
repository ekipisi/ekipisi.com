<div class="box box-default box-solid">
    <div class="box-body">
        <h4 class="box-title custom-box-title">
            <i class="fa fa-fw fa-eye"></i>En Az Aktif Müşteriler
        </h4>
    </div>
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            @foreach($activities as $activity)
            <li>
                <a href="{{ route('customer.detail', $activity->user->id) }}" target="_blank">
                    {{ $activity->user->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>