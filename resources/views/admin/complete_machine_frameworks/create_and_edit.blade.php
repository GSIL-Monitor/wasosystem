@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create complete_machine_frameworks')
                    <button type="submit" class="Btn common_add" form_id="complete_machine_frameworks"
                            location="top">@if(Route::is('admin.complete_machine_frameworks.create'))添加@else
                            修改@endif</button>
                @elsecan('edit complete_machine_frameworks')
                    <button type="submit" class="Btn common_add" form_id="complete_machine_frameworks"
                            location="top">@if(Route::is('admin.complete_machine_frameworks.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="alertWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.complete_machine_frameworks.form')
        </div>
    </div>

@endsection