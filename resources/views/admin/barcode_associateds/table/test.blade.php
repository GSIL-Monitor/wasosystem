<form>
    <table class="listTable">
        <tr>
            <th class="">事件</th>
            <th class="tableInfoDel">条码</th>
            <th class="">产品类型</th>
            <th class="">产品规格</th>
            <th class="">供货单位</th>
            <th class="">采购人员</th>
            <th class="">操作员</th>
            <th class="">入库日期</th>

        </tr>

        @forelse($barcode_associateds as $key=>$barcode_associated)

            <tr>
                <td class="">
                 测试品
                </td>
                <td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"
                                                                       data_url="{{ route('admin.barcode_associateds.create') }}?status={{ $status }}&id={{ $barcode_associated['barcode_associateds']->id }}{{ array_to_url(array_except($barcode_associated,'barcode_associateds')) }}">{{ $key }}</a>
                </td>
                <td>{{ $barcode_associated['product_good_type'] }}</td>
                <td>{{ $barcode_associated['product_good_name'] }}</td>
                <td>{{ $barcode_associated['barcode_associateds']->supplier_managements->code }} {{ $barcode_associated['barcode_associateds']->supplier_managements->name }}</td>
                <td>{{ $barcode_associated['purchase'] ?? $barcode_associated['admin'] }}</td>
                <td>{{ $barcode_associated['admin'] }}</td>
                <td class="">{{ $barcode_associated['barcode_associateds']->updated_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        @endforelse
    </table>
</form>