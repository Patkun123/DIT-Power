<?php

use function Livewire\Volt\{state};
use App\Models\QuizQuestion;

state([
    "content" => "",
    "set" => "",
    "choices" => [
        "A" =>  "",
        "B" =>  "",
        "C" =>  "",
        "D" =>  "",
    ],
    "correct" =>  "A",
]);

$submit = function () {
    $this->validate([
        'content' => 'required|string|max:255',
        'set' => 'required|string|max:255',
        'choices.A' => 'required|string|max:255',
        'choices.B' => 'required|string|max:255',
        'choices.C' => 'required|string|max:255',
        'choices.D' => 'required|string|max:255',
        'correct' => 'required|string|in:A,B,C,D',
    ]);

    $question = QuizQuestion::create([
        'content' => $this->content,
        'answer' => $this->correct,
        'set'     => $this->set,
    ]);

    foreach ($this->choices as $letter => $content) {
        $question->choices()->create([
            'letter' => $letter,
            'content' => $content,
        ]);
    }
    $this->reset();
    $this->js('window.location.reload()');
}

?>



<div id="questionadd" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Question
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="questionadd">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6">
                @csrf
                <!-- Question -->
                <div>
                    <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question</label>

                    <textarea wire:model='content' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Your Question Here"></textarea>
                </div>
                <div>
                    <label for="set" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sets Schedule (1= 9am, 2=12nn, 3=3pm)</label>
                    <select id="set" wire:model="set" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Select Set</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">


                    <!-- A -->
                    <div>
                        <div class="flex gap-2">
                            <input wire:model='correct' name="correct" type="radio" value="A" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-full text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="answerA" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">A</label>

                        </div>
                        <input wire:model='choices.A' type="text" name="answerA" id="answerA" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Answer Letter A" required>
                    </div>

                    {{-- B --}}
                    <div>
                        <div class="flex gap-2">
                            <input wire:model='correct' type="radio" value="B" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-full text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="answerB" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">B</label>

                        </div>
                        <input wire:model='choices.B' type="text" name="answerB" id="answerB" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Answer Letter B" required>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">


                    <!-- C -->
                    <div>
                        <div class="flex gap-2">
                            <input wire:model='correct' name="correct" type="radio" value="C" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-full text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="answerC" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">C</label>

                        </div>
                        <input wire:model='choices.C' type="text" name="answerC" id="answerC" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Answer Letter C" required>
                    </div>

                    {{-- D --}}
                    <div>
                        <div class="flex gap-2">
                            <input wire:model='correct' type="radio" value="D" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-full text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="answerD" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">D</label>

                        </div>
                        <input wire:model='choices.D' type="text" name="answerD" id="answerD" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Answer Letter D" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" wire:click='submit' class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add Question
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

