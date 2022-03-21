<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserQuestionnaire extends Model
{
    use HasFactory;

    protected $table = 'questionnaire_user';

    public function evaluation(): HasOne
    {
        return $this->hasOne(Evaluation::class);
    }
}
