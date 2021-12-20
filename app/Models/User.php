<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use TeamTeaTime\Forum\Support\Web\Forum;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'role_id',
        'group_id',
        'team_id',
        'project_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    public function project()
    {
        return $this->belongsTo(ForumThread::class, 'project_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function forum_thread_likes()
    {
        return $this->hasMany(ForumThreadLike::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
