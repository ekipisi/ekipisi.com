@extends('layouts.user') 

@section('section')
<section class="section">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <div class="content">
                        <h2 class="no-margin is-size-5">{{ $title }}</h2>
                        <hr />
<p>
    {!! $description !!}
</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('user-scripts')
<script>
function OpenOnlineSupport(){
    $crisp.push(["do", "chat:open"])
}
</script>
@endsection