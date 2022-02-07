<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'forum_categories';
    protected $fillable = [
        'title',
        'description',
        'course_id',
        'accepts_threads',
        'is_private',
        'parent_id',
        'color',
        '_lft',
        '_rgt',
    ];
    public function forum_threads()
    {
        return $this->hasMany(ForumThread::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
