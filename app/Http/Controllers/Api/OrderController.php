<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Api\BaseController;

class OrderController extends BaseController
{
    public function index(){
        $data=Order::get();
        return $this->sendResponse($data,"Order data");
    }
}
