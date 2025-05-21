<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'tbl_lessons';

    protected $fillable = [
        'title',
        'id_course',
        'url',
        'is_preview',
        'time',
        'chapter'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function getChapterTypeAttribute()
    {
        $info = $this->getChapterInfoAttribute();
        return $info['type'] ?? 'chapter';
    }
}