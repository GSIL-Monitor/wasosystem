<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
         $user = User::find($request->get('user_id'));
         $user_addresses=$user->user_address()->latest('number')->latest('default')->paginate();
         return $user_addresses;
        }
    public function show(Request $request, $id)
    {
        $user_address=UserAddress::findOrFail($id);
        return $user_address;
    }
}
