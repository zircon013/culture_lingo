<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Land Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('cultures.update', $culture->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label>Uniek ID</label>
                            <input type="text" value="{{ $culture->id }}" class="w-full border-gray-300 rounded-md bg-gray-100 dark:bg-gray-700 dark:text-gray-400" disabled>
                        </div>
                        <div>
                            <label>Naam</label>
                            <input type="text" name="name" value="{{ $culture->name }}" class="w-full border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                        </div>
                        <div>
                            <label>Emoji</label>
                            <input type="text" name="emoji" value="{{ $culture->emoji }}" class="w-full border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                        </div>
                        <div>
                            <label>Afbeelding Pad</label>
                            <input type="text" name="flag_path" value="{{ $culture->flag_path }}" class="w-full border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                        </div>
                        <div>
                            <label>Beschrijving</label>
                            <textarea name="description" class="w-full border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" rows="4" required>{{ $culture->description }}</textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Bijwerken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 dark:text-gray-100">Quiz Vragen voor {{ $culture->name }}</h3>
                
                <ul class="mb-6 space-y-2">
                    @foreach($culture->questions as $question)
                        <li class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                            <span class="dark:text-white">{{ $question->question_text }}</span>
                            <div class="flex gap-4">
                                <a href="{{ route('questions.edit', $question->id) }}" class="text-indigo-500 hover:text-indigo-400">Antwoorden Beheren &rarr;</a>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Vraag verwijderen?');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-400">X</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <form action="{{ route('questions.store', $culture->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="question_text" placeholder="Typ hier een nieuwe vraag..." class="flex-1 border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Vraag Toevoegen</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>