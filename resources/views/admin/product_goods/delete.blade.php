@extends('admin.layout.default')
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>

                @can('delete product_goods')
                    <button type="submit" class="red Btn AllDel" form="AllDel"
                            data_url="{{ url('/waso/product_goods/destory') }}?&delete=Trashed">删除
                    </button>
                @endcan
                <button type="submit" class="blue Btn AllDel" form="AllDel"
                        data_url="{{ url('/waso/product_goods/destory') }}?&recover=recover">恢复
                </button>

                <button class="Btn alertWebClose ">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>$products,'duiBiCanShu'=>$product_id,'url'=>route('admin.product_goods.show',$product_id),'canshu'=>'product_id'])
            <table class="listTable">
                <tr>
                    <th class="tableInfoDel"><input type="checkbox" class="selectBox SelectAll"></th>
                    <th class="tableInfoDel">架构类型</th>
                    <th class="">架构系列</th>
                    <th class="">产品型号</th>
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
                    </tr>
                    @empty
                    <td>
                        <div class="empty">没有数据</div>
                    </td>
                @endforelse
            </table>
            </form>
            {{ $product_goods->links('vendor.pagination.bootstrap-4',['data'=>'&product_id='.$product_id]) }}
        </div>
    </div>

@endsection