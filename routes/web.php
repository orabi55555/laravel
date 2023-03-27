<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', [TestController::class, 'test']);
Route::group(['middleware' => ['auth']],function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
// Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.edit');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/auth/{provider}/redirect",[SocialiteController::class,'redirect'])->name("auth.socilaite.redirect");
Route::get("/auth/{provider}/callback",[SocialiteController::class,'callback'])->name("auth.socilaite.callback");
Route::get("/auth/{provider}/info",[SocialiteController::class,'info'])->name("auth.socilaite.info");
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
   
       $githubUser = Socialite::driver('github')->user();
     
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
     
        Auth::login($githubUser);
 
    // $user->token
});

// Route::get('/auth/google', function () {
//     return Socialite::driver('google')->redirect();
// });
// Route::get('/auth/google/callback', function () {
//     $googleUser = Socialite::driver('google')->user();
//     $user = User::updateOrCreate(
//         ['email' => $googleUser->email],
//         [
//             'name' => $googleUser->name,
//             'password' => Hash::make(Str::random(24)), // generate a random password
//             'google_id' => $googleUser->id,
//             'google_token' => $googleUser->token,
//             'google_refresh_token' => $googleUser->refreshToken,
//         ]
//     );
//     Auth::login($user);
//     return redirect()->route('posts.index');
// });