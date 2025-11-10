<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\AdminQuizController;
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
use App\Http\Controllers\ScrambleWordController;
use App\Http\Controllers\SocialController;

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


    //Quiz Management
    Route::get('ManageQuiz', [AdminQuizController::class, 'index'])->name('managequiz');
    Route::get('quizzes/create', [AdminQuizController::class, 'create'])->name('admin.quizzes.create');
    Route::post('quizzes', [AdminQuizController::class, 'store'])->name('admin.quizzes.store');
    Route::get('quizzes/{quiz}', [AdminQuizController::class, 'show'])->name('admin.quizzes.show');
    Route::get('quizzes/{quiz}/edit', [AdminQuizController::class, 'edit'])->name('admin.quizzes.edit');
    Route::put('quizzes/{quiz}', [AdminQuizController::class, 'update'])->name('admin.quizzes.update');
    Route::delete('quizzes/{quiz}', [AdminQuizController::class, 'destroy'])->name('admin.quizzes.destroy');
    Route::get('quizzes/{quiz}/questions', [AdminQuizController::class, 'questions'])->name('admin.quizzes.questions');
    Route::get('quizzes/{quiz}/questions/create', [AdminQuizController::class, 'createQuestion'])->name('admin.quizzes.questions.create');
    Route::post('quizzes/{quiz}/questions', [AdminQuizController::class, 'storeQuestion'])->name('admin.quizzes.questions.store');
    Route::get('quizzes/{quiz}/questions/{question}/edit', [AdminQuizController::class, 'editQuestion'])->name('admin.quizzes.questions.edit');
    Route::put('quizzes/{quiz}/questions/{question}', [AdminQuizController::class, 'updateQuestion'])->name('admin.quizzes.questions.update');
    Route::delete('quizzes/{quiz}/questions/{question}', [AdminQuizController::class, 'destroyQuestion'])->name('admin.quizzes.questions.destroy');
            Route::get('quizzes/{quiz}/statistics', [AdminQuizController::class, 'statistics'])->name('admin.quizzes.statistics');

            // Quiz Sets Management
            Route::get('quizzes/{quiz}/sets', [AdminQuizController::class, 'sets'])->name('admin.quizzes.sets');
            Route::get('quizzes/{quiz}/sets/create', [AdminQuizController::class, 'createSet'])->name('admin.quizzes.sets.create');
            Route::post('quizzes/{quiz}/sets', [AdminQuizController::class, 'storeSet'])->name('admin.quizzes.sets.store');
            Route::get('quizzes/{quiz}/sets/{set}/edit', [AdminQuizController::class, 'editSet'])->name('admin.quizzes.sets.edit');
            Route::put('quizzes/{quiz}/sets/{set}', [AdminQuizController::class, 'updateSet'])->name('admin.quizzes.sets.update');
            Route::delete('quizzes/{quiz}/sets/{set}', [AdminQuizController::class, 'destroySet'])->name('admin.quizzes.sets.destroy');

    // Scramble words management
    Route::get('manage-scramble-words', [ScrambleWordController::class, 'index'])->name('admin.scramble-words.index');
    Route::post('manage-scramble-words', [ScrambleWordController::class, 'store'])->name('admin.scramble-words.store');
    Route::put('manage-scramble-words/{scrambleWord}', [ScrambleWordController::class, 'update'])->name('admin.scramble-words.update');
    Route::delete('manage-scramble-words/{scrambleWord}', [ScrambleWordController::class, 'destroy'])->name('admin.scramble-words.destroy');

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
    Route::get('quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
    Route::get('quiz/{quiz}/set/{set}', [QuizController::class, 'showSet'])->name('quiz.set.show');
    Route::post('quiz/{quiz}/set/{set}/submit', [QuizController::class, 'submit'])->name('quiz.set.submit');
    Route::get('quiz/result/{attempt}', [QuizController::class, 'result'])->name('quiz.result');
    Route::get('quiz/history', [QuizController::class, 'history'])->name('quiz.history');

    // Scramble game (UI similar to quiz)
    Route::view('scramble', 'auth.users.view.scramble')->name('scramble');

    Route::get('Physical-tools', [ToolsController::class, 'index'])->name('physical.tools');
    Route::post('physical-tools', [ToolsController::class, 'calculate'])->name('calculate.bmi');
    Route::post('physical-tools/meditation', [ToolsController::class, 'start'])->name('meditation.start');
    Route::post('/meditation/stop', [ToolsController::class, 'stop'])->name('meditation.stop');

    Route::get('Policies', [PdfController::class, 'index'])->name('policies');

    // Route::view('Policies', 'Auth.users.view.policies')->name('policies');
    // Route::view('Feedbacks', 'Auth.user.view.policies')->name('policies');

    Route::view('Financial-tools','auth.users.view.financial')->name('financial.tools');
    Route::view('mental-tools','auth.users.view.mental')->name('mental.tools');
    Route::get('emotional-tools',[emotional::class, 'index'])->name('emotional.tools');
    Route::get('social',[SocialController::class, 'index'])->name('social.tools');
    Route::get('social/{post}',[SocialController::class, 'show'])->name('social.show');
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
