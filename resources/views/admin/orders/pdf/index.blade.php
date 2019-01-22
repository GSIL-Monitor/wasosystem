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
            <p><b>应用领域：</b>{{ implode(',',optional($complate_machine)->application  ?? []) }}</p>
            <p><b>产品优势：</b>{{ optional($complate_machine)->additional_arguments['product_description'] ?? '占位' }}</p>
        <div class="pics">
            @php $pics=order_complete_machine_pic($complate_machine->complete_machine_product_goods,'all') ?? [];@endphp
            @forelse($pics as $item)
                    <img src="{{ $item['url'] }}">
                @empty
           @endforelse
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