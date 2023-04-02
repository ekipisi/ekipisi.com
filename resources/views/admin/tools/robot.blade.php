<div class="btn-group" data-toggle="buttons">
    @foreach($options as $option => $label)
    <label class="btn btn-default btn-sm {{ \Request::get('is_robot', 'all') == $option ? 'active' : '' }}">
        <input type="radio" class="is-robot" value="{{ $option }}">{{$label}}
    </label>
    @endforeach
</div>