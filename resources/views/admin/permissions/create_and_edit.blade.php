@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
            <button class="Btn Refresh ">刷新</button>
            <button type="submit" class="Btn common_add" form_id="permissions" location="top" >@if(Route::is('admin.permissions.create'))添加@else
                    修改@endif</button>
            <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.permissions.form')
        </div>
    </div>

@endsection