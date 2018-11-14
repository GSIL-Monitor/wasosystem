@extends('site.layouts.default')
@inject('complete_machine_paramenter','App\Presenters\CompleteMachineParamenter')

@section('title',$comparisons->implode('name',' - ').' - 产品对比')
@section('css')
    <link href="{{ asset('css/comparision.css') }}" rel="stylesheet" type="text/css">
    <style>
        .addComparisonBox{
            display: none;
        }
    </style>
@endsection
@section('js')
    <script>
        $(function () {
             function checkComparisons(){
                if($('.comparisons').length < 4){
                    $('.addComparisonBox').show();
                }else{
                    $('.addComparisonBox').hide();
                }
            }
            checkComparisons();
            $(document).on("click", ".remove", function () {
                var url = $(this).attr('data_url');
                var id= $(this).attr('data_id');
                var self=$(this);
                var proLength = $(".remove").length;
                if (proLength < 3) {
                    swal('最少2个产品对比', '', 'warning');
                    return false;
                }
                axios.get(url)
                    .then(function () { // 请求成功会执行这个回调
                        self.parents('td').remove();
                        $('.remove'+id).remove();
                        checkComparisons();
                    }, function (error) { // 请求失败会执行这个回调
                        swal('系统错误', '', 'error');
                    });

            });
            $(document).on("change", ".addComparison", function () {
                var id=$(this).val();
                axios.get("/completeMachine/"+id+"/comparison")
                    .then(function () { // 请求成功会执行这个回调
                        location.reload();
                    }, function (error) { // 请求失败会执行这个回调
                        swal('系统错误', '', 'error');
                    });

            });

        });

    </script>

@endsection
@section('content')
    <div class="body">
        <div id="crumbs"><div class="wrap"><a href="#">首页</a> > <a href="{:U('Products/products')}">产品中心</a> > 产品对比</div></div>

        <div class="wrap">
            <div class="detail_box">
                <table>
                    <tr id="add">
                        <td class="big_tit"></td>

                        @if($comparisons->count() <= 4)
                            @foreach($comparisons as $comparison)
                                @php $pics=order_complete_machine_pic($comparison->complete_machine_product_goods,'all');@endphp
                                <td class="comparisons">
                                    <a href="@if($server->parent_id ==1 )
                {{ route('server.show',$server->id) }}
                @else
                {{ route('server.designer',$comparison->id) }}
                @endif" target="_blank"><img
                                                class='lazy' data-original="{{ $pics[0]['url'] ?? '' }}"  alt="" width="250px" height="200px"/></a>
                                    <a class="name" href="@if($server->parent_id ==1 )
                {{ route('server.show',$server->id) }}
                @else
                {{ route('server.designer',$comparison->id) }}
                @endif" target="_blank">{{ $comparison->name }}</a>
                                    <div class="control">
                                            <a class="remove" data_id="{{ $comparison->id }}" data_url="{{ route('server.comparisonRemove',$comparison->id) }}">删除</a>
                                            <a class="shop" href="@if($server->parent_id ==1 )
                {{ route('server.show',$server->id) }}
                @else
                {{ route('server.designer',$comparison->id) }}
                @endif">购买</a>
                                    </div>
                                </td>
                            @endforeach
                                    <td class="addComparisonBox" >
                                        {!! Form::select(null,$complete_machines,null,['class'=>'select2 addComparison','placeholder'=>'请选择对比整机']) !!}
                                    </td>
                        @endif
                    </tr>
                    @foreach($complete_machine_paramenter->material_details($comparisons) as $key=> $comparison)
                        <tr class="details"><td class="big_tit">{{ $key }}</td>
                        @foreach($comparison as $key2=>$detail)
                            <td class="remove{{ $key2 }}">{{ empty($detail) ? '----' : $detail }}</td>
                        @endforeach
                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>

@endsection