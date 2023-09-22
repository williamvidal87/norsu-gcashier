<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'receipt_no',
        'payor_name',
        // 'student_id',
        'mode_of_payment_id',
        'cashier_id',
        'remark',
        'status_id',
        'date',
        'check_bank',
        'check_number',
        'check_date',
        'note',

    ];

    public function getStudent()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function getModeOfPayment()
    {
        return $this->belongsTo(ModeOfPayment::class,'mode_of_payment_id');
    }
    public function getCashier()
    {
        return $this->belongsTo(User::class,'cashier_id');
    }
}
