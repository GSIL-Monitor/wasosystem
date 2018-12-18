
<table class="listTable">
    <tr>

        <th class="tableInfoDel" @if($cate != 'parts' && $productGoods->isNotEmpty()) hidden @endif><input type="checkbox" class="selectBox SelectAll"></th>
        <th class="tableInfoDel">配件类型</th>
        <th class="">配件名称</th>
        <th  class="">数量</th>
        <th  class="">质保(年)</th>
        <th  class="">单价</th>
        <th  class="">合计</th>
    </tr>
    @forelse($productGoods as $productGood)
        @if($productGood->product->title == '机箱' && $productGood->details['kun_bang_dian_yuan'])
            @php $power=$product_good->whereProductId(21)->where('oldid',$product_good->details['kun_bang_dian_yuan'])->first();@endphp
        @endif
        <tr>
            <td class="tableInfoDel"  @if($cate != 'parts' && $productGoods->isNotEmpty()) hidden @endif>  <input class="selectBox selectIds" @if($cate != 'parts' && $productGoods->isNotEmpty()) checked @endif type="checkbox" name="id[]" value="{{ $productGood->id }}"></td>
            <td>{{ $productGood->product->title }}</td>
            <td class="tableInfoDel  tablePhoneShow  tableName">{{ $productGood->name }}</td>
            <td class="num">
                <input type="text" readonly="" class="PJnum good_num" style="text-align: center;padding: 0" value="{{ $productGood->pivot->product_good_num  }}"  product-name="{{ $productGood->product->title }}"  product-bianhao="{{  $productGood->product->bianhao }}" good-id="{{ $productGood->id }}" good-framework="{{ $productGood->framework->name }}" good-jianma="{{ $productGood->jianma }}" >
                {{  $productGood->pivot->product_good_raid }}
            </td>
            <td>{{ $productGood->quality_time }}</td>
            <td data-price="{{ $productGood->pivot->product_good_price }}" class="product_good_price">{{ $productGood->pivot->product_good_price }}</td>
            <td class="total_price">
                {{ $productGood->pivot->product_good_price * $productGood->pivot->product_good_num }}
            </td>
        </tr>
        @if(isset($power))
            <tr >
                <td class="num">
                    <input type="hidden"  class="PJnum good_num"  product-name="{{ $power->product->title }}"  product-bianhao="{{  $power->product->bianhao }}" good-id="{{ $power->id }}" good-framework="{{ $power->framework->name }}" good-jianma="{{ $power->jianma }}">
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="7">暂时没有物料！</td>
        </tr>
    @endforelse
    <tfoot>
    <tr class="tit">
        <td colspan="7">
            <div class="addPro" id="app" >
                @if($cate == 'parts')
                    @include('admin.demand_managements.table.parts')
                @else
                    @if($productGoods->isEmpty())
                    @include('admin.demand_managements.table.complete_machine')
                    @endif
                @endif

            </div>
        </td>
    </tr>
    <tfoot/>
</table>
