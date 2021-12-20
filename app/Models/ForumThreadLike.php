<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThreadLike extends Model
{
    use HasFactory;

    protected $table = 'forum_thread_likes';
    protected $fillable = [
        'user_id',
        'forum_thread_id',
    ];

    public function forum_thread()
    {
        return $this->belongsTo(ForumThread::class, 'forum_thread_id');
    }
}
