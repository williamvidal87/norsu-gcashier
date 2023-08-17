<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeOfPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'mode_of_payment_name'
    ];
}
