<table class="listTable">
    <tr>
        <th class="">发生时间</th>
        <th class="tableInfoDel">事件</th>
        <th class="">所在地</th>
    </tr>

    @forelse($barcode_associateds as $barcode_associated)
        @php $types=$barcode_associated->current_state ?? $barcode_associated->procurement_type ?? $barcode_associated->out_type;@endphp
        <tr>
            <td class="">{{ $barcode_associated->updated_at ?? '' }}</td>
            <td class="tableInfoDel  tablePhoneShow  tableName">
                @if(str_contains($types,['procurement','test']))
                    @php $url=route('admin.put_in_storage_managements.edit',$barcode_associated->id);@endphp
                @elseif(in_array($types,['sell','loan_out']))
                    @php $url=route('admin.warehouse_out_managements.edit',$barcode_associated->id);@endphp
                @else
                    @php $url=route('admin.barcode_associateds.create').'?category='.$barcode_associated->type.'&status='.$types.'&id='.$barcode_associated->id.'&code='.$barcode_associated->code.'&product_good_id='.$barcode_associated->product_good->id.'&search=search';@endphp
                @endif
                <a class="changeWeb" data_url="{{ $url }}">
                    {{ config('status.barcode_associateds_type')[$types] }} {{ $types }}
                </a>
            </td>
            <td>
                @if(isset($barcode_associated->location) && $barcode_associated->location =='库存' || in_array($types,['procurement','test']))
                    库存
               @endif
               @if(isset($barcode_associated->location) && $barcode_associated->location =='客户' || in_array($types,['sell','loan_out']))
                        {{ $barcode_associated->user->username  }}   {{ $barcode_associated->user->nickname  }}
               @endif
               @if(isset($barcode_associated->location) && $barcode_associated->location =='代管')
                    代管
               @endif
               @if(isset($barcode_associated->location) && $barcode_associated->location =='供货商')
                        {{ $barcode_associated->supplier_managements->code }}  {{ $barcode_associated->supplier_managements->name  }}
               @endif
               <span class="redWord">{{ $barcode_associated->description }}</span>
                    {{ $barcode_associated->user_id ?? 0 }}
                    {{ $barcode_associated->order->id ?? 0 }}

            </td>
        </tr>
    @empty
        <tr><td colspan='3'><div class='error'>没有数据</div></td></tr>
    @endforelse
</table>
