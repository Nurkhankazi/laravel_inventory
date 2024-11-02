<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable=['sales_id','sales_return_id','purchase_id','purchase_return_id','product_id', 'qty', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
