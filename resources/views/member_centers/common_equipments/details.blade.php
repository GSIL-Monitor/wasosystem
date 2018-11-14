@extends('member_centers.orders.layouts.default')
@inject('good','App\Presenters\ProductGoodParamenterPresenter')
@section('title','配件选购')
@section('css')
    <link href="{{ asset('css/order_info_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/order.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/product_info_edit.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('js')

    <script type="text/javascript" src="{{ asset('js/picScroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/clipboard.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/person.js') }}"></script>
    <script src="{{ asset('js/common_equipments.js') }}"></script>
    <script>
        $(function () {
            qrcode();
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate()
        });
        var vm = new Vue({
            el: "#app",
            data:{
                total_price: '{!! $common_equipment->unit_price !!}',
                goodLists:[],
                @if($user_products->isNotEmpty())
                goodLists:{!! $good->get_goods($user_products) !!},
                @endif
                raids :{!! json_encode($good->raids(),true) !!}
            },
            methods:{
                set_price:function (price){
                    this.total_price=price;
                },
                reset:function () {
                    var self=this;
                    var Notice=this.$Notice;
                    axios.get('{{ route('common_equipments.reset',$common_equipment->id) }}').then(function (response) {
                        self.$refs.child.goodList=response.data;
                        Notice.success(
                            {
                                title: "重置成功！",
                                duration: 1,
                                onClose: function () {
                                    zheng_JiXingHao_Create();
                                    ConfigurationCodeCreate()
                                    qrcode();
                                }
                            });
                    }).catch(function (error) {
                        swal(error.response.data.message,'','warning')
                    });
                },
                save:function () {
                    var self=this;
                    var Notice=this.$Notice;
                    var form_data=$('#completeMachine').fixedSerialize();
                    axios.post('{{ route('common_equipments.save',$common_equipment->id) }}',form_data+'&_token='+getToken()).then(function (response) {
                        Notice.success(
                            {
                                title: "保存成功 正在刷新订单！",
                                duration: 1,
                                onClose: function () {
                                    location.reload()
                                }
                            });
                    }).catch(function (error) {
                        swal(error.response.data.message,'','warning')
                    });
                }
            }
        });
    </script>
@endsection
@section('content')
    <div id="Pic_black"></div>
        <div class="pro_detail" id="app">
            @include('member_centers.common_equipments.form.material_editor')
        </div>
        @include('member_centers.common_equipments.form.non_intention')
@endsection