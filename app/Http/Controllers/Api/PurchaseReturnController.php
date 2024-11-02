<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\Stock;
use App\Models\Payment;
use App\Http\Controllers\Api\BaseController;

class PurchaseReturnController extends BaseController
{
    public function index(){
        // $data=Purchase::with('supplier')->get();
        $data=PurchaseReturn::with('supplier')->withSum('payment','amount')->get();
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
            $item['purchase_return_id']=$data->id;
            $item['product_id']=$itms['id'];
            $item['qty']=$itms['quantity'];
            $item['price']=$itms['price'];
            PurchaseReturnItem::create($item);
            $stock['purchase_return_id']=$data->id;
            $stock['product_id']=$itms['id'];
            $stock['qty']="-".$itms['quantity'];
            // $stock['qty']=$itms['quantity'];
            $stock['price']=$itms['price'];
            Stock::create($stock);
        }

        $payment['purchase_return_id']=$data->id;
        $payment['supplier_id']=$request->input['supplier_id'];
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);

        return $this->sendResponse($data,"PurchaseReturn created successfully");
    }
    public function show(PurchaseReturn $purchasereturn){
        $purchasereturn=PurchaseReturn::with('supplier')->withSum('payment','amount')->find($purchasereturn->id);
        return $this->sendResponse($purchasereturn,"PurchaseReturn created successfully");
    }

    public function payment(Request $request,$id){
        //return $request->all();
        $data=PurchaseReturn::find($id);

        $payment['purchase_return_id']=$data->id;
        $payment['supplier_id']=$data->supplier_id;
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);
        return $this->sendResponse($data,"PurchaseReturn pay successfully");
    }

    public function destroy(PurchaseReturn $purchasereturn)
    {
        $purchasereturn=$purchasereturn->delete();
        return $this->sendResponse($purchasereturn,"PurchaseReturn deleted successfully");
    }
}
