@extends('site.layouts.default')
@section('title',$service_clause->field['name'])
@section('css')
    <link href="{{ asset('css/service_clause.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('js')
@endsection
@section('content')
    <div class="body">
        <div class="wrap">
            <div class="PhoneLinks">
                @foreach($service_clauses->groupBy('field.type') as $key=>$clauses)
                    <dl>
                        <dt>{{ config('status.service_directory_type')[$key] }}</dt>
                        @forelse($clauses as $item)
                            <dd class="{{ $item->id == $service_clause->id ? 'dd2' : ''  }}"><a href="{{ route('service_support.service_clause',$item->id) }}?status=true">{{ $item->field['name'] }}<i>></i></a></dd>
                        @empty
                        @endforelse
                    </dl>
                @endforeach
            </div>
        </div>
    </div>
@endsection