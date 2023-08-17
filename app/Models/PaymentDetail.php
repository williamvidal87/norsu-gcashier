<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_categories_id',
        'payment_detail_name',
        'purpose',
        'price'
    ];
    
    public function getPaymentCategories()
    {
        return $this->belongsTo(PaymentCategories::class,'payment_categories_id');
    }
}
