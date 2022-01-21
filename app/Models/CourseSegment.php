<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSegment extends Model
{
    use HasFactory;
    protected $table = 'course_segments';
    protected $fillable = [
        'name',
        'content',
        'user_id',
        'course_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
