<div class="JJList">
    <ul class="halfTwoUl" id="app">
        {!! Form::open(['route'=>['admin.barcode_associateds.store'],'id'=>'barcode_associateds','method'=>'post','onsubmit'=>'return false']) !!}
        @if(Request::has('search'))
            @if($status == 'test_return' || $status== 'test_to_procurement')
                @includeIf('admin.barcode_associateds.forms.test')

            @elseif($status == 'quality_take_away' )
                @includeIf('admin.barcode_associateds.forms.quality_return')
            @endif

        @else
            @includeIf('admin.barcode_associateds.forms.'.$status)
        @endif

        {!! Form::close() !!}
    </ul>
</div>