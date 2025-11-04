@extends('auth.users.partials.app.head')

@section('title', 'Tools')
@section('content')
<div class="bg-gray-50 text-center px-4 dark:bg-gray-900 min-h-screen flex flex-col items-center py-10">
    <h1 class="text-4xl font-bold dark:text-gray-50 text-gray-900 mb-2">Physical Wellness Tools</h1>
    <div class="w-50 h-1 bg-lime-500 rounded mb-5"></div>
    <div class="max-w-2xl mx-auto mb-10">
        <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300">
            "Physical well-being" refers to the overall condition and functioning of your body.
            It’s about more than just not being sick — it includes how well your body operates,
            how energized you feel, and how capable you are of doing daily activities.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 mb-5 gap-8 max-w-6xl w-full px-4">
        <!-- BMI Calculator -->
        <div x-data="bmiCalculator()" class="flex flex-col items-center bg-gradient-to-br from-lime-50 to-green-50 dark:from-lime-900/20 dark:to-green-900/20 transition-all hover:shadow-xl hover:-translate-y-1 shadow-lime-500 rounded-xl shadow-lg p-6 border border-lime-200 dark:border-lime-800">
            <div class="flex items-center mb-5">
                <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="font-bold text-lg text-gray-900 dark:text-white">BMI Calculator</h2>
            </div>

            {{-- BMI Display --}}
            <div class="mb-6">
                <div class="relative">
                    <div class="w-32 h-32 mx-auto rounded-full border-8 border-lime-200 dark:border-lime-800 flex items-center justify-center"
                        :class="{'border-lime-500': bmi > 0, 'animate-pulse': calculating}">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white" x-text="bmi > 0 ? bmi.toFixed(1) : '--'"></h1>
                    </div>
                    <div x-show="calculating" class="absolute inset-0 rounded-full border-8 border-lime-500 animate-spin"
                        style="animation-duration: 2s; animation-timing-function: linear;"></div>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 text-center" x-text="bmiStatus"></p>
            </div>

            {{-- Input Fields --}}
            <div class="grid grid-cols-2 gap-3 w-full mb-6">
                <div>
                    <label class="block text-gray-600 dark:text-gray-200 mb-2 text-sm font-medium">Weight (kg)</label>
                    <input type="number" x-model="weight"
                        class="w-full py-2 px-3 rounded-lg border border-lime-200 dark:border-lime-700 bg-lime-50 dark:bg-lime-900/30 text-lime-700 dark:text-lime-300 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all duration-200 text-sm"
                        placeholder="70">
                </div>
                <div>
                    <label class="block text-gray-600 dark:text-gray-200 mb-2 text-sm font-medium">Height (cm)</label>
                    <input type="number" x-model="height"
                        class="w-full py-2 px-3 rounded-lg border border-lime-200 dark:border-lime-700 bg-lime-50 dark:bg-lime-900/30 text-lime-700 dark:text-lime-300 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all duration-200 text-sm"
                        placeholder="175">
                </div>
            </div>

            {{-- Calculate / Reset Buttons --}}
            <div class="flex gap-3 w-full">
                <button @click="calculateBMI"
                    :disabled="!weight || !height"
                    :class="(!weight || !height) ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-lime-600 hover:bg-lime-700 text-white'"
                    class="flex-1 py-3 px-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Calculate
                </button>
                <button @click="resetBMI"
                    class="px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </button>
            </div>

            {{-- Progress Bar --}}
            <div x-show="bmi > 0" class="w-full mt-4">
                <div class="w-full bg-lime-200 dark:bg-lime-800 rounded-full h-2">
                    <div class="h-2 rounded-full transition-all duration-1000 ease-linear"
                        :class="getBMIColorClass()"
                        :style="`width: ${getBMIProgress()}%`"></div>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2 text-center">
                    <span x-text="getBMIProgress()"></span>% of healthy range
                </p>
            </div>

            {{-- BMI Categories --}}
            <div x-show="bmi > 0" class="mt-4 w-full">
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-gray-600 dark:text-gray-400">Underweight</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-gray-600 dark:text-gray-400">Normal</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span class="text-gray-600 dark:text-gray-400">Overweight</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="text-gray-600 dark:text-gray-400">Obese</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meditation Timer -->
        @include('livewire.countdown-timer')

        <!-- Quick Notes -->
        <div x-data="quickNotes()" class="flex flex-col items-center bg-gradient-to-br from-lime-50 to-green-50 dark:from-lime-900/20 dark:to-green-900/20 transition-all hover:shadow-xl hover:-translate-y-1 shadow-lime-500 rounded-xl shadow-lg p-6 border border-lime-200 dark:border-lime-800">
            <div class="flex items-center mb-5">
                <div class="w-10 h-10 bg-lime-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h2 class="font-bold text-lg text-gray-900 dark:text-white">Quick Notes</h2>
            </div>

            {{-- Notes Counter Display --}}
            <div class="mb-6 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-lime-100 dark:bg-lime-900/30 rounded-full">
                    <svg class="w-5 h-5 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-lime-700 dark:text-lime-300 font-semibold" x-text="notes.length"></span>
                    <span class="text-lime-600 dark:text-lime-400 text-sm">Notes</span>
                </div>
            </div>

            {{-- Add Note Button --}}
            <div class="w-full mb-6">
                <button data-modal-target="note-modal" data-modal-toggle="note-modal"
                    class="w-full bg-lime-600 hover:bg-lime-700 text-white py-3 px-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Note
                </button>
            </div>

            {{-- Notes List --}}
            <div class="w-full" x-show="notes.length > 0">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Your Notes</h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400" x-text="notes.length + ' note(s)'"></span>
                </div>

                <div class="max-h-80 overflow-y-auto space-y-3">
                    <template x-for="note in notes" :key="note.id">
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow duration-200"
                            :class="{'ring-2 ring-yellow-400 border-yellow-300': note.is_important}">

                            {{-- Note Header --}}
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm truncate"
                                            x-text="note.title || 'Untitled Note'"></h4>
                                        <span x-show="note.is_important" class="inline-flex items-center">
                                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed" x-text="note.content"></p>
                                </div>
                            </div>

                            {{-- Note Footer --}}
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700">
                                <div class="text-xs text-gray-500 dark:text-gray-400" x-text="formatDate(note.created_at)"></div>

                                <div class="flex items-center gap-1">
                                    <button @click="toggleImportant(note.id)"
                                        class="p-2 rounded-lg transition-colors duration-200"
                                        :class="note.is_important ? 'bg-yellow-100 text-yellow-600 hover:bg-yellow-200' : 'text-gray-400 hover:text-yellow-500 hover:bg-yellow-50'"
                                        :title="note.is_important ? 'Remove from important' : 'Mark as important'">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </button>

                                    <button data-modal-target="note-modal" data-modal-toggle="note-modal" @click="openEditModal(note)"
                                        class="p-2 rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 transition-colors duration-200"
                                        title="Edit note">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <button @click="deleteNote(note.id)"
                                        class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors duration-200"
                                        title="Delete note">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Empty State --}}
            <div x-show="notes.length === 0 && !loading" class="text-center py-12">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-8 border-2 border-dashed border-gray-200 dark:border-gray-700">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-600 dark:text-gray-400 mb-2">No notes yet</h3>
                    <p class="text-gray-500 dark:text-gray-500 text-sm mb-4">Start by adding your first note above</p>
                    <div class="text-xs text-gray-400 dark:text-gray-600">
                        💡 <strong>Tip:</strong> Use the "Mark as Important" option to highlight priority notes
                    </div>
                </div>
            </div>

            {{-- Loading State --}}
            <div x-show="loading" class="text-center py-8">
                <div class="inline-flex items-center gap-2 text-lime-600 dark:text-lime-400">
                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="text-sm">Loading notes...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Flowbite Modal -->
    <div id="note-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-lime-50 dark:bg-lime-900/20">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span x-text="editingNote ? 'Edit Note' : 'Add New Note'"></span>
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="note-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <!-- Error Message -->
                    <div x-show="errorMessage" x-transition class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-900/20 dark:text-red-400 border border-red-200 dark:border-red-800">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span x-text="errorMessage"></span>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <div x-show="successMessage" x-transition class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900/20 dark:text-green-400 border border-green-200 dark:border-green-800">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span x-text="successMessage"></span>
                        </div>
                    </div>

                    <!-- Title Field -->
                    <div>
                        <label for="note-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Title <span class="text-gray-400">(Optional)</span>
                        </label>
                        <input type="text" id="note-title" x-model="newNote.title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                            placeholder="Enter note title...">
                    </div>

                    <!-- Content Field -->
                    <div>
                        <label for="note-content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <textarea id="note-content" x-model="newNote.content" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-lime-500 focus:border-lime-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                            placeholder="Write your note here..." maxlength="1000"></textarea>
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                <span x-text="newNote.content.length"></span>/1000 characters
                            </span>
                            <span x-show="newNote.content.length > 900" class="text-xs text-orange-500">
                                <span x-show="newNote.content.length >= 1000" class="text-red-500">Character limit reached!</span>
                                <span x-show="newNote.content.length < 1000">Approaching limit</span>
                            </span>
                        </div>
                    </div>

                    <!-- Important Checkbox -->
                    <div class="flex items-center">
                        <input id="important-checkbox" type="checkbox" x-model="newNote.is_important"
                            class="w-4 h-4 text-lime-600 bg-gray-100 border-gray-300 rounded focus:ring-lime-500 dark:focus:ring-lime-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="important-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 flex items-center cursor-pointer">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Mark as Important
                        </label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" @click="editingNote ? updateNote() : addNote()"
                        :disabled="!newNote.content.trim() || loading"
                        :class="(!newNote.content.trim() || loading) ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-lime-600 hover:bg-lime-700 text-white'"
                        class="text-white bg-lime-600 hover:bg-lime-700 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800 flex items-center gap-2">
                        <svg x-show="!loading" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span x-text="loading ? 'Saving...' : (editingNote ? 'Update Note' : 'Add Note')"></span>
                    </button>
                    <button type="button" data-modal-hide="note-modal"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-lime-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Zumba Section -->
    <h1 class="text-4xl font-bold mt-10 dark:text-gray-50 text-gray-900 mb-2">Zumba Session</h1>
    <div class="w-50 h-1 bg-lime-500 rounded mb-8"></div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
        $videos = [
        ['title' => 'Zumba Warmup', 'youtubeId' => 'snAlswICqtE'],
        ['title' => 'Zumba Dance Session', 'youtubeId' => 'PjrKaI8vbQo'],
        ['title' => 'Zumba Cooldown', 'youtubeId' => 'b1OstaWSkRs'],
        ];
        @endphp

        @foreach($videos as $video)
        <div class="bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-3">
            <div class="relative cursor-pointer" onclick="playVideo('{{ $video['youtubeId'] }}')">
                <img src="https://img.youtube.com/vi/{{ $video['youtubeId'] }}/hqdefault.jpg"
                    alt="{{ $video['title'] }}"
                    class="rounded-lg w-full">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-black bg-opacity-50 p-3 rounded-full text-white text-2xl">▶</div>
                </div>
            </div>
            <h2 class="mt-3 text-lg font-semibold">{{ $video['title'] }}</h2>
        </div>
        @endforeach
    </div>
