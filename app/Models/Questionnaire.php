<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Questionnaire extends Model
{
    use HasFactory;

    public const DIFFICULTY = [
        'easy' => 1,
        'medium' => 2,
        'hard' => 3,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'questionnaire_question')->withTimestamps();
    }
}
