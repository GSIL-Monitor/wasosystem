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
            <th class="">操作员</th>
            <th class="">受理时间</th>

        </tr>

        @forelse($barcode_associateds as $barcode_associated)

            {{--<tr>--}}
                {{--<td class="">--}}
                 {{--质保受理--}}
                {{--</td>--}}
                {{--<td class="tableInfoDel  tablePhoneShow  tableName"><a class="changeWeb"--}}
                                                                       {{--data_url="{{ route('admin.barcode_associateds.edit',$barcode_associated['product_good_id']) }}">{{ $key }}</a>--}}
                {{--</td>--}}
                {{--<td>{{ $barcode_associated['product_good_type'] }}</td>--}}
                {{--<td>{{ $barcode_associated['product_good_name'] }}</td>--}}
                {{--<td>{{ $barcode_associated['barcode_associateds']->user->username ?? $barcode_associated['barcode_associateds']->admins->name }}</td>--}}
                {{--<td>{{ $barcode_associated['barcode_associateds']->admins->name }}</td>--}}
                {{--<td class="">{{ $barcode_associated['barcode_associateds']->updated_at->format('Y-m-d') }}</td>--}}
            {{--</tr>--}}
        @empty
            <tr><td colspan="11"><div class='error'>没有数据</div></td></tr>
        @endforelse
    </table>
</form>