@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create products')
                    <button class="alertWeb Btn" data_url="{{ route('admin.products.create') }}">添加配件</button>
                @endcan
                @can('delete products')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/products/destory') }}">删除
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th>配件编号</th>
                    <th class="tableInfoDel">配件名</th>
                    <th class="">配件简码</th>
                </tr>

                @foreach($products as $product)
                    <tr>
                        <td class="tableInfoDel">
                            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $product->id }}">
                        </td>
                        <td>{{ $product->bianhao }}</td>
                        <td class="tableInfoDel  tablePhoneShow  tableName"><a class="alertWeb"
                                                                               data_url="{{ route('admin.products.edit',$product->id) }}">{{ $product->title }}</a>
                        </td>
                        <td class="">{{ $product->jianma }} </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection