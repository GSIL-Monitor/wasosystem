<div class="JJList">
    <ul class="maxUl" id="app">
        @if(!optional($business_management)->id)
            {!! Form::open(['route'=>'admin.business_managements.store','method'=>'post','id'=>'business_managements','onsubmit'=>'return false']) !!}
        @else
            {!! Form::model($business_management,['route'=>['admin.business_managements.update',$business_management->id],'id'=>'business_managements','method'=>'put','onsubmit'=>'return false']) !!}
        @endif
            @switch(Request::get('type'))
                @case('honor')
                @include('admin.business_managements.form.honor')
                @break
                @case('job')
                @include('admin.business_managements.form.job')
                @break
                @case('service_directory')
                @include('admin.business_managements.form.service_directory')
                @break
                @case('banner')
                @include('admin.business_managements.form.banner')
                @break
                @case('friend')
                @include('admin.business_managements.form.friend')
                @break
                @default
                {{ Request::get('type') }}
            @endswitch

        <div class="clear"></div>
        {!! Form::close() !!}
    </ul>
</div>
<script>

    var vm = new Vue({
        el: "#app",
        data: {
            @if(!optional($business_management)->id)
            defaultList: [],
            @else
            defaultList:{!! $business_management->pic !!},
            @endif
            actionImageUrl: "{!! env('ActionImageUrl') !!}",
            imageUrl: "{!! env('IMAGES_URL') !!}",
            deleteImageUrl: "{!! env('DeleteImageUrl') !!}",
            fileCount:2,
        },
        methods: {

        },
        mounted: function () {
        },
    });

</script>


