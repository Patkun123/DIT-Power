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
            "Dream it. Wish it. Do it.",
            "You are stronger than you know and more capable than you imagine.",
            "Every challenge is an opportunity to grow and become better.",
            "Your mental health is just as important as your physical health.",
            "It's okay to not be okay. What matters is that you keep moving forward.",
            "Self-care is not selfish; it's essential for your well-being.",
            "You have the power to change your thoughts and transform your life.",
            "Embrace your emotions; they are messengers trying to tell you something important.",
            "Progress, not perfection, is the goal.",
            "You are worthy of love, happiness, and all the good things life has to offer.",
            "Take it one day at a time, one breath at a time.",
            "Your feelings are valid, and it's okay to express them.",
            "Healing is not linear, but every step forward counts.",
            "You are not alone in your struggles; reach out when you need support.",
            "Practice self-compassion; treat yourself with the same kindness you'd show a friend.",
            "Your mental health journey is unique to you; honor your own pace.",
            "Remember: you have survived 100% of your worst days so far.",
            "Focus on what you can control and let go of what you cannot."
        ];

        $this->quote = $quotes[array_rand($quotes)];
    }

    public function render()
    {
        return view('livewire.quote-generator');
    }
}
