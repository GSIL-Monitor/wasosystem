<div class="JJList">
    <ul class="halfTwoUl" id="app">
        {!! Form::open(['route'=>['admin.barcode_associateds.store'],'id'=>'barcode_associateds','method'=>'post','onsubmit'=>'return false']) !!}
        @if(Request::has('search'))
            @includeIf('admin.barcode_associateds.forms.info')
        @else
            @if(Request::has('searchSelect'))
                @php $types=config('codeStatus.barcode_associateds_type')[Request::get('type')];@endphp
                @if($types == '借出还回' || $types == '借转销售')
                    @includeIf('admin.barcode_associateds.forms.loan_out')
                @endif
                @if($types == '进货退货' || $types == '返厂在途' || $types == '报损' || $types == '坏货' || $types == '型号更换')
                    @includeIf('admin.barcode_associateds.forms.bad')
                @endif
                @if($types == '质保返回' || $types == '返厂返回')
                @includeIf('admin.barcode_associateds.forms.returned_to_the_factory')
                @endif
                @if($types == '质保受理' || $types == '销售退货' || $types == '借转更换' || $types == '质保更换')
                    @includeIf('admin.barcode_associateds.forms.sell')
                @endif
                @if($types == '质保取走' || $types == '质保返厂' || $types == '代管转入库' )
                    @includeIf('admin.barcode_associateds.forms.quality_return')
                @endif
                @if($types == '测试品归还' || $types == '测试品转采购')
                    @includeIf('admin.barcode_associateds.forms.test')
                @endif
            @else
                @includeIf('admin.barcode_associateds.forms.'.$status)

            @endif
        @endif

        {!! Form::close() !!}
    </ul>
</div>