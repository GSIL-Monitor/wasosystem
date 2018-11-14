@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create product_frameworks')
                    <button class="OneAdd Btn" data_title="添加架构" data_parent_id="0"
                            data_product_id="{{ $product_id }}" data_url="{{ route('admin.product_frameworks.store') }}">添加架构</button>
                @endcan
                @can('edit product_frameworks')
                <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
                @can('delete product_frameworks')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/product_frameworks/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_frameworks.index'),'canshu'=>'product_id'])
            <form action="{{ route('admin.allupdate') }}" method="post" id="AllEdit" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="table" value="product_frameworks">
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">参数名称</th>
                    <th class="tableMoreHide">添加时间</th>
                    <th class="">修改时间</th>
                    <th class="tableInfoDel">操作</th>
                </tr>
                @foreach($product_frameworks as $product_framework)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product_framework->id }}">
                        </td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><input type="text" name="edit[{{ $product_framework->id }}][name]"
                                                                                   value="{{ $product_framework->name }}">
                           {{ $product_framework->name }}
                        </td>
                        <td class="tableMoreHide">{{ $product_framework->created_at->format('Y-m-d') }}</td>
                        <td class="">{{ $product_framework->updated_at->format('Y-m-d') }}</td>
                        <td>
                            <button class="OneAdd Btn" data_title="系列" data_parent_id="{{ $product_framework->id }}"
                                    data_product_id="{{ $product_id }}" data_url="{{ route('admin.product_frameworks.store') }}">添加系列</button>
                        </td>
                    </tr>
                    @php $childFrameworks=$product_framework->Childrens;@endphp
                    @if(count($childFrameworks) >0)
                        @foreach($childFrameworks as $childFramework)
                            <tr>
                                <td class="tableInfoDel">
                                    <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $childFramework->id }}">
                                </td>
                                <td class="tableInfoDel  tablePhoneShow  tableName"><input type="text" name="edit[{{ $childFramework->id }}][name]"
                                                                                           value="{{ $childFramework->name }}">
                                    &nbsp;&nbsp;&nbsp; &nbsp;{{ $childFramework->name }}
                                </td>
                                <td class="tableMoreHide">{{ $childFramework->created_at->format('Y-m-d') }}</td>
                                <td class="">{{ $childFramework->updated_at->format('Y-m-d') }}</td>
                                <td><a class="alertWeb" data_url="{{ route('admin.product_frameworks.edit',$childFramework->id) }}">添加驱动</a></td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
            </form>
        </div>
    </div>

@endsection