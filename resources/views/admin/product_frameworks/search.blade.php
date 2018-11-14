<form action="{{ route('admin.user.index') }}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="search">
        <select name="type" id="" >
            <option value="username">账号</option>
            <option value="nickname">姓名</option>
            <option value="jianchen">单位</option>
            <option value="phone">电话</option>
        </select>
        <input type="text" name="keyword" value="{{ old('keyword') }}" required placeholder="请输入关键字">
        <input type="hidden" name="type_id" value="{{ $type_id }}" placeholder="">
        <input type="submit" class="Btn green"  value="搜索">
    </div>
</form>