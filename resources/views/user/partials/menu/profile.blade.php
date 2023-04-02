<div class="column is-3">
    <div class="flex-card light-bordered light-raised">
        <div class="card-body no-padding">
            <ul class="list-block">
                <li class="{{ (Request::is("user/profile")?"is-active":"") }}">
                    <a href="{{ route('user.profile') }}">
                        <i class="sl sl-icon-user mr-20"></i> {{ __('user.profile.title') }}</a>
                </li>
                <li class="{{ (Request::is("user/password")?"is-active":"") }}">
                    <a href="{{ route('user.password') }}">
                        <i class="sl sl-icon-key mr-20"></i> {{ __('user.password.title') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
