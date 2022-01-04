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
    ];
    public function forum_threads()
    {
        return $this->hasMany(ForumThread::class);
    }
}
