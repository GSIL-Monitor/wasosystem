<div class="right">
    <div class="info">
        <div class="tit bigTit">
            <h5>消息通知</h5>
            <p>您可以在这里查看最新的会员公告等消息。</p>
        </div>

        <div class="tonggao">
            <ul>
              @forelse($user_notifications as $user_notification)
                        <li class="check_read  @if($user_notification->pivot->state) read @else noread @endif" data_url="{{ route('notifications.read',$user_notification->id) }}">
                            <div class="headPic">
                                <div class="headImg"><img src="{{ asset('pic/wasoHead.png') }}"></div>
                                <div class="headInfo">
                                    <span class="names">网烁公司</span>
                                    <span class="time">{{ $user_notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="infos">
                                <h5 class="name" >
                                            @if($user_notification->pivot->state)
                                                     <i class="radius readed">[已读]</i>
                                            @else
                                                      <i class="radius notRead">未读</i>
                                            @endif
                                        {{ $user_notification->title }}
                                </h5>
                                <p>{{ $user_notification->content }} </p>
                            </div>
                            <div class="clear"></div>
                        </li>

                    @empty
                    暂时没有消息！
               @endforelse
            </ul>
        </div>
      {!! $user_notifications->links() !!}
    </div>

</div>