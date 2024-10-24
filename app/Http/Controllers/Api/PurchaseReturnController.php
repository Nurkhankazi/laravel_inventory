<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\Stock;
use App\Http\Controllers\Api\BaseController;

class PurchaseReturnController extends BaseController
{
    public function index(){
        $data=PurchaseReturn::with('supplier')->get();
        return $this->sendResponse($data,"PurchaseReturn data");
    }

    public function store(Request $request){
        //return $request->all();
        
        $purchasereturn_data['supplier_id']=$request->input['supplier_id'];
        $purchasereturn_data['purchasereturn_date']=$request->input['purchasereturn_date'];
        $purchasereturn_data['total']=$request->totalData['total'];
        $purchasereturn_data['discount']=$request->totalData['discount'];
        $purchasereturn_data['tax']=$request->totalData['tax'];
        $purchasereturn_data['gtotal']=$request->totalData['finalTotal'];
        $purchasereturn_data['discountamt']=$request->totalData['discountAmt']?? 0;
        $purchasereturn_data['taxamt']=$request->totalData['taxAmt']?? 0;
        $data=PurchaseReturn::create($purchasereturn_data);
        foreach($request->cartitems as $itms){
            $item['purchasereturn_id']=$data->id;
            $item['product_id']=$itms['id'];
            $item['qty']=$itms['quantity'];
            $item['price']=$itms['price'];
            PurchaseReturnItem::create($item);
            $stock['purchasereturn_id']=$data->id;
            $stock['product_id']=$itms['id'];
            //$stock['qty']=$itms['quantity']; //use for purchase add
            $stock['qty']="-".$itms['quantity'];
            $stock['price']=$itms['price'];
            Stock::create($stock);
        }
       
        return $this->sendResponse($data,"PurchaseReturn created successfully");
    }
    public function show(PurchaseReturn $purchasereturn){
        return $this->sendResponse($purchasereturn,"PurchaseReturn created successfully");
    }

    public function update(Request $request,$id){

        $data=PurchaseReturn::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"PurchaseReturn updated successfully");
    }

    public function destroy(PurchaseReturn $purchasereturn)
    {
        $purchasereturn=$purchasereturn->delete();
        return $this->sendResponse($purchasereturn,"PurchaseReturn deleted successfully");
    }
}
