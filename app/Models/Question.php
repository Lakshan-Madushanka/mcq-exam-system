<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    const DIFFICULTY = [
        'easy'   => 1,
        'medium' => 2,
        'hard'   => 3,
    ];

    public function questionnaires(): BelongsToMany
    {
        return $this->belongsToMany(Questionnaire::class)->withTimestamps();
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function answers(): BelongsToMany
    {
        return $this->belongsToMany(Answer::class)->withTimestamps();
    }

}
