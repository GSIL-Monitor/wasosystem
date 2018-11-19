@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create product_goods')
                    <button class="changeWeb Btn" data_url="{{ route('admin.product_goods.create') }}?product_id={{ $product_id }}">添加产品</button>
                @endcan
                @can('edit product_goods')
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete product_goods')
                    <button class="alertWeb Btn" data_url="{{ route('admin.product_goods.show',$product_id) }}?product_id={{ $product_id }}">删除管理</button>
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/product_goods/destory') }}">删除
                    </button>
                @endcan
                @if(Request::has('souce'))
                    <button class="changeWebClose Btn">返回</button>
                @endif
            </div>
            @include('admin.product_goods.search',['url'=>route('admin.product_goods.index')])
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_goods.index'),'canshu'=>'product_id'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="product_goods">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">架构类型</th>
                    <th class="">架构系列</th>
                    <th class="">产品型号</th>
                    <th class=""><a href="{{ route('admin.product_goods.index') }}?product_id={{ $product_id }}&equal=equal">简称</a></th>
                    <th class="tableMoreHide">状态</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="">操作</th>
                </tr>
                @forelse($product_goods as $product_good)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product_good->id }}">
                        </td>
                        <td class="">{{ $product_good->framework->name }}</td>
                        <td class="">{{ $product_good->series->name }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName">
                            <input type="text"  name="edit[{{ $product_good->id }}][name]" value="{{ $product_good->name }}">
                            <a class="changeWeb" data_url="{{ route('admin.product_goods.edit',$product_good->id) }}">{{ $product_good->name }}</a>
                        </td>
                        <td ><input type="text" name="edit[{{ $product_good->id }}][jiancheng]"
                                                                                   value="{{ $product_good->jiancheng }}">
                        </td>
                        <td class="tableMoreHide">
                            @foreach(config('status.procuctGoodStatus') as $key=>$status)
                                <label for="{{ $key.$product_good->id }}">
                                    {{ Form::checkbox('edit['.$product_good->id.'][status->'.$key.']',$product_good->status[$key],old('edit['.$product_good->id.'][status->'.$key.']',$product_good->status[$key]),['class'=>'radio','id'=>$key.$product_good->id]) }}
                                    {{ $status }}</label>
                            @endforeach
                        </td>
                        <td class="tableMoreHide">{{ $product_good->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $product_good->updated_at->format('Y-m-d') }}</td>
                        <td class="">
                            <a class="alertWeb" data_url="{{ route('admin.product_goods.drive',$product_good->id) }}">添加驱动</a>
                            <a data_url="{{ route('admin.product_goods.copy',$product_good->id) }}" class="Copy">复制</a>
                        </td>
                    </tr>
                    @empty
                    <div class="empty">没有数据</div>
                @endforelse
            </table>
                {{ $product_goods->appends(array_except(request()->all(),['page']))->links() }}
            </form>

        </div>
    </div>

@endsection