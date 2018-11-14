@extends('admin.layout.default')
@section('js')
    <script src="{{ asset('admin/js/code.js') }}"></script>
    <script>
        $(function () {
            $(document).on('change','.product',function () {
                filtrate($(this),"{{ route('admin.procurement_plans.get_goods') }}")
            })
        });
        var vm=new Vue({
            el:"#barcode_associateds",
            data:{
                code: '',
                new_code:'',
                show:true,
                selected:'',
                showSelect:false,
                color:"{!! $barcode_associated['barcode_associated']->product_colour ?? '' !!}"
            },
            methods: {
                changeSelect:function () {
                    console.log(this.selected);
                   switch (this.selected){
                       case 'loan_out_return' :
                           this.showSelect=true;
                           break;
                       case 'models_to_replace' :
                           this.showSelect=true;
                           break;
                       case 'escrow_to_storage' :
                           this.showSelect=true;
                           break;

                       default :
                         this.showSelect=false;
                   }
                },
                entering: function () {
                    this.checkCode(this.code);
                },
                checkCode: function (code) {
                    axios.post("{{ route('admin.warehouse_out_managements.checkCode') }}", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        var good_id=response.data.codes.product_good_id;
                        var product_good_id=parseInt($('.product_good_id').val());
                        console.log(good_id,product_good_id);
                        if(good_id === product_good_id){
                            vm.new_code=code;
                            vm.show=false
                            vm.code='';
                        }else{
                            showError($('.code'), '没有这个条码')
                        }

                    }).catch(function (err) {
                        showError($('.code'), '没有这个条码')
                    });
                },
            },
            mounted: function () {

            },
        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create barcode_associateds')
                    <button type="submit" class="Btn common_add" form_id="barcode_associateds"
                            location="top">保存</button>
                @endcan
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.barcode_associateds.form')
        </div>
    </div>

@endsection