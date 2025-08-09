<div>
    @php
        $moods = [
            ['emoji' => '😊', 'value' => 'happy'],
            ['emoji' => '😌', 'value' => 'calm'],
            ['emoji' => '😟', 'value' => 'sad'],
            ['emoji' => '😠', 'value' => 'angry'],
            ['emoji' => '😰', 'value' => 'anxious'],
        ];
    @endphp

    <!-- hidden input so mood is included in form submission -->
    <input type="hidden" name="feeling" value="{{ $selectedMood }}">

    <div class="flex items-center space-x-6">
        @foreach ($moods as $mood)
            <button
                type="button"
                wire:click="selectMood('{{ $mood['value'] }}')"
                class="text-3xl p-3 rounded-full transition
                       @if($selectedMood === $mood['value']) bg-gray-200 dark:bg-gray-700 @endif
                       hover:bg-gray-100 dark:hover:bg-gray-600"
            >
                {{ $mood['emoji'] }}
            </button>
        @endforeach
    </div>
</div>
