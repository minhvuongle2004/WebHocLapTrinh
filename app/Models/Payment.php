<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'tbl_payments';

    protected $fillable = [
        'id_course',
        'id_user',
        'payment_method',
        'amount',
        'content',
        'status',
        'transaction_code',
        'vnp_transaction_no',
        'vnp_response_code',
        'vnp_bank_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}