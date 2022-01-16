<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Answer;
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'questions',
        'type',
        'option',
        'answer',
        'quiz_id',
        'uuid',
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function answers(){
        return $this->belongsToMany(Answer::class);
    }
}
