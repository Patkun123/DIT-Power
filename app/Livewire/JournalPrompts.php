<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\Auth;

class JournalPrompts extends Component
{
    public $currentPrompt = '';
    public $promptCategory = 'general';
    public $userResponse = '';
    public $showResponse = false;

    public $prompts = [
        'general' => [
            "What are three things you're grateful for today?",
            "Describe a moment today when you felt truly happy.",
            "What challenge did you face today, and how did you handle it?",
            "Write about someone who made a positive impact on your day.",
            "What's one thing you learned about yourself today?",
            "Describe your ideal day from start to finish.",
            "What emotions did you experience today, and why?",
            "Write about a goal you're working towards and your progress.",
            "What made you smile or laugh today?",
            "How did you take care of yourself today?"
        ],
        'emotional' => [
            "What emotion are you feeling most strongly right now?",
            "Describe a time when you felt overwhelmed and how you coped.",
            "What triggers your stress, and how can you manage it better?",
            "Write about a time you felt proud of yourself.",
            "What does self-care mean to you, and how do you practice it?",
            "Describe a difficult conversation you had and how it made you feel.",
            "What boundaries do you need to set in your life?",
            "Write about a fear you're working to overcome.",
            "How do you show yourself compassion when you make mistakes?",
            "What brings you peace and calm in your daily life?"
        ],
        'reflection' => [
            "What patterns do you notice in your thoughts and behaviors?",
            "How have you grown or changed in the past year?",
            "What values are most important to you, and how do you live them?",
            "Write about a decision you made that changed your life.",
            "What would you tell your younger self if you could?",
            "How do you want to be remembered by the people you love?",
            "What legacy do you want to leave behind?",
            "Describe your perfect relationship with yourself.",
            "What would you do if you weren't afraid of failing?",
            "How do you want to feel at the end of each day?"
        ],
        'gratitude' => [
            "What small moment today brought you joy?",
            "Write about someone who has supported you recently.",
            "What aspect of your health are you grateful for?",
            "Describe a place that makes you feel peaceful and grateful.",
            "What skill or talent are you grateful to have?",
            "Write about a lesson you learned from a difficult experience.",
            "What about your current living situation are you grateful for?",
            "Describe a book, movie, or song that touched your heart.",
            "What opportunity are you grateful to have had recently?",
            "Write about a tradition or ritual that brings you comfort."
        ]
    ];

    public function mount()
    {
        $this->getNewPrompt();
    }

    public function getNewPrompt()
    {
        $categoryPrompts = $this->prompts[$this->promptCategory];
        $this->currentPrompt = $categoryPrompts[array_rand($categoryPrompts)];
        $this->userResponse = '';
        $this->showResponse = false;
    }

    public function setCategory($category)
    {
        $this->promptCategory = $category;
        $this->getNewPrompt();
    }

    public function saveResponse()
    {
        if (empty($this->userResponse)) {
            return;
        }

        try {
            JournalEntry::create([
                'user_id' => Auth::id(),
                'category' => $this->promptCategory,
                'prompt' => $this->currentPrompt,
                'response' => $this->userResponse,
                'is_private' => true,
            ]);

            $this->showResponse = true;
            $this->userResponse = '';

            // Show success message
            session()->flash('journal-success', 'Your journal entry has been saved successfully!');
        } catch (\Exception $e) {
            session()->flash('journal-error', 'There was an error saving your entry. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.journal-prompts');
    }
}
