<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nieuw Land Toevoegen
        </h2>
    </x-slot>

    <div class="admin-container">
        <a href="{{ route('cultures.index') }}" style="color: #4f46e5; text-decoration: none; display: inline-block; margin-bottom: 15px;">&larr; Terug naar overzicht</a>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Oeps! Er ging iets mis:</strong>
                <ul style="margin-top: 10px; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-card">
            <form action="{{ route('cultures.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Uniek ID (bijv. 'japanese')</label>
                    <input type="text" name="id" class="form-control" value="{{ old('id') }}" required>
                </div>
                <div class="form-group">
                    <label>Naam (bijv. 'Japanse Cultuur')</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label>Emoji (bijv. 🎌)</label>
                    <input type="text" name="emoji" class="form-control" value="{{ old('emoji') }}" required>
                </div>
                <div class="form-group">
                    <label>Afbeelding Pad (bijv. '/IMG/japan.png')</label>
                    <input type="text" name="flag_path" class="form-control" value="{{ old('flag_path') }}" required>
                </div>
                <div class="form-group">
                    <label>Beschrijving</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Land Opslaan</button>
            </form>
        </div>
    </div>
</x-app-layout>