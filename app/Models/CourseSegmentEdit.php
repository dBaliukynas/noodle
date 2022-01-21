<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSegmentEdit extends Model
{
    use HasFactory;
    protected $table = 'course_segment_edits';
    protected $fillable = [
        'user_id',


    ];
}
