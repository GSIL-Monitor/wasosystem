<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    @yield('meta')
    {{-- 公用css --}}
    @include('admin.layout.css')
    @include('admin.layout.js')
    {{-- 专有css --}}
    @yield('css')
</head>
<body>
<audio id="wavFileId" src="{{ asset('mp3/xiadan.wav') }}" style="display: none;" ></audio>
    {{-- 动态内容 --}}
    @yield('content')
    {{-- 专有js --}}
   {{-- 公用js --}}
    @yield('js')
    <script>
        $(function() {
            @foreach (['error','success','info'] as $msg)
            @if(session()->has($msg))
                toastrMessage("{{ $msg }}","{{ session()->get($msg) }}");
            @endif
            @endforeach
            if($('.new').length > 0){
                $("#wavFileId").attr("autoplay","autoplay");
            }
        });
        </script>
</body>
</html>
