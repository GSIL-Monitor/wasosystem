<form>
    <table class="listTable">
        <tr>
            <th class="">事件</th>
            <th class="tableInfoDel">条码</th>
            <th class="">产品类型</th>
            <th class="">产品规格</th>
            <th class="">关联客户</th>
            <th class="">经办人</th>
            <th class="">操作员</th>
            <th class="">借出时间</th>

        </tr>

        @forelse($barcode_associateds as $key=>$barcode_associated)

            <tr>
                <td class="">
                 借出
                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                       data_url="{{ route('admin.barcode_associateds.create') }}?status={{ $barcode_associated['barcode_associateds']->out_type }}&id={{ $barcode_associated['barcode_associateds']->id }}{{ array_to_url(array_except($barcode_associated,'barcode_associateds')) }}">{{ $key }}</a>
                </td>
                <td>{{ $barcode_associated['product_good_type'] }}</td>
                <td>{{ $barcode_associated['product_good_name'] }}</td>
                <td>{{ $barcode_associated['barcode_associateds']->user->username ?? $barcode_associated['barcode_associateds']->admins->name }}</td>

                <td>{{ $barcode_associated['barcode_associateds']->order->markets->name  ?? $barcode_associated['barcode_associateds']->user->admins->name }}</td>
                <td>{{ $barcode_associated['barcode_associateds']->admins->name }}</td>
                <td class="">{{ $barcode_associated['barcode_associateds']->updated_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        @endforelse
    </table>
</form>