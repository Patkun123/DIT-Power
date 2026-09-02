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
            // Encouragement
            "Believe in yourself and all that you are.",
            "Every day is a second chance.",
            "Difficult roads often lead to beautiful destinations.",
            "Your only limit is your mind.",
            "Start where you are. Use what you have. Do what you can.",
            "Small progress is still progress.",
            "Push yourself, because no one else is going to do it for you.",
            "Dream it. Wish it. Do it.",
            "You are stronger than you think.",
            "Keep going. You are making progress.",
            "One step at a time is still moving forward.",
            "Don't give up. Your story isn't finished yet.",
            "You don't have to be perfect to make progress.",
            "Better days are ahead.",
            "Be proud of how far you've come.",
            "Your effort today builds your strength tomorrow.",
            "Even the smallest step forward matters.",
            "You can do hard things.",
            "Take a breath, reset, and try again.",
            "Progress takes patience. Keep going.",
            "You are capable of more than you realize.",
            "Don't let one difficult day define your journey.",
            "Your future needs the courage you have today.",
            "Keep believing. Keep growing. Keep moving.",
            "You have overcome difficult days before. You can do it again.",
            "It's okay to rest. Rest is part of the journey.",
            "Give yourself permission to start again.",
            "You are doing better than you think.",
            "Your journey is unique. Don't compare it to someone else's.",
            "Keep moving forward, even if the steps are small.",

            // Strength, hope, peace, and faith
            "I can do all things through Christ who strengthens me. - Philippians 4:13",
            "Be strong and courageous. Do not be afraid; do not be discouraged. - Joshua 1:9",
            "The Lord is my strength and my shield. - Psalm 28:7",
            "God is our refuge and strength, an ever-present help in trouble. - Psalm 46:1",
            "The Lord is my shepherd; I shall not want. - Psalm 23:1",
            "Those who hope in the Lord will renew their strength. - Isaiah 40:31",
            "My grace is sufficient for you, for my power is made perfect in weakness. - 2 Corinthians 12:9",
            "The Lord is my light and my salvation - whom shall I fear? - Psalm 27:1",
            "The Lord gives strength to his people; the Lord blesses his people with peace. - Psalm 29:11",
            "For I know the plans I have for you, plans to prosper you and not to harm you, plans to give you hope and a future. - Jeremiah 29:11",
            "Weeping may endure for a night, but joy comes in the morning. - Psalm 30:5",
            "May the God of hope fill you with all joy and peace as you trust in Him. - Romans 15:13",
            "The Lord is good, a refuge in times of trouble. - Nahum 1:7",
            "Cast all your anxiety on Him because He cares for you. - 1 Peter 5:7",
            "The Lord is near to all who call on Him. - Psalm 145:18",
            "When I am afraid, I put my trust in You. - Psalm 56:3",
            "Hope in the Lord; for with the Lord there is mercy. - Psalm 130:7",
            "Peace I leave with you; my peace I give you. - John 14:27",
            "Be still, and know that I am God. - Psalm 46:10",
            "Do not be anxious about anything, but in every situation, by prayer and petition, present your requests to God. - Philippians 4:6",
            "Come to me, all you who are weary and burdened, and I will give you rest. - Matthew 11:28",
            "Trust in the Lord with all your heart and lean not on your own understanding. - Proverbs 3:5",
            "The Lord will fight for you; you need only to be still. - Exodus 14:14",
            "Do not let your hearts be troubled. You believe in God; believe also in me. - John 14:1",

            // Perseverance and renewal
            "Let us not become weary in doing good, for at the proper time we will reap a harvest if we do not give up. - Galatians 6:9",
            "Consider it pure joy whenever you face trials of many kinds, because you know that the testing of your faith produces perseverance. - James 1:2-3",
            "Run with perseverance the race marked out for us. - Hebrews 12:1",
            "Blessed is the one who perseveres under trial. - James 1:12",
            "Let perseverance finish its work so that you may be mature and complete. - James 1:4",
            "I press on toward the goal to win the prize. - Philippians 3:14",
            "He heals the brokenhearted and binds up their wounds. - Psalm 147:3",
            "He gives strength to the weary and increases the power of the weak. - Isaiah 40:29",
            "He restores my soul. - Psalm 23:3",
            "Create in me a pure heart, O God, and renew a steadfast spirit within me. - Psalm 51:10",
            "Therefore, if anyone is in Christ, the new creation has come. - 2 Corinthians 5:17",
            "He refreshes my soul. He guides me along the right paths. - Psalm 23:3",

            // Gratitude, wisdom, kindness, and motivation
            "This is the day the Lord has made; let us rejoice and be glad in it. - Psalm 118:24",
            "Let all that you do be done in love. - 1 Corinthians 16:14",
            "Whatever you do, work at it with all your heart. - Colossians 3:23",
            "Give thanks to the Lord, for He is good; His love endures forever. - Psalm 107:1",
            "Give thanks in all circumstances; for this is God's will for you in Christ Jesus. - 1 Thessalonians 5:18",
            "Above all else, guard your heart, for everything you do flows from it. - Proverbs 4:23",
            "Your word is a lamp for my feet, a light on my path. - Psalm 119:105",
            "In all your ways acknowledge Him, and He will make your paths straight. - Proverbs 3:6",
            "The Lord directs the steps of the godly. - Psalm 37:23",
            "If any of you lacks wisdom, you should ask God, who gives generously to all. - James 1:5",
            "Above all, love each other deeply. - 1 Peter 4:8",
            "Be kind and compassionate to one another. - Ephesians 4:32",
            "Love is patient, love is kind. - 1 Corinthians 13:4",
            "And now these three remain: faith, hope and love. But the greatest of these is love. - 1 Corinthians 13:13",
            "Your current situation is not your final destination.",
            "Don't be afraid of slow progress. Be afraid of standing still.",
            "A difficult day does not mean a difficult life.",
            "You don't need to have everything figured out today.",
            "Give yourself the same encouragement you give to others.",
            "You are allowed to take things one day at a time.",
            "Every morning is another opportunity to begin again.",
            "Keep showing up for yourself.",
            "Your small victories deserve to be celebrated.",
            "You are growing through what you are going through.",
            "Sometimes making it through the day is an achievement.",
            "Choose hope, even when the road feels uncertain.",
            "Your journey matters.",
        ];

        $this->quote = $quotes[array_rand($quotes)];
    }

    public function render()
    {
        return view('livewire.quote-generator');
    }
}
