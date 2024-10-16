<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Stock;
use App\Http\Controllers\Api\BaseController;
use DB;
class StockController extends BaseController
{
    public function index(){
        $data=DB::select('SELECT products.id, products.name,sum(stocks.qty) as qty FROM `stocks` JOIN products on products.id=stocks.product_id GROUP by `product_id`');
        return $this->sendResponse($data,"Product data");
    }

   
}
