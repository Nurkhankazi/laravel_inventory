<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;
    protected $fillable=['supplier_id', 'purchasereturn_date', 'total', 'discount', 'tax', 'gtotal', 'discountamt', 'taxamt'];
    public function supplier()
    {
        return $this->belongsTo(suppliers::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
