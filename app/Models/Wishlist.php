<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'tbl_wishlists';

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    // Relationship với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship với Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}