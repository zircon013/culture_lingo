<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Vraag Beheren
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="{{ route('cultures.edit', $question->culture_id) }}" class="text-indigo-500 hover:underline">&larr; Terug naar Cultuur</a>
        
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('questions.update', $question->id) }}" method="POST" class="flex gap-2">
                @csrf @method('PUT')
                <input type="text" name="question_text" value="{{ $question->question_text }}" class="flex-1 border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Vraag Opslaan</button>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4 dark:text-white">Antwoorden</h3>
            
            <div class="space-y-4 mb-8">
                @foreach($question->answers as $answer)
                    <div class="flex items-center gap-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                        <form action="{{ route('answers.update', $answer->id) }}" method="POST" class="flex-1 flex items-center gap-4">
                            @csrf @method('PUT')
                            <input type="text" name="answer_text" value="{{ $answer->answer_text }}" class="flex-1 border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                            
                            <label class="flex items-center gap-2 dark:text-white cursor-pointer">
                                <input type="checkbox" name="is_correct" value="1" {{ $answer->is_correct ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                Dit is het juiste antwoord
                            </label>
                            
                            <button type="submit" class="text-indigo-500 text-sm hover:underline">Update</button>
                        </form>
                        
                        <form action="{{ route('answers.destroy', $answer->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-sm hover:underline">Verwijder</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('answers.store', $question->id) }}" method="POST" class="flex items-center gap-4 bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                @csrf
                <input type="text" name="answer_text" placeholder="Nieuw antwoord..." class="flex-1 border-gray-300 rounded-md dark:bg-gray-900 dark:text-white" required>
                <label class="flex items-center gap-2 dark:text-white cursor-pointer">
                    <input type="checkbox" name="is_correct" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    Dit is het juiste antwoord
                </label>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Toevoegen</button>
            </form>
        </div>
    </div>
</x-app-layout>