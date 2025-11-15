@extends('auth.admin.partials.layouts.app.head')

@section('title', 'Manage Scramble Words')
@include('auth.admin.partials.layouts.side')
@include('auth.admin.partials.layouts.header')
@section('content')
<div class="h-70 md:h-80 w-full bg-gradient-to-l from-primary-400 via-primary-600 to-lime-700">
    <div class="container mx-auto flex items-start justify-start h-full px-2 md:px-70">
        <div class="flex flex-col mt-40 md:mt-40">
            <h1 class="text-2xl md:text-4xl text-white">{{ auth()->user()->lastname }}, <b>Scramble Words</b></h1>
            <span class="text-white text-sm md:text-base mt-2">Add, edit, and remove scramble words</span>
        </div>
    </div>
</div>
<main class="p-4 md:ml-64 h-auto pt-4">
    <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden rounded-lg shadow border-gray-300 dark:border-gray-600 p-4 mb-4">
        @if (session('status'))
            <div class="mb-3 p-2 rounded bg-green-100 text-green-700">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-3 p-2 rounded bg-red-100 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($editing) && $editing)
            <form action="{{ route('admin.scramble-words.update', $editing) }}" method="POST" class="flex flex-wrap gap-3 items-end">
                @csrf
                @method('PUT')
                <div class="flex-1 min-w-[220px]">
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Edit Word</label>
                    <input name="word" value="{{ $editing->word }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" required />
                </div>
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Set</label>
                    <input type="number" name="set" value="{{ $editing->set }}" min="1" class="w-24 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" required />
                </div>
                <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                    <input type="checkbox" name="active" value="1" {{ $editing->active ? 'checked' : '' }} class="rounded" /> Active
                </label>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Update</button>
                    <a href="{{ route('admin.scramble-words.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Cancel</a>
                </div>
            </form>
        @else
            <form action="{{ route('admin.scramble-words.store') }}" method="POST" class="flex flex-wrap gap-3 items-end">
                @csrf
                <div class="flex-1 min-w-[220px]">
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Word</label>
                    <input name="word" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" placeholder="e.g. wellness" required />
                </div>
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Set</label>
                    <input type="number" name="set" value="1" min="1" class="w-24 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" required />
                </div>
                <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                    <input type="checkbox" name="active" value="1" checked class="rounded" /> Active
                </label>
                <button class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white rounded">Add Word</button>
            </form>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden rounded-lg shadow border-gray-300 dark:border-gray-600">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Word</th>
                        <th class="px-6 py-3">Set</th>
                        <th class="px-6 py-3">Active</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($words as $word)
                        <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-3">{{ $word->word }}</td>
                            <td class="px-6 py-3">{{ $word->set }}</td>
                            <td class="px-6 py-3">{{ $word->active ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-3 flex gap-2">
                                <a href="{{ route('admin.scramble-words.index', ['edit' => $word->id]) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded">Edit</a>
                                <form action="{{ route('admin.scramble-words.destroy', $word) }}" method="POST" onsubmit="return confirm('Delete this word?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $words->links() }}</div>
    </div>
</main>
@endsection


