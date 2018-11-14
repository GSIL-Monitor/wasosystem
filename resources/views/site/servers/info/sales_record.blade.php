@auth('user')
<div class="sale_records" name="sale_records" @if($sales_records->isEmpty())style="display: none" @endif>
    <div class="wrap">
        <h6 class="tit">销售记录（{{ $sales_srecord_count }}）</h6>
        <ul>
            @foreach($sales_records as $sales_record)
                <li>
                    <span class="name">会员名称：{{ RandomName($sales_record->user->username) }} </span>
                    <span class="model">型号：{{ $sales_record->machine_model }}</span>
                    <span class="num">购买数量：{{ $sales_record->num }}</span>
                    <span class="time">购买时间：{{ $sales_record->created_at->format('Y-m-d') }}</span>
                    <div class="clear"></div>
                </li>
            @endforeach
            <div class="clear"></div>
        </ul>
    </div>
</div>
    @endauth