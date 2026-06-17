<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            {{ __('Land Bewerken') }}: {{ $culture->name }}
        </h2>
    </x-slot>

    <style>
        /* Exact dezelfde Glassmorphism UI als de vragen-pagina */
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
            margin-bottom: 16px;
        }
        .glass-input:disabled {
            background: rgba(0, 0, 0, 0.5);
            color: rgba(255,255,255,0.4);
            cursor: not-allowed;
        }
        .glass-input:focus:not(:disabled) {
            outline: none;
            border-color: #818cf8;
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.2);
        }
        textarea.glass-input {
            min-height: 120px;
            resize: vertical;
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
        .item-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s, transform 0.2s;
        }
        .item-card:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: translateX(4px);
        }
        .add-item-card {
            background: rgba(129, 140, 248, 0.05);
            border: 1px dashed rgba(129, 140, 248, 0.4);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 20px;
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
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.95rem;
            text-decoration: none;
        }
        .btn-text-update { color: #818cf8; }
        .btn-text-update:hover { background: rgba(129, 140, 248, 0.15); }
        .btn-text-delete { color: #f87171; }
        .btn-text-delete:hover { background: rgba(248, 113, 113, 0.15); }
        label {
            display: block;
            margin-bottom: 6px;
            color: #cbd5e1;
            font-weight: bold;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>

    <div class="admin-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <a href="{{ route('cultures.index') }}" class="link-back">
                &larr; Terug naar het Hoofdmenu
            </a>
            
            <div class="glass-panel">
                <h3 style="font-size: 1.6rem; font-weight: bold; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 16px;">
                    🌍 Land Details
                </h3>
                
                <form action="{{ route('cultures.update', $culture->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div>
                        <label>Uniek ID</label>
                        <input type="text" value="{{ $culture->id }}" class="glass-input" disabled>
                    </div>
                    
                    <div style="display: flex; gap: 16px;">
                        <div style="flex: 1;">
                            <label>Naam</label>
                            <input type="text" name="name" value="{{ $culture->name }}" class="glass-input" required>
                        </div>
                        <div style="width: 120px;">
                            <label>Emoji</label>
                            <input type="text" name="emoji" value="{{ $culture->emoji }}" class="glass-input" required>
                        </div>
                    </div>

                    <div>
                        <label>Afbeelding Pad (Flag)</label>
                        <input type="text" name="flag_path" value="{{ $culture->flag_path }}" class="glass-input" required>
                    </div>

                    <label>Beschrijving</label>
                    <textarea name="description" class="glass-input" rows="4" required>{{ $culture->description }}</textarea>

                    <button type="submit" class="glass-btn btn-primary mt-2">Bijwerken</button>
                </form>
            </div>

            <div class="glass-panel">
                <h3 style="font-size: 1.6rem; font-weight: bold; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 16px;">
                    📝 Quiz Vragen voor {{ $culture->name }}
                </h3>
                
                <div>
                    @forelse($culture->questions as $question)
                        <div class="item-card">
                            <span style="font-size: 1.1rem; font-weight: 500;">{{ $question->question_text }}</span>
                            
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <a href="{{ route('questions.edit', $question->id) }}" class="btn-text btn-text-update">
                                    Antwoorden Beheren &rarr;
                                </a>
                                
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Vraag verwijderen?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-text btn-text-delete">
                                        X
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p style="color: #94a3b8; font-style: italic; padding: 10px 0;">Er zijn nog geen vragen voor dit land.</p>
                    @endforelse
                </div>

                <form action="{{ route('questions.store', $culture->id) }}" method="POST" class="add-item-card">
                    @csrf
                    <div style="flex: 1;">
                        <input type="text" name="question_text" placeholder="Typ hier een nieuwe vraag..." class="glass-input" style="margin-bottom: 0;" required>
                    </div>
                    <button type="submit" class="glass-btn btn-success">Vraag Toevoegen</button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>