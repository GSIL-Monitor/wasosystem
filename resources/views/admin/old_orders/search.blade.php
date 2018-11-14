<form action="{{ route('admin.old_orders.index') }}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="search">
        {{ Form::select('type',
                    ['proid'=>'序列号',
                    'remarks'=>'公司',
                    'userid'=>'用户账号',
                 ],old('type')) }}
        {{ Form::text('keyword',old('keyword'),['required','placeholder'=>'请输入关键字']) }}
        <input type="submit" class="Btn green"  value="搜索">
    </div>
</form>