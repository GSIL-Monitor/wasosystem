<div>所选产品：<a target="_blank" href="{{ route('product.show',$product_id) }}">{{ $productName }}</a></div>
<div>姓名：{{ $name }}</div>
<div>电话：{{ $phone }}</div>
<div>QQ：{{ $qq }}</div>
<div>留言信息：{{ $content}}</div>
<div>所选参数：
    <br/>
    @foreach(json_decode($shaixuan_canshu,true) as $k=>$v)
        {{ $k }}
        &nbsp; &nbsp; &nbsp;|--{{ $v }}<br/>
@endforeach
</div>

