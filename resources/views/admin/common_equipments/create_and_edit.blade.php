@extends('admin.layout.default')
@section('js')
    <script>
        $(function(){
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate();
            qrcodeCreate();
            orderMaterialsTaxAndNotTax();
            $(document).on('change','.invoice_type ,.service_status',function () {
                orderTaxAndNotTax()
            })
        });
    </script>
    @endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create common_equipments')
                    <button type="submit" class="Btn common_add" form_id="common_equipments"
                            location="top">@if(Route::is('admin.common_equipments.create'))添加@else
                            修改@endif</button>
                @elsecan('edit common_equipments')
                    <button type="submit" class="Btn common_add" form_id="common_equipments"
                            location="top">@if(Route::is('admin.common_equipments.create'))添加@else
                            修改@endif</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common_equipments.form')
        </div>
    </div>

@endsection