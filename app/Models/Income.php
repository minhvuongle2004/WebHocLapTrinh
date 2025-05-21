<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'tbl_incomes';

    protected $fillable = ['total_buyer', 'total_amount', 'time', 'type'];
}