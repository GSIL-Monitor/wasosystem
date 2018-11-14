@extends('admin.layout.default')
@section('css')
    <style>
        .listBox::after{content:"."; height:0; visibility:hidden; clear:both; display:block;}
        .tableL, .tableR {
            float: left;
        }
        .tableR{margin-left:10px;}
    </style>
@endsection
@section('js')
    <script>
        $(function () {
            $(document).on('click','.set_config',function () {
                var order_id="{{ $out_order->id }}";
                var out_id=$(this).attr('data-id');
               axios.put("/waso/warehouse_out_managements/"+out_id,{
                   "_method":"PUT",
                   "_token":getToken(),
                   "order_id":order_id,
                   "type":"inventory_machine"
               }).then(function (response) {
                   toastrMessage('success',response.data.info,'top')
               }).catch(function (err) {
                   if(err.response.data.info){
                       toastrMessage('error',err.response.data.info)
                   }
               })
            });
        });
    </script>
@endsection

@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <div class="JJList">
                <div class="listBox">
                <div class="tableL">
                    <table class="listTable">
                        <tbody>
                        <tr>
                            <th>产品</th>
                            <th>配件</th>
                            <th>数量</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $out_order->serial_number }}-------&gt;    {{ $out_order->machine_model }}
                            </td>
                        </tr>
                        @foreach($out_order->order_product_goods as $item)
                        <tr>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item->pivot->product_good_num }}
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tableR">
                    <table class="listTable">
                        <tbody>
                        <tr class="first">
                            <th>产品</th>
                            <th>配件</th>
                            <th>数量</th>
                        </tr>

                        @foreach($inventory_machine as $item)
                        <tr>
                            <td colspan="3">{{ $item->order->serial_number }}-------&gt;         {{ $item->order->machine_model }}
                                                                  <a class="set_config" data-id="{{ $item->id }}">选用这个配置</a>
                            </td>
                        </tr>
                        @foreach($item->order->order_product_goods as $item2)
                            <tr>
                                <td>{{ $item2->product->title }}</td>
                                <td>{{ $item2->name }}</td>
                                <td>
                                    {{ $item2->pivot->product_good_num }}
                                </td>
                            </tr>
                        @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection