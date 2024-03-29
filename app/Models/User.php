<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\StudentQuiz;
use App\Models\Answer;
use App\Models\Quiz;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function quizzesMaker()
    {
        return $this->hasMany(Quiz::class);
    }

    // public function quizzesParticipants()
    // {
    //     return $this->belongsToMany(Quiz::class);
    // }
    public function quizzesParticipants()
    {
        return $this->belongsToMany(StudentQuiz::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }
}
