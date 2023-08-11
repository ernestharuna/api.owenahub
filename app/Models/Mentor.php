<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Mentor extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = "mentor";
    protected $table = "mentors";

    /**
     * The attributes that are mass assignable
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'bio', 'field', 'language',
        'twitter_handle', 'linkedin_handle', 'exp_years', 'date_of_birth', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function article(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function session(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function work_timeline(): HasMany
    {
        return $this->hasMany(WorkTimeline::class);
    }

    public function group_session(): HasMany
    {
        return $this->hasMany(GroupSession::class);
    }
}
