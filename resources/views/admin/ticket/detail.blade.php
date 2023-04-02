<div class="row">
    <div class="col-md-3">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ $ticket->user->avatar ? $ticket->user->avatar : Gravatar::get($ticket->user->email, ['size'=>128])  }}" alt="User Avatar">
                </div>
                <h3 class="widget-user-username">{{ $ticket->user->firstname }} {{ $ticket->user->lastname }}</h3>
                <h5 class="widget-user-desc">{{ $ticket->user->email }}</h5>
            </div>
            <div class="box-body box-profile">
                <dl>
                    <dt>Telefon</dt>
                    <dd>{{ $ticket->user->phone }}</dd>
                    <dt>Cep Telefonu</dt>
                    <dd>{{ $ticket->user->mobile }}</dd>
                    <dt>Kayıt Tarihi:</dt>
                    <dd>{{ $ticket->user->created_at }}</dd>
                    <dt>Son Giriş Tarihi:</dt>
                    <dd>{{ $ticket->user->updated_at }}</dd>
                </dl>
                <a href="javascript:void(0);" data-href="{{ admin_url('users/' . $ticket->user->id . '/edit') }}" class="btn btn-primary btn-block external"><b>Bilgileri Düzenle</b></a>
            </div>
        </div>
        <div class="btn-group btn-flex margin-bottom">
            <button type="button" class="btn btn-info">Faydalı Bağlantılar</button>
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu pull-right">
                <li><a href="https://intodns.com/" target="_blank">https://intodns.com/</a></li>
                <li><a href="https://prnt.sc/" target="_blank">https://prnt.sc/</a></li>
                <li><a href="https://gtmetrix.com/" target="_blank">https://gtmetrix.com/</a></li>
                <li><a href="https://webpagetest.org/" target="_blank">https://webpagetest.org/</a></li>
                <li><a href="https://semrush.com/">https://semrush.com/</a></li>
            </ul>
        </div>

        <div class="box box-default box-solid">
            <form action="{{ admin_url('tickets/' . $ticket->id . '/update') }}" role="form" method="post">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group">
                        <label for="status" style="display:block;">Durum</label>
                        <select class="form-control selectpicker-auto show-tick" name="status">
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $status->id == $ticket->status_id ? "selected": "" }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" style="display:block;">Departman</label>
                        <select class="form-control selectpicker-auto show-tick" name="department">
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $ticket->department_id ? "selected": "" }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" style="display:block;">Öncelik</label>
                        <select class="form-control selectpicker-auto show-tick" name="priority">
                            @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ $priority->id == $ticket->priority_id ? "selected": "" }}>{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" style="display:block;">Tip</label>
                        <select class="form-control selectpicker-auto show-tick" name="type">
                            <option value="0">Destek Talebi</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == $ticket->type_id ? "selected": "" }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Not</label>
                        <textarea class="form-control" name="note" rows="1" id="simplemde-notoolbar">{{ $ticket->notes }}</textarea>
                    </div>
                </div>

                <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right"><span class="fa fa-save"></span> Güncelle</button>
                </div>
            </form>
        </div>

        <div class="box box-default box-solid">
            <div class="box-body no-padding">
                <h4 style="margin-left:18px;">Önceki Sorular</h4>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    @for ($i=0; $i < (count($others) > 10 ? 10 : count($others)); $i++)
                    <li>
                        <a href="{{ admin_url('tickets/' . $others[$i]->id . '/detail') }}" target="_blank">{{ $others[$i]->title }}</a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>


        <div class="box box-default box-solid">
            <form action="{{ admin_url('tickets/' . $ticket->id . '/merge') }}" role="form" method="post">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="status" style="display:block;">Birleştir</label>
                        <select class="form-control selectpicker-auto show-tick" name="merged_id">
                            @foreach($others as $other)
                            <option value="{{ $other->id }}">{{ $other->id }} - {{ $other->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Bulunduğunuz talep seçtiğiniz talebin içine aktarılacak.
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-warning pull-right"><span class="fa fa-window-restore"></span> Birleştir</button>
            </div>
            </form>
        </div>

    </div>
    <div class="col-md-9">

        <div class="box box-primary box-solid">
            <div class="box-body">
                <div class="post">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ Gravatar::get($ticket->user->email, ['size'=>128])  }}" alt="user image">
                        <span class="username">
                            {{ $ticket->title }}
                            <a href="{{ admin_url('tickets/' . $ticket->id . '/delete') }}" onclick="return confirm('Mesajı silmek istediğinize eminmisiniz?')" class="pull-right btn-box-tool">
                                <i class="fa fa-times"></i>
                            </a>
                        </span>
                        <span class="description">
                            <span class="label label-{{ $ticket->status->color }}">{{ $ticket->status->name }}</span>
                            <span class="label label-default">{{ $ticket->departman->name}}</span> 
                            <span class="label label-success">{{ $ticket->ip }}</span>
                            {{ Carbon\Carbon::parse($ticket->created_at)->diffForHumans()}}
                        </span>
                    </div>
                    {{ parsedown($ticket->message) }}

                                                    
                    @if ($ticket->file != "[]" && $ticket->file != "")
                    <hr />
                    @foreach($ticket->file as $file)
                        <i class="fa fa-paperclip"></i>
                        <a target="_blank" href="{{ Storage::disk('warden')->url($file) }}">
                            {{ strrev(str_limit(strrev($file), 20)) }}
                        </a>
                    @endforeach
                @endif
                </div>
            </div>
        </div>

        @foreach($ticket->messages as $msg)

        <div class="box @if ($msg->assign_id)box-default @else box-primary @endif box-solid">
            <div class="box-body">
                <div class="post">
                    <div class="user-block">
                        @if ($msg->assign_id)
                        <img class="img-circle img-bordered-sm" src="{{ Gravatar::get($msg->admin['email'], ['size'=>128])  }}" alt="user image">
                        <span class="username">
                            <strong>{{ $msg->admin['name'] }}</strong>
                            <a href="{{ admin_url('tickets/' . $ticket->id . '/deletereply/' . $msg->id ) }}" onclick="return confirm('Mesajı silmek istediğinize eminmisiniz?')" class="pull-right btn-box-tool">
                                <i class="fa fa-times"></i>
                            </a>
                        </span> 
                        @else
                        <img class="img-circle img-bordered-sm" src="{{ Gravatar::get($msg->user['email'], ['size'=>128])  }}" alt="user image">
                        <span class="username">
                            <a href="{{ admin_url('users/' . $ticket->user->id . '/edit') }}" target="_blank">{{ $msg->user['firstname'] }} {{ $msg->user['lastname'] }}</a>
                            <a href="{{ admin_url('tickets/' . $ticket->id . '/deletereply/' . $msg->id ) }}" onclick="return confirm('Mesajı silmek istediğinize eminmisiniz?')" class="pull-right btn-box-tool">
                                <i class="fa fa-times"></i>
                            </a>
                        </span> 
                        @endif
                        <span class="description">
                            <span class="label label-success">{{ $msg->ip }}</span>
                            {{ Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                        </span>
                    </div>
                    {{ parsedown($msg->message) }}
                    @if ($msg->file!="[]")
                    <hr />
                    @foreach($msg->file as $file)
                        <i class="fa fa-paperclip"></i>
                        <a target="_blank" href="{{ Storage::disk('warden')->url($file) }}">
                            {{ strrev(str_limit(strrev($file), 20)) }}
                        </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <div class="box box-default box-solid">
            <div class="box-body">
                <form action="{{ admin_url('tickets/' . $ticket->id . '/addreply') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="simplemde" rows="3" placeholder="Mesaj ..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control selectpicker-auto show-tick" name="assign_id">
                                    @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ $admin->id == $assign_id ? "selected": "" }}>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="file" class="file" name="file[]" multiple="1" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Gönder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

{{--
<div class="row docs-premium-template">
    <div class="col-sm-12 col-md-6">
        <div class="box box-solid">
            <div class="box-body">
                <h4>
                    Önceki Sorular
                </h4>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="box box-solid">
            <div class="box-body">
                <h4>
                    Önceki Mesajlar
                </h4>
            </div>
        </div>
    </div>
</div> --}}

<script>
    if (document.getElementById("simplemde")) {
    var simplemde = new SimpleMDE({
    element: document.getElementById("simplemde"),
    hideIcons: ["guide", "fullscreen", "side-by-side", "preview"],
    parsingConfig: {
        allowAtxHeaderWithoutSpace: true,
        strikethrough: true,
        underscoresBreakWords: true,
    },
    promptURLs: false,
    spellChecker: false,
        tabSize: 4,
    });
}
$("input.file").fileinput({
    "overwriteInitial":false,
    "initialPreviewAsData":true,
    "browseLabel":"G\u00f6zat",
    "showRemove":false,
    "showUpload":false,
    "allowedFileTypes":["image"]}
);
</script>