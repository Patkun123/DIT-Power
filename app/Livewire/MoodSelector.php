<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\MoodTracking;
use Carbon\Carbon;

class MoodSelector extends Component
{
    public $selectedMood = null;

    public function mount()
    {
        // Load today's mood if exists
        if (Auth::check()) {
            $todayMood = MoodTracking::where('user_id', Auth::id())
                ->whereDate('tracked_date', Carbon::today())
                ->latest()
                ->first();

            if ($todayMood) {
                $this->selectedMood = $todayMood->mood;
            }
        }
    }

    public function selectMood($mood)
    {
        $this->selectedMood = $mood;

        // Save to database if user is authenticated
        if (Auth::check()) {
            MoodTracking::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'tracked_date' => Carbon::today(),
                ],
                [
                    'mood' => $mood,
                ]
            );
        }

        $this->dispatch('moodSelected', mood: $mood); // notify parent
    }

    public function render()
    {
        return view('livewire.mood-selector');
    }
}
