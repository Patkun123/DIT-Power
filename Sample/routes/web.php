<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\QuestionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quiz/{level}/start', [QuizController::class, 'start'])->name('quiz.start'); // details + Start button
    Route::get('/quiz/{level}/take', [QuizController::class, 'take'])->name('quiz.take');   // quiz page (timer)
    Route::post('/quiz/{level}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/leaderboard', [QuizController::class, 'leaderboard'])->name('quiz.leaderboard');
});



// Group admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('quizzes', [QuestionController::class, 'quizList'])->name('admin.quizzes.index');
    Route::get('quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('admin.questions.store');
});



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
