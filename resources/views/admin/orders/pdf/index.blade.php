<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $pdf_title }}</title>
    <link href="{{ asset('admin/css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>


<body>

<div class="bg" style="page-break-inside:avoid;">
    <div class="tit">
        <h5>{{ $order->machine_model }}</h5>
        <p>{{ optional($complate_machine)->additional_arguments['page_description'] ?? '占位' }}</p>
    </div>
    <div class="ling">
        <notempty name="chanpin">
            <p><b>应用领域：</b>{{ implode(',',optional($complate_machine)->application  ?? []) }}</p>
            <p><b>产品优势：</b>{{ optional($complate_machine)->additional_arguments['product_description'] ?? '占位' }}</p>
        </notempty>
        <div class="pics">
            <notempty name="pic">
                <volist name="pic" id="v" offset="0" length="3">
                    <img src="__PUBLIC__/Uploads/{$v}">
                </volist>
            </notempty>
            <div class="clear"></div>
        </div>
    </div>

    <div class="canshu">

        <ul>

            @foreach(\App\Exports\BaseSheetExport::material_details($order)['complete_machine_detailed'] as $key=>$item)
                <li><span class="liT">{{ $key }}</span><span class="liC">{{ $item }}</span><div class="clear"></div></li>
           @endforeach
        </ul>
    </div>
</div>
<div class='{{ $bgImage }}' style="page-break-inside:avoid;">

</div>


</body>
</html>