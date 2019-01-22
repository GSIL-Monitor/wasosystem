@extends('site.layouts.default')
@inject('good','App\Presenters\ProductGoodParamenterPresenter')
{{--@php dd($good->get_goods($completeMachine->complete_machine_product_goods)) @endphp--}}
@section('title',$completeMachine->name)
@section('css')
    <link href="{{ asset('css/product_info.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/product_info_edit.css') }}" rel="stylesheet" type="text/css">
    <style>
        .ivu-btn-primary{color:#fff;background-color:#fff;border:none}
        .ivu-btn-primary:hover{color:#fff;background-color:#fff;border:none}
        .A_caozuo .ivu-poptip-footer span {
            display: block;
            padding: 5px 20px;
            width: auto;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            background: #176b86;
            color: #fff;
            float: left;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="{{ asset('js/FixLinks.js') }}"></script>
    <script src="{{ asset('js/materialEditor.js') }}"></script>
    <script>
        $(function () {
            $(".news li:nth-child(3n)").addClass("last");
            qrcode();
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate()
        });
        var vm = new Vue({
            el: "#app",
            data:{
                total_price: '{!! $completeMachine->UnitPrice() !!}',
                goodLists:[],
                @if($user_products->isNotEmpty())
                goodLists:{!! $good->get_goods($user_products) !!},
                @endif
                raids :{!! json_encode($good->raids(),true) !!}
            },
            methods:{
                set_price(price){
                    this.total_price=price;
                },
                reset(){
                    var self=this;
                    var Notice=this.$Notice;
                    axios.get('{{ route('server.reset',$completeMachine->id) }}').then(function (response) {
                        self.$refs.child.goodList=response.data;
                        self.total_price='{!! $completeMachine->UnitPrice() !!}'
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
                save(){
                    var self=this;
                    var Notice=this.$Notice;
                    var form_data=$('#completeMachine').fixedSerialize();
                    axios.post('{{ route('server.save') }}',form_data+'&_token='+getToken()).then(function (response) {
                        Notice.success(
                            {
                                title: "保存成功 正在跳转到意向订单！",
                                duration: 1,
                                onClose: function () {
                                    location.href='/orders/'+response.data
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
    <div id="softCopyRight">
        <img src="{{ asset('pic/softCopyright.jpg') }}">
        <span class="softCopyClose" title="关闭">×</span>
    </div>
    <div id="Pic_black"></div>
    <div id="P_buy">
        <div class="P_buy_now">
            <button class="editDetail @guest('user') noLogin @endguest">基础配置修改</button>
            <button class="editDetail @guest('user') noLogin @endguest">意向保存</button>
            <div class="clear"></div>
        </div>
    </div>

    <div class="pro_detail" id="app">
        @include('site.servers.info.material_editor')
    </div>

    <div class="body">

        <div id="crumbs">
            <div class="wrap">
                <a href="/">首页</a> > 产品分类 >
                    <a class="P_backUrl" href="{{ route('server.index',$parent->id) }}"> {{ $parent->name }} </a>
                > 网烁{{ str_before($completeMachine->name,'-') }} 基础配置
            </div>
        </div>


        <div class="wrap">
            <div class="buy_box">
                @includeIf('site.servers.info.pic')
                @includeIf('site.servers.info.titleTag')
                <div class="clear"></div>
            </div>
            <!-- 上部图片及价格说明 结束 -->
        </div>


        <div class="info_down">
            @includeIf('site.servers.info.silder')


            <div class="detail_box">

                @includeIf('site.servers.info.video')


                @includeIf('site.servers.info.detail')
                <!-- 规格参数 结束 -->

                    @includeIf('site.servers.info.news')



                @includeIf('site.servers.info.drive')
                <!-- 相关下载 结束 -->


                @includeIf('site.servers.info.sales_record')
                <!-- 销售记录 结束 -->


                @includeIf('site.servers.info.recommend')
                <!-- 相关推荐 结束 -->

            </div>
            <!-- 商品详情 结束 -->


        </div>
    </div>
    </div>

@endsection