@forelse($goodss as $good)
    @if($good['good']->product->title == '机箱' && $good['good']->details['kun_bang_dian_yuan'])
        @php $power=$good['good']->find($good['good']->details['kun_bang_dian_yuan']);@endphp
    @endif
    @php $all_goods=$good['good']->product->good;@endphp
    <tr class="{{ $good['good']->product->bianhao }}">
        <td class="A_caozuo">
            {!! $good['good']->checkProduct['del_button'] !!}
            {!! $good['good']->parameters['html_hidden'] ?? '' !!}
            {!! $good['good']->addiator['adiator'] ?? '' !!}
        </td>
        <td class="A_type">
            {{  $good['good']->product->title }}
        </td>
        <td class="tableInfoDel  tablePhoneShow  tableName A_name">
            @php $goods=$good['good']->product->good; @endphp
            @if(str_contains($good['good']->product_id, [13,20,21,23]) && !auth('admin')->user()->can('super edit'))
                {{ $good['good']->name }}
            @else
                {{ Form::select('name',$good['good']->parameters['list'] ?? $all_goods->pluck('name','id'),old('name',$good['good']->id),['class'=>'select2 product_select','data_url'=>route('admin.common_equipments.add_modified_temporary_materials',$common_equipment->id),'old_id'=>$good['good']->id]) }}
            @endif
        </td>
        <td class="A_price" data-id="{!! $good['good']->addiator['terrace_price'] ?? '' !!}">{{ $good['good']->pivot->product_good_price }}</td>
        <td class="A_num num">
            <div class="A_numbox" maxNum="{{ $good['good']->parameters['max_num'] ??  $good['good']->checkProduct['max_num'] }}" >
                <button class="canshunum {{ $good['good']->checkProduct['del_class'] }}">{{ $good['good']->checkProduct['del_symbol'] }}</button>
                <input type="number"  class="PJnum good_num OneNumber" style="text-align: center;padding: 0" {{ $good['good']->checkProduct['readonly'] }} value="{{ $good['good']->pivot->product_good_num  }}"  product-name="{{ $good['good']->product->title }}"  product-bianhao="{{  $good['good']->product->bianhao }}" good-id="{{ $good['good']->id }}" good-framework="{{ $good['good']->framework->name }}" good-jianma="{{ $good['good']->jianma }}" >
                <button class="canshunum {{ $good['good']->checkProduct['add_class'] }}">{{ $good['good']->checkProduct['add_symbol'] }}</button>
                <div class="clear"></div>
            </div>
        </td>

        <td class="raids">
            {{ Form::select('raid1',$raids['raid1'],old('raid1',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid1 raid']) }}
            {{ Form::select('raid2',$raids['raid2'],old('raid2',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid2 raid']) }}
            {{ Form::select('raid3',$raids['raid3'],old('raid3',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid3 raid']) }}
            {{ Form::select('raid4',$raids['raid4'],old('raid4',$good['good']->pivot->product_good_raid),['placeholder'=>'-RAID-','class'=>'raid4 raid']) }}
        </td>
        <td class="A_prices">
            {{--$good['good']->pivot->product_good_num  获取中间表中的字段信息--}}
            {{ $good['good']->pivot->product_good_price * $good['good']->pivot->product_good_num }}
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