<div id="view-modal{{ $journal->id }}" data-modal-backdrop="view" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $journal->title }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="view-modal{{ $journal->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                   {{ $journal->text }}
                </p>
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
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-xs font-medium">
                        {{ $journal->tags }}
                    </span>
                </div>
            </div>
            <!-- Modal footer -->
            <!-- Modal footer -->
            <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="view-modal{{ $journal->id }}" data-modal-target="edit-modal{{$journal->id}}" data-modal-toggle="edit-modal{{$journal->id}}" type="button"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Edit
                </button>
                <button data-modal-hide="view-modal{{ $journal->id }}" data-modal-target="delete-modal{{$journal->id}}" data-modal-toggle="delete-modal{{$journal->id}}" type="button"
                    class="py-2.5 px-5 ms-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
@include('Auth.Users.partials.delete-modal')
@include('Auth.Users.partials.edit-modal')
