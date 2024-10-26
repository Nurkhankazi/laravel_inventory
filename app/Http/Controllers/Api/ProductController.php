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
         /* for files */
   $input=$request->all();
   $files=[];
   if($request->hasFile('files')){
       foreach($request->file('files') as $f){
           $photoname=time().rand(1111,9999).".".$f->extension();
           $photoPath=public_path().'/productsadd';
           if($f->move($photoPath,$photoname)){
               array_push($files,$photoname);
           }
       }
   }
   $input['photo']=implode(',',$files);
   /* /for files */
        $data=Product::create($input);
        return $this->sendResponse($data,"Product created successfully");
    }
    public function show(Product $product){
        return $this->sendResponse($product,"Product created successfully");
    }

    public function update(Request $request,$id){

        $input=$request->all();
        /* for files */
        $files=[];
        if($request->hasFile('files')){
            foreach($request->file('files') as $f){
                $photoname=time().rand(1111,9999).".".$f->extension();
                $photoPath=public_path().'/productsadd';
                if($f->move($photoPath,$photoname)){
                    array_push($files,$photoname);
                }
            }
            $input['photo']=implode(',',$files);
        }
        unset($input['files']);
        $product=Product::where('id',$id)->update($input);
        return $this->sendResponse($id,"Product updated successfully");
    }

    public function destroy(Product $product)
    {
        $product=$product->delete();
        return $this->sendResponse($product,"Product deleted successfully");
    }
}
