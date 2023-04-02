@extends('layouts.user') 

@section('section')

<section class="section no-padding-bottom">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body no-padding">
                <form action="{{ route('user.support.home') }}" method="POST" class="validation padding-10">
                    {{ csrf_field() }}
                    <div class="columns is-gapless is-mobile search-form">
                        <div class="column is-four-fifths">
                            <input class="input is-medium" name="query" type="text" value="{{ $query }}" placeholder="Destek Talepleri İçerisinde Arama">
                        </div>
                        <div class="column">
                            <button type="submit" class="button btn-align is-info is-medium is-fullwidth">
                                <i class="sl sl-icon-magnifier"></i> <span class="is-hidden-touch">Arama</span>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section no-padding-top">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body no-padding">
                    <div class="content">
                        <div class="columns is-vcentered is-gapless is-mobile no-margin padding-20">
                            <div class="column">
                                <h2 class="no-margin no-padding is-size-5">Destek Talepleri</h2>
                            </div>
                            <div class="column has-text-right">
                                <a href="{{ route('user.support.add') }}" class="button is-info"><i class="im im-icon-Formspring"></i><span class="is-hidden-mobile">Yeni Destek Talebi</span></a>
                            </div>
                        </div>

                        <table class="responsive-table is-light-grey">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Öncelik</th>
                                    <th>Başlık</th>
                                    <th>Son Güncelleme</th>
                                    <th>Durum</th>
                                    <th></th>
                                </tr>
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td data-th="ID" class="is-size-6 text-bold">
                                            #{{ $ticket->id }}
                                        </td>
                                        <td data-th="Öncelik">
                                            <span class="tag squared is-{{ $ticket->priority->color }}">{{ $ticket->priority->name }}</span>
                                        </td>
                                        <td data-th="Başlık">
                                            <a href="{{ route('user.support.detail', $ticket->id) }}">
                                                @desktop
                                                {{ $ticket->title }}
                                                @elsedesktop
                                                {{ str_limit($ticket->title, 20) }}
                                                @enddesktop
                                            </a>
                                            @if ($ticket->type_id == 2 && !empty($ticket->notes))
                                                <i class="material-icons is-icon-md has-text-danger animated swing slower pull-right">notifications_active</i>
                                            @endif
                                        </td>
                                        <td data-th="Son Güncelleme">
                                            {{ Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}
                                        </td>
                                        <td data-th="Durum">
                                            <span class="tag squared is-{{ $ticket->status->color }}">{{ $ticket->status->name }}</span>
                                        </td>
                                        <td data-th="İşlem">
                                            <a href="{{ route('user.support.detail', $ticket->id) }}" class="button is-small btn-align primary-btn"><i class="fa fa-eye"></i> Görüntüle</a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        @if (count($tickets) == 0) 
                        <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Daha önce destek talebinde bulunmadınız</p>
                        @endif
                    </div>
                </div>
            </div>
            {{ $tickets->links() }}
        </div>
    </section>
@endsection