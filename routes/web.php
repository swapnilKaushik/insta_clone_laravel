<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *  Route::get('/', function () {
 *      return view('welcome');
 *  });
 */

Auth::routes();

# Route::get('/home', [App\Http\Controllers\ProfilesController::class, 'index'])->name('home'); 

Route::get('/email', function() {
    return new App\Mail\NewUserWelcomeMail();
});

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::post('/l/{post}/{user}', [App\Http\Controllers\LikesController::class, 'store']);
Route::post('/c/{post}/{user}', [App\Http\Controllers\CommentsController::class, 'store']);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
# display the updated profile
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
# update the profile
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

/*
    Route::post('/follow/{user}', function() {
        return ['success'];
    });
*/
Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);