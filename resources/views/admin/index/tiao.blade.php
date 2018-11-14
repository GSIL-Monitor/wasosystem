@extends('admin.layout.default')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/indexPage.css') }}" type="text/css">
    <script>
        $(document).ready(function(){
            $(document).on("click",".mobile_show dl",function(){
                if($(this).hasClass("opend")){
                    $(this).removeClass("opend");
                    $(this).children("dd").hide();
                }else{
                    $(this).addClass("opend").siblings("dl").removeClass("opend");
                    $(this).children("dd").show();
                    $(this).siblings("dl").children("dd").hide();
                }
            });
        });
    </script>
@endsection
@section('content')

    <div class="PageBox">
        <div class="WEB">
            <div class="indexL">
                <div class="faxtLinks index_links">
                    @foreach($nav['TiaoMenus'] as $navs)
                        @can('show '.$navs['url'])
                            <dl>
                                <dt>{{ $navs->name }}<i></i></dt>
                                <div class="linksHide">
                                    @php $childMenus=$navs->childMenus;@endphp
                                    @if(count($childMenus) >0)
                                        <dd>
                                            @foreach($childMenus as $childMenu)
                                                @can('show '.$childMenu->slug)
                                                    @php $pic=array_flatten(json_decode($childMenu->pic,true));@endphp
                                                    <a sys="tiao" href="javascript:;" url="{{ $childMenu->slug }}"><em>{{ $childMenu->name }}</em></a>
                                                @endcan
                                            @endforeach
                                            <div class="clear"></div>
                                        </dd>

                                    @endif
                                </div>
                            </dl>
                        @endcan
                    @endforeach
                </div>
            </div>

            <div class="clear"></div>
        </div>
    </div>

@endsection