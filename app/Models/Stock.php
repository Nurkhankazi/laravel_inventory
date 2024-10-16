<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable=['sales_id','purchase_id','product_id', 'qty', 'price'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
