<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Culture;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request, Culture $culture)
    {
        $request->validate(['question_text' => 'required|string']);
        $culture->questions()->create(['question_text' => $request->question_text]);
        return back()->with('success', 'Vraag toegevoegd!');
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate(['question_text' => 'required|string']);
        $question->update(['question_text' => $request->question_text]);
        return back()->with('success', 'Vraag gewijzigd!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Vraag verwijderd!');
    }
}