<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Http\Controllers\Api\BaseController;

class PurchaseController extends BaseController
{
    public function index(){
        $data=Purchase::get();
        return $this->sendResponse($data,"Purchase data");
    }

    public function store(Request $request){
        $data=Purchase::create($request->all());
        return $this->sendResponse($data,"Purchase created successfully");
    }
    public function show(Purchase $purchase){
        return $this->sendResponse($purchase,"Purchase created successfully");
    }

    public function update(Request $request,$id){

        $data=Purchase::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Purchase updated successfully");
    }

    public function destroy(Purchase $purchase)
    {
        $purchase=$purchase->delete();
        return $this->sendResponse($purchase,"Purchase deleted successfully");
    }
}
