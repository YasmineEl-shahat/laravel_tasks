<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts', [PostController::class, 'index']) -> name('posts.index')->middleware('auth');

Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('/posts/create', [PostController::class, 'create']) -> name('posts.create');
        Route::post('/posts/store', [PostController::class, 'store']) -> name('posts.store');
        Route::get('/posts/edit/{id}', [PostController::class, 'edit']) -> name('posts.edit');
        Route::put('/posts/update/{id}', [PostController::class, 'update']) -> name('posts.update');
        Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy']) -> name('posts.destroy');
        Route::get('/posts/{post}', [PostController::class, 'show']) -> name('posts.show');
        Route::post("/comments/store", [CommentController::class, 'store'])->name('comments.store');
    }
);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/auth/redirect/github', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback/github', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    // we may use github token to access repos
    // Http::get('/api.github.com/repositories', [$githubUser->token]);
    return redirect(to:'/posts');
});
