@extends('admin.layout.default')
@section('js')
    <script>
        $(function () {
            $(document).on('change','.search select',function () {
                $('#search').submit();
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
            @if($status == 'barcode_associated')
            <form action="{{ route('admin.barcode_associateds.index') }}" method="get" id="search">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="search">
                    {{ Form::select('type',array_except(config('status.barcode_associateds_type'),['procurement','test','sell'
                    ,'loan_out','new','good','bad'
                    ]),old('type',Request::input('type')),['class'=>'select2','placeholder'=>'请选择筛选条件']) }}
                </div>
            </form>
            @endif
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            @include('admin.common._lookType',['datas'=>config('status.barcode_associateds_menu'),'duiBiCanShu'=>$status,'url'=>route('admin.barcode_associateds.index'),'canshu'=>'status'])
                @switch($status)
                    @case('loan_out')
                    @include('admin.barcode_associateds.table.loan_out')
                    @break;
                @case('quality_acceptance')
                @include('admin.barcode_associateds.table.quality_acceptance')
                @break;
                @case('bad')
                @include('admin.barcode_associateds.table.bad')
                @break;
                @case('returned_to_the_factory_and_warranty_returned_to_the_factory')
                @include('admin.barcode_associateds.table.returned_to_the_factory_and_warranty_returned_to_the_factory')
                @break;
                @case('quality_return')
                @include('admin.barcode_associateds.table.quality_return')
                @break;
                @case('test')
                @include('admin.barcode_associateds.table.test')
                @break;
                @case('barcode_associated')
                @include('admin.barcode_associateds.table.barcode_associated')
                @break;
                @endswitch


        </div>
    </div>

@endsection