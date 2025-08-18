<?php

use function Livewire\Volt\{state};
use App\Models\QuizQuestion;

state([
    "questionId" => null,
    "content" => "",
    "set" => "",
    "choices" => ["A" => "", "B" => "", "C" => "", "D" => ""],
    "correct" => "A",
    "showModal" => false, // New: controls modal visibility
]);

$edit = function ($id) {
    $question = QuizQuestion::with('choices')->findOrFail($id);

    $this->questionId = $question->id;
    $this->content = $question->content;
    $this->set = $question->set;
    $this->correct = $question->answer;

    foreach ($question->choices as $choice) {
        $this->choices[$choice->letter] = $choice->content;
    }

    $this->showModal = true; // Show modal automatically
};

?>
<div id="questionedit" tabindex="-1" aria-hidden="true"
     class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full"
     @if(!$showModal) style="display: none;" @endif>
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">

            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $questionId ? 'Edit Question' : 'Add Question' }}
                </h3>
                <button type="button" wire:click="$set('showModal', false)" class="text-gray-400 ...">
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="space-y-6">
                <!-- Your form fields (content, choices, set, correct) here -->

                <div class="flex justify-end">
                    <button type="submit" wire:click="{{ $questionId ? 'update' : 'submit' }}" class="btn-primary">
                        {{ $questionId ? 'Update Question' : 'Add Question' }}
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
