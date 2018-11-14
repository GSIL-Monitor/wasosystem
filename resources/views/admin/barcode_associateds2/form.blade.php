
@switch($status)
    @case(in_array($status,['loan_out','loan_out_to_replace']))
    @include('admin.barcode_associateds.forms.loan_out')
    @break;
    @case('sell_return')
    @include('admin.barcode_associateds.forms.sell_return')
    @break;
    @case('warranty_replacement')
    @include('admin.barcode_associateds.forms.warranty_replacement')
    @break;
    @case('quality_acceptance')
    @include('admin.barcode_associateds.forms.quality_acceptance')
    @break;
    @case(in_array($status,['bad' , 'stock_returns','breakage','returned_to_the_factory','models_to_replace']))
    @include('admin.barcode_associateds.forms.bad')
    @break;
    @case(in_array($status,['returned_to_the_factory_and_warranty_returned_to_the_factory' ,'warranty_returned_to_the_factory']))
    @include('admin.barcode_associateds.forms.returned_to_the_factory_and_warranty_returned_to_the_factory')
    @break;
    @case(in_array($status,['quality_return' ,'breakage','quality_take_away','escrow_to_storage']))
    @include('admin.barcode_associateds.forms.quality_return')
    @break;
    @case('test')
    @include('admin.barcode_associateds.forms.test')
    @break;
@endswitch


