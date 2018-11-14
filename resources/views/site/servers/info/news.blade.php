
<div class="otherServer P_hide" name="otherServer" @if($completeMachine->information_management_complete_machines->isEmpty()) style="display: none" @endif>
    <div class="wrap">
        <h6 class="tit">相关资讯</h6>
        <ul class="news">
          @foreach($completeMachine->information_management_complete_machines as $new)
                <li>
                    <a href="{:U('/news_'.$v['id'])}">
                        <div class="newsPic"><img alt="" class="lazy"
                                                  data-original="{{ pic($new->pic)[0]['url'] }}"></div>
                        <h6>{{ $new->name }}</h6>
                        <span>{{ $new->created_at->format('Y-m-d') }}</span>
                    </a>
                </li>
         @endforeach
            <div class="clear"></div>
        </ul>
    </div>
</div>
