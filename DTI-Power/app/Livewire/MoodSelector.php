<?php
namespace App\Livewire;

use Livewire\Component;

class MoodSelector extends Component
{
    public $selectedMood = null;

    public function selectMood($mood)
    {
        $this->selectedMood = $mood;
        $this->dispatch('moodSelected', mood: $mood); // notify parent
    }

    public function render()
    {
        return view('livewire.mood-selector');
    }
}
