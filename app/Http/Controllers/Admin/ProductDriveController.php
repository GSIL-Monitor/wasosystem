<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductDrive;
use App\Services\FileServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductDriveController  extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
         $product_drives=ProductDrive::whereIn('id', $request->get('id'))->get(); //查找所有删除对象
         FileServices::DriveDelete($product_drives) ;
        return response()->json(['info' => '删除成功'], Response::HTTP_OK);
    }
}
