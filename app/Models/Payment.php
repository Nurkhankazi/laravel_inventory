<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=["sales_id", "purchase_id", "customer_id", "supplier_id", "amount", "pay_date", "pay_type", "bank_name", "check_number", "check_date"];
    
}
