<?php

namespace App\Livewire; // Livewire v3 — if v2 use App\Http\Livewire

use Livewire\Component;

class CountdownTimer extends Component
{
    public int $timeRemaining = 0;   // in seconds
    public bool $running = false;    // whether timer is active

    public function selectTime(int $minutes): void
    {
        $this->timeRemaining = $minutes * 60;
        $this->running = false;
        $this->dispatch('reset-bg');
    }

    public function start(): void
    {
        $this->running = true;
        $this->dispatch('play-audio');
    }

    public function resets(): void
    {
        $this->timeRemaining = 0;
        $this->running = false;
        $this->dispatch('reset-bg');
    }

    public function tick(): void
    {
        if ($this->running && $this->timeRemaining > 0) {
            $this->timeRemaining--;
        }
    }

    public function render()
    {
        return view('livewire.countdown-timer');
    }
}
