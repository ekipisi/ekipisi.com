<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
    <div class="{{$viewClass['field']}}">
        @include('admin::form.error')
        <textarea class="form-control" id="{{$id}}" name="{{$name}}"
                  placeholder="{{ $placeholder }}" {!! $attributes !!} >{{ old($column, $value) }}</textarea>
        @include('admin::form.help-block')
    </div>
</div>