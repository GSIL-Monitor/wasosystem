@forelse($order_product_goods as $good)
    @if($good->product->title == '机箱' && $good->details['kun_bang_dian_yuan'])
        @php $power=$good->find($good->details['kun_bang_dian_yuan']);@endphp
    @endif
    @php $all_goods=$good->product->good;@endphp
    <tr class="{{ $good->product->bianhao }}">
        <td class="A_caozuo">
            <input class="selectBox selectIds" type="checkbox" name="id[]" value="{{ $good->id }}">
        </td>
        <td class="A_type">
            {{  $good->product->title }}
        </td>
        <td class="tableInfoDel  tablePhoneShow  tableName A_name">
            {{ Form::select('name', $all_goods->pluck('name','id'),old('name',$good->id),['class'=>'select2 product_select','data_url'=>route('admin.orders.add_modified_temporary_materials',$order->id),'old_id'=>$good->id]) }}
        </td>
        <td class="A_price">{{ $good->pivot->product_good_price }}</td>
        <td class="A_num num">
                <div class="A_numbox">
                <input type="number"  class="PJnum good_num OneNumber" style="text-align: center;padding: 0"  value="{{ $good->pivot->product_good_num  }}"  product-name="{{ $good->product->title }}"  product-bianhao="{{  $good->product->bianhao }}" good-id="{{ $good->id }}" good-framework="{{ $good->framework->name }}" good-jianma="{{ $good->jianma }}" >
                </div>
                <div class="clear"></div>
            </div>
        </td>
        <td class="raids">
            {{ Form::select('raid1',$raids['raid1'],old('raid1',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid1 raid']) }}
            {{ Form::select('raid2',$raids['raid2'],old('raid2',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid2 raid']) }}
            {{ Form::select('raid3',$raids['raid3'],old('raid3',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid3 raid']) }}
            {{ Form::select('raid4',$raids['raid4'],old('raid4',$good->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid4 raid']) }}
        </td>
        <td class="A_prices">
            {{--$good->pivot->product_good_num  获取中间表中的字段信息--}}
            {{ $good->pivot->product_good_price * $good->pivot->product_good_num }}
        </td>
    </tr>
    @if(isset($power))
        <tr >
            <td class="A_num">
                <input type="hidden"  class="PJnum good_num"  product-name="{{ $power->product->title }}"  product-bianhao="{{  $power->product->bianhao }}" good-id="{{ $power->id }}" good-framework="{{ $power->framework->name }}" good-jianma="{{ $power->jianma }}">
            </td>
        </tr>
    @endif

@empty
    <tr>
        <td colspan="6"><div class="empty">没有数据</div></td>
    </tr>
@endforelse