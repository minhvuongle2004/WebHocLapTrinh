<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_admins'; // Chỉ định bảng tbl_admins

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}