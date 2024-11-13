<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\Stock;
use App\Models\Payment;
use App\Http\Controllers\Api\BaseController;

class SalesController extends BaseController
{
    public function index(){
        $data=Sales::with('customer','details')->withSum('payment','amount')->get();
        return $this->sendResponse($data,"Sales data");
    }

    public function store(Request $request){
        //return $request->all();
        
        $sales_data['customer_id']=$request->input['customer_id'];
        $sales_data['sales_date']=$request->input['sales_date'];
        $sales_data['total']=$request->totalData['total'];
        $sales_data['discount']=$request->totalData['discount'];
        $sales_data['tax']=$request->totalData['tax'];
        $sales_data['gtotal']=$request->totalData['finalTotal'];
        $sales_data['discountamt']=$request->totalData['discountAmt']?? 0;
        $sales_data['taxamt']=$request->totalData['taxAmt']?? 0;
        $data=Sales::create($sales_data);
        foreach($request->cartitems as $itms){
            $item['sales_id']=$data->id;
            $item['product_id']=$itms['id'];
            $item['qty']=$itms['quantity'];
            $item['price']=$itms['price'];
            SalesItem::create($item);
            $stock['sales_id']=$data->id;
            $stock['product_id']=$itms['id'];
            $stock['qty']="-".$itms['quantity']; //use for sales
            $stock['price']=$itms['price'];
            Stock::create($stock);
        }
        
        /* sales payment */
        $payment['sales_id']=$data->id;
        $payment['customer_id']=$request->input['customer_id'];
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);
        /* sales payment */

        return $this->sendResponse($data,"Sales created successfully");
    }
    public function show(Sales $sales){
        $sales=Sales::with('customer','details')->withSum('payment','amount')->find($sales->id);
        return $this->sendResponse($sales,"Sales created successfully");
    }

    public function payment(Request $request,$id){
        //return $request->all();
        $data=Sales::find($id);
        
        $payment['sales_id']=$data->id;
        $payment['customer_id']=$data->customer_id;
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);
        return $this->sendResponse($data,"Sales pay successfully");
    }

    public function destroy(Sales $sales)
    {
        $sales=$sales->delete();
        return $this->sendResponse($sales,"Sales deleted successfully");
    }
}
