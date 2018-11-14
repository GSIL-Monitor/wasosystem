@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.supplier_repair_addresses.create'))
                @can('create supplier_repair_addresses')
                    <button type="submit" class="Btn common_add" form_id="supplier_repair_addresses"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit supplier_repair_addresses')
                    <button type="submit" class="Btn common_add" form_id="supplier_repair_addresses"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.supplier_repair_addresses.form')
        </div>
    </div>

@endsection