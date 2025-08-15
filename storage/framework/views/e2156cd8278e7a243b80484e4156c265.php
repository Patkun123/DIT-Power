<?php

use Livewire\Volt\Actions;
use Livewire\Volt\CompileContext;
use Livewire\Volt\Contracts\Compiled;
use Livewire\Volt\Component;

new class extends Component implements Livewire\Volt\Contracts\FunctionalComponent
{
    public static CompileContext $__context;

    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public $questions;

    public $answers;

    public $phase;

    public $index;

    public $attempt;

    public $time;

    public $bestScore;

    public $isSubmitted;

    public function mount()
    {
        (new Actions\InitializeState)->execute(static::$__context, $this, get_defined_vars());

        (new Actions\CallHook('mount'))->execute(static::$__context, $this, get_defined_vars());
    }

    public function saveAnswers()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('saveAnswers'))->execute(...$arguments);
    }

    public function startQuiz()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('startQuiz'))->execute(...$arguments);
    }

    public function skipQuestion()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('skipQuestion'))->execute(...$arguments);
    }

    public function selectAnswer(int $id, string $letter, int $seconds)
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('selectAnswer'))->execute(...$arguments);
    }

};