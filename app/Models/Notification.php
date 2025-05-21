<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'tbl_notifications';

    protected $fillable = [
        'type',
        'title',
        'content',
        'icon',
        'icon_color',
        'image',
        'link',
        'source_id',
        'source_type',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    public function source()
    {
        return $this->morphTo();
    }
}