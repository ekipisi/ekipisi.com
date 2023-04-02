<div class="row">
    <div class="col-md-9">
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="{{ Gravatar::get($message->email, ['size'=>128])  }}" alt="{{ $message->firstname }} {{ $message->lastname }}">
                    <span class="username">
            {{ $message->firstname }} {{ $message->lastname }}
        @if (!empty($message->user_id))
        <a href="{{ admin_url('users/' . $message->user_id . '/detail') }}"><i class="fa fa-external-link"></i></a>
        @endif
        </span>
                    <span class="description" id="message-subject">{{ $message->subject }}</span>
                </div>
            </div>
            <div class="box-body">
                <p id="message-body">{!! $message->message !!}</p>
                <hr />
                <a href="javascript:void(0);" class="btn btn-warning btn-reply-email">Cevap Ver</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-widget">
            <div class="box-header with-border">
                <h4 class="text-bold">Mesaj Detayları</h4>
            </div>
            <div class="box-body">
                <dl>
                    <dt>Form Tipi:</dt>
                    <dd>
                        @if ($message->type==1) İletişim Formu 
                        @elseif ($message->type==2) Demo Talep 
                        @elseif ($message->type==3)
                        Biz Sizi Arayalım 
                        @elseif ($message->type==4)
                        E-Ticaret Sipariş
                        @endif
                    </dd>
                    <dt>E-Posta Adresi</dt>
                    <dd id="reply-email">{{ $message->email }}</dd>
                    @if ($message->phone)
                    <dt>Telefon Numarası</dt>
                    <dd>{{ $message->phone }}</dd>
                    @endif
                    <dt>Bülten Aboneliği:</dt>
                    <dd>@if ($message->newsletter) Abone Oldu @else Abone Olmadı @endif</dd>
                    <dt>Gönderilme Tarihi:</dt>
                    <dd>{{ $message->created_at }}</dd>
                    <dt>Güncellenme Tarihi:</dt>
                    <dd>{{ $message->updated_at }}</dd>
                </dl>

                <hr />
                <form action="{{ admin_url('messages/' . $message->id . '/updatenote') }}" method="post">
                    {{ csrf_field() }}
                    <div>
                        <div class="form-group">
                            <label>Notunuz</label>
                            <textarea name="message" placeholder="Not" class="form-control" style="height:158px;">{{ $message->note }}</textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default btn-block">Güncelle <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>