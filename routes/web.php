<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\ArticleandNewsController;
use App\Http\Controllers\emotional;
use App\Http\Controllers\JournalsController;
use App\Http\Controllers\leaderboards;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserIndexController;
use App\Http\Controllers\UserInformationController;
use App\Http\Controllers\usertrackingController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Notifications\RealtimeTestNotification;
use App\Http\Livewire\FinanceDashboard;

Route::get('/', function () {
    return view('home');
})->middleware([
    'guest',        // Laravel's built-in authentication check
    'check_profile' // Your custom middleware to check if the user profile is complete
])->name('home');
Route::get('about', function () {
    return view('about');
})->middleware(['guest'])->name('about');

Route::get('loading-demo', function () {
    return view('loading-demo');
})->name('loading.demo');

Route::middleware(['auth', 'is_admin:admin'])->group(function () {
    Route::get('Dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    //user managements
    Route::get('/Manage-users', [UserInformationController::class, 'index'])->name('manage.user');
    Route::post('/Manage-users', [UserInformationController::class, 'store'])->name('users.store');
    Route::put('/Manage-users/{user}', [UserInformationController::class, 'update'])->name('users.update');
    Route::delete('/Manage-users/{user}', [UserInformationController::class, 'destroy'])->name('users.destroy');


    //user tracking
    Route::get('Users/Tracking', [usertrackingController::class, 'index'])->name('users.tracking');

    //article and news
    Route::get('article',[ArticleandNewsController::class, 'index'])->name('article');
    Route::post('article', [ArticleandNewsController::class, 'store'])->name('news-articles.store');
    Route::put('article/{news_article}', [ArticleandNewsController::class, 'update'])->name('news.update');
    Route::delete('article/{news_article}', [ArticleandNewsController::class, 'destroy'])->name('news-articles.destroy');


    //Quiz
    Route::view('ManageQuiz', 'Auth.Admin.view.managequiz')->name('managequiz');

    //Feedback Management
    Route::get('feedbacks', [AdminFeedbackController::class, 'index'])->name('admin.feedbacks.index');
    Route::get('feedbacks/{feedback}', [AdminFeedbackController::class, 'show'])->name('admin.feedbacks.show');
    Route::delete('feedbacks/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('admin.feedbacks.destroy');
    Route::get('feedbacks/export/csv', [AdminFeedbackController::class, 'export'])->name('admin.feedbacks.export');
});

Route::middleware(['auth','check_profile'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/index',[UserIndexController::class, 'index'])->name('index');
    Route::post('/index/feed',[UserIndexController::class, 'store'])->name('feedback.store');

    Route::get('Journal', [JournalsController::class, 'index'])->name('journal');
    Route::post('Journal', [JournalsController::class, 'store'])->name('journal.store');
    Route::delete('journals/{journal}', [JournalsController::class, 'destroy'])->name('journals.destroy');
    Route::put('journals/{journal}', [JournalsController::class, 'update'])->name('journals.update');



    Route::get('Nutrition', [NutritionController::class, 'index'])->name('nutrition');
    Route::get('quiz', [QuizController::class, 'index'])->name('quiz');

    Route::get('Physical-tools', [ToolsController::class, 'index'])->name('physical.tools');
    Route::post('physical-tools', [ToolsController::class, 'calculate'])->name('calculate.bmi');
    Route::post('physical-tools/meditation', [ToolsController::class, 'start'])->name('meditation.start');
    Route::post('/meditation/stop', [ToolsController::class, 'stop'])->name('meditation.stop');

    Route::get('Policies', [PdfController::class, 'index'])->name('policies');

    // Route::view('Policies', 'Auth.users.view.policies')->name('policies');
    // Route::view('Feedbacks', 'Auth.user.view.policies')->name('policies');

    Route::view('Financial-tools','Auth.users.view.financial')->name('financial.tools');
    Route::view('mental-tools','Auth.users.view.mental')->name('mental.tools');
    Route::get('emotional-tools',[emotional::class, 'index'])->name('emotional.tools');
    Route::view('social-tools','Auth.users.view.social')->name('social.tools');
    Route::get('leaderboard', [leaderboards::class, 'index'])->name('leaderboards');

    // Quick test route to trigger a realtime broadcast notification for the current user
    Route::get('notify-test', function() {
        $user = auth()->user();
        if (!$user) {
            abort(403);
        }
        $user->notify(new RealtimeTestNotification());
        return back()->with('status', 'Notification sent');
    })->name('notify.test');

});

require __DIR__.'/auth.php';
