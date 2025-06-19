<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FoodRecommendationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DietInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\UserGuideController;
use Illuminate\Support\Facades\Route;

// Test route untuk Google OAuth (hapus di production)
if (app()->environment('local')) {
    Route::get('/test-google', function () {
        $config = config('services.google');
        
        return response()->json([
            'client_id' => $config['client_id'] ?? 'NOT SET',
            'client_secret' => $config['client_secret'] ? 'SET (Hidden)' : 'NOT SET', 
            'redirect' => $config['redirect'] ?? 'NOT SET',
            'app_url' => config('app.url'),
        ]);
    });
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk guest (tidak perlu login)
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/login', [AuthController::class, 'indexLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Google OAuth routes
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
    Route::get('/register', [AuthController::class, 'indexRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Rute untuk pengguna yang sudah login (auth)
Route::middleware('auth')->group(function () {
    // Logout (hanya satu rute, hindari duplikasi)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::match(['post', 'put'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Rute kuesioner (hanya untuk non-admin)
    Route::middleware('non-admin')->group(function () {
        Route::get('/questionnaire', [QuestionnaireController::class, 'index'])->name('questionnaire.index');
        Route::post('/questionnaire/step/{step}', [QuestionnaireController::class, 'store'])->name('questionnaire.store');
        Route::post('/questionnaire/back', [QuestionnaireController::class, 'back'])->name('questionnaire.back');
        Route::post('/questionnaire/submit', [QuestionnaireController::class, 'submit'])->name('questionnaire.submit');
        Route::get('/questionnaire/recommendation', [QuestionnaireController::class, 'recommendation'])->name('questionnaire.recommendation');
        Route::get('/diet-info', [DietInfoController::class, 'index'])->name('diet.info');
        Route::get('/user-guide', [UserGuideController::class, 'index'])->name('user.guide');
    });
});

// Rute untuk dashboard pengguna (auth + questionnaire)
Route::middleware(['auth', 'questionnaire'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/save-weight', [DashboardController::class, 'saveWeight'])->name('dashboard.saveWeight');
    Route::post('/dashboard/prev-day', [DashboardController::class, 'prevDay'])->name('dashboard.prevDay');
    Route::post('/dashboard/next-day', [DashboardController::class, 'nextDay'])->name('dashboard.nextDay');
    Route::post('/dashboard/set-day', [DashboardController::class, 'setDay'])->name('dashboard.setDay');
    Route::post('/dashboard/select-water-volume', [DashboardController::class, 'selectWaterVolume'])->name('dashboard.selectWaterVolume');
    Route::post('/dashboard/add-water', [DashboardController::class, 'addWater'])->name('dashboard.addWater');
    Route::post('/dashboard/reduce-water', [DashboardController::class, 'reduceWater'])->name('dashboard.reduceWater');
    Route::post('/dashboard/reset-water', [DashboardController::class, 'resetWater'])->name('dashboard.resetWater');
    Route::post('/dashboard/prev-articles', [DashboardController::class, 'prevArticles'])->name('dashboard.prevArticles');
    Route::post('/dashboard/next-articles', [DashboardController::class, 'nextArticles'])->name('dashboard.nextArticles');
    Route::post('/dashboard/consume-meal', [DashboardController::class, 'consumeMeal'])->name('dashboard.consumeMeal');
    Route::post('/dashboard/add-exercise-log', [DashboardController::class, 'addExerciseLog'])->name('dashboard.addExerciseLog');

    // Exercise Recommendations for user dashboard
    Route::get('/exercise-recommendations/{id}', [DashboardController::class, 'getExerciseDetail'])->name('exercise.detail');

    // User Articles routes
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
});

// Rute untuk admin (auth + admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update', 'destroy', 'create', 'store']);
    Route::post('/users/bulk', [UserController::class, 'bulk'])->name('users.bulk');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

    // Content routes
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::get('/content/articles', [ContentController::class, 'articles'])->name('content.articles');
    Route::get('/content/diet-info', [ContentController::class, 'dietInfo'])->name('content.diet-info');

    // Reports routes (placeholder)
    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('reports.index');

    // Settings routes (placeholder)
    Route::get('/settings', function () {
        return view('admin.settings.index');
    })->name('settings.index');

    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('food-recommendations', FoodRecommendationController::class);
    Route::resource('exercise-recommendations', App\Http\Controllers\Admin\ExerciseRecommendationController::class);
    Route::post('exercise-recommendations/{exerciseRecommendation}/toggle-status', [App\Http\Controllers\Admin\ExerciseRecommendationController::class, 'toggleStatus'])->name('exercise-recommendations.toggle-status');
});

Route::middleware(['auth', 'questionnaire'])->group(function () {
    // Route::get('/diet-info', fn() => view('diet-info'))->name('diet-info');
    // Route::get('/articles', fn() => view('articles'))->name('articles');
});
