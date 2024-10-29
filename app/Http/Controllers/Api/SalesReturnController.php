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
        $data=SalesReturn::with('customer')->get();
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
            $item['salesreturn_id']=$data->id;
            $item['product_id']=$itms['id'];
            $item['qty']=$itms['quantity'];
            $item['price']=$itms['price'];
            SalesReturnItem::create($item);
            $stock['salesreturn_id']=$data->id;
            $stock['product_id']=$itms['id'];
            // $stock['qty']="-".$itms['quantity']; //use for sales
            $stock['qty']=$itms['quantity'];
            $stock['price']=$itms['price'];
            Stock::create($stock);
        }

        /* sales payment */
        $payment['salesreturn_id']=$data->id;
        $payment['customer_id']=$request->input['customer_id'];
        $payment['pay_type']=$request->input['pay_type'];
        $payment['amount']=$request->input['amount'];
        $payment['bank_name']=$request->input['bank_name'];
        $payment['check_number']=$request->input['check_number'];
        $payment['check_date']=$request->input['check_date'];
        Payment::create($payment);
        /* sales payment */

        return $this->sendResponse($data,"SalesReturn created successfully");
    }
    public function show(SalesReturn $salesreturn){
        $salesreturn=SalesReturn::with('customer')->withSum('payment','amount')->find($salesreturn->id);
        return $this->sendResponse($salesreturn,"SalesReturn created successfully");
    }

    public function payment(Request $request,$id){  //payment
         //return $request->all();
         $data=SalesReturn::find($id);

         $payment['salesreturn_id']=$data->id;
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
