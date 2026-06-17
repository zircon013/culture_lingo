<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function index()
    {
        $cultures = Culture::all();
        return view('cultures.index', compact('cultures'));
    }

    public function create()
    {
        return view('cultures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:50|unique:cultures,id',
            'name' => 'required|string|max:100',
            'emoji' => 'required|string|max:10',
            'flag_path' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Culture::create($validated);

        return redirect()->route('cultures.index')->with('success', 'Cultuur succesvol toegevoegd!');
    }

    public function edit(Culture $culture)
    {
        return view('cultures.edit', compact('culture'));
    }

    public function update(Request $request, Culture $culture)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'emoji' => 'required|string|max:10',
            'flag_path' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $culture->update($validated);

        return redirect()->route('cultures.index')->with('success', 'Cultuur succesvol aangepast!');
    }

    public function destroy(Culture $culture)
    {
        $culture->delete();
        return redirect()->route('cultures.index')->with('success', 'Cultuur succesvol verwijderd!');
    }

    public function apiIndex()
    {
        $cultures = Culture::with('questions.answers')->get();

        $formattedCultures = $cultures->map(function ($culture) {
            return [
                'id' => $culture->id,
                'name' => $culture->name,
                'emoji' => $culture->emoji,
                'flag' => $culture->flag_path,
                'description' => $culture->description,
                
                'lessons' => [
                    [
                        'title' => 'Welkom bij ' . $culture->name, 
                        'text' => $culture->description
                    ]
                ],
                
                'quiz' => $culture->questions->map(function ($question) {
                    $answers = $question->answers->values(); 
                    $choices = $answers->pluck('answer_text')->toArray();
                    
                    $correctIndex = $answers->search(function ($answer) {
                        return $answer->is_correct == true;
                    });

                    return [
                        'question' => $question->question_text,
                        'choices' => $choices,
                        'answer' => $correctIndex !== false ? $correctIndex : 0
                    ];
                })->toArray()
            ];
        });

        return response()->json($formattedCultures);
    }
    public function updateStats(Request $request)
 {
     $user = auth()->user();
     $xpGained = $request->input('xp', 0);

     $user->xp += $xpGained;

     $today = now()->format('Y-m-d');
     $yesterday = now()->subDay()->format('Y-m-d');

     if ($user->last_played_at !== $today) {
         if ($user->last_played_at === $yesterday) {
             $user->streak += 1;
         } elseif ($user->last_played_at !== null) {
             $user->streak = 1;
         } else {
             $user->streak = 1;
         }
         $user->last_played_at = $today;
     }

     $user->save();

     return response()->json([
         'success' => true, 
         'xp' => $user->xp, 
         'streak' => $user->streak
     ]);
 }
}