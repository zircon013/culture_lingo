<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate(['answer_text' => 'required|string']);
        
        $question->answers()->create([
            'answer_text' => $request->answer_text,
            'is_correct' => $request->has('is_correct') 
        ]);
        return back()->with('success', 'Antwoord toegevoegd!');
    }

    public function update(Request $request, Answer $answer)
    {
        $request->validate(['answer_text' => 'required|string']);
        $answer->update([
            'answer_text' => $request->answer_text,
            'is_correct' => $request->has('is_correct')
        ]);
        return back()->with('success', 'Antwoord gewijzigd!');
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return back()->with('success', 'Antwoord verwijderd!');
    }
}