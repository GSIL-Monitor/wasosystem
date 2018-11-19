@if(!empty($video))
<div class='serverInduce' name="serverInduce">
    <div class="wrap">
        <notempty name="video.name">
            <i class="mobileTips">视频较大，建议在WIFI下观看</i>
            <div class="videoBox">
                <a class="videoLinks" href="{{ $video->url }}"
                   target="_blank" name="F_news" class="F_news"></a>
                <i class="videoBtns play"></i>
                <div class="playscreen"></div>
                <video controls id="video1">
                    <source src="{{ asset('storage/'.$video->file['url'][0]) }}" type="video/mp4">
                    <source src="{{ asset('storage/'.$video->file['url'][0]) }}" type="video/ogg">
                </video>
            </div>
        </notempty>
        {!! str_replace('src="/ueditor','class="lazy" data-original="https://www.waso.com.cn/ueditor',$completeMachine->details) !!}
    </div>
</div>
    @endif