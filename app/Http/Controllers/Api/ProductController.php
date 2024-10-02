<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\AddProduct;
use App\Http\Controllers\Api\BaseController;

class ProductController extends BaseController
{
    public function index(){
        $data=AddProduct::get();
        return $this->sendResponse($data,"AddProduct data");
    }

    public function store(Request $request){
        $data=AddProduct::create($request->all());
        return $this->sendResponse($data,"AddProduct created successfully");
    }
    public function show(AddProduct $addProduct){
        return $this->sendResponse($addProduct,"AddProduct created successfully");
    }

    public function update(Request $request,$id){

        $data=AddProduct::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"AddProduct updated successfully");
    }

    public function destroy(AddProduct $addProduct)
    {
        $addProduct=$addProduct->delete();
        return $this->sendResponse($addProduct,"AddProduct deleted successfully");
    }
}
