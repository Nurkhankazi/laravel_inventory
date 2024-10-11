<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Suppliers;
use App\Http\Controllers\Api\BaseController;

class SuppliersController extends BaseController
{
    public function index(){
        $data=Suppliers::get();
        return $this->sendResponse($data,"Suppliers data");
    }

    public function store(Request $request){
        $data=Suppliers::create($request->all());
        return $this->sendResponse($data,"Suppliers created successfully");
    }
    public function show(Suppliers $suppliers){
        return $this->sendResponse($suppliers,"Suppliers created successfully");
    }

    public function update(Request $request,$id){

        $data=Suppliers::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Suppliers updated successfully");
    }

    public function destroy(Suppliers $suppliers)
    {
        $suppliers=$suppliers->delete();
        return $this->sendResponse($suppliers,"Suppliers deleted successfully");
    }
}
