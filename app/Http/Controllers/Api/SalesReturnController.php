<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\SalesReturn;
use App\Models\SalesReturnItem;
use App\Models\Stock;
use App\Models\Payment;
use App\Http\Controllers\Api\BaseController;

class SalesReturnController extends BaseController
{
    public function index(){
        // $data=Sales::with('customer')->get();
        $data=SalesReturn::with('customer')->withSum('payment','amount')->get();
        return $this->sendResponse($data,"SalesReturn data");
    }

    public function store(Request $request){
        //return $request->all();

        $salesreturn_data['customer_id']=$request->input['customer_id'];
        $salesreturn_data['salesreturn_date']=$request->input['salesreturn_date'];
        $salesreturn_data['total']=$request->totalData['total'];
        $salesreturn_data['discount']=$request->totalData['discount'];
        $salesreturn_data['tax']=$request->totalData['tax'];
        $salesreturn_data['gtotal']=$request->totalData['finalTotal'];
        $salesreturn_data['discountamt']=$request->totalData['discountAmt']?? 0;
        $salesreturn_data['taxamt']=$request->totalData['taxAmt']?? 0;
        $data=SalesReturn::create($salesreturn_data);
        foreach($request->cartitems as $itms){
            $item['sales_return_id']=$data->id;
            $item['product_id']=$itms['id'];
            $item['qty']=$itms['quantity'];
            $item['price']=$itms['price'];
            SalesReturnItem::create($item);
            $stock['sales_return_id']=$data->id;
            $stock['product_id']=$itms['id'];
            // $stock['qty']="-".$itms['quantity'];
            $stock['qty']=$itms['quantity'];
            $stock['price']=$itms['price'];
            Stock::create($stock);
        }

        $payment['sales_return_id']=$data->id;
        $payment['customer_id']=$request->input['customer_id'];
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);

        return $this->sendResponse($data,"SalesReturn created successfully");
    }
    public function show(SalesReturn $salesreturn){
        $salesreturn=SalesReturn::with('customer')->withSum('payment','amount')->find($salesreturn->id);
        return $this->sendResponse($salesreturn,"SalesReturn created successfully");
    }

    public function payment(Request $request,$id){
        //return $request->all();
        $data=SalesReturn::find($id);

        $payment['sales_return_id']=$data->id;
        $payment['customer_id']=$data->customer_id;
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);
        return $this->sendResponse($data,"SalesReturn pay successfully");
    }

    public function destroy(SalesReturn $salesreturn)
    {
        $salesreturn=$salesreturn->delete();
        return $this->sendResponse($salesreturn,"SalesReturn deleted successfully");
    }
}
