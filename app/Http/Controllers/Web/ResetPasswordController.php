<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function index()
    {
//          dump(\Cache::get('phone_code'),\Cache::get('email_code'));
        return view('site.reset_passwords.index');
    }
    public function reset(Request $request)
    {
        $user=User::where($request->type,$request->number)->first();
        $user->clear_text=encrypt($request->password);
        $user->password=bcrypt($request->password);
        $user->save();
        return [];
    }
}
