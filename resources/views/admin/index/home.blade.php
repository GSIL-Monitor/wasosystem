@extends('admin.layout.default')

@section('css')

    <link rel="stylesheet" href="{{ asset('admin/css/indexPage.css') }}" type="text/css">
    <script>
        $(document).ready(function () {
            $(document).on("click", ".mobile_show dl", function () {
                if ($(this).hasClass("opend")) {
                    $(this).removeClass("opend");
                    $(this).children("dd").hide();
                } else {
                    $(this).addClass("opend").siblings("dl").removeClass("opend");
                    $(this).children("dd").show();
                    $(this).siblings("dl").children("dd").hide();
                }
            });
        });
    </script>
@endsection
@section('js')

@endsection

@section('content')

    <div class="PageBox">
        <div class="WEB">
            <div class="indexL">
                <div class="faxtLinks index_links">
                    <dl>
                        <div class="linksHide">
                            <dd>
                                <a href="{{ route('admin.demand_managements.index') }}"><em>需求管理</em></a>
                                <a href="{{ route('admin.orders.index') }}"><em>全部订单</em></a>
                                <a href="{{ route('admin.users.index') }}"><em>会员管理</em></a>
                                <a href="{{ route('admin.services.index') }}"><em>服务管理</em></a>
                                <a href="{{ route('admin.barcodes.index') }}"><em>条码查询</em></a>
                                <div class="clear"></div>
                            </dd>
                        </div>
                    </dl>
                    <dl>

                            <dd>

                                <div class="chart">
                                    <h4>本月综合统计</h4>
                                    <iframe src="{{ url('/waso/all_data_chart') }}" style="border: none"></iframe>
                                </div>
                                @cannot('show self_user')
                                    <div class="chart">
                                        <h4>全部会员统计</h4>
                                        <iframe src="{{ url('/waso/user_chart') }}" style="border: none"></iframe>
                                    </div>
                                @endcannot

                                <div class="chart">
                                    <h4>所属会员统计</h4>
                                    <iframe src="{{ url('/waso/self_user_chart') }}" style="border: none"></iframe>
                                </div>
                                @cannot('show self_orders')
                                    <div class="chart">
                                        <h4>全部交易统计</h4>
                                        <iframe src="{{ url('/waso/order_price_chart') }}"
                                                style="border: none"></iframe>
                                    </div>
                                @endcannot
                                <div class="chart">
                                    <h4>所属交易统计</h4>
                                    <iframe src="{{ url('/waso/self_order_price_chart') }}"
                                            style="border: none"></iframe>
                                </div>
                                @cannot('show self_orders')
                                    <div class="chart">
                                        <h4>全部订单统计</h4>
                                        <iframe src="{{ url('/waso/order_chart') }}" style="border: none"></iframe>
                                    </div>
                                @endcannot
                                <div class="chart">
                                    <h4>所属订单统计</h4>
                                    <iframe src="{{ url('/waso/self_order_chart') }}" style="border: none"></iframe>
                                </div>
                                <div class="chart">
                                    <h4>文章统计</h4>
                                    <iframe src="{{ url('/waso/articles_chart') }}" style="border: none"></iframe>
                                </div>
                                <div class="chart" style="width: 620px;">
                                    <h4>全部产品统计</h4>
                                    <iframe src="{{ url('/waso/product_goods_chart') }}" style="border: none"></iframe>
                                </div>
                                <div class="clear"></div>
                            </dd>
                    </dl>

                    {{--@foreach($nav['WebMenus'] as $navs)--}}
                    {{--@can('show '.$navs['url'])--}}

                    {{--<dl>--}}
                    {{--<dt>{{ $navs->name }}<i></i></dt>--}}
                    {{--<div class="linksHide">--}}
                    {{--@php $childMenus=$navs->childMenus;@endphp--}}
                    {{--@if(count($childMenus) >0)--}}
                    {{--<dd>--}}
                    {{--@foreach($childMenus as $childMenu)--}}
                    {{--@can('show '.$childMenu->slug)--}}
                    {{--@php $pic=array_flatten(json_decode($childMenu->pic,true));@endphp--}}
                    {{--<a sys="web" href="javascript:;" url="{{ $childMenu->slug }}"><em>{{ $childMenu->name }}</em></a>--}}
                    {{--@endcan--}}
                    {{--@endforeach--}}
                    {{--<div class="clear"></div>--}}
                    {{--</dd>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    {{--</dl>--}}
                    {{--@endcan--}}
                    {{--@endforeach--}}

                </div>
            </div>

            <div class="clear"></div>
        </div>
    </div>

@endsection