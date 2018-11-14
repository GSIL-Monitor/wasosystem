<div class='serverInduce' name="serverInduce">
    <div class="wrap">
        <notempty name="video.name">
            <i class="mobileTips">视频较大，建议在WIFI下观看</i>
            <div class="videoBox">
                <a class="videoLinks" href="{$video['url']?$video['url']:'javascript:void(0)'}"
                   target="_blank" name="F_news" class="F_news"></a>
                <i class="videoBtns play"></i>
                <div class="playscreen"></div>
                <video controls id="video1">
                    <source src="https://www.waso.com.cn/Public/video/intel~waso-1.mp4" type="video/mp4">
                    <source src="https://www.waso.com.cn/Public/video/intel~waso-1.mp4" type="video/ogg">
                </video>
            </div>
        </notempty>
        {!! str_replace('src="/ueditor','class="lazy" data-original="https://www.waso.com.cn/ueditor',$completeMachine->details) !!}
    </div>
</div>