@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
            <button class="Btn Refresh ">刷新</button>
            @if(isset($role) && $role->id !== 1)
            <button type="submit" class="Btn common_add" form_id="roles" location="top" >@if(Route::is('admin.roles.create'))添加@else修改@endif</button>
            @endif
            <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.roles.form')
        </div>
    </div>

@endsection