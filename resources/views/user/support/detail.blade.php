@extends('layouts.user') 
@section('section')

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-3">
                <div class="content">
                    <a class="button is-medium raised primary-btn is-fullwidth mb-40 btn-reply"><i class="sl sl-icon-lock"></i> Yeni Mesaj Ekle</a>
                    @if ($ticket->type_id == 2 && !empty($ticket->notes))
                    <article class="message custom-message icon-msg danger-msg">
                        <i class="material-icons animated swing infinite slower">notifications_active</i>
                        <div class="message-body">
                            <h4>Bilgi</h4>
                            {!! parsedown($ticket->notes) !!}
                        </div>
                    </article>
                    @endif 
                    @if (count($supporter)>0)
                    <h2 class="title is-size-5">Katkıda Bulunan Personeller</h2>
                    <div class="is-divider no-margin no-padding"></div>
                    <div class="solid-list mt-10 mb-10">
                        @foreach($supporter as $admin)
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check"></i>
                            </div>
                            <div class="list-text">
                                {{ $admin->admin['name'] }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="is-divider no-margin no-padding"></div>
                    <div class="solid-list mt-10 mb-30">
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-clock is-size-5"></i>
                            </div>
                            <div class="list-text is-size-7">
                                Oluşturulma Tarihi : <span class="text-bold">{{ $ticket->created_at }}</span>
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-clock is-size-5"></i>
                            </div>
                            <div class="list-text  is-size-7">
                                Güncellenme Tarihi : <span class="text-bold">{{ $ticket->updated_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="flex-card light-bordered light-raised" id="reply" style="display:none">
                    <div class="card-body padding-10">
                        <div class="content">
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <h2 class="is-size-5">Yeni Destek Talebi</h2>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        <a href="javascript:void(0)" class="btn-reply">
                                                <i class="material-icons">close</i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                            <form class="validate-with-message" method="post" action="{{ route('user.support.reply', $ticket->id) }}" accept-charset="UTF-8"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="columns no-padding-bottom no-margin-bottom">
                                    <div class="column">
                                        <textarea name="message" id="simplemde" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="level">
                                    <div class="level-left">
                                        <div class="level-item">
                                            <div class="uploader-controls has-text-centered animated preFadeInUp fadeInUp">
                                                <input type="file" name="fielduploader">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="level-right">
                                        <div class="level-item">
                                            <button type="submit" class="button is-medium is-info">Gönder</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flex-card card-md light-bordered light-raised">
                    <div class="card-body">
                        <div class="content">
                            <h4 class="no-margin is-size-5">Konu Başlığı:
                                <span class="has-text-weight-normal">{{ $ticket->title }}</span>
                            </h4>
                            <hr />
                            
                            {!! parsedown($ticket->message) !!}

                            @if ($ticket->file != "[]" && $ticket->file != "")
                            <div class="solid-list">
                                @foreach($ticket->file as $file)
                                <div class="solid-list-item">
                                    <div class="list-bullet is-size-7">
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                    <div class="list-text is-size-6">
                                        <a target="_blank" href="{{ Storage::disk('warden')->url($file) }}">
                                            {{ strrev(str_limit(strrev($file), 20)) }}
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <div class="is-divider mt-10 mb-10"></div>
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        IP Adresiniz: {{ $ticket->ip }}
                                    </div>
                                </div>
                                <div class="level-right">
                                    <p class="level-item">
                                        {{ Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($ticket->messages as $msg)
                <div class="flex-card card-md light-bordered light-raised {{ $msg->assign_id != 0 ? " soft-card supporter-card":" " }}">
                    <div class="card-body">
                        <div class="content">
                            {!! parsedown($msg->message) !!} 
                            
                            @if ($msg->file!="[]")
                            <div class="solid-list">
                                @foreach($msg->file as $file)
                                <div class="solid-list-item">
                                    <div class="list-bullet is-size-7">
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                    <div class="list-text is-size-6">
                                        <a target="_blank" href="{{ Storage::disk('warden')->url($file) }}">
                                                        {{ strrev(str_limit(strrev($file), 20)) }}
                                                    </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            
                            <div class="is-divider mt-10 mb-10"></div>
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        @if ($msg->assign_id != 0) {{ $msg->admin['name'] }} @else IP Adresiniz: {{ $msg->ip }} @endif
                                    </div>
                                </div>
                                <div class="level-right">
                                    <p class="level-item">
                                        {{ Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('user.support.home') }}" class="button raised is-white mb-20 is-hidden-tablet">
            <i class="fa fa-angle-left"></i> {{ __('global.back') }}
        </a>
    </div>
</section>
@endsection
 
@section('user-scripts')
<script>
    @if ($errors->any())
iziToast.show({
    icon: 'fa fa-bell-o',
    title: 'Merhaba',
    message: '@foreach ($errors->all() as $error) {{ $error }} @endforeach',
    theme: 'dark',
    class: 'custom1',
    position: 'bottomCenter',
    displayMode: 2,
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    progressBarColor: '#4FC1EA',
    balloon: true,
    iconColor: '#fff'
});
@endif

</script>
@endsection