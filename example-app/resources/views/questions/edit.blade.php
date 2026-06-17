<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            Vraag & Antwoorden Beheren
        </h2>
    </x-slot>

    <style>
        .admin-wrapper {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: calc(100vh - 65px);
            padding: 40px 0;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            color: #f8fafc;
            margin-bottom: 24px;
        }
        .glass-input {
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-radius: 8px;
            padding: 14px 18px;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        .glass-input:focus {
            outline: none;
            border-color: #818cf8;
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.2);
        }
        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        .glass-btn {
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-primary {
            background: rgba(79, 70, 229, 0.8);
            border-color: rgba(79, 70, 229, 1);
            color: white;
        }
        .btn-primary:hover {
            background: rgba(79, 70, 229, 1);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
            transform: translateY(-2px);
        }
        .btn-success {
            background: rgba(34, 197, 94, 0.8);
            border-color: rgba(34, 197, 94, 1);
            color: white;
        }
        .btn-success:hover {
            background: rgba(34, 197, 94, 1);
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
            transform: translateY(-2px);
        }
        .answer-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: background 0.2s, transform 0.2s;
        }
        .answer-card:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: translateX(4px);
        }
        .add-answer-card {
            background: rgba(129, 140, 248, 0.05);
            border: 1px dashed rgba(129, 140, 248, 0.4);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 30px;
        }
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #cbd5e1;
            cursor: pointer;
            font-size: 1rem;
            white-space: nowrap;
            user-select: none;
        }
        .glass-checkbox {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            accent-color: #818cf8;
        }
        .link-back {
            color: #818cf8;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            margin-bottom: 24px;
            transition: color 0.2s;
            font-size: 1.1rem;
        }
        .link-back:hover {
            color: #a5b4fc;
        }
        .btn-text {
            background: none;
            border: none;
            font-weight: 600;
            cursor: pointer;
            padding: 10px 16px;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.95rem;
        }
        .btn-text-update { color: #818cf8; }
        .btn-text-update:hover { background: rgba(129, 140, 248, 0.15); }
        .btn-text-delete { color: #f87171; }
        .btn-text-delete:hover { background: rgba(248, 113, 113, 0.15); }
    </style>

    <div class="admin-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('cultures.edit', $question->culture_id) }}" class="link-back">
                &larr; Terug naar Cultuur Overzicht
            </a>
            
            <div class="glass-panel">
                <h3 style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px; font-weight: bold; margin-bottom: 16px; color: #a5b4fc;">
                    ✏️ Vraag Bewerken
                </h3>
                <form action="{{ route('questions.update', $question->id) }}" method="POST" style="display: flex; gap: 16px;">
                    @csrf @method('PUT')
                    <input type="text" name="question_text" value="{{ $question->question_text }}" class="glass-input" required>
                    <button type="submit" class="glass-btn btn-primary" style="white-space: nowrap;">Vraag Opslaan</button>
                </form>
            </div>

            <div class="glass-panel">
                <h3 style="font-size: 1.6rem; font-weight: bold; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 16px;">
                    🎯 Antwoorden
                </h3>
                
                <div>
                    @foreach($question->answers as $answer)
                        <div class="answer-card">
                            <form action="{{ route('answers.update', $answer->id) }}" method="POST" style="display: flex; flex: 1; align-items: center; gap: 20px;">
                                @csrf @method('PUT')
                                <input type="text" name="answer_text" value="{{ $answer->answer_text }}" class="glass-input" required>
                                
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="is_correct" value="1" {{ $answer->is_correct ? 'checked' : '' }} class="glass-checkbox">
                                    <span style="{{ $answer->is_correct ? 'color: #4ade80; font-weight: bold;' : '' }}">
                                        Juiste antwoord
                                    </span>
                                </label>
                                
                                <button type="submit" class="btn-text btn-text-update">Update</button>
                            </form>
                            
                            <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" style="margin: 0;">
                                @csrf @method('DELETE')
                                <button class="btn-text btn-text-delete">Verwijder</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <form action="{{ route('answers.store', $question->id) }}" method="POST" class="add-answer-card">
                    @csrf
                    <div style="flex: 1;">
                        <input type="text" name="answer_text" placeholder="Typ hier een nieuw antwoord..." class="glass-input" required>
                    </div>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="is_correct" value="1" class="glass-checkbox">
                        Juiste antwoord
                    </label>
                    <button type="submit" class="glass-btn btn-success">Toevoegen</button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>