<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'forum_posts';
    protected $fillable = [
        'thread_id',
        'author_id',
    ];

    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
