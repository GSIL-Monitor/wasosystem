@extends('site.layouts.default')
@section('title',$service_clause->field['name'])
@section('css')
    <link href="{{ asset('css/service_clause.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script>
        $(function () {
            var status="{{ request()->input('status') }}";
            if(status ==''){
                var WindW = $(window).width();
                if(WindW<900){
                    location.href = "{{ route('service_support.service_clause_phone',$service_clause->id) }}";
                }
            }
        })
    </script>
@endsection
@section('content')
    <div class="body">
        <div id="crumbs">
            <div class="wrap">
                <a href="/">首页</a> > <a href="{{ route('service_support.index') }}">服务支持</a> > {{ $service_clause->field['name'] }}
            </div>
        </div>


        <div class="wrap">
            <div class="info_box">
                <div class="left leftLinks">
                   @foreach($service_clauses->groupBy('field.type') as $key=>$clauses)
                        <dl>
                            <dt>{{ config('status.service_directory_type')[$key] }}</dt>
                            @forelse($clauses as $item)
                                <dd class="{{ $item->id == $service_clause->id ? 'dd2' : ''  }}"><a href="{{ route('service_support.service_clause',$item->id) }}">{{ $item->field['name'] }}<i>></i></a><img src="{{ asset('pic/more_black.png') }}"></dd>
                            @empty
                            @endforelse
                        </dl>
                   @endforeach
                </div>

                <div class="right">
                    <div class="info">
                        <div class="contact">{!! $service_clause->field['content'] !!}</div>
                    </div>

                </div>
                <div class="clear"></div>
            </div>

        </div>
    </div>
@endsection