@extends('admin.layout.default')
@section('js')
    <script>
        $(function () {
            $(document).on('change','.search select',function () {
                var code = "{{ Request::get('keyword') }}";
                var type = $(this).val();
                var status = "{{ optional($last)->out_type ?? optional($last)->procurement_type ?? optional($last)->current_state ?? '' }}";
                if (status){
                var id = "{{ optional($last)->id ?? '' }}";
                var product_good_id = "{{ optional($product)->product_goods->id  ?? optional($product)->product_good->id ?? ''}}";
                var param = '?status=' + status + '&type=' + type + '&id=' + id + '&code=' + code + '&product_good_id=' + product_good_id;
                $('.openFrame').attr('data_url', '{{ route('admin.barcode_associateds.create')}}' + param);
                console.log( '{{ route('admin.barcode_associateds.create')}}' + param);
                $('.openFrame').click();
            }
            });

        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
            </div>

        @include('admin.common._search',[
        'url'=>route('admin.barcodes.index'),
        'status'=>array_except(Request::all(),['type','keyword','_token']),
        'condition'=>array_prepend($condition,'请选择事件',''),
        'placeholder'=>'请输入要查询的条码'
        ])


            <div class="phoneBtnOpen"></div>
            <div class="PageBtnTxt">
               <div>{{ optional($product)->products->title  ?? optional($product)->product_good->product->title ?? ''}}</div>
               <div>{{ optional($product)->product_goods->name  ?? optional($product)->product_good->name ?? ''}}</div>
            </div>
        </div>
        <div class="PageBox">
         @include('admin.barcodes.table.barcode_associated')
            <a class="changeWeb openFrame" data_url=""></a>
        </div>
    </div>

@endsection