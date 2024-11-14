<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Stock;
use App\Models\Payment;
use App\Http\Controllers\Api\BaseController;

class PurchaseController extends BaseController
{
    public function index(){
        // $data=Purchase::with('supplier')->get();
        $data=Purchase::with('supplier','details')->withSum('payment','amount')->get();
        return $this->sendResponse($data,"Purchase data");
    }

    public function store(Request $request){
        //return $request->all();

        $purchase_data['supplier_id']=$request->input['supplier_id'];
        $purchase_data['purchase_date']=$request->input['purchase_date'];
        $purchase_data['total']=$request->totalData['total'];
        $purchase_data['discount']=$request->totalData['discount'];
        $purchase_data['tax']=$request->totalData['tax'];
        $purchase_data['gtotal']=$request->totalData['finalTotal'];
        $purchase_data['discountamt']=$request->totalData['discountAmt']?? 0;
        $purchase_data['taxamt']=$request->totalData['taxAmt']?? 0;
        $data=Purchase::create($purchase_data);
        foreach($request->cartitems as $itms){
            $item['purchase_id']=$data->id;
            $item['product_id']=$itms['id'];
            $item['qty']=$itms['quantity'];
            $item['price']=$itms['price'];
            PurchaseItem::create($item);
            $stock['purchase_id']=$data->id;
            $stock['product_id']=$itms['id'];
            //$stock['qty']="-".$itms['quantity']; //use for sales
            $stock['qty']=$itms['quantity'];
            $stock['price']=$itms['price'];
            Stock::create($stock);
        }

        $payment['purchase_id']=$data->id;
        $payment['supplier_id']=$request->input['supplier_id'];
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);

        return $this->sendResponse($data,"Purchase created successfully");
    }
    public function show(Purchase $purchase){
        $purchase=Purchase::with('supplier','details')->withSum('payment','amount')->find($purchase->id);
        return $this->sendResponse($purchase,"Purchase created successfully");
    }

    public function payment(Request $request,$id){
        //return $request->all();
        $data=Purchase::find($id);

        $payment['purchase_id']=$data->id;
        $payment['supplier_id']=$data->supplier_id;
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);
        return $this->sendResponse($data,"Purchase pay successfully");
    }

    public function destroy(Purchase $purchase)
    {
        $purchase=$purchase->delete();
        return $this->sendResponse($purchase,"Purchase deleted successfully");
    }
}
