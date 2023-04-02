@extends('layouts.user') 

@section('section')

<section class="section">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <div class="content">
                        <h2 class="no-margin is-size-5">Yeni Destek Talebi</h2>
                        <form class="validate-with-message" method="post" action="{{ route('user.support.add') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="columns mt-10">
                                <div class="column is-12">
                                    @if (isset($data['title']))
                                    <input type="text" placeholder="Destek Talebinizin Başlığı" class="required input is-large" name="title" id="title"  value="{{ $data['title'] }}" />
                                    @else
                                    <input type="text" placeholder="Destek Talebinizin Başlığı" class="required input is-large" name="title" id="title"  value="{{ $title or old('title') }}" />
                                    @endif
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-4">
                                    <div class="select is-large is-fullwidth">
                                        <select class="required" data-placeholder="- Departman Seçiniz -" name="department" required>
                                            <option label="- Departman Seçiniz -"></option>
                                            @foreach($departments as $department)
                                                @if (isset($data['department_id']))
                                                    <option {{ $department->id == $data['department_id'] ? "selected" : "" }} value="{{ $department->id }}">{{ $department->name }}</option>
                                                @else
                                                    <option {{ ($department->id) == (old('department')) ? "selected" : "" }} value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="column is-4">
                                    <div class="select is-large is-fullwidth">
                                        <select class="required" data-placeholder="- Öncelik -" name="priority" required>
                                            <option label="- Öncelik -"></option>
                                            @foreach($priorities as $priority)
                                                @if (isset($data['priority_id']))
                                                <option {{ $priority->id == $data['priority_id'] ? "selected":"" }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @else
                                                    <option {{ $priority->id == old('priority') ? "selected":"" }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="column is-4">
                                    <div class="select is-large is-fullwidth">
                                        <select data-placeholder="İlişkili Hizmet" name="service">
                                            <option label="- İlişkili Hizmet -"></option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" {{ $service->id == old('service') ? "selected":"" }}>{{ $service->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="columns no-padding-bottom no-margin-bottom">
                                <div class="column">
                                    <textarea name="message" class="required" id="simplemde" cols="20" rows="10">{{ $message or old('message') }}</textarea>
                                </div>
                            </div>
                            <div class="columns no-margin no-padding">
                                <div class="column is-5 no-margin no-padding">
                                        <div class="section-wrapper">
                                    <div class="uploader-controls has-text-centered animated preFadeInUp fadeInUp">
                                            <input type="file" name="fielduploader">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-20 has-text-left">
                                <button type="submit" class="button is-medium is-info">Destek Talebini Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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