<div class="row">
  <div class="col-md-3">
    <div class="box box-widget widget-user-2">
      <div class="widget-user-header bg-blue">
          <div class="widget-user-image">
              <img class="img-circle" src="{{ $user->avatar ? $user->avatar : Gravatar::get($user->email, ['size'=>128])  }}" alt="User Avatar">
          </div>
          <h3 class="widget-user-username">{{ $user->firstname }} {{ $user->lastname }}</h3>
          <h5 class="widget-user-desc">{{ $user->email }}</h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <li>
            <a href="{{ admin_url('users/'.$user->id.'/edit') }}" target="_blank">
                <i class="fa fa-fw fa-pencil-square-o"></i> Bilgileri Düzenle
              </a>
          </li>
          <li>
            <a href="{{ admin_url('services/create') }}" target="_blank">
              <i class="fa fa-fw fa-coffee"></i> Hizmet Ekle
            </a>
          </li>
          <li>
            <a href="{{ admin_url('billings/create') }}" target="_blank">
                <i class="fa fa-fw fa-money"></i> Ödeme Ekle
              </a>
          </li>
          <li>
            <a href="{{ admin_url('tickets/create') }}" target="_blank">
              <i class="fa fa-fw fa-tag"></i> Destek Talebi Ekle
            </a>
          </li>
          {{--
          <li>
            <a href="#notes" data-toggle="tab">
              <i class="fa fa-fw fa-sticky-note"></i> Notlar 
              <span class="pull-right badge bg-blue">{{ count($notes) }}</span></a>
          </li> --}}
        </ul>
      </div>
    </div>
    <div class="box box-default box-solid">
      <div class="box-body">
        <dl>
          <dt>E-Posta Adresi</dt>
          <dd>{{ $user->email }}</dd>
          <dt>Telefon</dt>
          <dd>{{ $user->phone }}</dd>
          <dt>Cep Telefonu</dt>
          <dd>{{ $user->mobile }}</dd>
          <dt>Adres</dt>
          <dd>{{ $user->address }}</dd>
          <dt>Kayıt Tarihi:</dt>
          <dd>{{ $user->created_at }}</dd>
          <dt>Son Giriş Tarihi:</dt>
          <dd>{{ $user->updated_at }}</dd>
        </dl>
        <b>Sosyal Medya : </b>
        @if ($social && $social->facebook_id) 
          <i class="fa fa-fw fa-facebook text-green"></i>
        @endif
        @if ($social && $social->google_id) 
          <i class="fa fa-fw fa-google text-green"></i>
        @endif
        @if ($social && $social->linkedin_id) 
          <i class="fa fa-fw fa-linkedin text-green"></i>
        @endif
      </div>
    </div>
    <a href="javascript:void(0);" data-id="{{ $user->id }}" class="customer-delete btn btn-block btn-danger btn-lg mb-20">
      <i class="fa fa-fw fa-times"></i> Müşteriyi Sil
    </a>
  </div>
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tickets" data-toggle="tab">Destek Talepleri</a></li>
        <li><a href="#services" data-toggle="tab">Hizmetler</a></li>
        <li><a href="#billings" data-toggle="tab">Ödemeler</a></li>
        <li><a href="#partnership" data-toggle="tab">Gelir Ortaklığı</a></li>
        <li><a href="#login_activities" data-toggle="tab">Giriş Aktiviteleri</a></li>
        <li><a href="#email_activities" data-toggle="tab">E-Posta Aktiviteleri</a></li>
        <li><a href="#notes" data-toggle="tab">Notlar</a></li>
      </ul>
      <div class="tab-content no-padding">
        <div class="tab-pane active" id="tickets">
            <div class="table-responsive custom-table">
                <table class="table table-hover">
                  <tr>
                    <th>ID</th>
                    <th>Konu</th>
                    <th>Hizmet</th>
                    <th>Mesajlar</th>
                    <th>Durum</th>
                    <th>Öncelik</th>
                    <th>Tip</th>
                    <th>Departman</th>
                    <th>Güncellenme</th>
                    <th>İşlem</th>
                  </tr>
                  @if (count($tickets)>0) 
                  @foreach($tickets as $ticket)
                  <tr>
                    <td>#{{ $ticket->id }}</td>
                    <td>
                      <span data-toggle="tooltip" data-placement="bottom" data-html="true" title="{{ $ticket->title }}">
                        {{ str_limit($ticket->title, 20) }}
                      </span>
                    </td>
                    <td>
                      <span data-toggle="tooltip" data-placement="bottom" data-html="true" title="{{ ($ticket->product ? $ticket->product->title : "-") }}">
                        {{ ($ticket->product ? str_limit($ticket->product->title, 20) : "-") }}
                      </span>
                    </td>
                    <td style="text-align:center">{{ count($ticket->messages) }}</td>
                    <td><span class="label label-{{ $ticket->status->color }}">{{ $ticket->status->name }}</span></td>
                    <td><span class="label label-{{ $ticket->priority->color }}">{{ $ticket->priority->name }}</span></td>
                    <td><span class="label label-{{ $ticket->type['color'] }}">{{ $ticket->type['name'] }}</span></td>
                    <td><span class="label label-default">{{ $ticket->departman->name }}</span></td>
                    <td>{{ Carbon\Carbon::parse($ticket->updated_at)->format("d M Y, H:i")}}</td>
                    <td><a class="btn btn-success btn-xs" target="_blank" href="{{ admin_url('tickets/' . $ticket->id . '/detail') }}"><i class="fa fa-eye"></i></td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="10">Kayıtlı talep bulunamadı.</td>
                    </tr>
                  @endif
              </table>
              <div class="custom-pagination">
                  {{ $tickets->links('admin::pagination') }}
              </div>
          </div>
        </div>
        <div class="tab-pane" id="services">
          <div class="table-responsive custom-table">
            <table class="table table-hover">
              <tr>
                <th>ID</th>
                <th style="width:30px;">Durum</th>
                <th>Ürün</th>
                <th>Fiyat</th>
                <th>Yenileme</th>
                <th>Ödeme Türü</th>
                <th>Periyot</th>
                <th>Ödeme Tarihi</th>
                <th>Eklenme Tarihi</th>
                <th>İşlem</th>
              </tr>
              @if (count($products)>0) @foreach($products as $product)
              <tr>
                <td>#{{ $product->id }}</td>
                <td>
                  @if ($product->status) 
                    <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                  @else
                    <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                  @endif
                </td>
                <td>
                  <span data-toggle="tooltip" data-placement="bottom" data-html="true" title="{{ $product->title }}@if ($product->domain)<br /><b>Alan Adları:</b><br />{{ $product->domain }}@endif">
                    {{ str_limit($product->title, 20) }}
                  </span>
                </td>
                <td>{{ ($product->currency['symbol_left'] ? $product->currency['symbol_left'] : $product->currency['symbol_right'])
                  }}{{ $product->price }}</td>
                <td>{{ ($product->currency['symbol_left'] ? $product->currency['symbol_left'] : $product->currency['symbol_right'])
                  }}{{ $product->price_renewal }}</td>
                <td>{{ $product->paymenttype['name'] }}</td>
                <td>{{ $product->period['name'] }}</td>
                <td>{{ $product->payment_date }}</td>
                <td>{{ Carbon\Carbon::parse($product->created_at)->format("d M Y, H:i")}}</td>
                <td><a class="btn btn-info btn-xs" target="_blank" href="{{ admin_url('services/' . $product->id . '/edit') }}"><i class="fa fa-edit"></i></td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="10">Kayıtlı hizmet bulunamadı.</td>
                    </tr>
                  @endif
                </table>
            </div>
        </div>
        <div class="tab-pane" id="billings">
          <div class="table-responsive custom-table">
            <table class="table table-hover">
              <tr>
                <th>ID</th>
                <th style="width:30px;">Durum</th>
                <th>Bildirim</th>
                <th>Ürün</th>
                <th>Fiyat</th>
                <th>Ödeme Tarihi</th>
                <th>Ödenme Tarihi</th>
                <th>İşlem</th>
              </tr>
              @if (count($billings)>0)
                @foreach($billings as $billing)
                  <tr>
                      <td>#{{ $billing->id }}</td>
                      
                      <td>
                        @if ($billing->status) 
                          <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                        @else
                          <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                        @endif
                      </td>


                      <td>
                        @if ($billing->is_paid) 
                        <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                      @else
                        <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                      @endif
                      </td>
                      <td>
                        @if ($billing->service['title']) 
                          <a target="_blank" href="{{ admin_url('billings/' . $billing->id . '/edit') }}">
                            {{ str_limit($billing->service['title'], 50) }}
                          </a> @else - @endif
                </td>
                <td>{{ ($billing->currency['symbol_left'] ? $billing->currency['symbol_left'] : $billing->currency['symbol_right'])
                  }}{{ $billing->price }}</td>
                <td>{{ $billing->payment_date }}</td>
                <td>
                  @if ($billing->is_paid_date) {{ Carbon\Carbon::parse($billing->is_paid_date)->format("d M Y")}} @else - @endif
                </td>
                <td><a class="btn btn-info btn-xs" target="_blank" href="{{ admin_url('billings/' . $billing->id . '/edit') }}"><i class="fa fa-edit"></i></td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="10">Kayıtlı ödeme bulunamadı.</td>
                </tr>
              @endif
            </table>
        </div>
        </div>
        <div class="tab-pane" id="partnership">
            <div class="table-responsive custom-table">
                <table class="table table-hover">
                  <tr>
                    <th>ID</th>
                    <th>Durum</th>
                    <th>Arandı</th>
                    <th>Ödendi</th>
                    <th>Kanal</th>
                    <th>Ad Soyad</th>
                    <th>E-posta</th>
                    <th>Telefon</th>
                    <th>Ücret</th>
                    <th>Eklenme</th>
                    <th>İşlem</th>
                  </tr>
                  @if (count($partnerships)>0) 
                  @foreach($partnerships as $partnership)
                  <tr>
                    <td>#{{ $partnership->id }}</td>
                    <td>
                      @if ($partnership->status) 
                        <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                      @else
                        <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                      @endif
                    </td>
                    <td>
                        @if ($partnership->called) 
                          <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                        @else
                          <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                        @endif
                    </td>
                    <td>
                        @if ($partnership->paid) 
                          <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                        @else
                          <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                        @endif
                    </td>
                    <td>
                      @if ($partnership->channel=="form")
                          Form
                      @else 
                          Link
                      @endif
                    </td>
                    <td>
                        {{ $partnership->firstname }} {{ $partnership->lastname }}
                    </td>
                    <td>
                        {{ $partnership->email }}
                    </td>
                    <td>
                        {{ $partnership->phone }}
                    </td>
                    <td>
                        @if ($partnership->price)
                        {{ $partnership->price }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ Carbon\Carbon::parse($partnership->created_at)->format("d M Y, H:i")}}</td>
                    <td><a class="btn btn-success btn-xs" target="_blank" href="{{ admin_url('partnerships/' . $partnership->id . '/edit') }}"><i class="fa fa-eye"></i></td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="10">Kayıtlı referans bulunamadı.</td>
                    </tr>
                  @endif
              </table>
          </div>
        </div>
        <div class="tab-pane" id="login_activities">
            <div class="table-responsive custom-table">
                <table class="table table-hover">
                  <tr>
                    <th>ID</th>
                    <th>Olay</th>
                    <th>Ip Adresi</th>
                    <th>Beni Hatırla</th>
                    <th>İşlem Tarihi</th>
                  </tr>
                  @if (count($login_activities)>0) 
                  @foreach($login_activities as $login_activity)
                  <tr>
                    <td>#{{ $login_activity->id }}</td>
                    <td>{{ ($login_activity->event == "login" ? "Giriş Yaptı" : "Çıkış Yaptı") }}</td>
                    <td><a href="http://www.geoplugin.net/json.gp?ip={{ $login_activity->ip_address }}" target="_blank">{{ $login_activity->ip_address }}</a></td>
                    <td>
                      @if ($login_activity->remember)
                        <span class="label label-success">Aktif</span>
                      @else
                      <span class="label label-default">Aktif Değil</span>
                      @endif
                    </td>
                    <td>{{ Carbon\Carbon::parse($login_activity->created_at)->format("d M Y, H:i")}}</td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="10">Kayıtlı aktivite bulunamadı.</td>
                    </tr>
                  @endif
              </table>
          </div>
        </div>
        <div class="tab-pane" id="email_activities">
            <div class="table-responsive custom-table">
                <table class="table table-hover">
                  <tr>
                    <th>ID</th>
                    <th>Konu</th>
                    <th>Okundu</th>
                    <th>Tarih</th>
                  </tr>
                  @if (count($mail_activities)>0) 
                  @foreach($mail_activities as $mail_activity)
                  <tr>
                    <td>#{{ $mail_activity->id }}</td>
                    <td><a href="{{ admin_url('email_activity/' . $mail_activity->id) }}" target="_blank">{{ $mail_activity->title }}</a></td>
                    <td>
                      @if ($mail_activity->read) 
                        <center><i class="fa fa-fw fa-check text-green" aria-hidden="true"></i></center>
                      @else
                        <center><i class="fa fa-fw fa-times text-red" aria-hidden="true"></i></center>
                      @endif
                    </td>
                    <td>{{ Carbon\Carbon::parse($mail_activity->created_at)->format("d M Y, H:i")}}</td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="4">Kayıtlı aktivite bulunamadı.</td>
                    </tr>
                  @endif
              </table>
          </div>
        </div>
        <div class="tab-pane padding-20" id="notes">
          @if (count($notes))
          <ul class="note-list">
            @foreach($notes as $note)
            <li>
              <div class="text">
                @if ($note->status)
                <strike>{{ $note->note }}</strike><br />
                @else 
                {{ $note->note }}<br />
                @endif
              </div>
              <div class="info">
                @if ($note->priority==0) @elseif ($note->priority==1)
                <span class="label label-danger">Önemli</span> @elseif ($note->priority==2)
                <span class="label label-warning">Normal</span> @elseif ($note->priority==3)
                <span class="label label-success">Düşük</span> @endif @if ($note->end_at)
                <span data-toggle="tooltip" data-placement="bottom" data-html="true" title="Bitiş Tarihi:<br /> {{ Carbon\Carbon::parse($note->end_at)->format("
                  d M Y, H:i:s ") }}" class="label label-info">{{ Carbon\Carbon::parse($note->end_at)->diffForHumans() }}</span>                @endif
                <span data-toggle="tooltip" data-placement="bottom" data-html="true" title="Oluşturulma Tarihi:<br />{{ Carbon\Carbon::parse($note->created_at)->format("
                  d M Y, H:i:s ") }}" class="label label-default">{{ Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</span>
              </div>
              <div class="tools">
                <a class="btn btn-success btn-xs" href="{{ admin_url('users/' . $user->id . '/updatenote/' . $note->id) }}" onclick="return confirm('Notu güncellemek istediğinize eminmisiniz?')">
                    <i class="fa fa-check"></i>
                </a>
                  <a class="btn btn-danger btn-xs" href="{{ admin_url('users/' . $user->id . '/deletenote/' . $note->id) }}" onclick="return confirm('Notu silmek istediğinize eminmisiniz?')">
                    <i class="fa fa-trash-o"></i>
                </a>
          </div>
          </li>
          @endforeach
          </ul>
          @else
          <ul class="note-list">
            <li>Kayıtlı not bulunamadı.</li>
          </ul>
          @endif
          <hr />
          <form action="{{ admin_url('users/' . $user->id . '/addnote') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-xs-8">
                <div class="form-group">
                  <label>Notunuz</label>
                  <textarea name="message" placeholder="Not" class="form-control required" style="height:158px;"></textarea>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Bitiş Tarihi</label>
                      <input name="end_at" class="form-control datetime" autocomplete="off" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Önem</label>
                      <select name="priority" class="form-control">
                          <option value="1">Önemli</option>
                          <option value="2" selected>Normal</option>
                          <option value="3">Düşük</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-default btn-block">Gönder <i class="fa fa-arrow-circle-right"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>