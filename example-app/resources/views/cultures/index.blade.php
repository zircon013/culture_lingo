<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            {{ __('Landen Beheren') }}
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
        .glass-alert {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #4ade80;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .glass-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
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
        
        .glass-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .glass-table th {
            text-align: left;
            padding: 16px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            color: #a5b4fc;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        .glass-table td {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
            font-size: 1.05rem;
        }
        .glass-table tr {
            transition: background 0.2s ease;
        }
        .glass-table tr:hover {
            background: rgba(255, 255, 255, 0.04);
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
            display: inline-block;
        }
        .btn-text-update { color: #818cf8; }
        .btn-text-update:hover { background: rgba(129, 140, 248, 0.15); }
        .btn-text-delete { color: #f87171; }
        .btn-text-delete:hover { background: rgba(248, 113, 113, 0.15); }
        
        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
    </style>

    <div class="admin-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="glass-alert">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="glass-panel">
                <div class="header-flex">
                    <h3 style="font-size: 1.8rem; font-weight: bold;">Alle Landen in CultureLingo</h3>
                    <a href="{{ route('cultures.create') }}" class="glass-btn btn-primary">+ Nieuw Land Toevoegen</a>
                </div>

                @if($cultures->count() > 0)
                    <div style="overflow-x: auto;">
                        <table class="glass-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naam & Emoji</th>
                                    <th style="text-align: right;">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cultures as $culture)
                                    <tr>
                                        <td style="color: #64748b; font-family: monospace;">{{ $culture->id }}</td>
                                        <td style="font-weight: bold; color: white;">
                                            <span style="font-size: 1.5rem; margin-right: 10px; vertical-align: middle;">{{ $culture->emoji }}</span> 
                                            {{ $culture->name }}
                                        </td>
                                        <td style="text-align: right;">
                                            <a href="{{ route('cultures.edit', $culture->id) }}" class="btn-text btn-text-update">Bewerken / Vragen toevoegen</a>
                                            
                                            <form action="{{ route('cultures.destroy', $culture->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Weet je zeker dat je dit land en alle bijbehorende vragen wilt verwijderen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-text btn-text-delete">Verwijderen</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 0;">
                        <span style="font-size: 4rem; opacity: 0.5;">🌍</span>
                        <p style="margin-top: 20px; color: #94a3b8; font-size: 1.1rem;">Je hebt nog geen landen toegevoegd. Klik op de knop rechtsboven om te beginnen!</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>