<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'grade',
        'comment',
        'user_id',
        'rated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'rated_by');
    }
}
