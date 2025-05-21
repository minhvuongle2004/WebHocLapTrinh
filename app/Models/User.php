<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Import Authenticatable
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_users';

    protected $fillable = [
        'fullname',
        'displayname',
        'username',
        'email',
        'password',
        'phone',
        'avatar',
        'remember_token',
    ];

    public function enrolledCourses()
    {
        return $this->hasMany(\App\Models\CourseEnrolled::class, 'id_user');
    }


    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    public function wishlistCourses()
    {
        return $this->belongsToMany(Course::class, 'tbl_wishlists', 'user_id', 'course_id')->withTimestamps();
    }
}
