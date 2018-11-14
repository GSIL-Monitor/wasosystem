<?php

namespace App\Http\Controllers\Admin;

use App\Models\BarcodeAssociated;
use App\Models\InventoryManagement;
use App\Models\ProcurementPlan;
use App\Models\WarehouseOutManagement;
use App\Services\BarcodeAssociatedServices;
use App\Services\BarcodeAssociatedStatusServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarcodesController extends Controller
{
    protected $barcode_associated;
    protected $barcode_associatedServices;

    public function __construct(BarcodeAssociated $barcode_associated, BarcodeAssociatedServices $barcode_associatedServices)
    {
        $this->middleware('auth.admin:admin');
        $this->barcode_associated = $barcode_associated;
        $this->barcode_associatedServices = $barcode_associatedServices;
    }

    public function index(Request $request)
    {
        $keyword=$request->get('keyword');
        $product=collect([]);
        $condition=[];
        $last=collect([]);
        $barcode_associateds=$this->barcode_associatedServices->search($keyword);
        if($barcode_associateds->isNotEmpty()){
            $product=$barcode_associateds->first();
            $last=$barcode_associateds->last();
            $condition=$this->barcode_associatedServices->check_select( $last);//根据最后一个数据 状态来判断显示select
        }

        return view('admin.barcodes.index',compact('barcode_associateds','product','condition','last'));
    }
}
