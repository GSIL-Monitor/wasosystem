@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.feed_backs.create'))
                @can('create feed_backs')
                    <button type="submit" class="Btn common_add" form_id="feed_backs"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit feed_backs')
                    <button type="submit" class="Btn common_add" form_id="feed_backs"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.feed_backs.form')
        </div>
    </div>

@endsection