@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.videos.create'))
                @can('create videos')
                    <button type="submit" class="Btn common_add" form_id="videos"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit videos')
                    <button type="submit" class="Btn common_add" form_id="videos"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.videos.form')
        </div>
    </div>

@endsection