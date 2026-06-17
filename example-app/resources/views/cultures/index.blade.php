<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Landen Beheren
        </h2>
    </x-slot>

    <div class="admin-container">
        
        @if (session('success'))
            <div class="admin-card" style="background-color: #dcfce7; border-left: 5px solid #22c55e;">
                <strong style="color: #166534;">{{ session('success') }}</strong>
            </div>
        @endif

        <div class="admin-card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3>Alle Landen in CultureLingo</h3>
                <a href="{{ route('cultures.create') }}" class="btn btn-primary">Nieuw Land Toevoegen</a>
            </div>

            @if($cultures->count() > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam & Emoji</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cultures as $culture)
                            <tr>
                                <td>{{ $culture->id }}</td>
                                <td>{{ $culture->emoji }} {{ $culture->name }}</td>
                                <td>
                                    <a href="{{ route('cultures.edit', $culture->id) }}" style="color: #4f46e5; margin-right: 15px; font-weight: bold;">Bewerken</a>
                                    
                                    <form action="{{ route('cultures.destroy', $culture->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Weet je zeker dat je dit land en alle bijbehorende vragen wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: #ef4444; background: none; border: none; font-weight: bold; cursor: pointer;">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="margin-top: 20px;">Je hebt nog geen landen toegevoegd. Klik op de knop rechtsboven om te beginnen!</p>
            @endif
        </div>
    </div>
</x-app-layout>