@extends('admin.layout.default')
@section('js')
    <script src="{{ asset('admin/js/code.js') }}"></script>
    <script>
        $(function () {
            $(document).on('change', '.product', function () {
                filtrate($(this), "{{ route('admin.procurement_plans.get_goods') }}")
            })
        });
        var vm = new Vue({
            el: "#app",
            data: {
                code: '',
                new_code: '',
                show: true,
                selected: '{{ Request::get('type') ?? '' }}',
                showInput: false,
                showColor: true,
                showProduct: false,
                showTable:false,
                color: "{!! $barcode_associated['barcode_associated']->product_colour ?? '' !!}",
                GoodUrl: "{{ route('admin.product_goods.getseries') }}",
            },
            methods: {
                changeSelect: function () {
                    if(this.selected == 'loan_out_return' || this.selected == 'escrow_to_storage'){
                        this.showColor = false;
                    }else if(this.selected == 'models_to_replace'){
                        this.showProduct = true;
                    }else{
                        this.showInput = false;
                        this.showColor = true;
                        this.showProduct = false;
                        this.showTable = false;
                    }
                },
                entering: function () {
                    this.checkCode(this.code);
                },
                checkCode: function (code) {
                    var self=this;
                    axios.post("{{ route('admin.warehouse_out_managements.checkCode') }}", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        var good_id = response.data.codes ? response.data.codes.product_good_id : 0;
                        var product_good_id = parseInt($('.product_good_id').val());
                        console.log(good_id, product_good_id,self.selected);
                        if (self.selected == 'quality_return' || self.selected == 'factory_return') {
                            if (!good_id) {
                                self.new_code = code;
                                self.show = false
                                self.code = '';
                            } else {
                                showError($('.code'), '这个条码已存在')
                            }

                        } else {
                            if (good_id == product_good_id) {
                                self.new_code = code;
                                self.show = false
                                self.code = '';
                            } else {
                                showError($('.code'), '没有这个条码')
                            }
                        }


                    }).catch(function (err) {
                        showError($('.code'), '没有这个条码')
                    });
                },
            },
            mounted: function () {
                this.changeSelect()
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
                    @if(!Request::has('search'))
                        <button type="submit" class="Btn common_add" form_id="barcode_associateds"
                                location="top">保存
                        </button>
                    @endif
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