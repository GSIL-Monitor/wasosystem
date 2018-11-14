<div class="serverDown P_hide" name="serverDown" @if(drive($completeMachine->complete_machine_product_goods)->isEmpty()) style="display: none" @endif>
    <div class="wrap">
        <h6 class="tit">驱动下载</h6>
        <ul class="down">
            @auth('user')
                    @forelse(drive($completeMachine->complete_machine_product_goods) as $item)
                    <li>
                        <a href="{{ url('/downloadFile') }}?file={{ $item->file['url']  }}&name={{  $item->file['name'] }}" >
                           {{ $item->file['name'] }}<i></i>
                        </a>
                    </li>
                        @empty
                @endforelse
               @else
                <div class="error" style="text-align: center">
                    请 <a href="{{ route('login') }}" style="color: #0187CE">登录</a> 后下载！
                </div>
            @endauth
            <div class="clear"></div>
        </ul>
    </div>
</div>