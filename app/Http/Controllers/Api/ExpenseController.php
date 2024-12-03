<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Controllers\Api\BaseController;
use DB;
class ExpenseController extends BaseController
{
    public function index(){
        $data=Expense::with('head')->get();
        return $this->sendResponse($data,"Expense data");
    }

    public function store(Request $request){
        $data=Expense::create($request->all());
        return $this->sendResponse($data,"Expense created successfully");
    }
    public function show(Expense $expense){
        return $this->sendResponse($expense,"Expense created successfully");
    }

    public function update(Request $request,$id){

        $data=Expense::where('id',$id)->update($request->all());
        return $this->sendResponse($id,"Expense updated successfully");
    }

    public function destroy(Expense $expense)
    {
        $expense=$expense->delete();
        return $this->sendResponse($expense,"Expense deleted successfully");
    }
    public function expReport(Request $request)
    {
        $expense=DB::select("SELECT account_heads.headname, sum(expenses.amount) as amount FROM `expenses` JOIN account_heads on account_heads.id=expenses.head_id GROUP BY expenses.head_id");
        return $this->sendResponse($expense,"report successfully");
    }
}
