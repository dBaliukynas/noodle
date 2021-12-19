<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'forum_threads';
    protected $fillable = [
        'title',
    ];

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }
}
