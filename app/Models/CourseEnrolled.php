<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrolled extends Model
{
    use HasFactory;

    protected $table = 'tbl_course_enrolled';

    protected $fillable = ['id_user', 'id_course', 'title_course', 'status', 'progess', 'expiration_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}
