<?php

namespace App\Livewire;

use Livewire\Component;

class QuoteGenerator extends Component
{
    public $quote;

    public function mount()
    {
        $this->generateQuote();
    }

    public function generateQuote()
    {
        $quotes = [
            "Believe in yourself and all that you are.",
            "Every day is a second chance.",
            "Difficult roads often lead to beautiful destinations.",
            "Your only limit is your mind.",
            "Start where you are. Use what you have. Do what you can.",
            "Small progress is still progress.",
            "Push yourself, because no one else is going to do it for you.",
            "Dream it. Wish it. Do it."
        ];

        $this->quote = $quotes[array_rand($quotes)];
    }

    public function render()
    {
        return view('livewire.quote-generator');
    }
}
