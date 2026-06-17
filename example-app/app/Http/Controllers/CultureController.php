<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    // READ: Lijst van alle culturen
    public function index()
    {
        $cultures = Culture::all();
        return view('cultures.index', compact('cultures'));
    }

    // CREATE: Toon het formulier
    public function create()
    {
        return view('cultures.create');
    }

    // CREATE: Sla de nieuwe cultuur op in de database
    public function store(Request $request)
    {
        // 1. Sla de gevalideerde data op in een variabele
        $validated = $request->validate([
            'id' => 'required|string|max:50|unique:cultures,id',
            'name' => 'required|string|max:100',
            'emoji' => 'required|string|max:10',
            'flag_path' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. Gebruik ALLEEN de gevalideerde data, dan wordt de _token genegeerd!
        Culture::create($validated);

        return redirect()->route('cultures.index')->with('success', 'Cultuur succesvol toegevoegd!');
    }

    // UPDATE: Toon het bewerkingsformulier
    public function edit(Culture $culture)
    {
        return view('cultures.edit', compact('culture'));
    }

    // UPDATE: Sla de wijzigingen op
    public function update(Request $request, Culture $culture)
    {
        // 1. Sla de gevalideerde data op in een variabele
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'emoji' => 'required|string|max:10',
            'flag_path' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. Gebruik ALLEEN de gevalideerde data
        $culture->update($validated);

        return redirect()->route('cultures.index')->with('success', 'Cultuur succesvol aangepast!');
    }

    // DELETE: Verwijder de cultuur
    public function destroy(Culture $culture)
    {
        $culture->delete();
        return redirect()->route('cultures.index')->with('success', 'Cultuur succesvol verwijderd!');
    }

    // API: Stuur de data naar de JavaScript game
    public function apiIndex()
    {
        // Haal alle culturen op, INCLUSIEF hun vragen en antwoorden
        $cultures = Culture::with('questions.answers')->get();

        $formattedCultures = $cultures->map(function ($culture) {
            return [
                'id' => $culture->id,
                'name' => $culture->name,
                'emoji' => $culture->emoji,
                'flag' => $culture->flag_path,
                'description' => $culture->description,
                
                // We maken tijdelijk 1 les aan op basis van de beschrijving zodat je game niet vastloopt
                'lessons' => [
                    [
                        'title' => 'Welkom bij ' . $culture->name, 
                        'text' => $culture->description
                    ]
                ],
                
                // Formatteer de vragen precies zoals jouw JS het wil
                'quiz' => $culture->questions->map(function ($question) {
                    $answers = $question->answers->values(); // Zorg dat de lijst netjes bij 0 begint
                    $choices = $answers->pluck('answer_text')->toArray();
                    
                    // Zoek welke van de antwoorden de 'is_correct' op 1 heeft staan
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

     // 1. Voeg XP toe
     $user->xp += $xpGained;

     // 2. Bereken de Streak
     $today = now()->format('Y-m-d');
     $yesterday = now()->subDay()->format('Y-m-d');

     if ($user->last_played_at !== $today) {
         if ($user->last_played_at === $yesterday) {
             // Gisteren gespeeld? Streak + 1!
             $user->streak += 1;
         } elseif ($user->last_played_at !== null) {
             // Dag gemist? Terug naar 1.
             $user->streak = 1;
         } else {
             // Eerste keer ooit? Streak is 1.
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