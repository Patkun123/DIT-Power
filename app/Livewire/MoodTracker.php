<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MoodEntry;
use Illuminate\Support\Facades\Auth;

class MoodTracker extends Component
{
    public $selectedMood = '';
    public $moodNote = '';
    public $showSuccess = false;
    public $moods = [
        'excited' => ['emoji' => '😄', 'label' => 'Excited', 'color' => 'from-yellow-400 to-orange-500'],
        'happy' => ['emoji' => '😊', 'label' => 'Happy', 'color' => 'from-green-400 to-blue-500'],
        'content' => ['emoji' => '😌', 'label' => 'Content', 'color' => 'from-blue-400 to-indigo-500'],
        'neutral' => ['emoji' => '😐', 'label' => 'Neutral', 'color' => 'from-gray-400 to-gray-500'],
        'tired' => ['emoji' => '😴', 'label' => 'Tired', 'color' => 'from-purple-400 to-pink-500'],
        'anxious' => ['emoji' => '😰', 'label' => 'Anxious', 'color' => 'from-red-400 to-pink-500'],
        'sad' => ['emoji' => '😢', 'label' => 'Sad', 'color' => 'from-indigo-400 to-purple-500'],
        'angry' => ['emoji' => '😠', 'label' => 'Angry', 'color' => 'from-red-500 to-orange-500'],
    ];

    public function selectMood($mood)
    {
        $this->selectedMood = $mood;
        $this->showSuccess = false;
    }

    public function saveMood()
    {
        if (empty($this->selectedMood)) {
            return;
        }

        try {
            // Check if user already has a mood entry for today
            $existingEntry = MoodEntry::where('user_id', Auth::id())
                ->where('date', now()->toDateString())
                ->first();

            if ($existingEntry) {
                // Update existing entry
                $existingEntry->update([
                    'mood' => $this->selectedMood,
                    'note' => $this->moodNote,
                ]);
            } else {
                // Create new entry
                MoodEntry::create([
                    'user_id' => Auth::id(),
                    'mood' => $this->selectedMood,
                    'note' => $this->moodNote,
                    'date' => now()->toDateString(),
                ]);
            }

            $this->showSuccess = true;

            // Reset form
            $this->selectedMood = '';
            $this->moodNote = '';

            // Show success message
            session()->flash('mood-success', 'Your mood has been recorded successfully!');
        } catch (\Exception $e) {
            session()->flash('mood-error', 'There was an error saving your mood. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.mood-tracker');
    }
}
