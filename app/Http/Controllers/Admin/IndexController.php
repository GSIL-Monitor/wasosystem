<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DeliverySheetExport;
use App\Models\BarcodeAssociated;
use App\Models\CommonEquipment;
use App\Models\DemandFiltrate;
use App\Models\DemandManagement;
use App\Models\DemandManagementOrder;
use App\Models\DivisionalManagement;
use App\Models\FundsManagement;
use App\Models\HistoricalTaskManagement;
use App\Models\InventoryManagement;
use App\Models\Member;
use App\Models\MemberGrade;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\OrderMaterial;
use App\Models\ProcurementPlan;
use App\Models\SupplierManagement;
use App\Models\TaskManagement;
use App\Models\UserAddress;
use App\Models\UserCompany;
use App\Models\VisitorDetail;
use App\Models\WarehouseOutManagement;
use Illuminate\Http\Request;
use App\Comdodel;
use App\Models\ProductGood;
use App\Models\Product;
use App\Models\ProductFramework;
use App\Models\ProductParamenter;
use App\Models\User;
use App\Models\Admin;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\Integration;
use App\Http\Controllers\Controller;
use Overtrue\Pinyin\Pinyin;
class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function index()
    {
//        dd('后台首页，当前用户名：'.auth('admin')->user()->name);
        return view('admin.index.index');
    }

    public function home()
    {
        return view('admin.index.home');
    }

    public function tiao()
    {
        return view('admin.index.tiao');
    }





}
