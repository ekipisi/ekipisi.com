@extends('layouts.user') 

@section('section')

<section class="section">
    <div class="container">
        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content">
                    <h2 class="no-margin is-size-5 padding-20">{{ __('user.email.title') }}</h2>
                    <table class="responsive-table is-light-grey">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Konu</th>
                                <th>Tarih</th>
                            </tr>
                            @foreach($emails as $email)
                            <tr>
                                <td data-th="ID" class="is-size-6 text-bold">#{{ $email->id }}</td>
                                <td data-th="Konu">
                                    <a href="{{ route('user.email.detail', $email->id) }}" target="_blank">
                                        {{ $email->title }}
                                    </a>
                                </td>
                                <td data-th="Tarih">{{ Carbon\Carbon::parse($email->created_at)->format("d M Y, h:i") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($emails) == 0) 
                        <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Kayıtlı e-posta bulunamadı.</p>
                    @endif
                </div>
            </div>
        </div>
        {{ $emails->links() }}
    </div>
</section>
@endsection