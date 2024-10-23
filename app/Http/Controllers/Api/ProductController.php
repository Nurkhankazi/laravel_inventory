<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Api\BaseController;

class ProductController extends BaseController
{
    public function index(){
        $data=Product::with('category')->get();
        return $this->sendResponse($data,"Product data");
    }

    public function store(Request $request){
        $data=Product::create($request->all());
        return $this->sendResponse($data,"Product created successfully");
    }
    public function show(Product $product){
        return $this->sendResponse($product,"Product created successfully");
    }

    public function update(Request $request,$id){
        $data=Product::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Product updated successfully");
    }

    public function destroy(Product $product)
    {
        $product=$product->delete();
        return $this->sendResponse($product,"Product deleted successfully");
    }
}
