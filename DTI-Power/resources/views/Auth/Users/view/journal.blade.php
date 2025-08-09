@extends('auth.users.partials.app.head')

@section('title', 'Journal')
@section('content')

<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen overflow-x-hidden">
    <div class="grid grid-cols-1 mt-8 md:grid-cols-2 gap-6">
        <!-- Top Quiz Performers -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-xl shadow">
            <h2 class="text-3xl mt-2 font-bold text-gray-800 dark:text-white mb-4 text-center">
                New Journal Entry
            </h2>
            <form method="POST" action="{{ route('journal.store') }}">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 p-2">
                    <div class="sm:col-span-2">
                        <flux:input
                        type="text"
                        wire:model.defer="title"
                        :label="__('Title')"
                        placeholder="Give your entry Title"
                    />
                    </div>
                    <div class="sm:col-span-2">
                        <flux:textarea wire:model.defer="text"
                        :label="__('Your Thoughts')"
                        placeholder="Write your thoughts here..."/>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="feeling" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">How your Feeling tody?</label>
                        @livewire('mood-selector')
                    </div>
                    <div class="sm:col-span-2">
                        <flux:input
                        type="tags"
                        wire:model.defer="title"
                        :label="__('Tags')"
                        placeholder="Add Tags"
                    />
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 p-2">
                <flux:button type="submit" variant="primary" color="lime">Submit</flux:button>
                </div>
            </form>
            {{-- <div class="text-center mt-6">
                <a href="#" class="px-6 py-2 bg-emerald-500 text-white rounded-full hover:bg-emerald-600 transition">Start Quiz</a>
            </div> --}}
        </div>

        <!-- Wellness Stats -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <div class="grid grid-cols-3 gap-4 ml-6 mt-3">
                <h2 class="text-2xl  font-bold text-gray-800 dark:text-white mb-4">Previous Entries</h2>
                <flux:select wire:model="moods">
                    <flux:select.option >All Moods</flux:select.option>
                    <flux:select.option>Happy</flux:select.option>
                    <flux:select.option>Calm</flux:select.option>
                    <flux:select.option>Sad</flux:select.option>
                    <flux:select.option>Angry</flux:select.option>
                    <flux:select.option>Anxious</flux:select.option>
                </flux:select>
                <flux:input type="text" placeholder="Search" icon:trailing="magnifying-glass"></flux:input>
            </div>

    <div class="grid grid-cols-2 gap-4 mt-4 ml-6">
        <div class="w-160 p-6 rounded-xl shadow">
            <div class="max-h-[440px] overflow-y-auto pr-2 space-y-6">
                @if(!$hasEntries)
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                        You don’t have any journal entries yet. Start by creating your first one!
                    </div>
                @else
                    @foreach($journals as $journal)
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-xl shadow-xl p-6 border border-gray-200 dark:border-gray-700 space-y-6">
                            <!-- Title + Date -->
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-50">
                                    {{ $journal->title }}
                                </h3>
                                <span class="text-sm text-gray-500">
                                    {{ $journal->created_at->format('F j, Y') }}
                                </span>
                            </div>

                            <!-- Mood -->
                        <div class="flex items-center mb-4 text-sm">
                            <span class="text-2xl mr-2">
                                @if($journal->feeling === 'happy')
                                    😊
                                @elseif($journal->feeling === 'sad')
                                    😢
                                @elseif($journal->feeling === 'angry')
                                    😡
                                @elseif($journal->feeling === 'excited')
                                    🤩
                                @else
                                    😐
                                @endif
                            </span>
                            <span class="font-medium text-gray-700 dark:text-gray-50">
                                {{ ucfirst($journal->feeling) }}
                            </span>
                        </div>


                            <!-- Text -->
                            <p class="text-gray-600 dark:text-gray-200 mb-4">
                                {{ $journal->text }}
                            </p>

                            <!-- Tags -->
                            @if(!empty($journal->tags))
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(explode(',', $journal->tags) as $tag)
                                        <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-xs font-medium">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                                                            <!-- Actions -->
                                                            {{-- {{ route('journal.show', $journal->id) }} --}}
                                <div class="flex gap-2">
                                    <a href=""
                                    class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg text-sm shadow-sm">
                                        View
                                    </a>
                                    {{-- <a href="{{ route('journal.edit', $journal->id) }}"
                                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm shadow-sm">
                                        Edit
                                    </a> --}}
                                    {{-- <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm shadow-sm">
                                            Delete
                                        </button>
                                    </form> --}}
                                </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

        </div>
    </div>
</div>
@endsection
