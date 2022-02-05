<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'image_name',
    ];
    public function users()
    {
        return $this->belongstoMany(User::class)->withTimestamps();
    }
    public function forum_categories()
    {
        return $this->hasMany(ForumCategory::class);
    }
}
