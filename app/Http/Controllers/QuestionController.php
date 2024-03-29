<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\StudentQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    public function update(Question $id, Request $request)
    {
        $request->validate([
            'questions' => "required|string",
            'option' => 'nullable|array',
            'answer' => 'nullable|string',
            'point' => 'required|numeric',
            'uuid' => 'required|string',
        ]);

        $id->update([
            'questions' => $request->questions,
            'option' => json_encode($request->option),
            'answer' => $request->answer,
            'point' => $request->point,
        ]);

        return  back()->withInput();
    }

    public function point(Request $request)
    {
        foreach ($request->points as $userId => $answers) {
            $pointQuiz = 0;
            foreach ($answers as $questionId => $point) {
                Answer::where('user_id', '=', $userId)->where('question_id', '=', $questionId)->update([
                    'point' =>  number_format((float)$point, 2, '.', ''),
                ]);
                $pointQuiz += $point;
            }
            $studentQuiz  = StudentQuiz::where('user_id', '=', $userId)->where('quiz_id', '=', $request->id)->first();
            $studentQuiz->update([
                'start' =>  $studentQuiz->created_at,
                'point' => $pointQuiz,
            ]);
        }

        return back()->withInput();
    }
}
