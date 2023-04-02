@extends('layouts.user') 

@section('section')
<section class="section">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body no-padding">
                    <div class="content">
                        <h2 class="no-margin is-size-5 padding-20">Duyurular</h2>
                        <table class="responsive-table is-light-grey">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Başlık</th>
                                    <th>Aktif Olduğu Süre</th>
                                </tr>
                                    @foreach($announces as $announce)
                                    <tr>
                                        <td data-th="ID" class="is-size-6 text-bold">
                                            #{{ $announce->id }}
                                        </td>
                                        <td data-th="Başlık">
                                                <a href="{{ route('user.announce.detail', ['id' => $announce->id, 'domain' => $announce->domain]) }}">{{ str_limit($announce->title, 100) }}</a>
                                        </td>
                                        <td data-th="Aktif Olduğu Süre">
                                                {{ Carbon\Carbon::parse($announce->date_start)->format("d M Y") }} - {{ Carbon\Carbon::parse($announce->date_end)->format("d M Y") }}
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        @if (count($announces) == 0) 
                        <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Kayıtlı duyuru bulunamadı.</p>
                    @endif
                    </div>
                </div>
            </div>
            {{ $announces->links() }}
        </div>
    </section>
@endsection