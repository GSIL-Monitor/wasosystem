<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Request;
use App\Models\User;

use App\Models\FundsManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class CollectController extends Controller
{

    //资金管理列表
    public function index(Request $request)
    {

        $collects=user()->favoriteCompleteMachines()->latest()->paginate(12);

       return view('member_centers.collects.index',compact('collects'));

    }
}