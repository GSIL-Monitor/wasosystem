@extends('admin.layout.default')

@section('js')
    @include('vendor.ueditor.assets')
    <script src="{{ asset('admin/js/completeMachinesPrice.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate();
            qrcodeCreate();
        })
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create complete_machines')
                    <button type="submit" class="Btn common_add" form_id="complete_machines"
                            location="top">@if(Route::is('admin.complete_machines.create'))添加@else
                            修改@endif</button>
                @elsecan('edit complete_machines')
                    <button type="submit" class="Btn common_add" form_id="complete_machines"
                            location="top">@if(Route::is('admin.complete_machines.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.complete_machines.form')
        </div>
    </div>

@endsection