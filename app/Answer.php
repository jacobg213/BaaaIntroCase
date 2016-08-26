<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_answer');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