</div>

<!-- Hidden Video Player -->
<div id="videoPlayer" class="hidden fixed inset-0 z-50 bg-black">
    <div class="relative w-full h-full flex items-center justify-center">
        <!-- Close Button -->
        <button onclick="closeVideo()" class="absolute top-4 mt-10 right-4 bg-red-600 text-white px-3 py-1 rounded-lg z-50">✖</button>
        <div id="playerContainer" class="w-full h-full"></div>
    </div>
</div>

@push('scripts')
<script>
    function playVideo(videoId) {
        const container = document.getElementById("playerContainer");
        container.innerHTML = `
            <iframe
              class="absolute top-0 left-0 w-full h-full rounded-lg"
              src="https://www.youtube.com/embed/${videoId}?autoplay=1&controls=1"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
            </iframe>
        `;
        document.getElementById("videoPlayer").classList.remove("hidden");

        // Request fullscreen
        let elem = document.getElementById("videoPlayer");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    }

    function closeVideo() {
        document.getElementById("videoPlayer").classList.add("hidden");
        document.getElementById("playerContainer").innerHTML = "";

        // Exit fullscreen
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }

    function bmiCalculator() {
        return {
            weight: '',
            height: '',
            bmi: 0,
            bmiStatus: '',
            calculating: false,

            calculateBMI() {
                if (!this.weight || !this.height) return;

                this.calculating = true;

                // Simulate calculation delay for animation
                setTimeout(() => {
                    const heightInMeters = this.height / 100;
                    this.bmi = this.weight / (heightInMeters * heightInMeters);

                    if (this.bmi < 18.5) {
                        this.bmiStatus = 'Underweight';
                    } else if (this.bmi < 24.9) {
                        this.bmiStatus = 'Normal weight';
                    } else if (this.bmi < 29.9) {
                        this.bmiStatus = 'Overweight';
                    } else {
                        this.bmiStatus = 'Obese';
                    }

                    this.calculating = false;
                }, 1000);
            },

            resetBMI() {
                this.weight = '';
                this.height = '';
                this.bmi = 0;
                this.bmiStatus = '';
                this.calculating = false;
            },

            getBMIColorClass() {
                if (this.bmi < 18.5) return 'bg-blue-500';
                if (this.bmi < 24.9) return 'bg-green-500';
                if (this.bmi < 29.9) return 'bg-yellow-500';
                return 'bg-red-500';
            },

            getBMIProgress() {
                if (this.bmi === 0) return 0;
                // Calculate progress based on BMI range (18.5-24.9 is 100%)
                if (this.bmi < 18.5) {
                    return Math.max(0, (this.bmi / 18.5) * 50);
                } else if (this.bmi <= 24.9) {
                    return 50 + ((this.bmi - 18.5) / (24.9 - 18.5)) * 50;
                } else {
                    return Math.min(100, 100 + ((this.bmi - 24.9) / 10) * 20);
                }
            }
        }
    }

    function quickNotes() {
        return {
            notes: [],
            loading: false,
            newNote: {
                title: '',
                content: '',
                is_important: false
            },
            editingNote: null,
            errorMessage: '',
            successMessage: '',

            init() {
                this.loadNotes();

                // Add keyboard support for modal
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        const modal = document.getElementById('note-modal');
                        if (modal && !modal.classList.contains('hidden')) {
                            this.closeAddNoteModal();
                        }
                    }
                });
            },

            async loadNotes() {
                this.loading = true;
                try {
                    const response = await fetch('/api/notes');
                    if (response.ok) {
                        this.notes = await response.json();
                    }
                } catch (error) {
                    console.error('Error loading notes:', error);
                } finally {
                    this.loading = false;
                }
            },

            openAddNoteModal() {
                this.clearForm();
                this.clearMessages();
                this.editingNote = null;
                // Flowbite will handle showing the modal
            },

            openEditModal(note) {
                this.editingNote = {
                    ...note
                };
                this.newNote = {
                    ...note
                };
                this.clearMessages();
                // Flowbite will handle showing the modal
            },

            closeAddNoteModal() {
                // Use Flowbite to hide the modal
                const modal = document.getElementById('note-modal');
                if (modal) {
                    modal.classList.add('hidden');
                }
                this.clearForm();
                this.clearMessages();
            },

            clearMessages() {
                this.errorMessage = '';
                this.successMessage = '';
            },

            async addNote() {
                if (!this.newNote.content.trim()) {
                    this.errorMessage = 'Please enter note content.';
                    return;
                }

                this.loading = true;
                this.clearMessages();

                try {
                    const response = await fetch('/api/notes', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.newNote)
                    });

                    if (response.ok) {
                        const note = await response.json();
                        this.notes.unshift(note);
                        this.successMessage = 'Note added successfully!';
                        setTimeout(() => {
                            this.closeAddNoteModal();
                        }, 1500);
                    } else {
                        const error = await response.json();
                        this.errorMessage = error.message || 'Failed to add note. Please try again.';
                    }
                } catch (error) {
                    console.error('Error adding note:', error);
                    this.errorMessage = 'Network error. Please check your connection and try again.';
                } finally {
                    this.loading = false;
                }
            },

            async updateNote() {
                if (!this.editingNote) return;

                if (!this.newNote.content.trim()) {
                    this.errorMessage = 'Please enter note content.';
                    return;
                }

                this.loading = true;
                this.clearMessages();

                try {
                    const response = await fetch(`/api/notes/${this.editingNote.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.newNote)
                    });

                    if (response.ok) {
                        const updatedNote = await response.json();
                        const index = this.notes.findIndex(note => note.id === updatedNote.id);
                        if (index !== -1) {
                            this.notes[index] = updatedNote;
                        }
                        this.successMessage = 'Note updated successfully!';
                        setTimeout(() => {
                            this.closeAddNoteModal();
                        }, 1500);
                    } else {
                        const error = await response.json();
                        this.errorMessage = error.message || 'Failed to update note. Please try again.';
                    }
                } catch (error) {
                    console.error('Error updating note:', error);
                    this.errorMessage = 'Network error. Please check your connection and try again.';
                } finally {
                    this.loading = false;
                }
            },

            async deleteNote(noteId) {
                if (!confirm('Are you sure you want to delete this note?')) return;

                this.loading = true;
                try {
                    const response = await fetch(`/api/notes/${noteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (response.ok) {
                        this.notes = this.notes.filter(note => note.id !== noteId);
                    }
                } catch (error) {
                    console.error('Error deleting note:', error);
                } finally {
                    this.loading = false;
                }
            },

            async toggleImportant(noteId) {
                try {
                    const response = await fetch(`/api/notes/${noteId}/toggle-important`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (response.ok) {
                        const updatedNote = await response.json();
                        const index = this.notes.findIndex(note => note.id === updatedNote.id);
                        if (index !== -1) {
                            this.notes[index] = updatedNote;
                        }
                    }
                } catch (error) {
                    console.error('Error toggling importance:', error);
                }
            },


            clearForm() {
                this.newNote = {
                    title: '',
                    content: '',
                    is_important: false
                };
                this.editingNote = null;
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        }
    }

    // Initialize Flowbite modal when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Flowbite modal will be automatically initialized
        // The data-modal-target and data-modal-toggle attributes handle the functionality
    });
</script>
@endpush
@endsection