<div>
    @php
        $moods = [
            ['emoji' => '😊', 'value' => 'happy', 'label' => 'Happy', 'color' => 'bg-yellow-100 dark:bg-yellow-900/30 border-yellow-300 dark:border-yellow-700'],
            ['emoji' => '😌', 'value' => 'calm', 'label' => 'Calm', 'color' => 'bg-blue-100 dark:bg-blue-900/30 border-blue-300 dark:border-blue-700'],
            ['emoji' => '😢', 'value' => 'sad', 'label' => 'Sad', 'color' => 'bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600'],
            ['emoji' => '😠', 'value' => 'angry', 'label' => 'Angry', 'color' => 'bg-red-100 dark:bg-red-900/30 border-red-300 dark:border-red-700'],
            ['emoji' => '😰', 'value' => 'anxious', 'label' => 'Anxious', 'color' => 'bg-orange-100 dark:bg-orange-900/30 border-orange-300 dark:border-orange-700'],
            ['emoji' => '🤩', 'value' => 'excited', 'label' => 'Excited', 'color' => 'bg-purple-100 dark:bg-purple-900/30 border-purple-300 dark:border-purple-700'],
            ['emoji' => '😐', 'value' => 'neutral', 'label' => 'Neutral', 'color' => 'bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600'],
        ];
    @endphp

    <!-- hidden input so mood is included in form submission -->
    <input type="hidden" name="feeling" value="{{ $selectedMood }}" required>

    <div class="grid grid-cols-4 sm:grid-cols-7 gap-3">
        @foreach ($moods as $mood)
            <button
                type="button"
                wire:click="selectMood('{{ $mood['value'] }}')"
                class="group relative flex flex-col items-center justify-center p-3 sm:p-4 rounded-xl border-2 transition-all duration-200
                       @if($selectedMood === $mood['value']) 
                           {{ $mood['color'] }} scale-110 shadow-lg ring-2 ring-primary-500 dark:ring-primary-400
                       @else 
                           border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-700 hover:border-primary-300 dark:hover:border-primary-600 hover:shadow-md
                       @endif">
                <span class="text-3xl sm:text-4xl mb-1.5 transition-transform group-hover:scale-110">{{ $mood['emoji'] }}</span>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300 @if($selectedMood === $mood['value']) text-gray-900 dark:text-white @endif">
                    {{ $mood['label'] }}
                </span>
                @if($selectedMood === $mood['value'])
                <div class="absolute -top-1 -right-1 w-5 h-5 bg-primary-600 dark:bg-primary-500 rounded-full flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                @endif
            </button>
        @endforeach
    </div>
    
    @if($selectedMood)
    <div class="mt-3 p-3 bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-lg">
        <p class="text-sm text-primary-700 dark:text-primary-300 font-medium text-center">
            Selected: <span class="capitalize">{{ $selectedMood }}</span>
        </p>
    </div>
    @endif
</div>
