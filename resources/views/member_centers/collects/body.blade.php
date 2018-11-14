<div class="right">
    <div class="info">
        <div class="tit bigTit">
            <h5>我的收藏</h5>
            <p>收藏您关注的产品，方便您第一时间了解最新信息</p>
        </div>

        <div class="mycollection">
            <ul>
                @forelse($collects as $collect)
                    <li>
                        <a name="F_news" href="{{ route('server.show',$collect->id) }}" target="_blank"  title="{{ $collect->name }}" target="_blank">
                            <img src="{{ order_complete_machine_pic($collect->complete_machine_product_goods) }}" />
                            <div class="pro_info">
                                <p>{{ $collect->name }}</p>
                            </div>
                        </a>
                        <div class="control">
                            <i class="delcoll" data_url="{{ route('server.collectRemove',$collect->id) }}">取消收藏</i>
                        </div>
                    </li>
                @empty
                    <div class="empty">您暂时没有收藏的产品</div>
                @endforelse
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    {!! $collects->links() !!}
</div>