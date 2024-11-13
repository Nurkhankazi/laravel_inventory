<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable=['customer_id', 'sales_date', 'total', 'discount', 'tax', 'gtotal', 'discountamt', 'taxamt'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function details()
    {
        return $this->hasMany(SalesItem::class,'sales_id')->with('product:id,name');
    }
}
