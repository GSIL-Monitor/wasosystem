@extends('admin.layout.default')
@section('js')
    <script>
        var vm = new Vue({
            el: "#app",
            data: {
                logo: {
                    pic:{!! getImages(setting($type.'_logo')) !!},
                    url:"{!! $type !!}_logo[url][]",
                    name:"{!! $type !!}_logo[name][]",
                },
                custome_hotline: {
                    pic:{!! getImages(setting($type.'_custome_hotline')) !!},
                    url:"{!! $type !!}_custome_hotline[url][]",
                    name:"{!! $type !!}_custome_hotline[name][]",
                },
                service_hotline: {
                    pic:{!! getImages(setting($type.'_service_hotline')) !!},
                    url:"{!! $type !!}_service_hotline[url][]",
                    name:"{!! $type !!}_service_hotline[name][]",
                },
                wechat: {
                    pic:{!! getImages(setting($type.'_wechat')) !!},
                    url:"{!! $type !!}_wechat[url][]",
                    name:"{!! $type !!}_wechat[name][]",
                },
                intel: {
                    pic:{!! getImages(setting($type.'_intel')) !!},
                    url:"{!! $type !!}_intel[url][]",
                    name:"{!! $type !!}_intel[name][]",
                },
                intelAD: {
                    pic:{!! getImages(setting($type.'_intelAD')) !!},
                    url:"{!! $type !!}_intelAD[url][]",
                    name:"{!! $type !!}_intelAD[name][]",
                },
                asus: {
                    pic:{!! getImages(setting($type.'_asus')) !!},
                    url:"{!! $type !!}_asus[url][]",
                    name:"{!! $type !!}_asus[name][]",
                },
                supermicro: {
                    pic:{!! getImages(setting($type.'_supermicro')) !!},
                    url:"{!! $type !!}_supermicro[url][]",
                    name:"{!! $type !!}_supermicro[name][]",
                },
                members_base: {
                    pic:{!! getImages(setting($type.'_members_base')) !!},
                    url:"{!! $type !!}_members_base[url][]",
                    name:"{!! $type !!}_members_base[name][]",
                },
                committeeman: {
                    pic:{!! getImages(setting($type.'_committeeman')) !!},
                    url:"{!! $type !!}_committeeman[url][]",
                    name:"{!! $type !!}_committeeman[name][]",
                },
                soem: {
                    pic:{!! getImages(setting($type.'_soem')) !!},
                    url:"{!! $type !!}_soem[url][]",
                    name:"{!! $type !!}_soem[name][]",
                },
                stap: {
                    pic:{!! getImages(setting($type.'_stap')) !!},
                    url:"{!! $type !!}_stap[url][]",
                    name:"{!! $type !!}_stap[name][]",
                },
                actionImageUrl: "{!! env('ActionImageUrl') !!}",
                imageUrl: "{!! env('IMAGES_URL') !!}",
                deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
                fileCount:1,
            },
            methods: {
            },
            mounted: function () {
            },
        });
    </script>
 @endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('edit settings')
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.common._lookType',['datas'=>config('status.settings'),'duiBiCanShu'=>$type,'url'=>route('admin.settings.index'),'canshu'=>'type'])
            <div class="JJList ml-100" >
                <ul class="maxUl" id="app">
                    <form action="{{ route('admin.settings.store') }}" method="post" id="AllEdit" onsubmit="return false">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         @includeIf('admin.settings.list.'.$type)
                        <div class="clear"></div>
                    </form>
                </ul>
            </div>
        </div>
    </div>
@endsection
