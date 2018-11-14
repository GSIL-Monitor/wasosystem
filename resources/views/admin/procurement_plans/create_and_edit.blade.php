@extends('admin.layout.default')
@section('js')
    <script src="{{ asset('admin/js/code.js') }}"></script>
    <script>
        $(function () {
            $(document).on('change','.product',function () {
                filtrate($(this),"{{ route('admin.procurement_plans.get_goods') }}")
            })
        });

    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.procurement_plans.create'))
                @can('create procurement_plans')
                    <button type="submit" class="Btn common_add" form_id="procurement_plans"
                            location="top">添加</button>
                 @endcan
                    <button class="Btn changeWeb" data_url="{{ route('admin.supplier_managements.create') }}">添加供应商</button>
                    <button  class="Btn changeWeb" data_url="{{ route('admin.product_goods.index') }}?product_id=23&souce=code">添加产品</button>
                @else
                @can('edit procurement_plans')
                       @if( $procurement_plan->procurement_status != 'finish')
                    <button type="submit" class="Btn common_add" form_id="procurement_plans"
                            location="top">修改</button>
                    @endif
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.procurement_plans.form')
        </div>
    </div>

@endsection