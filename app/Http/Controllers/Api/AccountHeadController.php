<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\AccountHead;
use App\Http\Controllers\Api\BaseController;

class AccountHeadController extends BaseController
{
    public function index(){
        $data=AccountHead::get();
        return $this->sendResponse($data,"AccountHead data");
    }

    public function store(Request $request){
        $data=AccountHead::create($request->all());
        return $this->sendResponse($data,"AccountHead created successfully");
    }
    public function show(AccountHead $account_head){
        return $this->sendResponse($account_head,"AccountHead created successfully");
    }

    public function update(Request $request,$id){

        $data=AccountHead::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"AccountHead updated successfully");
    }

    public function destroy(AccountHead $account_head)
    {
        $account_head=$account_head->delete();
        return $this->sendResponse($account_head,"AccountHead deleted successfully");
    }
}
