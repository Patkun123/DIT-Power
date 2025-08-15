<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArticleandNewsController;
use App\Http\Controllers\JournalsController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserIndexController;
use App\Http\Controllers\UserInformationController;
use App\Http\Controllers\usertrackingController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware([
    'guest',        // Laravel's built-in authentication check
    'check_profile' // Your custom middleware to check if the user profile is complete
])->name('home');
Route::get('about', function () {
    return view('about');
})->middleware(['guest'])->name('about');

Route::middleware(['auth', 'is_admin:admin'])->group(function () {
    Route::get('Dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    //user managements
    Route::get('/Manage-users', [UserInformationController::class, 'index'])->name('manage.user');
    Route::post('/Manage-users', [UserInformationController::class, 'store'])->name('users.store');


    //user tracking
    Route::get('Users/Tracking', [usertrackingController::class, 'index'])->name('users.tracking');

    //article and news
    Route::get('article',[ArticleandNewsController::class, 'index'])->name('article');
    Route::post('article', [ArticleandNewsController::class, 'store'])->name('news-articles.store');
    Route::put('article/{news_article}', [ArticleandNewsController::class, 'update'])->name('news.update');
    Route::delete('article/{news_article}', [ArticleandNewsController::class, 'destroy'])->name('news-articles.destroy');


    //Quiz
    Route::view('ManageQuiz', 'Auth.Admin.view.managequiz')->name('managequiz');
});

Route::middleware(['auth','check_profile'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/index',[UserIndexController::class, 'index'])->name('index');

    Route::get('Journal', [JournalsController::class, 'index'])->name('journal');
    Route::post('Journal', [JournalsController::class, 'store'])->name('journal.store');

    Route::get('Nutrition', [NutritionController::class, 'index'])->name('nutrition');
    Route::get('quiz', [QuizController::class, 'index'])->name('quiz');

    Route::get('Physical-tools', [ToolsController::class, 'index'])->name('physical.tools');
    Route::post('physical-tools', [ToolsController::class, 'calculate'])->name('calculate.bmi');
    Route::post('physical-tools/meditation', [ToolsController::class, 'start'])->name('meditation.start');
    Route::post('/meditation/stop', [ToolsController::class, 'stop'])->name('meditation.stop');

    Route::view('Policies', 'Auth.user.view.policies')->name('policies');

});

require __DIR__.'/auth.php';
