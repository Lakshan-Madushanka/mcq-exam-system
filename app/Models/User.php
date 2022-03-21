<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    const QUESTIONNAIRE_STATUS = [
        'not_started' => 0,
        'started'     => 1,
        'finished'    => 2,
        'unfinished'  => 3,
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function questionnaires(): BelongsToMany
    {
        $query = $this->belongsToMany(Questionnaire::class)->withPivot('status')->withTimestamps();


        return $query;
    }

   /* public function finishedQuestionnaires(): BelongsToMany
    {
        return $this->belongsToMany(Questionnaire::class)->wherePivot()->withPivot(['status'])->withTimestamps();
    }*/
}
