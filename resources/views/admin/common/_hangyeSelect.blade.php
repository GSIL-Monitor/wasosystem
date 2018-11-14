<link type="text/css" rel="stylesheet" href="{{ asset('admin/hangyeSelect/css.css') }}" />
<script src="{{ asset('admin/hangyeSelect/drag.js') }}"></script>
<script src="{{ asset('admin/hangyeSelect/industry_arr.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/hangyeSelect/industry_func.js') }}"></script>
<input id="btn_IndustryID" type="text" placeholder="请选择行业" onclick="IndustrySelect()" />
<div id="maskLayer" style="display:none">
    <div id="alphadiv" style="filter:alpha(opacity=50);-moz-opacity:0.5;opacity:0.5"></div>
    <div id="drag">
        <h3 id="drag_h"></h3>
        <div id="drag_con"></div>
        <!-- drag_con end -->
    </div>

</div>