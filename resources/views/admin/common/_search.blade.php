<form action="{{ $url }}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="search">
        @if(isset($condition) && !empty($condition))
        {{ Form::select('type',$condition,old('type',Request::input('type')),$select_data ?? []) }}
        @endif
        @if(!isset($show_input) || $show_input == true)
        {{ Form::text('keyword',old('keyword',Request::input('keyword')),['placeholder'=>$placeholder ?? '请输入关键字']) }}
        @endif
        @if(isset($status))
        @forelse($status as $key=>$value)
            <input type="hidden" name="{{ $key }}" value="{{ $value  }}" placeholder="">
            @empty
        @endforelse
        @endif
            {!! $select ?? '' !!}
        <input type="submit" class="Btn green"  value="{{ $btn ?? '搜索' }}">
    </div>
</form>