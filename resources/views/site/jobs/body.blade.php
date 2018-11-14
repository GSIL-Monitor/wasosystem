<div class="body">
    <div id="crumbs">
        <div class="wrap"><a href="/">首页</a> > 加入我们</div>
    </div>

    <div class="big_pic"><div class="wrap"><img src="{{ asset('pic/job_bg.jpg') }}"></div></div>


    <div class="wrap">
        <div class="jobBox">
            <dl class="job_type">
                <dt>职位类别：</dt>
                <dd>
                    <ul>
                        <li  class="@if(!request()->has('type')) li2  @endif"><a href="{{ route('job.index') }}">全部</a></li>
                        @foreach(config('status.job_type') as $key=>$item)
                            <li class="@if(request()->has('type') && request()->get('type') == $key) li2  @endif"><a href="{{ route('job.index') }}?type={{ $key }}">{{ $item }}</a></li>
                        @endforeach
                        <div class="clear"></div>
                    </ul>
                </dd>

            </dl>

            <dl class="jobs">
                <dt>
                    <span class="name">职位名称</span>
                    <span class="type">职位类别</span>
                    <span class="addr">工作地点</span>
                    <span class="num">招聘人数</span>
                    <span class="time">发布时间</span>
                    <div class="clear"></div>
                </dt>

                @if($jobs->isEmpty())
                    <dd>
                        <span >没有招聘信息！</span>
                    </dd>
                @else
               @foreach($jobs as $job)
                    <dd class="@if($job->field['over']) del_through @endif">
                        <a href="@if($job->field['over']) javascript:void(0) @else {{ route('job.show',$job->id) }}  @endif">
                            <span class="name" >{{ $job->field['position'] }}</span>
                            <div class="phoneBox">
                                <span class="type">{{ $job->field['position_type'] }}</span>
                                <span class="addr">{{ $job->field['workplace'] }}</span>
                                <span class="num">{{ $job->field['recruiting_numbers'] }}人</span>
                            </div>
                            <span class="time">
                                 {{ $job->created_at->format('Y-m-d') }}
                             </span>
                            <div class="clear"></div>
                        </a>
                    </dd>

                @endforeach
                    @endif

            </dl>
        </div>
    </div>
</div>
</div>