@extends('site.layouts.default')
@section('title',$name)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <style>
        .SMbody .bg {
            position: relative;
            height: 600px;
            background-size: cover;
            background-position: center bottom;
            background-repeat: no-repeat;
            background-image: url("{{ json_decode(getImages(setting('page_authorization_supermicro')),true)[0]['url'] }}");
        }
        .asusbody .bg {
            position: relative;
            height: 600px;
            background-size: cover;
            background-position: center bottom;
            background-repeat: no-repeat;
            background-image: url("{{ json_decode(getImages(setting('page_authorization_asus')),true)[0]['url'] }}");
        }
        .Ibody .bg .IWrap {
            height: 530px;
            position: relative;
            background-size: cover;
            background-position: center bottom;
            background-repeat: no-repeat;
            background-image: url("{{ json_decode(getImages(setting('page_authorization_intel')),true)[0]['url'] }}");
        }
    </style>
@endsection
@section('content')
   @if(Route::is('intel'))
       <div class="body Ibody">

           <a href="{{ route('service_support.online') }}" target="_top">
               <div class="bg">
              {!! setting('page_authorization_intel_description') !!}
                   <div class="IWrap"></div>
               </div>
           </a>
       </div>

   @endif
   @if(Route::is('intelAD'))
       <div class="body">
           <div class="IntelADWrap">
               <div class="tab_box">
                   <div class="about_box">
                      {!! setting('page_authorization_intelAD_description') !!}
                   </div>
                   <!-- 关于我们  结束 -->
                   <div class="proBox">
                       <a href="{{ route('service_support.online') }}" target="_top"><img src="{{ json_decode(getImages(setting('page_authorization_intelAD')),true)[0]['url'] }}"></a>
                   </div>
               </div>
           </div>
       </div>
   @endif
   @if(Route::is('asus'))
       <div class="body asusbody">
           <a href="{{ route('service_support.online') }}" target="_top" >
               <div class="bg">
                   {!! setting('page_authorization_asus_description') !!}
                   <div class="SMWrap"></div>
               </div>
           </a>
       </div>
   @endif
   @if(Route::is('supermicro'))
       <div class="body SMbody">
       <a href="{{ route('service_support.online') }}" target="_top" >
           <div class="bg">
               {!! setting('page_authorization_supermicro_description') !!}
               <div class="SMWrap"></div>
           </div>
       </a>
       </div>
   @endif
@endsection