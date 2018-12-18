 <form>
    <table class="listTable">
        <tr>
            <th class="">事件</th>
            <th class="tableInfoDel">条码</th>
            <th class="">产品类型</th>
            <th class="">产品规格</th>
            <th class="">供货商</th>
            <th class="">关联客户</th>
            <th class="">经办人</th>
            <th class="">采购员</th>
            <th class="">操作员</th>
            <th class="tableMoreHide">入库时间</th>
            <th class="">受理时间</th>
        </tr>

        @forelse($barcode_associateds as $barcode_associated)

            <tr>
                <td class="">
                {{ config('status.barcode_associateds_type')[$barcode_associated->current_state] }}
                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                       data_url="{{ route('admin.barcode_associateds.create') }}?status={{ $barcode_associated->current_state }}&id={{ $barcode_associated->id }}&code={{ $barcode_associated->code }}&product_good_id={{ $barcode_associated->product_good->id }}&category={{ $barcode_associated->type }}">{{ $barcode_associated->code }}</a>
                </td>
                <td>{{ $barcode_associated->product_good->product->title }}</td>
                <td>{{ $barcode_associated->product_good->name }}</td>
                <td>{{ $barcode_associated->supplier_managements->name ?? '' }}</td>
                <td>{{ $barcode_associated->user->username ?? '' }}  {{ $barcode_associated->user->nickname ?? '' }}</td>
                <td>{{ $barcode_associated->order->markets->name ?? '' }}</td>
                <td>{{ $barcode_associated->procurement_plans->admins->name ?? '' }}</td>
                <td>{{ $barcode_associated->admins->name ?? '' }}</td>
                <td class="tableMoreHide">{{ $barcode_associated->procurement_plans->updated_at->format('Y-m-d') }}</td>
                <td class="">{{ $barcode_associated->updated_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        @endforelse
    </table>
 </form>