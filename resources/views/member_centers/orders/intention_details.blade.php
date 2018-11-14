@extends('member_centers.orders.layouts.default')
@inject('good','App\Presenters\ProductGoodParamenterPresenter')
@section('title',$order->machine_model.'订单详情')
@section('css')
    <link href="{{ asset('css/order_info_public.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/order.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/product_info_edit.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('js')

    <script type="text/javascript" src="{{ asset('js/picScroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/clipboard.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/shopcar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/person.js') }}"></script>

    <script>
        var location_url='{{ route('orders.index') }}';
        $(function () {
            qrcode();
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate()
        });

        var vm = new Vue({
            el: "#app",
            data:{
                total_price: '{!! $order->unit_price !!}',
                goodLists:[],
                @if(optional($user_products)->isNotEmpty() && $order->order_type !='parts')
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
                    axios.get('{{ route('order.reset',$order->id) }}').then(function (response) {
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
                    axios.post('{{ route('order.save',$order->id) }}',form_data+'&_token='+getToken()).then(function (response) {
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
    @if($order->order_status == 'intention_to_order')
        @include('member_centers.orders.form.intention')
    @else
        @include('member_centers.orders.form.non_intention')
    @endif

@endsection