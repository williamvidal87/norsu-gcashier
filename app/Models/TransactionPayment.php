<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'payment_categories_id',
        'payment_detail_id',
        'qty',
        'price',
        'transaction_category'
    ];
    
    public function getPaymentCategory()
    {
        return $this->belongsTo(PaymentCategories::class,'payment_categories_id');
    }
    public function getPaymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class,'payment_detail_id');
    }
}
