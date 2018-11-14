<link type="text/css" rel="stylesheet" href="{{ asset('admin/areaSelect/css.css') }}" />
<input type="text" name="{{ $address }}" class="address">
        <div class="dd">
            <div id="store-selector">
                <div class="text"><div></div><b></b></div>
                <div onclick="$('#store-selector').removeClass('hover')" class="close"></div>
            </div>
            <div id="store-prompt"><strong></strong></div>
        </div>

<script src="{{ asset('admin/areaSelect/location.js') }}"></script>