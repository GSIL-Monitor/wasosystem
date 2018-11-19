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
    {{-- 公用js --}}
    @include('admin.layout.js')
    {{-- 专有css --}}
    @yield('css')
</head>
<body>
    {{-- 动态内容 --}}
    @yield('content')
    {{-- 专有js --}}
    @yield('js')
    <script>
        $(function() {
            @foreach (['error','success','info'] as $msg)
            @if(session()->has($msg))
                toastrMessage("{{ $msg }}","{{ session()->get($msg) }}");
            @endif
            @endforeach
        });
        </script>
</body>
</html>