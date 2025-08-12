@extends('auth.users.partials.app.head')

@section('title', 'Journal')
@section('content')

<div class="p-4 sm:p-6 space-y-10 bg-gray-50 dark:bg-gray-900 min-h-screen overflow-x-hidden">
    <div class="grid grid-cols-1 mt-8 md:grid-cols-2 gap-6">
        <!-- Top Quiz Performers -->
        <div class="bg-white dark:bg-gray-800 p-6 sm:p-10 rounded-xl shadow w-full max-w-3xl mx-auto">
            <h2 class="text-2xl sm:text-3xl mt-2 font-bold text-gray-800 dark:text-white mb-6 text-center">
                New Journal Entry
            </h2>

            <form method="POST" action="{{ route('journal.store') }}" class="space-y-6">
                @csrf

                {{-- Title --}}
                <div>
                    <flux:input
                        type="text"
                        wire:model.defer="title"
                        :label="__('Title')"
                        placeholder="Give your entry a title"
                        class="w-full"
                    />
                </div>

                {{-- Thoughts --}}
                <div>
                    <flux:textarea
                        wire:model.defer="text"
                        :label="__('Your Thoughts')"
                        placeholder="Write your thoughts here..."
                        class="w-full"
                    />
                </div>

                {{-- Mood Selector --}}
                <div>
                    <label for="feeling" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
                        How are you feeling today?
                    </label>
                    @livewire('mood-selector')
                </div>

                {{-- Tags --}}
                <div>
                    <flux:input
                        type="tags"
                        wire:model.defer="tags"
                        :label="__('Tags')"
                        placeholder="Add tags"
                        class="w-full"
                    />
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-center">
                    <flux:button type="submit" variant="primary" color="lime" class="w-full sm:w-auto">
                        Submit
                    </flux:button>
                </div>
            </form>
        </div>


        <!-- Wellness Stats -->
<div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow w-full max-w-6xl mx-auto">
    {{-- Header & Filters --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white">
            Previous Entries
        </h2>

        <flux:select wire:model="moods" class="w-full">
            <flux:select.option>All Moods</flux:select.option>
            <flux:select.option>Happy</flux:select.option>
            <flux:select.option>Calm</flux:select.option>
            <flux:select.option>Sad</flux:select.option>
            <flux:select.option>Angry</flux:select.option>
            <flux:select.option>Anxious</flux:select.option>
        </flux:select>

        <flux:input
            type="text"
            placeholder="Search"
            icon:trailing="magnifying-glass"
            class="w-full"
        />
    </div>

    {{-- Entries --}}
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        @if(!$hasEntries)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg col-span-full">
                You don’t have any journal entries yet. Start by creating your first one!
            </div>
        @else
            @foreach($journals as $journal)
                <div class="bg-gray-100 w-auto 2xl:w-165 xl:w-150 lg:w-110 md:w-75 md:sm-50 dark:bg-gray-900 rounded-xl shadow p-6 border border-gray-200 dark:border-gray-700 flex flex-col justify-between">
                    {{-- Title & Date --}}
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-50">
                                {{ $journal->title }}
                            </h3>
                            <span class="text-sm text-gray-500">
                                {{ $journal->created_at->format('F j, Y') }}
                            </span>
                        </div>

                        {{-- Mood --}}
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

                        {{-- Text --}}
                        <p class="text-gray-600 dark:text-gray-200 mb-4">
                            {{ $journal->text }}
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-xs font-medium">
                            {{ $journal->tags }}
                            </span>
                        </div>
                        {{-- Tags --}}
                        {{-- @if(!empty($journal->tags))
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(explode(',', $journal->tags) as $tag)
                                    <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-xs font-medium">
                                        {{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif --}}
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-2 mt-4">
                        <a href=""
                           class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded-lg text-sm shadow-sm">
                            View
                        </a>
                        {{-- Uncomment for Edit/Delete if needed --}}
                        {{-- <a href="{{ route('journal.edit', $journal->id) }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm shadow-sm">Edit</a> --}}
                        {{-- <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm shadow-sm">Delete</button>
                        </form> --}}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

    </div>
</div>
@endsection
