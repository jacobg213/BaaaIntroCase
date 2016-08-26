<?php

namespace App\Http\Controllers;

use App\User;
use App\Answer;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $questions = Question::all();
        $votes = [];
        foreach(Answer::all() as $answer)
        {
            $votes += [$answer->id => $answer->users->count()];
        }
        return view('quiz', compact('questions', 'votes'));
    }
}
