<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class SurveyController extends Controller
{
    //
    public function show(Questionnaire $questionnaire, $slug)
    {
        //dd($questionnaire);
        $questionnaire->load('questions.answers');
        return view('survey.show', compact('questionnaire'));
    }

    public function store(Questionnaire $questionnaire)
    {   
        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            'responses.*.question_id' => 'required',
            
        ]);
        $survey = $questionnaire->surveys()->create();


//        dd(request()->all());

    }
}
