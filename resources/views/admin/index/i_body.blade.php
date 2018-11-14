<div id="C_body">
    {{--<div class="loadPage" id="yuanhome" sys="yuan"><iframe frameborder="no" name="home" src=""></iframe></div>--}}
    @can("barcode system")
        <div class="loadPage" id="tiaohome" sys="tiao"><iframe frameborder="no" name="home" src="{{ route('admin.tiao') }}"></iframe></div>
    @endcan
    @can("website system")
        <div class="loadPage" id="webhome" sys="web"><iframe frameborder="no" name="home" src="{{ route('admin.home') }}"></iframe></div>
    @endcan
</div>