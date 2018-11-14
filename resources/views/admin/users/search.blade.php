<form action="{{ route('admin.users.index') }}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="search">
        {{ Form::select('type',
                    ['username'=>'账号',
                    'nickname'=>'姓名',
                    'unit'=>'单位',
                    'phone'=>'电话'
                 ],old('type')) }}
        {{ Form::text('keyword',old('keyword'),['required','placeholder'=>'请输入关键字']) }}
        <input type="hidden" name="status" value="{{ $status  }}" placeholder="">
        <input type="submit" class="Btn green"  value="搜索">
    </div>
</form>